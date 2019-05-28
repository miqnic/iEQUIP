@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Calendar</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/equiplist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/core-main.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-main.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/daygrid-main.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/timegrid-main.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/timeline-main.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/resourcetimeline-main.min.css') }}">

    
    <script type="text/javascript" src="{{ asset('js/core-main.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-main.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/daygrid-main.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/timegrid-main.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/timeline-main.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/resourcecommon-main.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/resourcetimeline-main.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/resourcedaygrid-main.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/resourcetimegrid-main.min.js') }}"></script>

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
        plugins: [ 'resourceTimeline', 'bootstrap', 'resourceTimeGrid' ],
        themeSystem: 'bootstrap',
        eventClick: function(info) {
            alert(info.event.title + '\nStart: ' + info.event.start + '\nEnd: ' + info.event.end);
        },
        header: {
            left: 'today prev,next',
            center: 'title',
            right: 'resourceTimelineDay,resourceTimeGridFourDay,resourceTimelineWeek,resourceTimelineMonth,resourceTimelineYear'
        },
        views: {
          resourceTimeGridFourDay: {
            type: 'resourceTimeGrid',
            duration: { days: 4 },
            buttonText: '4 days'
          }
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
        eventTextColor: 'white',
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
                          title : '{{$form->transaction_id}} | {{$user->first_name}} {{$user->last_name}}',
                          resourceId: '{{$equipment->equipID}}',
                        @endif
                      @endif
                      start: '{{$form->start_date}}T{{$form->start_time}}',
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
        plugins: [ 'resourceTimeline', 'bootstrap', 'resourceTimeGrid' ],
        themeSystem: 'bootstrap',
        eventClick: function(info) {
            alert(info.event.title + '\nStart: ' + info.event.start + '\nEnd: ' + info.event.end);
        },
        header: {
            left: 'today prev,next',
            center: 'title',
            right: 'resourceTimelineDay,resourceTimeGridFourDay,resourceTimelineWeek,resourceTimelineMonth,resourceTimelineYear'
        },
        views: {
          resourceTimeGridFourDay: {
            type: 'resourceTimeGrid',
            duration: { days: 4 },
            buttonText: '4 days'
          }
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
        eventTextColor: 'white',
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
        ]
        });

        calendar.render();
      });

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('category3');

        var calendar = new FullCalendar.Calendar(calendarEl, {
        schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
        plugins: [ 'resourceTimeline', 'bootstrap', 'resourceTimeGrid' ],
        themeSystem: 'bootstrap',
        eventClick: function(info) {
            alert(info.event.title + '\nStart: ' + info.event.start + '\nEnd: ' + info.event.end);
        },
        header: {
            left: 'today prev,next',
            center: 'title',
            right: 'resourceTimelineDay,resourceTimeGridFourDay,resourceTimelineWeek,resourceTimelineMonth,resourceTimelineYear'
        },
        views: {
          resourceTimeGridFourDay: {
            type: 'resourceTimeGrid',
            duration: { days: 4 },
            buttonText: '4 days'
          }
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
        eventTextColor: 'white',
        resourceGroupField: 'itemName',
        resources: [
          @foreach($equipments as $equipment)
            @if($equipment->equip_category=="GMNG")
            { id: '{{$equipment->equipID}}', itemName: '{{$equipment->equip_name}}', title: '{{$equipment->equipID}}' },
            @endif
          @endforeach
        ],
        eventTextColor: 'white',
        events : [
          @foreach($users as $user)
            @foreach($equipments as $equipment)
              @if($equipment->equip_category=="GMNG")
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
        ]
        });

        calendar.render();
      });

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('category4');

        var calendar = new FullCalendar.Calendar(calendarEl, {
        schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
        plugins: [ 'resourceTimeline', 'bootstrap', 'resourceTimeGrid' ],
        themeSystem: 'bootstrap',
        eventClick: function(info) {
            alert(info.event.title + '\nStart: ' + info.event.start + '\nEnd: ' + info.event.end);
        },
        header: {
            left: 'today prev,next',
            center: 'title',
            right: 'resourceTimelineDay,resourceTimeGridFourDay,resourceTimelineWeek,resourceTimelineMonth,resourceTimelineYear'
        },
        views: {
          resourceTimeGridFourDay: {
            type: 'resourceTimeGrid',
            duration: { days: 4 },
            buttonText: '4 days'
          }
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
        eventTextColor: 'white',
        resourceGroupField: 'itemName',
        resources: [
          @foreach($equipments as $equipment)
            @if($equipment->equip_category=="LPTP")
            { id: '{{$equipment->equipID}}', itemName: '{{$equipment->equip_name}}', title: '{{$equipment->equipID}}' },
            @endif
          @endforeach
        ],
        eventTextColor: 'white',
        events : [
          @foreach($users as $user)
            @foreach($equipments as $equipment)
              @if($equipment->equip_category=="LPTP")
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
        ]
        });

        calendar.render();
      });

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('category5');

        var calendar = new FullCalendar.Calendar(calendarEl, {
        schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
        plugins: [ 'resourceTimeline', 'bootstrap', 'resourceTimeGrid' ],
        themeSystem: 'bootstrap',
        eventClick: function(info) {
            alert(info.event.title + '\nStart: ' + info.event.start + '\nEnd: ' + info.event.end);
        },
        header: {
            left: 'today prev,next',
            center: 'title',
            right: 'resourceTimelineDay,resourceTimeGridFourDay,resourceTimelineWeek,resourceTimelineMonth,resourceTimelineYear'
        },
        views: {
          resourceTimeGridFourDay: {
            type: 'resourceTimeGrid',
            duration: { days: 4 },
            buttonText: '4 days'
          }
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
        eventTextColor: 'white',
        resourceGroupField: 'itemName',
        resources: [
          @foreach($equipments as $equipment)
            @if($equipment->equip_category=="SPRT")
            { id: '{{$equipment->equipID}}', itemName: '{{$equipment->equip_name}}', title: '{{$equipment->equipID}}' },
            @endif
          @endforeach
        ],
        eventTextColor: 'white',
        events : [
          @foreach($users as $user)
            @foreach($equipments as $equipment)
              @if($equipment->equip_category=="SPRT")
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
        ]
        });

        calendar.render();
      });

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('category6');

        var calendar = new FullCalendar.Calendar(calendarEl, {
        schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
        plugins: [ 'resourceTimeline', 'bootstrap', 'resourceTimeGrid' ],
        themeSystem: 'bootstrap',
        eventClick: function(info) {
            alert(info.event.title + '\nStart: ' + info.event.start + '\nEnd: ' + info.event.end);
        },
        header: {
            left: 'today prev,next',
            center: 'title',
            right: 'resourceTimelineDay,resourceTimeGridFourDay,resourceTimelineWeek,resourceTimelineMonth,resourceTimelineYear'
        },
        views: {
          resourceTimeGridFourDay: {
            type: 'resourceTimeGrid',
            duration: { days: 4 },
            buttonText: '4 days'
          }
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
        eventTextColor: 'white',
        resourceGroupField: 'itemName',
        resources: [
          @foreach($equipments as $equipment)
            @if($equipment->equip_category=="MISC")
            { id: '{{$equipment->equipID}}', itemName: '{{$equipment->equip_name}}', title: '{{$equipment->equipID}}' },
            @endif
          @endforeach
        ],
        eventTextColor: 'white',
        events : [
          @foreach($users as $user)
            @foreach($equipments as $equipment)
              @if($equipment->equip_category=="MISC")
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
        ]
        });

        calendar.render();
      });
    </script> 
@endsection

@section('navi')
    @if (Auth::user()->access_role == 'ADMIN')
      @include('inc.naviAdmin')        
    @else
      @include('inc.naviStudent', [$equipments, $lastTransaction, $countCart]) 
    @endif
    
@endsection

@section('content')
<div class="row">
  <div class="col-md-10 pt-4">
    <h3>Availability Calendar</h3>
  </div>
  <div class="col-md-2 pt-4 pb-3">
    Choose Category: 
    <select class="form-control custom-select" id="selectCategory">
        <option value="1">Art Tools</option>
        <option value="2">Cameras & Accessories</option>
        <option value="3">Gaming Devices</option>
        <option value="4">Laptops & Accessories</option>
        <option value="5">Sports Equipment</option>
        <option value="6">Miscellaneous</option>
    </select>
  </div>
</div>

<div class="row mt-4" style="overflow-y: hidden">   
  <div class="col-md-12">         
    <div class="calendar" id="category1"></div>
    <div class="calendar" id="category2"></div>
    <div class="calendar" id="category3"></div>
    <div class="calendar" id="category4"></div>
    <div class="calendar" id="category5"></div>
    <div class="calendar" id="category6"></div>
  </div>
</div>
@endsection