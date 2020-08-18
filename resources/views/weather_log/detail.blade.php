@extends('layouts.app')

@section('page_title', 'Detail Weather Log')

@push('styles')

@endpush

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">Detail Weather Log</h3>
            </div>
            <form class="form" id="form" method="POST" action="{{ route("weather_log_view_detail") }}" data-form-success-redirect="{{ route("weather_log_view") }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$detail_data["weather_log_id"]}}" name="weather_log_id" disabled>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3 class="font-size-lg text-dark font-weight-bold mb-6">1. Data Log</h3>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>Kode Log</label>
                                    <input type="text" maxlength="255" class="form-control max_length_input" name="weather_log_code" value="{{$detail_data["weather_log_code"]}}" disabled>
                                </div>
                            </div>
                            @foreach ($location_data as $loc_data)
                            <?php if ($loc_data["location_id"] == $detail_data["weather_log_location_id"]) { ?>
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <label>Lokasi</label>
                                        <input type="text" maxlength="255" class="form-control max_length_input" name="{{ $loc_data["location_name"] }}" value="{{ $loc_data["location_name"] }}" disabled>
                                    </div>
                                </div>
                            <?php } ?>
                            @endforeach
                            <br />
                            <h3 class="font-size-lg text-dark font-weight-bold mb-6">2. Data Cuaca Saat ini</h3>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>Waktu</label>
                                    <input type="text" maxlength="255" class="form-control max_length_input" name="date_current" value="{{$date_current}}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>Hujan Lebat</label>
                                    <input type="text" maxlength="255" class="form-control max_length_input" name="heavy_rain_current" value="<?php if ($heavy_rain_current) echo "Ya"; else echo "Tidak"; ?>" disabled>
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
                                        <th scope="col">Suhu ( &#8451 )</th>
                                        <th scope="col">Hujan Lebat</th>
                                    </tr>
                                </thead>
                                @foreach ($daily_data as $daily)
                                <?php $daily_number++;  ?>
                                <tbody>
                                    <tr>
                                        <th scope="row">{{ $daily_number }}</th>
                                        <td>{{ $daily["date"] }}</td>
                                        <td>{{ $daily["temp_min"] }} - {{ $daily["temp_max"] }}</td>
                                        <td>
                                            <span class="label label-inline <?php if ($daily["is_heavy_rain"]) echo "label-light-danger"; else echo "label-light-success"; ?> font-weight-bold">
                                                <?php if ($daily["is_heavy_rain"]) echo "Ya"; else echo "Tidak"; ?>
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
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection