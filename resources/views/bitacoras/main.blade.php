
@extends('layouts.app')

@section('cssSection')

  <link href='../css/calendar/fullcalendar.css' rel='stylesheet' />
  <link href='../css/calendar/fullcalendar.print.css' rel='stylesheet' media='print' />

@endsection

@section('pageContent')

  <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-12 col-sm-6 mb-xl-0 mb-2">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <!-- <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">weekend</i>
              </div> -->
              <div class=" pt-1">

                <div id='wrap'>

                <div id='calendar'></div>

                <div style='clear:both'></div>
                
              </div>
            </div>
      
          </div>
        </div>

@endsection

@section('jsSection')

  <script src='../js/calendar/jquery-1.10.2.js' type="text/javascript"></script>
  <script src='../js/calendar/jquery-1.10.2.js' type="text/javascript"></script>
  <script src='../js/calendar/jquery-ui.custom.min.js' type="text/javascript"></script>
  <script src='../js/calendar/fullcalendar.js' type="text/javascript"></script>
  <script src='../js/calendar/mainCalendar.js' type="text/javascript"></script>

@endsection