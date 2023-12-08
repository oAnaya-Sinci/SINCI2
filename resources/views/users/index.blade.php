@extends('layouts.app')
@section('pageContent')
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

                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha Ingreso</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Notificación Email</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Notificación Telegram</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Administrador</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ver Reportes</th>

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
                                            <button type="button" onclick="return confirm('Estas seguro?')" class="btn btn-danger"
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
    $('.navbar-nav li a').removeClass('bg-gradient-primary');
    $('a[href = "/users"]').addClass('bg-gradient-primary');
    // $('a[href = "/bitacoras/main"]').addClass('active').removeClass('bg-gradient-primary');
</script>
@endsection
