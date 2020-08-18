@extends('layouts.app')

@section('page_title', 'Detail Master User')

@push('styles')

@endpush

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">Detail Master User</h3>
            </div>
            <form class="form" id="form" method="POST" action="{{ route("master_user_view_detail") }}" data-form-success-redirect="{{ route("master_user_view") }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$detail_data["user_id"]}}" name="user_id" disabled>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Nama User</label>
                            <input type="text" maxlength="255" class="form-control max_length_input" name="user_name" value="{{$detail_data["user_name"]}}" placeholder="Masukkan judul berita dan artikel" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Email</label>
                            <input type="text" maxlength="255" class="form-control max_length_input" name="user_email" value="{{$detail_data["user_email"]}}" placeholder="Masukkan judul berita dan artikel" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Terdaftar Sejak</label>
                            <input type="text" maxlength="255" class="form-control max_length_input" name="user_registration_timestamp" value="{{$detail_data["user_registration_timestamp"]}}" placeholder="Masukkan judul berita dan artikel" disabled>
                        </div>
                    </div>
                    @foreach ($location_data as $loc_data)
                    <?php if ($loc_data["location_id"] == $detail_data["user_location_id"]) { ?>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Lokasi</label>
                                <input type="text" maxlength="255" class="form-control max_length_input" name="{{ $loc_data["location_name"] }}" value="{{ $loc_data["location_name"] }}" placeholder="Masukkan judul berita dan artikel" disabled>
                            </div>
                        </div>
                    <?php } ?>
                    @endforeach
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="{{ route("master_user_view") }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection