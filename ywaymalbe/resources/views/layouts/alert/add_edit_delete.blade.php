<div class="x_content bs-example-popovers">
    @if(Session::has('Added'))
        <div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong></strong> {{ Session::get('Added') }}
        </div>
    @endif

    @if(Session::has('Updated'))
            <div class="alert alert-info alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong></strong> {{ Session::get('Updated') }}
            </div>
        @endif
        @if(Session::has('Deleted'))
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong></strong> {{ Session::get('Deleted') }}
            </div>
        @endif

</div>