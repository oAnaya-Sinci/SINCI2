
@extends('layouts.app')

@section('cssSection')

@endsection

@section('pageContent')

  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-xl-12 col-sm-12 mb-xl-0 mb-2">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="pt-1">

              <div id='wrap'>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('jsSection')

<script src="../js/compras/mainCompras.js"></script>

  <script>

    $('.navbar-nav li a').removeClass('bg-gradient-primary');
    $('a[href = "/compras/main"]').addClass('bg-gradient-primary');

  </script>

@endsection