@extends('layouts.app')
@section('pageContent')

<style>

    #dataReport thead tr th{
        cursor: pointer;
    }

    #dataReport tbody tr td{
        padding: 0;
    }

    #dataReport tbody tr td:nth-child(9){
        padding-top: 1rem;
    }

    #dataReport tbody tr td:last-child{
        padding-top: 1rem;
    }

    #dataReport thead tr th{
        padding: 1rem 0.3rem;
    }

    #dataReport thead tr th img{
        margin: -0.4rem 0.3rem 0 0;
    }

</style>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-2">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="pt-1">
                        <a href="{{ route('users.create') }}" class="m-4 ml-6 mt-3 mb-2 text-md">{{__('Nuevo')}}</a>
                    </div>
                    <div class="pt-3">

                        <div class="table-responsive">
                            <table id="dataReport" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        <span class="nombre"><img src="/img/order_down.png" alt="" width="15" height="15" name="order_down"> Nombre / Correo </span></th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            <span class="puesto"><img src="/img/order_down.png" alt="" width="15" height="15" name="order_down"> Puesto / Oficina </span></th>
                                            <!-- Puesto / Oficina</th> -->
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            <span class="departamento"><img src="/img/order_down.png" alt="" width="15" height="15" name="order_down"> Departamento </span></th>

                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><span class="fecha"><img src="/img/order_down.png" alt="" width="15" height="15" name="order_down"> Fecha Ingreso </span></th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><span class="noti_email"><img src="/img/order_down.png" alt="" width="15" height="15" name="order_down">Notificación Email </span></th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><span class="noti_telegram"><img src="/img/order_down.png" alt="" width="15" height="15" name="order_down">Notificación Telegram </span></th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><span class="admin"><img src="/img/order_down.png" alt="" width="15" height="15" name="order_down">Administrador </span></th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"><span class="ver_reporte"><img src="/img/order_down.png" alt="" width="15" height="15" name="order_down">Ver Reportes </span></th>

                                        <th class="text-secondary opacity-7"></th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{url('/img/user.png')}}"
                                                        class="avatar avatar-sm me-3">
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
                                            <span class="text-xs text-secondary mb-0">{{ date_format(date_create($user->admission_date), 'd-m-Y') }}</span>
                                        </td>

                                        <td class="align-middle text-center text-sm">
                                            @if( $user->email_notifi == "on" )
                                                <span class="text-xs text-secondary mb-0">Activo</span>
                                            @else
                                                <span class="text-xs text-secondary mb-0">Inactivo</span>
                                            @endif
                                        </td>

                                        <td class="align-middle text-center text-sm">
                                            @if( $user->telegram_notifi == "on" )
                                                <span class="text-xs text-secondary mb-0">Activo</span>
                                            @else
                                                <span class="text-xs text-secondary mb-0">Inactivo</span>
                                            @endif
                                        </td>

                                        <td class="align-middle text-center text-sm">
                                            @if( $user->is_admin == 1 )
                                                <span class="text-xs text-secondary mb-0">si</span>
                                            @else
                                                <span class="text-xs text-secondary mb-0">no</span>
                                            @endif
                                        </td>

                                        <td class="align-middle text-center text-sm">
                                            @if( $user->reports == 1 )
                                                <span class="text-xs text-secondary mb-0">si</span>
                                            @else
                                                <span class="text-xs text-secondary mb-0">no</span>
                                            @endif
                                        </td>

                                        <td class="align-middle text-center text-sm">
                                            <a  href="{{ route('users.edit', $user) }}" class="btn btn-info"
                                                data-toggle="tooltip" data-original-title="Edit user">
                                                Editar
                                            </a>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                        <form method="POST" action="{{ route('users.destroy', $user) }}">
                                                @csrf
                                                @method('DELETE')
                                            <button type="submit" onclick="return confirm('¿Desea continuar con la eliminación del usuario {{ $user->name }}? ')" class="btn btn-danger"
                                                data-toggle="tooltip" data-original-title="Delete user">
                                                Eliminar
                                            </button>
                                            </form>
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

document.addEventListener("DOMContentLoaded", function(event) {
        outLoader();
    });
    checkIsAdmin();
    
    $('.navbar-nav li a').removeClass('bg-gradient-primary');
    $('a[href = "/users"]').addClass('bg-gradient-primary');
    // $('a[href = "/bitacoras/main"]').addClass('active').removeClass('bg-gradient-primary');

    localStorage.setItem('searchDataDepto', 'todos');
    localStorage.setItem('searchDataOffice', 'todos');

    document.querySelectorAll('#dataReport thead tr th').forEach( th => {
        
        th.addEventListener('click', event => {

            let span = th.querySelector('span');            
            let typeHead = span.classList.value;

            let checkImgOrder = (elem, type) => {

                let previousValue = elem.querySelector('img').name;

                elem.parentElement.parentElement.querySelectorAll('th span img').forEach( img => {
                    img.src = '/img/order_down.png';
                    img.name = 'order_down';
                });

                if(previousValue == 'order_up'){
                    elem.querySelector('img').src = '/img/order_down.png';
                    elem.querySelector('img').name = 'order_down';
                    orderDataTable(type, 'order_down');
                } else {
                    elem.querySelector('img').src = '/img/order_up.png';
                    elem.querySelector('img').name = 'order_up';
                    orderDataTable(type, 'order_up');
                }
            };

            let dateFormater = (date, wichFormat) => {
    
                let dateToFormat = date.split(/[- /]/);

                let newDate;
                
                switch(wichFormat){
                    case 1:
                        newDate = `${dateToFormat[0]}-${dateToFormat[1]}-${dateToFormat[2]}`;
                        break;
                    case 2:
                        newDate = `${dateToFormat[2]}-${dateToFormat[1]}-${dateToFormat[0]}`;
                        break;
                }
                
                return newDate;
            }

            let orderDataTable = (type, order) => {

                let dataTable = [];
                document.querySelectorAll('#dataReport tbody tr').forEach( td => {

                    let objDataRow = {
                        'name': td.querySelectorAll('td')[0].querySelector('h6').innerText,
                        'email': td.querySelectorAll('td')[0].querySelector('p').innerText,
                        'puesto': td.querySelectorAll('td')[1].querySelectorAll('p')[0].innerText,
                        'office': td.querySelectorAll('td')[1].querySelectorAll('p')[1].innerText,
                        'department': td.querySelectorAll('td')[2].innerText,
                        'date': dateFormater(td.querySelectorAll('td')[3].innerText, 2),
                        'not_email': td.querySelectorAll('td')[4].innerText,
                        'not_teleg': td.querySelectorAll('td')[5].innerText,
                        'admin': td.querySelectorAll('td')[6].innerText,
                        'report': td.querySelectorAll('td')[7].innerText,
                        'btn_edit': td.querySelectorAll('td')[8].innerHTML,
                        'btn_delete': td.querySelectorAll('td')[9].innerHTML
                    };
                    dataTable.push(objDataRow);
                });

                let dataSorted;    
                if(order == 'order_up')
                    dataSorted = dataTable.sort( (a,b) => { return a[type] < b[type] ? 1 : -1 } );
                else
                    dataSorted = dataTable.sort( (a,b) => { return a[type] > b[type] ? 1 : -1 } );
                
                    console.log(dataSorted);
                let orderBody = "";
                
                dataSorted.forEach( elem => {
                    orderBody += `<tr>`
                    orderBody += `<td><div class="d-flex px-2 py-1"> <div><img src="{{url('/img/user.png')}}" class="avatar avatar-sm me-3"></div> <div class="d-flex flex-column justify-content-center"> <h6 class="mb-0 text-xs">${elem.name}</h6> <p class="text-xs text-secondary mb-0">${elem.email}</p></div></div></td>`;
                    orderBody += `<td> <p class="text-xs font-weight-bold mb-0">${elem.puesto}</p> <p class="text-xs text-secondary mb-0">${elem.office}</p></td>`;                    
                    orderBody += `<td class="align-middle text-center text-sm"> <span class="text-xs text-secondary mb-0">${elem.department}</span> </td>`;                    
                    orderBody += `<td class="align-middle text-center text-sm"> <span class="text-xs text-secondary mb-0">${dateFormater(elem.date, 2)}</span> </td>`;
                    orderBody += `<td class="align-middle text-center text-sm"> <span class="text-xs text-secondary mb-0">${elem.not_email}</span> </td>`;
                    orderBody += `<td class="align-middle text-center text-sm"> <span class="text-xs text-secondary mb-0">${elem.not_teleg}</span> </td>`;
                    orderBody += `<td class="align-middle text-center text-sm"> <span class="text-xs text-secondary mb-0">${elem.admin}</span> </td>`;
                    orderBody += `<td class="align-middle text-center text-sm"> <span class="text-xs text-secondary mb-0">${elem.report}</span> </td>`;
                    orderBody += `<td class="align-middle text-center text-sm"> <span class="text-xs text-secondary mb-0">${elem.btn_edit}</span> </td>`;
                    orderBody += `<td class="align-middle text-center text-sm"> <span class="text-xs text-secondary mb-0">${elem.btn_delete}</span> </td>`;
                    orderBody += '</tr>'
                });

                document.querySelectorAll('#dataReport tbody tr').forEach( elem => { elem.remove(); } );
                document.querySelector('#dataReport tbody').innerHTML = orderBody;
            };

            switch(typeHead){
                case 'nombre':
                    checkImgOrder(span, 'name');
                    break;
                
                case 'puesto':
                    checkImgOrder(span, 'puesto');
                    break;
                
                case 'departamento':
                    checkImgOrder(span, 'department');
                    break;

                case 'fecha':
                    checkImgOrder(span, 'date');
                    break;

                case 'noti_email':
                    checkImgOrder(span, 'noti_email');
                    break;

                case 'noti_telegram':
                    checkImgOrder(span, 'not_teleg');
                    break;

                case 'admin':
                    checkImgOrder(span, 'admin');
                    break;
                    
                case 'ver_reporte':
                    checkImgOrder(span, 'report');
                    break;
            }
        });
    });

</script>
@endsection
