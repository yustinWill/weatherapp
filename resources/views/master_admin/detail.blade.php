@extends('layouts.app')

@section('page_title', 'Detail Master Admin')

@push('styles')

@endpush

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">Detail Master Admin</h3>
            </div>
            <form class="form" id="form" method="POST" action="{{ route("master_admin_view_detail") }}" data-form-success-redirect="{{ route("master_admin_view") }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$detail_data["backend_user_id"]}}" name="backend_user_id" disabled>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Nama Admin</label>
                            <input type="text" maxlength="255" class="form-control max_length_input" name="backend_user_name" value="{{$detail_data["backend_user_name"]}}" placeholder="Masukkan nama admin" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Email</label>
                            <input type="text" maxlength="255" class="form-control max_length_input" name="backend_user_email" value="{{$detail_data["backend_user_email"]}}" placeholder="Masukkan email" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Login Terakhir</label>
                            <input type="text" maxlength="255" class="form-control max_length_input" name="backend_user_last_login" value="{{$detail_data["backend_user_last_login"]}}" placeholder="Masukkan login terakhir" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Tanggal Dibuat</label>
                            <input type="text" maxlength="255" class="form-control max_length_input" name="backend_user_created_time" value="{{$detail_data["backend_user_created_time"]}}" placeholder="Masukkan tanggal dibuat" disabled>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="{{ route("master_admin_view") }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection