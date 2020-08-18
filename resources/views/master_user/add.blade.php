@extends('layouts.app')

@section('page_title', 'Tambah User')

@push('styles')

@endpush

@push('scripts')
<script src="{{ asset('custom/js/master_user/add/submit_ajax.js') }}"></script>
<script src="{{ asset('custom/js/master_user/add/select2.js') }}"></script>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">Form Tambah User</h3>
            </div>
            <form class="form" id="form" method="POST" action="{{ route("master_user_save") }}" data-form-success-redirect="{{ route("master_user_view") }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Data User</h3>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Nama User</label>
                            <input type="text" maxlength="255" class="form-control max_length_input" name="user_name" placeholder="Masukkan nama user">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Email</label>
                            <input type="text" maxlength="255" class="form-control max_length_input" name="user_email" placeholder="Masukkan email">
                        </div>
                    </div>
                    <br/>
                    <h3 class="font-size-lg text-dark font-weight-bold mb-6">2. Lokasi User</h3>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Lokasi</label>
                            <select class="form-control select2" id="kt_select2_1" name="user_location_id">
                                @foreach ($location_data as $data)
                                    <option value="<?php echo $data["location_id"] ?>">{{ $data["location_name"] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="{{ route("master_user_view") }}" class="btn btn-secondary">Kembali</a>
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