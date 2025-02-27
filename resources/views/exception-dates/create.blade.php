@extends('layouts.app')

@section('cssSection')
@endsection

@section('pageContent')

@endsection

@section('jsSection')
<script src='../js/calendar/jquery-ui.custom.min.js' type="text/javascript"></script>
<script>
    $('.navbar-nav li a').removeClass('bg-gradient-primary');
    $('a[href = "/exception-dates/main"]').addClass('bg-gradient-primary');

    setTimeout(() => {
        outLoader();
    }, 1000);
</script>
@endsection
