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

    <script>

      $(function () {
        $('.calendar').hide();
        $('#category1').show();
        $('#selectCategory').on("change",function () {
          $('.calendar').hide();
          $('#category'+$(this).val()).show();
        }).val(1); // reflect the div shown 
      });

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('category1');

        var calendar = new FullCalendar.Calendar(calendarEl, {
        schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
        plugins: [ 'resourceTimeline' ],
        header: {
            left: 'today prev,next',
            center: 'title',
            right: 'resourceTimelineDay,resourceTimelineWeek, resourceTimelineMonth'
        },
        businessHours: {
            // xdays of week. an array of zero-based day of week integers (0=Sunday)
            dow: [ 1, 2, 3, 4 ,5, 6],

            startTime: '07:00',
            endTime: '21:30',
        },
        aspectRatio: 1.6,
        height: 600,
        defaultView: 'resourceTimelineDay',
        resourceGroupField: 'itemName',
        resources: [
          @foreach($equipments as $equipment)
            @if($equipment->equip_category=="ART")
            { id: '{{$equipment->equipID}}', itemName: '{{$equipment->equip_name}}', title: '{{$equipment->equipID}}' },
            @endif
          @endforeach
        ],
        events: [
          @foreach($users as $user)
            @foreach($equipments as $equipment)
              @if($equipment->equip_category=="ART")
                @foreach($transaction_forms as $form)
                  {
                      @if($form->transaction_id == $equipment->transaction_id)
                        @if($form->user_id == $user->user_id)
                          title : '{{$form->transaction_id}} | {{$user->last_name}}',
                          resourceId: '{{$equipment->equipID}}',
                        @endif
                      @endif
                      start : '{{$form->start_date}}T{{$form->start_time}}',
                      end: '{{$form->due_date}}T{{$form->end_time}}'
                  },
                @endforeach
              @endif
            @endforeach
          @endforeach
        ]
        });

        calendar.render();
      });

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('category2');

        var calendar = new FullCalendar.Calendar(calendarEl, {
        schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
        plugins: [ 'resourceTimeline' ],
        eventClick: function(info) {
            alert(info.event.title + '\nStart: ' + info.event.start + '\nEnd: ' + info.event.end);
        },
        header: {
            left: 'today prev,next',
            center: 'title',
            right: 'resourceTimelineDay,resourceTimelineWeek,resourceTimelineMonth,resourceTimelineYear'
        },
        businessHours: {
            // xdays of week. an array of zero-based day of week integers (0=Sunday)
            dow: [ 1, 2, 3, 4 ,5, 6],

            startTime: '07:00',
            endTime: '21:30',
        },
        aspectRatio: 1.6,
        height: 600,
        defaultView: 'resourceTimelineDay',
        resourceGroupField: 'itemName',
        resources: [
          @foreach($equipments as $equipment)
            @if($equipment->equip_category=="CAMACC")
            { id: '{{$equipment->equipID}}', itemName: '{{$equipment->equip_name}}', title: '{{$equipment->equipID}}' },
            @endif
          @endforeach
        ],
        eventTextColor: 'white',
        events : [
          @foreach($users as $user)
            @foreach($equipments as $equipment)
              @if($equipment->equip_category=="CAMACC")
                @foreach($transaction_forms as $form)
                  {
                      @if($form->transaction_id == $equipment->transaction_id)
                        @if($form->user_id == $user->user_id)
                          title: '{{$form->transaction_id}} | {{$user->first_name}} {{$user->last_name}}',
                          resourceId: '{{$equipment->equipID}}',
                        @endif
                      @endif
                      start : '{{$form->start_date}}T{{$form->start_time}}',
                      end: '{{$form->due_date}}T{{$form->end_time}}'
                  },
                @endforeach
              @endif
            @endforeach
          @endforeach
        ],
        textColor: 'white'
        });

        calendar.render();
      });

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('category3');

        var calendar = new FullCalendar.Calendar(calendarEl, {
        schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
        plugins: [ 'resourceTimeline' ],
        header: {
            left: 'today prev,next',
            center: 'title',
            right: 'resourceTimelineDay,resourceTimelineWeek'
        },
        businessHours: {
            // xdays of week. an array of zero-based day of week integers (0=Sunday)
            dow: [ 1, 2, 3, 4 ,5, 6],

            startTime: '07:00',
            endTime: '21:30',
        },
        aspectRatio: 1.6,
        height: 600,
        defaultView: 'resourceTimelineDay',
        resourceGroupField: 'itemName',
        resources: [
            { id: 'a', itemName: 'Sony Playstation 4 Slim Console', title: 'SONPLA0001' },
            { id: 'b', itemName: 'Sony Playstation 4 Slim Console', title: 'SONPLA0002' },
            { id: 'c', itemName: 'Sony Playstation 4 Slim Console', title: 'SONPLA0003' },
            { id: 'd', itemName: 'Sony Playstation 4 Slim Console', title: 'SONPLA0004' },
            { id: 'e', itemName: 'Sony Playstation 4 Slim Console', title: 'SONPLA0005' },
            { id: 'f', itemName: 'Sony Playstation 4 Slim Console', title: 'SONPLA0006' },
            { id: 'g', itemName: 'Sony Playstation 4 Slim Console', title: 'SONPLA0007' },
            { id: 'h', itemName: 'Xbox One X Console', title: 'XBOONE0001' },
            { id: 'i', itemName: 'Xbox One X Console', title: 'XBOONE0002' },
            { id: 'j', itemName: 'Xbox One X Console', title: 'XBOONE0003' },
            { id: 'k', itemName: 'Xbox One X Console', title: 'XBOONE0004' },
            { id: 'l', itemName: 'Xbox One X Console', title: 'XBOONE0005' },
            { id: 'm', itemName: 'Xbox One X Console', title: 'XBOONE0006' },
            { id: 'n', itemName: 'Xbox One X Console', title: 'XBOONE0007' },
            { id: 'q', itemName: 'Razer Kraken Pro Headphones', title: 'RAZKRA0001' },
            { id: 'r', itemName: 'Razer Kraken Pro Headphones', title: 'RAZKRA0002' },
            { id: 's', itemName: 'Razer Kraken Pro Headphones', title: 'RAZKRA0003' },
            { id: 't', itemName: 'Razer Kraken Pro Headphones', title: 'RAZKRA0004' },
            { id: 'u', itemName: 'Razer Kraken Pro Headphones', title: 'RAZKRA0005' },
            { id: 'v', itemName: 'Razer Kraken Pro Headphones', title: 'RAZKRA0006' },
            { id: 'w', itemName: 'Razer Kraken Pro Headphones', title: 'RAZKRA0007' },
        ]
        });

        calendar.render();
      });

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('category4');

        var calendar = new FullCalendar.Calendar(calendarEl, {
        schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
        plugins: [ 'resourceTimeline' ],
        header: {
            left: 'today prev,next',
            center: 'title',
            right: 'resourceTimelineDay,resourceTimelineWeek'
        },
        businessHours: {
            // xdays of week. an array of zero-based day of week integers (0=Sunday)
            dow: [ 1, 2, 3, 4 ,5, 6],

            startTime: '07:00',
            endTime: '21:30',
        },
        aspectRatio: 1.6,
        height: 600,
        defaultView: 'resourceTimelineDay',
        resourceGroupField: 'itemName',
        resources: [
            { id: 'a', itemName: 'Apple Macbook Pro Laptop', title: 'MACPRO0001' },
            { id: 'b', itemName: 'Apple Macbook Pro Laptop', title: 'MACPRO0002' },
            { id: 'c', itemName: 'Apple Macbook Pro Laptop', title: 'MACPRO0003' },
            { id: 'd', itemName: 'Apple Macbook Pro Laptop', title: 'MACPRO0004' },
            { id: 'e', itemName: 'Apple Macbook Pro Laptop', title: 'MACPRO0005' },
            { id: 'f', itemName: 'Apple Macbook Pro Laptop', title: 'MACPRO0006' },
            { id: 'g', itemName: 'Apple Macbook Pro Laptop', title: 'MACPRO0007' },
            { id: 'h', itemName: 'Microsoft New Surface Pro 2017 Laptop', title: 'MICSUR0001' },
            { id: 'i', itemName: 'Microsoft New Surface Pro 2017 Laptop', title: 'MICSUR0002' },
            { id: 'j', itemName: 'Microsoft New Surface Pro 2017 Laptop', title: 'MICSUR0003' },
            { id: 'k', itemName: 'Microsoft New Surface Pro 2017 Laptop', title: 'MICSUR0004' },
            { id: 'l', itemName: 'Microsoft New Surface Pro 2017 Laptop', title: 'MICSUR0005' },
            { id: 'm', itemName: 'Microsoft New Surface Pro 2017 Laptop', title: 'MICSUR0006' },
            { id: 'n', itemName: 'Microsoft New Surface Pro 2017 Laptop', title: 'MICSUR0007' },
            { id: 'q', itemName: 'Logitech M353 Mouse', title: 'LOGMOU0001' },
            { id: 'r', itemName: 'Logitech M353 Mouse', title: 'LOGMOU0002' },
            { id: 's', itemName: 'Logitech M353 Mouse', title: 'LOGMOU0003' },
            { id: 't', itemName: 'Logitech M353 Mouse', title: 'LOGMOU0004' },
            { id: 'u', itemName: 'Logitech M353 Mouse', title: 'LOGMOU0005' },
            { id: 'v', itemName: 'Logitech M353 Mouse', title: 'LOGMOU0006' },
            { id: 'w', itemName: 'Logitech M353 Mouse', title: 'LOGMOU0007' },
        ]
        });

        calendar.render();
      });

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('category5');

        var calendar = new FullCalendar.Calendar(calendarEl, {
        schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
        plugins: [ 'resourceTimeline' ],
        header: {
            left: 'today prev,next',
            center: 'title',
            right: 'resourceTimelineDay,resourceTimelineWeek'
        },
        businessHours: {
            // xdays of week. an array of zero-based day of week integers (0=Sunday)
            dow: [ 1, 2, 3, 4 ,5, 6],

            startTime: '07:00',
            endTime: '21:30',
        },
        aspectRatio: 1.6,
        height: 600,
        defaultView: 'resourceTimelineDay',
        resourceGroupField: 'itemName',
        resources: [
            { id: 'a', itemName: 'Spalding NBA Official Game Ball Basketball', title: 'SPANBA0001' },
            { id: 'b', itemName: 'Spalding NBA Official Game Ball Basketball', title: 'SPANBA0002' },
            { id: 'c', itemName: 'Spalding NBA Official Game Ball Basketball', title: 'SPANBA0003' },
            { id: 'd', itemName: 'Spalding NBA Official Game Ball Basketball', title: 'SPANBA0004' },
            { id: 'e', itemName: 'Spalding NBA Official Game Ball Basketball', title: 'SPANBA0005' },
            { id: 'f', itemName: 'Spalding NBA Official Game Ball Basketball', title: 'SPANBA0006' },
            { id: 'g', itemName: 'Spalding NBA Official Game Ball Basketball', title: 'SPANBA0007' },
            { id: 'h', itemName: 'Stiga Pro Carbon Table Tennis Racket', title: 'STIPRO0001' },
            { id: 'i', itemName: 'Stiga Pro Carbon Table Tennis Racket', title: 'STIPRO0002' },
            { id: 'j', itemName: 'Stiga Pro Carbon Table Tennis Racket', title: 'STIPRO0003' },
            { id: 'k', itemName: 'Stiga Pro Carbon Table Tennis Racket', title: 'STIPRO0004' },
            { id: 'l', itemName: 'Stiga Pro Carbon Table Tennis Racket', title: 'STIPRO0005' },
            { id: 'm', itemName: 'Stiga Pro Carbon Table Tennis Racket', title: 'STIPRO0006' },
            { id: 'n', itemName: 'Stiga Pro Carbon Table Tennis Racket', title: 'STIPRO0007' },
            { id: 'q', itemName: 'Decathlon FT 950 Indoor Table Tennis Table', title: 'DECIND0001' },
            { id: 'r', itemName: 'Decathlon FT 950 Indoor Table Tennis Table', title: 'DECIND0002' },
            { id: 's', itemName: 'Decathlon FT 950 Indoor Table Tennis Table', title: 'DECIND0003' },
            { id: 't', itemName: 'Decathlon FT 950 Indoor Table Tennis Table', title: 'DECIND0004' },
            { id: 'u', itemName: 'Decathlon FT 950 Indoor Table Tennis Table', title: 'DECIND0005' },
            { id: 'v', itemName: 'Decathlon FT 950 Indoor Table Tennis Table', title: 'DECIND0006' },
            { id: 'w', itemName: 'Decathlon FT 950 Indoor Table Tennis Table', title: 'DECIND0007' },
        ]
        });

        calendar.render();
      });

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('category6');

        var calendar = new FullCalendar.Calendar(calendarEl, {
        schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
        plugins: [ 'resourceTimeline' ],
        header: {
            left: 'today prev,next',
            center: 'title',
            right: 'resourceTimelineDay,resourceTimelineWeek'
        },
        businessHours: {
            // xdays of week. an array of zero-based day of week integers (0=Sunday)
            dow: [ 1, 2, 3, 4 ,5, 6],

            startTime: '07:00',
            endTime: '21:30',
        },
        aspectRatio: 1.6,
        height: 600,
        defaultView: 'resourceTimelineDay',
        resourceGroupField: 'itemName',
        resources: [
            { id: 'a', itemName: 'Swivel Chair', title: 'SWICHA0001' },
            { id: 'b', itemName: 'Swivel Chair', title: 'SWICHA0002' },
            { id: 'c', itemName: 'Swivel Chair', title: 'SWICHA0003' },
            { id: 'd', itemName: 'Swivel Chair', title: 'SWICHA0004' },
            { id: 'e', itemName: 'Swivel Chair', title: 'SWICHA0005' },
            { id: 'f', itemName: 'Swivel Chair', title: 'SWICHA0006' },
            { id: 'g', itemName: 'Swivel Chair', title: 'SWICHA0007' },
            { id: 'h', itemName: 'Whiteboard Marker', title: 'WHIMAR0001' },
            { id: 'i', itemName: 'Whiteboard Marker', title: 'WHIMAR0002' },
            { id: 'j', itemName: 'Whiteboard Marker', title: 'WHIMAR0003' },
            { id: 'k', itemName: 'Whiteboard Marker', title: 'WHIMAR0004' },
            { id: 'l', itemName: 'Whiteboard Marker', title: 'WHIMAR0005' },
            { id: 'm', itemName: 'Whiteboard Marker', title: 'WHIMAR0006' },
            { id: 'n', itemName: 'Whiteboard Marker', title: 'WHIMAR0007' },
        ]
        });

        calendar.render();
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
{{--     @include('inc.checkFormModal')
    @include('inc.viewStudentModal') --}}
@endsection