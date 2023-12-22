@php
use Carbon\Carbon;
@endphp

@extends('layouts.app')
@section('pageContent')

<style>
    .dataFiltered {
        display: none
    }
</style>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-2">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="pt-1">
                        <form method="POST" action="{{ route('reports.filter') }}">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group body-modalsSinci" style="flex-direction: column;">
                                        <label for="recipient-name" class="col-form-label">Departamento:</label>
                                        @csrf
                                        @method('POST')
                                        <select class="form-select modalForm department_slct" name="department">
                                            <option value="todos">todos</option>
                                            @foreach($departments as $id => $department)
                                            <option value="{{ $id }}" @selected(old($id))>
                                                {{ $department }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group body-modalsSinci" style="flex-direction: column;">
                                        <label for="recipient-name" class="col-form-label">Oficina:</label>
                                        <!-- @csrf
                                        @method('POST') -->
                                        <select class="form-select modalForm office_slct" name="office">
                                            <option value="todos">todos</option>
                                            @foreach($offices as $id => $office)
                                            <option value="{{ $id }}" @selected(old($id))>
                                                {{ $office }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 pt-1" style="margin-top: 2.6rem; display: flex; justify-content: space-between;">
                                    <button type="submit" class="btn btn-success">Descargar</button>
                                    <button type="button" class="btn btn-info refresh">Actualizar</button>
                                </div>
                                <hr>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- <div class="pt-2 modal-footer">
                    <button type="submit" class="btn btn-success">Descargar</button>
                </div> -->
                <div class="pt-1">
                    <div class="table-responsive">
                        <table id="dataReport" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nombre / Correo <img src="/public/img/order_up.png" alt=""> </th>
                                    <!-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Puesto / Oficina</th> -->
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Oficina <img src="/public/img/order_up.png" alt=""></th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Departamento <img src="/public/img/order_up.png" alt=""></th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Dias acumulados <img src="/public/img/order_up.png" alt=""></th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Fecha Ingreso <img src="/public/img/order_up.png" alt=""></th>
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
                                        <!-- @foreach($user->positions as $position)
                                        <p class="text-xs font-weight-bold mb-0">{{ $position->name }}</p>
                                        @endforeach -->
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
                                        <span class="text-xs text-secondary mb-0">{{ $user->days ?? 0 }}</span>
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
<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
<script>
    $('.navbar-nav li a').removeClass('bg-gradient-primary');
    $('a[href = "/reports"]').addClass('bg-gradient-primary');
    // $('a[href = "/bitacoras/main"]').addClass('active').removeClass('bg-gradient-primary');

    document.addEventListener("DOMContentLoaded", function(event) {

        let dataSearchSaved =  localStorage.setItem('searchData');

        document.querySelector('.department_slct').value = dataSearchSaved.depto;
        document.querySelector('.office_slct').value = dataSearchSaved.office;
    });

    document.querySelector('.refresh').addEventListener('click', async () => {

        localStorage.setItem('searchData', {'depto': document.querySelector('.department_slct').value, 'office': document.querySelector('.office_slct').value})

        await fetch('https://websas.sinci.com:1880/updateDaysNoDataUsers');

        setTimeout(() => {
            window.location.reload();
        }, 2000);
    });

    let filterPerOffice = valueSelected => {

        let deptoSelected = document.querySelector('.department_slct').selectedOptions[0].text;
        filterDatatable(valueSelected, deptoSelected);
        filterDatatableXLSX(valueSelected, deptoSelected);
    }

    let filterPerDeparment = valueSelected => {

        let officeSelected = document.querySelector('.office_slct').selectedOptions[0].text;
        filterDatatable(officeSelected, valueSelected);
        filterDatatableXLSX(officeSelected, valueSelected);
    }

    let filterDatatable = (officeSelected = 'todos', deptoSelected = 'todos') => {

        document.querySelectorAll('.dataFiltered').forEach(elem => {
            elem.classList.remove('dataFiltered');
        });

        let wichWay = 0;
        if (deptoSelected !== 'todos' && officeSelected !== 'todos') {
            wichWay = 1;
        } else if (deptoSelected === 'todos' && officeSelected !== 'todos') {
            wichWay = 2;
        } else if (deptoSelected !== 'todos' && officeSelected === 'todos') {
            wichWay = 3;
        }

        if (officeSelected === 'todos' && deptoSelected === 'todos')
            return false;

        if (wichWay == 1) {
            document.querySelectorAll('#dataReport tbody tr').forEach(elem => {

                let office = elem.querySelectorAll('p')[2].innerText;
                let department = elem.querySelector('span').innerText;

                if (office !== officeSelected || department !== deptoSelected)
                    elem.className = 'dataFiltered';
            });
        } else if (wichWay == 2) {
            document.querySelectorAll('#dataReport tbody tr').forEach(elem => {

                let office = elem.querySelectorAll('p')[2].innerText;

                if (office !== officeSelected)
                    elem.className = 'dataFiltered';
            });
        } else {
            document.querySelectorAll('#dataReport tbody tr').forEach(elem => {

                let department = elem.querySelector('span').innerText;

                if (department !== deptoSelected)
                    elem.className = 'dataFiltered';
            });
        }
    }

    document.querySelector('.department_slct').addEventListener('change', selection => {
        filterPerDeparment(selection.target.selectedOptions[0].text)
    });

    document.querySelector('.office_slct').addEventListener('change', selection => {
        filterPerOffice(selection.target.selectedOptions[0].text)
    });

</script>
@endsection
