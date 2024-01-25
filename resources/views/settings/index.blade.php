@php
use Carbon\Carbon;
@endphp

@extends('layouts.app')
@section('pageContent')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-2">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="pt-3">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Niveles</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Días</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($settings as $setting)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-xs text-secondary mb-0">{{ $setting->level }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $setting->days }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <a href="{{ route('settings.edit', $setting) }}"
                                                class="text-info font-weight-normal text-md" data-toggle="tooltip"
                                                data-original-title="Edit setting">
                                                Editar
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-2">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <!-- <div class="pt-1">
                        <a href="{{ route('settings.date.create') }}"
                            class="m-4 ml-6 mt-3 mb-2 text-md">{{__('Agregar')}}</a>
                    </div> -->
                    <div class="pt-3">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Fecha de configuración</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings_date as $date)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-xs text-secondary mb-0">
                                                        {{ Carbon::parse($date->setting_date)->format('Y-m-d') }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <a href="{{ route('settings.date.edit', $date) }}"
                                                class="text-info font-weight-normal text-md" data-toggle="tooltip"
                                                data-original-title="Edit setting">
                                                Editar
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="2" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ __('No se encontro fecha inicial') }}
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-2">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="pt-3">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Notificaciones</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Estatus</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($settings_notifi as $status)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-xs text-secondary mb-0">Correo electrónico</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($status->status_notifi == true)
                                            <p class="text-xs font-weight-bold mb-0">Activado</p>
                                            @else
                                            <p class="text-xs font-weight-bold mb-0">Desactivado</p>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <a href="{{ route('settings.status.edit', $status) }}"
                                                class="text-info font-weight-normal text-md" data-toggle="tooltip"
                                                data-original-title="Edit setting">
                                                Editar
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('jsSection')
<script>

    document.addEventListener("DOMContentLoaded", function(event) {
        outLoader();
    });

    checkIsAdmin();
    
    $('.navbar-nav li a').removeClass('bg-gradient-primary');
    $('a[href = "/settings"]').addClass('bg-gradient-primary');
    // $('a[href = "/bitacoras/main"]').addClass('active').removeClass('bg-gradient-primary');

    localStorage.setItem('searchDataDepto', 'todos');
    localStorage.setItem('searchDataOffice', 'todos');

</script>
@endsection
