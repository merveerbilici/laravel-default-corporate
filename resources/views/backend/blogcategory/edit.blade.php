@extends('backend.layout.master')

@section('title', 'Blog Kategorisi Düzenle')

@section('breadcrumb')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
  	<!--begin::Info-->
  	<div class="d-flex align-items-center flex-wrap mr-1">
    	<!--begin::Page Heading-->
    	<div class="d-flex align-items-baseline flex-wrap mr-5">
        <!--begin::Page Title-->
        <h5 class="text-dark font-weight-bold my-1 mr-5">Blog Kategorisi Düzenle</h5>
        <!--end::Page Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        	<li class="breadcrumb-item">
        	  <a href="{{route('get.index.admin')}}" class="text-muted">Anasayfa</a>
        	</li>
          <li class="breadcrumb-item">
            <a href="{{route('blog.index')}}" class="text-muted">Blog</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{route('blog-category.index')}}" class="text-muted">Blog Kategorileri</a>
          </li>
          <li class="breadcrumb-item">
            <a href="" class="text-muted">Blog Kategorisi Düzenle</a>
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
        <h3 class="card-title">Blog Kategorisi Düzenle</h3>
      </div>
      <!--begin::Form-->
      <form method="POST" action="{{route('blog-category.update', ['id' => $blogcategory->id])}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="card-body">
          <div class="form-group">
            <label for="name">Adı <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Adı" name="name" id="name" required value="{{ old('name') ? old('name') : $blogcategory->name }}" />
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="description">Açıklama <span class="text-danger">*</span></label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Açıklama" required maxlength="255">{{ old('description') ? old('description') : $blogcategory->description }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="seo_title">Seo Başlık </label>
            <input type="text" class="form-control @error('seo_title') is-invalid @enderror" placeholder="Seo Başlık" name="seo_title" id="seo_title" value="{{ old('seo_title') ? old('seo_title') : $blogcategory->seo_title }}" />
            @error('seo_title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="seo_description">Seo Açıklama </label>
            <textarea class="form-control @error('seo_description') is-invalid @enderror" id="seo_description" name="seo_description" rows="3" placeholder="Seo Açıklama" maxlength="255">{{ old('seo_description') ? old('seo_description') : $blogcategory->seo_description }}</textarea>
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
                <input type="text" class="form-control @error('order') is-invalid @enderror" placeholder="Sırası" name="order" id="order" required value="{{ old('order') ? old('order') : $blogcategory->order }}" />
                @error('order')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="is_active">Aktif mi? <span class="text-danger">*</span></label>
                <select class="form-control" id="is_active" name="is_active">
                  <option value="1" {{ old('is_active') == 1 || $blogcategory->is_active == 1 ? 'selected' : '' }}>Aktif</option>
                  <option value="0" {{ (old('is_active') && old('is_active') == 0) || $blogcategory->is_active == 0 ? 'selected' : '' }}>Aktif Değil</option>
                </select>
                @error('is_active')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
          <div class="form-group">
            @if($blogcategory->image != null)
            <img src="/upload/blog-category/{{$blogcategory->image}}" class="h-10 align-self-end">
            @endif
          </div>
          <div class="row">
            <div class="col-4">
              <div class="form-group">
                <label for="show_index">Göster - Anasayfa <span class="text-danger">*</span></label>
                <select class="form-control" id="show_index" name="show_index" required>
                  <option value="1" {{ old('show_index') == 1 || $blogcategory->show_index == 1 ? 'selected' : '' }}>Evet</option>
                  <option value="0" {{ (old('show_index') && old('show_index') == 0) || $blogcategory->show_index == 0 ? 'selected' : '' }}>Hayır</option>
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
                  <option value="1" {{ old('show_header') == 1 || $blogcategory->show_header == 1 ? 'selected' : '' }}>Evet</option>
                  <option value="0" {{ (old('show_header') && old('show_header') == 0) || $blogcategory->show_header == 0 ? 'selected' : '' }}>Hayır</option>
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
                  <option value="1" {{ old('show_footer') == 1 || $blogcategory->show_footer == 1 ? 'selected' : '' }}>Evet</option>
                  <option value="0" {{ (old('show_footer') && old('show_footer') == 0) || $blogcategory->show_footer == 0 ? 'selected' : '' }}>Hayır</option>
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