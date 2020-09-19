@extends('backend.layout.master')

@section('title', 'Kullanıcılar')

@section('breadcrumb')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
  	<!--begin::Info-->
  	<div class="d-flex align-items-center flex-wrap mr-1">
    	<!--begin::Page Heading-->
    	<div class="d-flex align-items-baseline flex-wrap mr-5">
        <!--begin::Page Title-->
        <h5 class="text-dark font-weight-bold my-1 mr-5">Kullanıcılar</h5>
        <!--end::Page Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        	<li class="breadcrumb-item">
        	  <a href="{{route('get.index.admin')}}" class="text-muted">Anasayfa</a>
        	</li>
        	<li class="breadcrumb-item">
        	  <a href="" class="text-muted">Kullanıcılar</a>
        	</li>
        </ul>
        <!--end::Breadcrumb-->
    	</div>
    	<!--end::Page Heading-->
  	</div>
  	<!--end::Info-->
	</div>
</div>
<!--end::Subheader-->
@endsection

@section('content')
<div class="row">
  <div class="col">
    <!--begin::Card-->
    <div class="card card-custom gutter-b">
      <div class="card-header">
        <div class="card-title">
          <h3 class="card-label">Kullanıcılar</h3>
        </div>
        <div class="card-toolbar">
          <a href="{{route('user.create')}}" class="btn btn-sm btn-light-success font-weight-bold">
            <i class="flaticon2-plus"></i> Kullanıcı Ekle
          </a>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-hover mb-6">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Görsel</th>
              <th scope="col">Adı Soyadı</th>
              <th scope="col">Emaili</th>
              <th scope="col">İşlemler</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            <tr>
              <th scope="row">{{$user->id}}</th>
              <td><img src="/upload/user/{{$user->profile_photo}}" class="h-10 align-self-end"></td>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>
                <a href="{{route('user.edit', ['id' => $user->id])}}" class="btn btn-sm btn-light-primary font-weight-bold mr-2">Düzenle</a>
                @if($user->id != 1)
                <button type="button" class="btn btn-sm btn-light-danger font-weight-bold mr-2 destroy" data-id="{{$user->id}}">Sil</button>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{$users->links()}}
      </div>
    </div>
    <!--end::Card-->
  </div>
</div>
@endsection

@section('scripts')
<script>
$(".destroy").click(function(e) {
  var id = $(this).data('id');

  Swal.fire({
    title: "Silmek istediğine emin misin?",
    text: "",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Evet",
    cancelButtonText: "Hayır!",
    reverseButtons: true
  }).then(function(result) {
    if (result.value) {
      var url = '{{ route("user.destroy", ":id") }}';

      url = url.replace(':id', id);

      window.location.href = url;
      
    } 
  });
});
</script>
@endsection