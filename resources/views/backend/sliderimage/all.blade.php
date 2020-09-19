@extends('backend.layout.master')

@section('title', 'Slayt Görselleri')

@section('breadcrumb')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
  	<!--begin::Info-->
  	<div class="d-flex align-items-center flex-wrap mr-1">
    	<!--begin::Page Heading-->
    	<div class="d-flex align-items-baseline flex-wrap mr-5">
        <!--begin::Page Title-->
        <h5 class="text-dark font-weight-bold my-1 mr-5">Slayt Görselleri</h5>
        <!--end::Page Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        	<li class="breadcrumb-item">
        	  <a href="{{route('get.index.admin')}}" class="text-muted">Anasayfa</a>
        	</li>
        	<li class="breadcrumb-item">
        	  <a href="" class="text-muted">Slayt Görselleri</a>
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
          <h3 class="card-label">Slayt Görselleri</h3>
        </div>
        <div class="card-toolbar">
          <a href="{{route('slider-image.create')}}" class="btn btn-sm btn-light-success font-weight-bold">
            <i class="flaticon2-plus"></i> Görsel Ekle
          </a>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-hover mb-6">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Görsel</th>
              <th scope="col">Başlık</th>
              <th scope="col">Açıklama</th>
              <th scope="col">Sırası</th>
              <th scope="col">Aktif Mi?</th>
              <th scope="col">İşlemler</th>
            </tr>
          </thead>
          <tbody>
            @foreach($sliderimages as $sliderimage)
            <tr>
              <th scope="row">{{$sliderimage->id}}</th>
              <td><img src="/upload/slider/{{$sliderimage->image}}" class="h-10 align-self-end"></td>
              <td>{{$sliderimage->title}}</td>
              <td>{{$sliderimage->description}}</td>
              <td>{{$sliderimage->order}}</td>
              <td>
                @if($sliderimage->is_active)
                <span class="label label-inline label-light-success font-weight-bold">Aktif</span>
                @else
                <span class="label label-inline label-light-danger font-weight-bold">Aktif Değil</span>
                @endif
              </td>
              <td>
                <a href="{{route('slider-image.edit', ['id' => $sliderimage->id])}}" class="btn btn-sm btn-light-primary font-weight-bold mr-2">Düzenle</a>
                <button type="button" class="btn btn-sm btn-light-danger font-weight-bold mr-2 destroy" data-id="{{$sliderimage->id}}">Sil</button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{$sliderimages->links()}}
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
      var url = '{{ route("slider-image.destroy", ":id") }}';

      url = url.replace(':id', id);

      window.location.href = url;
      
    } 
  });
});
</script>
@endsection