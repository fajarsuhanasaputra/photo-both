@extends('backend.template.master')
@section('content')
<div class="content">
    <div class="container-fluid">

        <form method="post" action="{{route('home')}}">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                {{ csrf_field()}}
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <label for="tgl-end" class="mb-3">Dari</label>
                                    <input name="tgl-start" type="date" id="tgl-start" class="form-control" value="{{ $tgl_start }}" max="{{ $tgl_end }}" onchange="onStartChange()" />
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <label for="tgl-end" class="mb-3">Ke</label>
                                    <input name="tgl-end" type="date" id="tgl-end" class="form-control" value="{{ $tgl_end }}" min="{{ $tgl_start }}" onchange="onEndChange()" />
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <label for="booth-select">Pilih Booth</label>
                                    <select name="booth-select" id="booth-select" class="form-control" onchange="onBoothChange()">
                                        @if($selected_booth == 'semua')
                                        <option value="semua" selected>Semua</option>
                                        @else
                                        <option value="semua">Semua</option>
                                        @endif
                                        @foreach($booth as $index=>$dt)
                                        @if($selected_booth == $dt->id)
                                        <option value="{{  $dt->id }}" selected> {{ $dt->booth_name }}</option>
                                        @else
                                        <option value="{{  $dt->id }}"> {{ $dt->booth_name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <button type="submit" class="btn btn-success btn-sm mt-3">
                                        Terapkan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
 
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">calendar_month</i>
                        </div>
                        <p class="card-category mt-3">Total Pendapatan</p>
                        <h3 class="card-title mb-3"> @currency($pendapatan - ($pendapatan*0.007771)) </h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-rose card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">today</i>
                        </div>
                        <p class="card-category mt-3">Total Transaksi </p>
                        <h3 class="card-title mb-3">{{ $tot_trans }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <a class="card-header card-header-success card-header-icon" href="{{ route('list-contact.index') }}">
                        <div class=" card-icon">
                            <i class="material-icons">schedule_send</i>
                        </div>
                        <p class="card-category mt-3">Total Form Disubmit</p>
                        <h3 class="card-title mb-3">{{ $tot_form }}</h3>
                    </a>
                </div>

            </div>
        </div>
        <div class="col-12 text-right">
            <form action="{{ route('list-contact-download') }}" method="POST">
                @csrf
                <input type="hidden" id="contact-booth" name="contact-booth" value="{{ $selected_booth }}">
                <input type="hidden" id="contact-start" name="contact-start" value="{{ $tgl_start }}">
                <input type="hidden" id="contact-end" name="contact-end" value="{{ $tgl_end }}">
                <button type="submit" class="btn btn-round btn-success btn-sm">
                    <i class="material-icons">download</i> donwload
                </button>
            </form>
        </div>
        <div class="card px-5 py-3">
            <input id="dashboard-data" type="hidden" value="{{ $chart }}" />
            <canvas id="dashboard-chart">
            </canvas>
        </div>
    </div>
</div>
<script type="text/javascript">
    function onStartChange() {
        var start = document.getElementById("tgl-start").value;
        document.getElementById("tgl-end").setAttribute("min", start);
        document.getElementById("contact-start").value = start;
    }

    function onEndChange() {
        var end = document.getElementById("tgl-end").value;
        document.getElementById("tgl-start").setAttribute("max", end);
        document.getElementById("contact-end").value = end;
    }

    function onBoothChange() {
        var booth = document.getElementById("booth-select").value;
        document.getElementById("contact-booth").value = booth;
    }
</script>
@stop
