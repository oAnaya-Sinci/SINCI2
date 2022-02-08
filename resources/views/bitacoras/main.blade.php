
@extends('layouts.app')

@section('cssSection')

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  <link href='../css/calendar/fullcalendar.css' rel='stylesheet' />
  <link href='../css/calendar/fullcalendar.print.css' rel='stylesheet' media='print' />

@endsection

@section('pageContent')

  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-xl-12 col-sm-12 mb-xl-0 mb-2">
        <div class="card">
          <div class="card-header p-3 pt-2">

            <div class="pt-1">

              <div id='wrap'>

                <div id='calendar'></div>
                <div style='clear:both'></div>

              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

@endsection

@section('jsSection')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
  <script src='../js/calendar/fullcalendar.js' type="text/javascript"></script>
  <script src='../js/calendar/mainCalendar.js' type="text/javascript"></script>

  <script>

    $('a[href = "/bitacoras/main"]').addClass('active').removeClass('bg-gradient-primary');

  </script>

@endsection