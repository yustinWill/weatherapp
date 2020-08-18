@extends('layouts.app')

@section('page_title', 'Detail Master Lokasi')

@push('styles')

@endpush

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">Detail Master Lokasi</h3>
            </div>
            <form class="form" id="form" method="POST" action="{{ route("master_location_view_detail") }}" data-form-success-redirect="{{ route("master_location_view") }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$detail_data["location_id"]}}" name="location_id" disabled>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Nama Lokasi</label>
                            <input type="text" maxlength="255" class="form-control max_length_input" name="location_name" value="{{$detail_data["location_name"]}}" placeholder="Masukkan nama lokasi" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Latitude</label>
                            <input type="text" maxlength="255" class="form-control max_length_input" name="location_lat" value="{{$detail_data["location_lat"]}}" placeholder="Masukkan latitude" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Longitude</label>
                            <input type="text" maxlength="255" class="form-control max_length_input" name="location_long" value="{{$detail_data["location_long"]}}" placeholder="Masukkan longitude" disabled>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="{{ route("master_location_view") }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection