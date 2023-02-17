@if(Session::has('flash-message-success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        {!! session('flash-message-success') !!}
    </div>
@endif

@if(Session::has('flash-message-error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        {!! session('flash-message-error') !!}
    </div>
@endif