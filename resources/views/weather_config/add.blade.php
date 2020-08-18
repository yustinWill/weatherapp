@extends('layouts.app')

@section('page_title', 'Ubah Weather API')

@push('styles')

@endpush

@push('scripts')
<script src="{{ asset('custom/js/weather_config/add/submit_ajax.js') }}"></script>
<script src="{{ asset('custom/js/weather_config/add/select2.js') }}"></script>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">Form Ubah Weather API</h3>
            </div>
            <form class="form" id="form" method="POST" action="{{ route("weather_config_save") }}" data-form-success-redirect="{{ route("weather_config_view") }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>API Key</label>
                            <input type="text" maxlength="255" class="form-control max_length_input" name="weather_config_weather_key" placeholder="Masukkan API Key">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Akun</label>
                            <input type="text" maxlength="255" class="form-control max_length_input" name="weather_config_weather_account" placeholder="Masukkan akun">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Kata Sandi</label>
                            <input type="text" maxlength="255" class="form-control max_length_input" name="weather_config_weather_password" placeholder="Masukkan kata sandi">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="{{ route("weather_config_view") }}" class="btn btn-secondary">Kembali</a>
                        </div>
                        <div class="col-lg-6 text-right">
                            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection