
@extends('layouts.panel')

@section('content')
   
    <div class="page-header my-3 mx-4">
        <div class="page-title">
            <h3>{{__('tenant.form.import_heading')}}</h3>
        </div>
        <div class="page-btn">
            @haspermission('tenant_view')
                <a href="{{ route('tenants.index') }}" class="btn btn-added">{{ __('tenant.users') }}</a>
            @endhaspermission
        </div>
    </div>
 
{{-- <div class="page-header">
    <div class="page-title">
        <h4>{{__('tenant.form.import_heading')}}</h4>
        <h6>{{__('tenant.form.import_desc')}}  <a href="{{ route('tenants.index') }}" class="btn btn-primary">{{ __('tenant.tenants') }}</a></h6>
    </div>
</div> --}}
        <div class="card">
            <div class="card-body">
             
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- <div class="form-group mb-4">
                <div class="custom-file text-left">
                    <input type="file" name="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div> --}}


            <div class="col-lg-12">
                <div class="form-group">
                    <label> {{ __('tenant.form.file') }}</label>
                    <div class="image-upload">
                        <input id="file" type="file"
                        class="form-control @error('file') is-invalid @enderror" name="file">
                        @error('file')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                        <div class="image-uploads">
                            <img src="/assets/img/icons/upload.svg" alt="img">
                            <h4>{{ __('tenant.form.file_upload_description') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary">{{ __('tenant.form.import_save_btn')}}</button>
            <a download class="btn btn-success"
                href="{{ route('export-users', ['id' => 1, 'format' => 'csv']) }} ">
                {{ __('tenant.form.export_btn')}}
                </a>
        </form>
    </div>
</div>
@endsection