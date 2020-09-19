@extends('backend.layout.master')

@section('title', 'Slayt Görseli Düzenle')

@section('breadcrumb')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
  	<!--begin::Info-->
  	<div class="d-flex align-items-center flex-wrap mr-1">
    	<!--begin::Page Heading-->
    	<div class="d-flex align-items-baseline flex-wrap mr-5">
        <!--begin::Page Title-->
        <h5 class="text-dark font-weight-bold my-1 mr-5">Slayt Görseli Düzenle</h5>
        <!--end::Page Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        	<li class="breadcrumb-item">
        	  <a href="{{route('get.index.admin')}}" class="text-muted">Anasayfa</a>
        	</li>
          <li class="breadcrumb-item">
            <a href="{{route('slider-image.index')}}" class="text-muted">Slayt Görselleri</a>
          </li>
          <li class="breadcrumb-item">
            <a href="" class="text-muted">Slayt Görseli Düzenle</a>
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
    <div class="card card-custom gutter-b example example-compact">
      <div class="card-header">
        <h3 class="card-title">Slayt Görseli Düzenle</h3>
      </div>
      <!--begin::Form-->
      <form method="POST" action="{{route('slider-image.update', ['id' => $sliderimage->id])}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="card-body">
          <div class="form-group">
            <label for="title">Başlığı <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Adı" name="title" id="title" required value="{{ old('title') ? old('title') : $sliderimage->title }}" maxlength="255" />
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="description">Açıklama <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('description') is-invalid @enderror" placeholder="Adı" name="description" id="description" required value="{{ old('description') ? old('description') : $sliderimage->description }}" maxlength="255" />
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="row">
            <div class="col-4">
              <div class="form-group">
                <label for="images">Görseli </label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input @error('images') is-invalid @enderror" id="images" name="images" />
                  <label class="custom-file-label" for="images">Dosya Seçin</label>
                </div>
                @error('images')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="order">Sırası <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('order') is-invalid @enderror" placeholder="Sırası" name="order" id="order" required value="{{ old('order') ? old('order') : $sliderimage->order }}" />
                @error('order')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="is_active">Aktif mi? <span class="text-danger">*</span></label>
                <select class="form-control" id="is_active" name="is_active">
                  <option value="1" {{ old('is_active') == 1 || $sliderimage->is_active == 1 ? 'selected' : '' }}>Aktif</option>
                  <option value="0" {{ (old('is_active') && old('is_active') == 0) || $sliderimage->is_active == 0 ? 'selected' : '' }}>Aktif Değil</option>
                </select>
                @error('is_active')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
          <div class="form-group">
            @if($sliderimage->image != null)
            <img src="/upload/slider/{{$sliderimage->image}}" class="h-150px align-self-end">
            @endif
          </div>
          
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary mr-2">Kaydet</button>
        </div>
      </form>
      <!--end::Form-->
    </div>
    <!--end::Card-->
  </div>
</div>
@endsection