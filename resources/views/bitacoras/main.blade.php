
@extends('layouts.app')

@section('cssSection')

  <link href='../css/datepicker.min.css' rel='stylesheet' media='print' />

  <link href='../css/calendar/mainCalendar.css' rel='stylesheet' />
  <link href='../css/calendar/fullcalendar.css' rel='stylesheet' />
  <link href='../css/calendar/fullcalendar.print.css' rel='stylesheet' media='print' />

  <!-- <link href='../css/MCDatePicker/mc-calendar.min.css' rel='stylesheet' /> -->
  
  <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css" rel="stylesheet"/>

@endsection

@section('pageContent')

  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-xl-12 col-sm-12 mb-xl-0 mb-2">
        <div class="card">
          <div class="card-header p-3 pt-2">

            <div class=" pt-1">

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

  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.2/moment.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
  <script src='../js/datepicker.min.js' type="text/javascript"></script>

  <script src='../js/calendar/fullcalendar.js' type="text/javascript"></script>
  <script src='../js/calendar/mainCalendar.js' type="text/javascript"></script>

  <!-- <script src='../js/MCDatePicker/mc-calendar.min.js' type="text/javascript"></script> -->

@endsection