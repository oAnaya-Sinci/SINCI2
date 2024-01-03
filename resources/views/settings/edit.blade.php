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
                    <form method="POST" action="{{ route('settings.update', $setting) }}">
                    @csrf
                    @method('POST')
                        <div class="pt-4">
                            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                                <div class="input-group input-group-outline">
                                    <label class="form-label">Nivel</label>
                                    <input type="text" class="form-control" name="level" value="{{ $setting->level }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="pt-5">
                            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                                <div class="input-group input-group-outline">
                                    <label class="form-label">Días</label>
                                    <input type="text" class="form-control" name="days" value="{{ $setting->days }}">
                                </div>
                            </div>
                        </div>
                        <div class="pt-4">
                        <div class="pt-2 modal-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a  class="btn btn-secondary" href="{{ route('settings') }}" >Cancelar</a>
                        </div>
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
    $('a[href = "/settings"]').addClass('bg-gradient-primary');
    // $('a[href = "/bitacoras/main"]').addClass('active').removeClass('bg-gradient-primary');

</script>
@endsection