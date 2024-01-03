@extends('layouts.app')

@section('cssSection')
<!-- <link rel="stylesheet" href="/css/dataTable/dataTable-1.11.5.css"> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<link rel="stylesheet" href="/css/compras/mainCompras.css">
@endsection

@section('pageContent')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-2">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        @method('POST')
                        <div class="pt-4">
                            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                                <div class="input-group input-group-outline">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                        </div>
                        <div class="pt-5">
                            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                                <div class="input-group input-group-outline">
                                    <label class="form-label">Correo electronico</label>
                                    <input type="text" class="form-control" name="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="pt-5">
                            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                                <div class="input-group input-group-outline">
                                    <label class="form-label">Codigo de Telegram</label>
                                    <input type="text" class="form-control" name="chat_id">
                                </div>
                            </div>
                        </div>
                        <div class="pt-5">
                            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                                <div class="input-group input-group-outline">
                                    <label class="form-label">Oficina</label>
                                    <select type="text" class="form-control" name="office" required>
                                        <option value="">{{__('Selecciona')}}</option>
                                        @foreach($offices as $id => $office)
                                        <option value="{{ $id }}" @selected(old($id))>
                                            {{ $office }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="pt-5">
                            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                                <div class="input-group input-group-outline">
                                    <label class="form-label">Puesto</label>
                                    <select type="text" class="form-control" name="position">
                                        <option value="">{{__('Selecciona')}}</option>
                                        @foreach($positions as $id => $position)
                                        <option value="{{ $id }}" @selected(old($id))>
                                            {{ $position }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="pt-5">
                            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                                <div class="input-group input-group-outline">
                                    <label class="form-label">Departamento</label>
                                    <select type="text" class="form-control" name="department">
                                        <option value="">{{__('Selecciona')}}</option>
                                        @foreach($departments as $id => $department)
                                        <option value="{{ $id }}" @selected(old($id))>
                                            {{ $department }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="pt-5">
                            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                                <div class="input-group input-group-outline">
                                    <label class="form-label">Fecha de ingreso</label>
                                    <input type="date" class="form-control" name="admission_date" required>
                                </div>
                            </div>
                        </div>
                        <div class="pt-5">
                            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                                <div class="input-group input-group-outline pt-2">
                                    <label class="form-label">Canales de notificacion</label>
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <input class="form-check-input" type="checkbox" id="email_notifi"
                                            name="email_notifi">
                                        <label class="form-check-label mb-0 ms-2" for="email">Correo electronico</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center mb-3">
                                        <input class="form-check-input" type="checkbox" id="telegram_notifi"
                                            name="telegram_notifi">
                                        <label class="form-check-label mb-0 ms-2" for="telegram">Telegram</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pt-3">
                            <div class="form-check d-flex align-items-center mb-3">
                                <input class="form-check-input" type="checkbox" id="is_admin"
                                    name="is_admin" value="true">
                                <label class="form-check-label mb-0 ms-2" for="admin">Agregar como administrador</label>
                            </div>
                            <div class="form-check d-flex align-items-center mb-3">
                                <input class="form-check-input" type="checkbox" id="reports"
                                    name="reports" value="true">
                                <label class="form-check-label mb-0 ms-2" for="reports">Ver reportes</label>
                            </div>
                        </div>
                        <div class="pt-2 modal-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a class="btn btn-secondary" href="{{ route('users') }}">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('jsSection')
<script>
    checkIsAdmin();
    
    $('.navbar-nav li a').removeClass('bg-gradient-primary');
    $('a[href = "/users"]').addClass('bg-gradient-primary');
    // $('a[href = "/bitacoras/main"]').addClass('active').removeClass('bg-gradient-primary');

</script>
@endsection