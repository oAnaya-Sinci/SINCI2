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
                    <div class="pt-1">
                        <form method="POST" action="{{ route('reports.filter') }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group body-modalsSinci">
                                        <label for="recipient-name" class="col-form-label">Departamento:</label>
                                        @csrf
                                        @method('POST')
                                        <select class="form-select modalForm" name="department">
                                            <option value="">{{__('Selecciona')}}</option>
                                            @foreach($departments as $id => $department)
                                            <option value="{{ $id }}" @selected(old($id))>
                                                {{ $department }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 pt-1">
                                    <button type="submit" class="btn btn-success">Descargar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- <div class="pt-2 modal-footer">
                    <button type="submit" class="btn btn-success">Descargar</button>
                </div> -->
                <div class="pt-1">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nombre / Correo</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Puesto / Oficina</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Departamento</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Dias acumulados</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{url('/img/user.png')}}" class="avatar avatar-sm me-3">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-xs">{{ $user->name }}</h6>
                                                <p class="text-xs text-secondary mb-0">{{$user->email}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @foreach($user->positions as $position)
                                        <p class="text-xs font-weight-bold mb-0">{{ $position->name }}</p>
                                        @endforeach
                                        @foreach($user->offices as $office)
                                        <p class="text-xs text-secondary mb-0">{{ $office->name }}</p>
                                        @endforeach
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        @foreach($user->departments as $department)
                                        <span class="text-xs text-secondary mb-0">{{ $department->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs text-secondary mb-0">0</span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs text-secondary mb-0">{{ Carbon::parse($user->admission_date)->format('Y-m-d') ?? Carbon::parse($date)->format('Y-m-d') }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ __('No se encontraron usuarios') }}
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
@endsection
@section('jsSection')
<script>
    $('.navbar-nav li a').removeClass('bg-gradient-primary');
    $('a[href = "/reports"]').addClass('bg-gradient-primary');
    // $('a[href = "/bitacoras/main"]').addClass('active').removeClass('bg-gradient-primary');
</script>
@endsection