@extends('backend.layout.master')

@section('title', 'Ürünler')

@section('breadcrumb')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
  	<!--begin::Info-->
  	<div class="d-flex align-items-center flex-wrap mr-1">
    	<!--begin::Page Heading-->
    	<div class="d-flex align-items-baseline flex-wrap mr-5">
        <!--begin::Page Title-->
        <h5 class="text-dark font-weight-bold my-1 mr-5">Ürünler</h5>
        <!--end::Page Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        	<li class="breadcrumb-item">
        	  <a href="{{route('get.index.admin')}}" class="text-muted">Anasayfa</a>
        	</li>
        	<li class="breadcrumb-item">
        	  <a href="" class="text-muted">Ürünler</a>
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
          <h3 class="card-label">Ürünler</h3>
        </div>
        <div class="card-toolbar">
          <a href="{{route('product-category.index')}}" class="btn btn-sm btn-light-primary font-weight-bold mr-2">
            <i class="flaticon2-list-2"></i> Kategoriler
          </a>
          <a href="{{route('product.create')}}" class="btn btn-sm btn-light-success font-weight-bold">
            <i class="flaticon2-plus"></i> Ürün Ekle
          </a>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-hover mb-6">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Görsel</th>
              <th scope="col">Kategori</th>
              <th scope="col">Başlık</th>
              <th scope="col">Sırası</th>
              <th scope="col">Aktif Mi?</th>
              <th scope="col">Göster/Gizle</th>
              <th scope="col">İşlemler</th>
            </tr>
          </thead>
          <tbody>
            @foreach($products as $product)
            <tr>
              <th scope="row">{{$product->id}}</th>
              <td><img src="/upload/product/{{$product->image}}" class="h-10 align-self-end"></td>
              <td>{{@$product->category->name}}</td>
              <td>{{$product->title}}</td>
              <td>{{$product->order}}</td>
              <td>
                @if($product->is_active)
                <span class="label label-inline label-light-success font-weight-bold">Aktif</span>
                @else
                <span class="label label-inline label-light-danger font-weight-bold">Aktif Değil</span>
                @endif
              </td>
              <td>
                @if($product->show_index)
                <span class="label label-light-success label-inline">Anasayfa</span> 
                @else
                <span class="label label-light-danger label-inline">Anasayfa</span>
                @endif
                @if($product->show_header)
                <span class="label label-light-success label-inline">Header</span> 
                @else
                <span class="label label-light-danger label-inline">Header</span>
                @endif
                @if($product->show_footer)
                <span class="label label-light-success label-inline">Footer</span> 
                @else
                <span class="label label-light-danger label-inline">Footer</span>
                @endif
              </td>
              <td>
                <a href="{{route('product.edit', ['id' => $product->id])}}" class="btn btn-sm btn-light-primary font-weight-bold mr-2">Düzenle</a>
                <button type="button" class="btn btn-sm btn-light-danger font-weight-bold mr-2 destroy" data-id="{{$product->id}}">Sil</button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{$products->links()}}
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
      var url = '{{ route("product.destroy", ":id") }}';

      url = url.replace(':id', id);

      window.location.href = url;
      
    } 
  });
});
</script>
@endsection