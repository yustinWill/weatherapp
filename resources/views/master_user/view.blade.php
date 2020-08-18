@extends('layouts.app')

@section('page_title', 'Master User')

@push('styles')

@endpush

@push('scripts')
<script src="{{ asset('custom/js/master_user/view/datatable.js') }}"></script>
<script src="{{ asset('custom/js/master_user/view/delete_ajax.js') }}"></script>
<script src="{{ asset('custom/js/master_user/view/select2.js') }}"></script>
@endpush

@section('content')
<div class="card card-custom">
    <div class="card-header py-3">
        <div class="card-title">
            <h3 class="card-label">Filter User</h3>
        </div>
    </div>
    <div class="card-body">
        <form method="get" action="{{ route("master_user_view") }}">
            <div class="row">
                <div class="col-md-4">
                    <label>Tanggal Terdaftar</label>
                        <div class="input-daterange input-group" id="date">
                            <input type="text" class="form-control" value="<?php echo $filter["start"] ?>" autocomplete="off" name="start"/>
                            <div class="input-group-append"><span class="input-group-text"><i class="la la-ellipsis-h"></i></span></div>
                            <input type="text" class="form-control" value="<?php echo $filter["end"] ?>" autocomplete="off" name="end"/>
                        </div>
                </div>
                <div class="col-lg-3">
                    <label>Lokasi</label>
                    <select class="form-control select2" name="location" id="location" name="user_location_id">
                        <option <?php if ($filter["location"] == "ALL") { echo("selected"); } ?> value="ALL">ALL</option>
                        @foreach ($location_data as $data)
                        <option <?php if ($filter["location"] == $data["location_id"]) { echo("selected"); } ?> value="<?php echo $data["location_id"] ?>">{{ $data["location_name"] }}</option>
                        @endforeach
                    </select>
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
            <h3 class="card-label">Master User</h3>
        </div>
        <div class="card-toolbar">
            <a href="{{ route("master_user_add") }}" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <i class="fas fa-plus-circle"></i>Tambah User
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-checkable" id="kt_datatable1">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Terdaftar Sejak</th>
                    <th>Lokasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user_data as $data)
                <tr>
                    <td>{{ $data["user_name"] }}</td>
                    <td>{{ $data["user_email"] }}</td>
                    <td>{{ $data["user_registration_timestamp"] }}</td>
                    <td>
                    @foreach ($location_data as $loc_data)
                    <?php if ($loc_data["location_id"] == $data["user_location_id"]) {?>
                        {{ $loc_data["location_name"] }}
                    <?php } ?>
                    @endforeach
                    </td>
                    <td nowrap="nowrap">
                        <a href="{{ route("master_user_view_detail", ["user_id" => $data["user_id"]]) }}" target="_blank" class="btn btn-sm btn-clean btn-icon"> <i
                            class="la la-eye"></i>
                        </a>
                        <a href="{{ route("master_user_edit", ["user_id" => $data["user_id"]]) }}" class="btn btn-sm btn-clean btn-icon"> <i
                            class="la la-edit"></i>
                        </a>
                        <a href="javascript:;" data-user-code="{{ $data["user_id"] }}" data-action="{{ route("master_user_delete") }}"
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
