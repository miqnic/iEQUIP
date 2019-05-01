@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Calendar</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/core-main.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/timeline-main.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/resourcetimeline-main.min.css') }}">
    
    <script type="text/javascript" src="{{ asset('js/core-main.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/timeline-main.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/resourcecommon-main.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/resourcetimeline-main.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/category1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/category2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/category3.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/category4.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/category5.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/category6.js') }}"></script>

    <script>
        $(function () {
          $('.calendar').hide();
          $('#category2').show();
          $('#selectCategory').on("change",function () {
            $('.calendar').hide();
            $('#category'+$(this).val()).show();
          }).val(2); // reflect the div shown 
        });
    </script> 
@endsection

@section('navi')
    @include('inc.naviAdmin')
@endsection

@section('content')
<div class="header">
    <h2 class="border-bottom pb-2 pl-3">Reservation Calendar</h2>
    <div class="row mr-3">
      <div class="col-md-10">
        <p class="lead pl-3">The availability of the items will reflect here.</p>
      </div>
      <div class="col-md-2 pt-3">
        Choose Category: 
        <select class="form-control" id="selectCategory">
            <option value="1">Art Tools</option>
            <option value="2">Cameras & Accessories</option>
            <option value="3">Gaming Devices</option>
            <option value="4">Laptops & Accessories</option>
            <option value="5">Sports Equipment</option>
            <option value="6">Miscellaneous</option>
        </select>
      </div>
    </div>
</div>

<div class="container-fluid">            
    <div class="calendar" id="category1"></div>
    <div class="calendar" id="category2"></div>
    <div class="calendar" id="category3"></div>
    <div class="calendar" id="category4"></div>
    <div class="calendar" id="category5"></div>
    <div class="calendar" id="category6"></div>
</div>
@endsection

@section('modal')
    @include('inc.checkFormModal')
    @include('inc.viewStudentModal')
@endsection