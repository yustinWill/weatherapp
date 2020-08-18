@extends('layouts.app')

@section('page_title', 'Weather Log')

@push('styles')

@endpush

@push('scripts')
<script src="{{ asset('custom/js/weather_log/view/date.js') }}"></script>
<script src="{{ asset('custom/js/weather_log/view/datatable.js') }}"></script>
<script src="{{ asset('custom/js/weather_log/view/delete_ajax.js') }}"></script>
<script src="{{ asset('custom/js/weather_log/view/select2.js') }}"></script>
<script src="{{ asset('custom/js/weather_log/view/submit_ajax.js') }}"></script>
@endpush

@section('content')
<div class="card card-custom">
    <div class="card-header py-3">
        <div class="card-title">
            <h3 class="card-label">Filter Weather Log</h3>
        </div>
    </div>
    <div class="card-body">
        <form method="get" action="{{ route("weather_log_view") }}">
            <div class="row">
                <div class="col-md-4">
                    <label>Tanggal Dibuat</label>
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
            <h3 class="card-label">Weather Log</h3>
        </div>
        <div class="card-toolbar">
            <form class="form" id="form" method="POST" action="{{ route("weather_log_generate_full") }}" data-form-success-redirect="{{ route("weather_log_view") }}" enctype="multipart/form-data">
                @csrf
                <button type="submit" class="btn btn-primary mr-2 font-weight-bolder"><i class="fas fa-plus-circle"></i> Generate Full Log</button>
            </form>
            <a href="{{ route("weather_log_add") }}" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <i class="fas fa-plus-circle"></i>Tambah Weather Log
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-checkable" id="kt_datatable1">
            <thead>
                <tr>
                    <th>Kode Log</th>
                    <th>Lokasi</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($weather_log_data as $data)
                <tr>
                    <td>{{ $data["weather_log_code"] }}</td>
                    <td>
                    @foreach ($location_data as $loc_data)
                    <?php if ($loc_data["location_id"] == $data["weather_log_location_id"]) {?>
                        {{ $loc_data["location_name"] }}
                    <?php } ?>
                    @endforeach
                    </td>
                    <td>{{ $data["weather_log_created_time"] }}</td>
                    <td nowrap="nowrap">
                        <a href="{{ route("weather_log_view_detail", ["weather_log_id" => $data["weather_log_id"]]) }}" target="_blank" class="btn btn-sm btn-clean btn-icon"> <i
                            class="la la-eye"></i>
                        </a>
                        <a href="javascript:;" data-user-code="{{ $data["weather_log_id"] }}" data-action="{{ route("weather_log_delete") }}"
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
