@extends('layouts.app')

@section('page_title', 'Master Admin')

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
            <h3 class="card-label">Filter Admin</h3>
        </div>
    </div>
    <div class="card-body">
        <form method="get" action="{{ route("master_admin_view") }}">
            <div class="row">
                <div class="col-md-4">
                    <label>Tanggal Dibuat</label>
                        <div class="input-daterange input-group" id="date">
                            <input type="text" class="form-control" value="<?php echo $filter["start"] ?>" autocomplete="off" name="start"/>
                            <div class="input-group-append"><span class="input-group-text"><i class="la la-ellipsis-h"></i></span></div>
                            <input type="text" class="form-control" value="<?php echo $filter["end"] ?>" autocomplete="off" name="end"/>
                        </div>
                </div>
                <div class="col-lg-2">
                    <label style="opacity:0">&nbsp;</label><br>
                    <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-filter"></i> Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>
<br>
<div class="card card-custom">
    <div class="card-header py-3">
        <div class="card-title">
            <span class="card-icon">
                 
            </span>
            <h3 class="card-label">Master Admin</h3>
        </div>
        <div class="card-toolbar">
            <a href="{{ route("master_admin_add") }}" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <i class="fas fa-plus-circle"></i>Tambah Admin
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-checkable" id="kt_datatable1">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Login Terakhir</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user_data as $data)
                <tr>
                    <td>{{ $data["backend_user_code"] }}</td>
                    <td>{{ $data["backend_user_name"] }}</td>
                    <td>{{ $data["backend_user_email"] }}</td>
                    <td>{{ $data["backend_user_last_login"] }}</td>
                    <td>{{ $data["backend_user_created_time"] }}</td>
                    <td nowrap="nowrap">
                        <a href="{{ route("master_admin_view_detail", ["backend_user_id" => $data["backend_user_id"]]) }}" target="_blank" class="btn btn-sm btn-clean btn-icon"> <i
                            class="la la-eye"></i>
                        </a>
                        <a href="{{ route("master_admin_edit", ["backend_user_id" => $data["backend_user_id"]]) }}" class="btn btn-sm btn-clean btn-icon"> <i
                            class="la la-edit"></i>
                        </a>
                        <a href="javascript:;" data-user-code="{{ $data["backend_user_id"] }}" data-action="{{ route("master_admin_delete") }}"
                        class="btn btn-sm btn-clean btn-icon delete_btn"> 
                            <i class="la la-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
