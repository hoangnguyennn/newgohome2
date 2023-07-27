@if (session('success'))
    <div class="container">
        <div class="alert alert-success my-5" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

@if (session('danger'))
    <div class="container">
        <div class="alert alert-danger my-5" role="alert">
            {{ session('danger') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

@if (session('warning'))
    <div class="container">
        <div class="alert alert-warning my-5" role="alert">
            {{ session('warning') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

@if ($errors->has('fullname') || $errors->has('email') || $errors->has('password'))
    <div class="container">
        <div class="alert alert-warning my-5" role="alert">
            @if ($errors->has('fullname'))
                {{ $errors->first('fullname') }}
            @endif

            @if ($errors->has('email'))
                {{ $errors->first('email') }}
            @endif

            @if ($errors->has('password'))
                {{ $errors->first('password') }}
            @endif

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif
