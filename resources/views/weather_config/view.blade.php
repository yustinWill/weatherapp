@extends('layouts.app')

@section('page_title', 'Weather Config')

@push('styles')

@endpush

@push('scripts')
<script src="{{ asset('custom/js/master_admin/view/datatable.js') }}"></script>
<script src="{{ asset('custom/js/master_admin/view/delete_ajax.js') }}"></script>
<script src="{{ asset('custom/js/master_admin/view/select2.js') }}"></script>
@endpush

@section('content')
<div class="card card-custom">
    <div class="card-header py-3">
        <div class="card-title">
            <h3 class="card-label">Weather API Account</h3>
        </div>
        <div class="card-toolbar">
            <a href="{{ route("weather_config_add") }}" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <i class="fas fa-edit"></i>Ubah API
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <div class="col-lg-12">
                <label>API Key</label>
                <input type="text" maxlength="255" class="form-control max_length_input" name="weather_config_weather_key" value="{{$config_data["weather_config_weather_key"]}}" disabled>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label>Akun</label>
                <input type="text" maxlength="255" class="form-control max_length_input" name="weather_config_weather_account" value="{{$config_data["weather_config_weather_account"]}}" disabled>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12">
                <label>Kata Sandi</label>
                <input type="text" maxlength="255" class="form-control max_length_input" name="weather_config_weather_password" value="{{$config_data["weather_config_weather_password"]}}" disabled>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-lg-6">
            </div>
            <div class="col-lg-6 text-right">
                <a href="https://home.openweathermap.org/api_keys" target="_blank" class="btn btn-primary">Buka Konsol</a>
            </div>
        </div>
    </div>
</div>
@endsection