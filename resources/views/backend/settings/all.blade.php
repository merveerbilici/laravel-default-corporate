@extends('backend.layout.master')

@section('title', 'Site Ayarları')

@section('breadcrumb')
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
  	<!--begin::Info-->
  	<div class="d-flex align-items-center flex-wrap mr-1">
    	<!--begin::Page Heading-->
    	<div class="d-flex align-items-baseline flex-wrap mr-5">
        <!--begin::Page Title-->
        <h5 class="text-dark font-weight-bold my-1 mr-5">Site Ayarları</h5>
        <!--end::Page Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        	<li class="breadcrumb-item">
        	  <a href="{{route('get.index.admin')}}" class="text-muted">Anasayfa</a>
        	</li>
          <li class="breadcrumb-item">
            <a href="" class="text-muted">Site Ayarları</a>
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
        <h3 class="card-title">Site Ayarları</h3>
      </div>
      <!--begin::Form-->
      <form method="POST" action="{{route('post.settings')}}" enctype="multipart/form-data">
        @include('backend.layout.messages')
        {{csrf_field()}}
        <div class="card-body">
          
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="facebook_url">Facebook Linki </label>
                <input type="text" class="form-control @error('facebook_url') is-invalid @enderror" placeholder="Facebook Linki" name="facebook_url" id="facebook_url" value="{{ old('facebook_url') ? old('facebook_url') : @$settings['facebook_url'] }}" />
                @error('facebook_url')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="twitter_url">Twitter Linki </label>
                <input type="text" class="form-control @error('twitter_url') is-invalid @enderror" placeholder="Twitter Linki" name="twitter_url" id="twitter_url" value="{{ old('twitter_url') ? old('twitter_url') : @$settings->twitter_url }}" />
                @error('twitter_url')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="instagram_url">Instagram Linki </label>
                <input type="text" class="form-control @error('instagram_url') is-invalid @enderror" placeholder="Instagram Linki" name="instagram_url" id="instagram_url" value="{{ old('instagram_url') ? old('instagram_url') : @$settings->instagram_url }}" />
                @error('instagram_url')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="linkedin_url">Linkedin Linki </label>
                <input type="text" class="form-control @error('linkedin_url') is-invalid @enderror" placeholder="Linkedin Linki" name="linkedin_url" id="linkedin_url" value="{{ old('linkedin_url') ? old('linkedin_url') : @$settings->linkedin_url }}" />
                @error('linkedin_url')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="contact_email">İletişim Emaili </label>
                <input type="text" class="form-control @error('contact_email') is-invalid @enderror" placeholder="İletişim Emaili" name="contact_email" id="contact_email" value="{{ old('contact_email') ? old('contact_email') : @$settings['contact_email'] }}" />
                @error('contact_email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="contact_phone">İletişim Telefonu </label>
                <input type="text" class="form-control @error('contact_phone') is-invalid @enderror" placeholder="İletişim Telefonu" name="contact_phone" id="contact_phone" value="{{ old('contact_phone') ? old('contact_phone') : @$settings['contact_phone'] }}" />
                @error('contact_phone')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="contact_address">İletişim Adresi <span class="text-danger">*</span></label>
            <textarea class="form-control @error('contact_address') is-invalid @enderror" id="contact_address" name="contact_address" rows="3" placeholder="İletişim Adresi" required maxlength="255">{{ old('contact_address') ? old('contact_address') : @$settings['contact_address'] }}</textarea>
            @error('contact_address')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="contact_map">Harita (iframe) <span class="text-danger">*</span></label>
            <textarea class="form-control @error('contact_map') is-invalid @enderror" id="contact_map" name="contact_map" rows="3" placeholder="Harita (iframe)" maxlength="255">{{ old('contact_map') ? old('contact_map') : @$settings['contact_map'] }}</textarea>
            @error('contact_map')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <hr>
          


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