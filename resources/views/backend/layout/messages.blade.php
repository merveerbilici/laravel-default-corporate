@if ($errors->any())
<div class="alert alert-custom alert-outline-2x alert-outline-danger fade show mb-5" role="alert">
    <div class="alert-icon"><i class="flaticon-warning"></i></div>
    @foreach ($errors->all() as $error)
    <div class="alert-text">{{ $error }}</div>
    @endforeach
    <div class="alert-close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"><i class="ki ki-close"></i></span>
        </button>
    </div>
</div>
@endif

@if(Session::has('error'))
<div class="alert alert-danger" role="alert">
    {{Session::get('error')}}
</div>
 @endif
@if(Session::has('success'))
<div class="alert alert-success" role="alert">
    {{Session::get('success')}}
</div>
 @endif