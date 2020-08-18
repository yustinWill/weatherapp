@extends('layouts.app')

@section('page_title', 'Ubah Admin')

@push('styles')

@endpush

@push('scripts')
<script src="{{ asset('custom/js/master_admin/edit/submit_ajax.js') }}"></script>
<script src="{{ asset('custom/js/master_admin/edit/select2.js') }}"></script>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">Form Ubah Admin</h3>
            </div>
            <form class="form" id="form" method="POST" action="{{ route("master_admin_update") }}" data-form-success-redirect="{{ route("master_admin_view") }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$edit_data["backend_user_id"]}}" name="backend_user_id">
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Nama Admin</label>
                            <input type="text" maxlength="255" class="form-control max_length_input" name="backend_user_name" value="{{$edit_data["backend_user_name"]}}" placeholder="Masukkan nama admin">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Email</label>
                            <input type="text" maxlength="255" class="form-control max_length_input" name="backend_user_email" value="{{$edit_data["backend_user_email"]}}" placeholder="Masukkan email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Terakhir Login</label>
                            <input type="text" maxlength="255" class="form-control max_length_input" name="backend_user_last_login" value="{{$edit_data["backend_user_last_login"]}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Tanggal Dibuat</label>
                            <input type="text" maxlength="255" class="form-control max_length_input" name="backend_user_created_time" value="{{$edit_data["backend_user_created_time"]}}" disabled>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="{{ route("master_admin_view") }}" class="btn btn-secondary">Kembali</a>
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