@extends('backend.layout.master')

@section('title', 'Hizmet Ekle')

@section('breadcrumb')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
  	<!--begin::Info-->
  	<div class="d-flex align-items-center flex-wrap mr-1">
    	<!--begin::Page Heading-->
    	<div class="d-flex align-items-baseline flex-wrap mr-5">
        <!--begin::Page Title-->
        <h5 class="text-dark font-weight-bold my-1 mr-5">Hizmet Ekle</h5>
        <!--end::Page Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        	<li class="breadcrumb-item">
        	  <a href="{{route('get.index.admin')}}" class="text-muted">Anasayfa</a>
        	</li>
          <li class="breadcrumb-item">
            <a href="{{route('service.index')}}" class="text-muted">Hizmetler</a>
          </li>
          <li class="breadcrumb-item">
            <a href="" class="text-muted">Hizmet Ekle</a>
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
        <h3 class="card-title">Hizmet Ekle</h3>
      </div>
      <!--begin::Form-->
      <form method="POST" action="{{route('service.store')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="card-body">
          <div class="form-group">
            <label for="title">Başlığı <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Adı" name="title" id="title" required value="{{ old('title') }}" />
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="form-group">
            <label for="description">Açıklama <span class="text-danger">*</span></label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Açıklama" required maxlength="255">{{ old('description') }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="content">İçerik <span class="text-danger">*</span></label>
            <textarea name="content" id="content" >{{ old('content') }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="seo_title">Seo Başlık </label>
            <input type="text" class="form-control @error('seo_title') is-invalid @enderror" placeholder="Seo Başlık" name="seo_title" id="seo_title" value="{{ old('seo_title') }}" />
            @error('seo_title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="seo_description">Seo Açıklama </label>
            <textarea class="form-control @error('seo_description') is-invalid @enderror" id="seo_description" name="seo_description" rows="3" placeholder="Seo Açıklama" maxlength="255">{{ old('seo_description') }}</textarea>
            @error('seo_description')
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
                <input type="text" class="form-control @error('order') is-invalid @enderror" placeholder="Sırası" name="order" id="order" required value="{{ old('order') ? old('order') : '0' }}" />
                @error('order')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="is_active">Aktif mi? <span class="text-danger">*</span></label>
                <select class="form-control" id="is_active" name="is_active" required>
                  <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>Aktif</option>
                  <option value="0" {{ old('is_active') && old('is_active') == 0 ? 'selected' : '' }}>Aktif Değil</option>
                </select>
                @error('is_active')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <div class="form-group">
                <label for="show_index">Göster - Anasayfa <span class="text-danger">*</span></label>
                <select class="form-control" id="show_index" name="show_index" required>
                  <option value="1" {{ old('show_index') == 1 ? 'selected' : '' }}>Evet</option>
                  <option value="0" {{ old('show_index') && old('show_index') == 0 ? 'selected' : '' }}>Hayır</option>
                </select>
                @error('show_index')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="show_header">Göster - Header <span class="text-danger">*</span></label>
                <select class="form-control" id="show_header" name="show_header" required>
                  <option value="1" {{ old('show_header') == 1 ? 'selected' : '' }}>Evet</option>
                  <option value="0" {{ old('show_header') && old('show_header') == 0 ? 'selected' : '' }}>Hayır</option>
                </select>
                @error('show_header')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="show_footer">Göster - Footer <span class="text-danger">*</span></label>
                <select class="form-control" id="show_footer" name="show_footer" required>
                  <option value="1" {{ old('show_footer') == 1 ? 'selected' : '' }}>Evet</option>
                  <option value="0" {{ old('show_footer') && old('show_footer') == 0 ? 'selected' : '' }}>Hayır</option>
                </select>
                @error('show_footer')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
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

@section('page-vendors')
<script src="{{asset('/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js?v=7.1.0')}}"></script>
@endsection

@section('scripts')
<script>
  ClassicEditor.create( document.querySelector( '#content' ) )
    .then( editor => {
      console.log( editor );
    } )
    .catch( error => {
      console.error( error );
    } );

</script>
@endsection