<?php

namespace App\Http\Controllers;

use App\Socialviewers;
use App\Viewer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiauthController extends Controller
{
    //reg for viewers
    public function __construct()
    {
//        $this->middleware('auth:api',['except'=>['register']]);
    }

    public function register(Request $request)
    {

        if(Viewer::where('provider_user_id',$request->userData['provider_user_id'])->count() > 0 or Viewer::where('email',$request->userData['email'])->count() > 0 ) {
             Viewer::where('email',$request->userData['email'])->update([
                'provider_user_id' => $request->userData['provider_user_id'],
//           'mobile' => $request->userData['mobile']
            ]);
            $viewer_from_database = Viewer::where('provider_user_id', $request->userData['provider_user_id'])->first();

            $token = $viewer_from_database->createToken('server_access_token')->accessToken;

            return response()->json(['token' => $token]);
        }
        else {


            //check request data from react
            $valid = validator::make($request->userData, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:viewers',
                'provider' => 'required',
                'provider_user_id' => 'required',
                'profile_picture' => 'required',
                'token' => 'required'
//            'password' => 'required|string|min:6',
//            'mobile' => 'required',
            ]);

            if ($valid->fails()) {
                $jsonError = response()->json($valid->errors()->all(), 400);
                return \Response::json($jsonError);
            }
//no need to hash this password because in auth config alreadey set hash true
            $tmppassword = 'temp' . mt_rand(100000, 999999);
            $user = Viewer::create([
                'name' => $request->userData['name'],
                'email' => $request->userData['email'],
                'provider_user_id' => $request->userData['provider_user_id'],
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make($tmppassword),
//           'mobile' => $request->userData['mobile']
            ]);

            //re get this user data from database
            $viewer_from_database = Viewer::where('provider_user_id', $request->userData['provider_user_id'])->first();
            if ($viewer_from_database) {
                $socialviewersdata = Socialviewers::create([
                    'user_id' => $viewer_from_database->id,
                    'provider_user_id' => $request->userData['provider_user_id'],
                    'provider' => $request->userData['provider'],
//                'token' =>  'test',
                    'profile_picture' => $request->userData['profile_picture']
//           'mobile' => $request->userData['mobile']
                ]);

                //and check this user password because auth guard passpord is not support laravel auth attempt function
                if (Hash::check($tmppassword, $viewer_from_database->password)) {
                    $user = $viewer_from_database;
                    $token = $user->createToken('server_access_token')->accessToken;
                    return response()->json(['token' => $token]);

                } else {
                    return response()->json(['email' => $request->userData['email']]);
                }
            } else {
                return response()->json(['email' => $request->userData['email']]);

            }
//        return response()->json(['email' =>$request->userData['email']]);

        }

    }

    public function check_token(){
        if(Auth::guard('api')->user()){
            $statuse='yes';
        }else{
//            $statuse='no';//real
            $statuse='yes';

        }
        return response()->json($statuse);
    }


}
