@extends('layouts.app')

@section('page_title', 'Tambah Weather Log')

@push('styles')

@endpush

@push('scripts')
<script src="{{ asset('custom/js/weather_log/add/submit_ajax.js') }}"></script>
<script src="{{ asset('custom/js/weather_log/add/select2.js') }}"></script>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom">
            <div class="card-header py-3">
                <div class="card-title">
                    <h3 class="card-label">Pilih Lokasi</h3>
                </div>
            </div>
            <div class="card-body">
                <form method="get" action="{{ route("weather_log_add") }}">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Lokasi</label>
                            <select class="form-control select2" name="weather_log_location_id" id="kt_select2_1">
                                @foreach ($location_data as $data)
                                <option <?php if ($weather_log_location_id == $data["location_id"]) { echo("selected"); } ?> value="<?php echo $data["location_id"] ?>">{{ $data["location_name"] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <label style="opacity:0">&nbsp;</label><br>
                            <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-plus"></i> Generate Cuaca</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if ($weather_log_location_id != null)
        <br>
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">Weather Log Terbuat</h3>
            </div>
            <form class="form" id="form" method="POST" action="{{ route("weather_log_save") }}" data-form-success-redirect="{{ route("weather_log_view") }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$encoded_detail_current}}" name="encoded_detail_current">
                <input type="hidden" value="{{$encoded_detail_daily}}" name="encoded_detail_daily">
                <input type="hidden" value="{{$weather_log_location_id}}" name="weather_log_location_id">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Data Log</h3>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>Kode Log</label>
                                    <input type="text" maxlength="255" class="form-control max_length_input" name="weather_log_code" value="{{$weather_log_code}}" readonly>
                                </div>
                            </div>
                            <br />
                            <h3 class="font-size-lg text-dark font-weight-bold mb-6">2. Data Cuaca Saat ini</h3>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>Waktu</label>
                                    <input type="text" maxlength="255" class="form-control max_length_input" name="date_current" value="{{$date_current}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>Hujan Lebat</label>
                                    <input type="text" maxlength="255" class="form-control max_length_input" name="heavy_rain_current" value="<?php if ($heavy_rain_current) echo "Ya"; else echo "Tidak"; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h3 class="font-size-lg text-dark font-weight-bold mb-6">3. Data Cuaca Harian</h3>
                            <?php $daily_number = 0; ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Hujan Lebat</th>
                                    </tr>
                                </thead>
                                @foreach ($daily_data as $daily)
                                <?php $daily_number++;  ?>
                                <tbody>
                                    <tr>
                                        <th scope="row">{{ $daily_number }}</th>
                                        <td>{{ $daily["date"] }}</td>
                                        <td>
                                            <span class="label label-inline <?php if ($daily["heavy_rain_daily"]) echo "label-light-danger"; else echo "label-light-success"; ?> font-weight-bold">
                                                <?php if ($daily["heavy_rain_daily"]) echo "Ya"; else echo "Tidak"; ?>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="{{ route("weather_log_view") }}" class="btn btn-secondary">Kembali</a>
                        </div>
                        <div class="col-lg-6 text-right">
                            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection