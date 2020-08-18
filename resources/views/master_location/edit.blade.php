@extends('layouts.app')

@section('page_title', 'Ubah Lokasi')

@push('styles')

@endpush

@push('scripts')
<script src="{{ asset('custom/js/master_location/edit/submit_ajax.js') }}"></script>
<script src="{{ asset('custom/js/master_location/edit/select2.js') }}"></script>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">Form Ubah Lokasi</h3>
            </div>
            <form class="form" id="form" method="POST" action="{{ route("master_location_update") }}" data-form-success-redirect="{{ route("master_location_view") }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$edit_data["location_id"]}}" name="location_id">
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Nama Lokasi</label>
                            <input type="text" maxlength="255" class="form-control max_length_input" name="location_name" value="{{$edit_data["location_name"]}}" placeholder="Masukkan nama lokasi">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Latitude</label>
                            <input type="text" maxlength="255" class="form-control max_length_input" name="location_lat" value="{{$edit_data["location_lat"]}}" placeholder="Masukkan latitude">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Longitude</label>
                            <input type="text" maxlength="255" class="form-control max_length_input" name="location_long" value="{{$edit_data["location_long"]}}" placeholder="Masukkan longitude">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Status</label>
                            <select class="form-control select2" id="kt_select2_1" name="location_is_active">
                                <option <?php if ($edit_data["location_is_active"] == 1) { echo("selected"); } ?> value="1">Aktif</option>
                                <option <?php if ($edit_data["location_is_active"] == 2) { echo("selected"); } ?> value="2">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="{{ route("master_location_view") }}" class="btn btn-secondary">Kembali</a>
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