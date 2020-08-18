@extends('layouts.app')

@section('page_title', 'Master Lokasi')

@push('styles')

@endpush

@push('scripts')
<script src="{{ asset('custom/js/master_location/view/datatable.js') }}"></script>
<script src="{{ asset('custom/js/master_location/view/delete_ajax.js') }}"></script>
<script src="{{ asset('custom/js/master_location/view/select2.js') }}"></script>
@endpush

@section('content')
<div class="card card-custom">
    <div class="card-header py-3">
        <div class="card-title">
            <span class="card-icon">
                 
            </span>
            <h3 class="card-label">Master Lokasi</h3>
        </div>
        <div class="card-toolbar">
            <a href="{{ route("master_location_add") }}" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <i class="fas fa-plus-circle"></i>Tambah Lokasi
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-checkable" id="kt_datatable1">
            <thead>
                <tr>
                    <th>Lokasi</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Status</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($location_data as $data)
                <tr>
                    <td>{{ $data["location_name"] }}</td>
                    <td>{{ $data["location_lat"] }}</td>
                    <td>{{ $data["location_long"] }}</td>
                    <td>
                        <span class="label label-inline <?php if ($data["location_is_active"] == 1) echo "label-light-success"; else echo "label-light-danger"; ?> font-weight-bold">
                            <?php if ($data["location_is_active"] == 1) echo "Aktif"; else echo "Tidak Aktif"; ?>
                        </span>
                    </td>
                    <td>{{ $data["location_created_time"] }}</td>
                    <td nowrap="nowrap">
                        <a href="{{ route("master_location_view_detail", ["location_id" => $data["location_id"]]) }}" target="_blank" class="btn btn-sm btn-clean btn-icon"> <i
                            class="la la-eye"></i>
                        </a>
                        <a href="{{ route("master_location_edit", ["location_id" => $data["location_id"]]) }}" class="btn btn-sm btn-clean btn-icon"> <i
                            class="la la-edit"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
