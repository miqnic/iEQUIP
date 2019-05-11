@extends('layouts.app')

@section('head')
    <title>{{ config('app.name') }} | Feedbacks</title>

    <script>
    $(function () {
      $('.sort').hide();
      $('#option1').show();
      $('#sortBy').on("change",function () {
        $('.sort').hide();
        $('#option'+$(this).val()).show();
      }).val(1); // reflect the div shown 
    });

    $(function () {
      $('.filter').hide();
      $('#filter1').show();
      $('#filterBy').on("change",function () {
        $('.filter').hide();
        $('#filter'+$(this).val()).show();
      }).val(1); // reflect the div shown 
    });
    </script>
@endsection

@section('navi')
    @include('inc.naviAdmin')
@endsection

@section('content')
    <h2 class="border-bottom pb-2 pl-3">Feedbacks</h2>
    <p class="lead pl-3">Unread messages sent by the faculty and students can be seen by clicking on each tab below.</p> 
    {{--<div class="w-25 ml-4 mt-4">
         <div class="btn-group dropright">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Sort by
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Newest</a>
          <a class="dropdown-item" href="#">Oldest</a>
          <a class="dropdown-item" href="#">Type of Feedback</a>
        </div>
      </div>
    </div> --}}

    <div class="row">
      <div class="col-md-2 pt-2 ml-4">
        Sort by:
          <select class="form-control" id="sortBy">
              <option value="1">Newest</option>
              <option value="2">Oldest</option>
              <option value="3">Type of Feedback</option>
          </select>
      </div>
      <div class="col-md-2 pt-2 ml-4">
        Filter:
          <select class="form-control" id="filterBy">
              <option value="1">All</option>
              <option value="2">Unread</option>
              <option value="3">Read</option>
          </select>
      </div>
    </div>

    <div class="sort" id="option1">
      <div class="mx-4 mt-4">
        <div class="accordion" id="feedback">
          @foreach($newest as $new)
          <div class="card">
            <div class="card-header" id="feedbackPost{{$new->id}}" data-toggle="collapse" data-target="#collapse{{$new->id}}" aria-expanded="true" aria-controls="collapse{{$new->id}}">
              <h6 class="text-primary">
                <span class="float-left @if($new->read==0)font-weight-bold @endif "><b>{{\Carbon\Carbon::parse($new->created_at)->toDayDateTimeString()}}</b> | {{$new->user_id}} | {{$new->subject}}</span>
                <span class="float-right"><i class="fas fa-chevron-down fa-xs"></i></span>
              </h6>
            </div>
          
            <div id="collapse{{$new->id}}" class="collapse" aria-labelledby="feedbackPost{{$new->id}}" data-parent="#feedback">
              <div class="card-body mx-4">
                <p>
                    {!! Form::open(['action' => 'EmailsController@read', 'method' => 'POST']) !!}
                    {{ Form::hidden('feedbackid', $new->id) }}
                    {{Form::submit('Mark as Read', ['class' => 'btn btn-primary float-right'])}}
                    {!! Form::close() !!}
                    @foreach($users as $user)
                    @if($user->user_id==$new->user_id)
                    <b>Student Name:</b> {{$user->first_name}} {{$user->last_name}}<br>
                    <b>Course:</b> {{$user->course}}<br>
                    @endif
                    @endforeach
                    <b>Type of Feedback:</b> 
                    @if($new->feedback_type==0)
                      Suggestion
                    @elseif($new->feedback_type==1)
                      Complaint
                    @else 
                      Others
                    @endif
                </p>
                <p>
                    <b>Message:</b><br>
                    {{$new->body}}
                </p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    
    <div class="sort" id="option2">
      <div class="mx-4 mt-4">
        <div class="accordion" id="feedback">
          @foreach($oldest as $old)
          <div class="card">
            <div class="card-header" id="feedbackPost{{$old->id}}" data-toggle="collapse" data-target="#collapse{{$old->id}}" aria-expanded="true" aria-controls="collapse{{$old->id}}">
              <h6 class="text-primary">
                <span class="float-left @if($old->read==0)font-weight-bold @endif ">{{\Carbon\Carbon::parse($old->created_at)->toDayDateTimeString()}} | {{$old->user_id}} | {{$old->subject}}</span>
                <span class="float-right"><i class="fas fa-chevron-down fa-xs"></i></span>
              </h6>
            </div>
          
            <div id="collapse{{$old->id}}" class="collapse" aria-labelledby="feedbackPost{{$old->id}}" data-parent="#feedback">
              <div class="card-body mx-4">
                <p>
                {!! Form::open(['action' => 'EmailsController@read', 'method' => 'POST']) !!}
                {{ Form::hidden('feedbackid', $old->id) }}
                {{Form::submit('Mark as Read', ['class' => 'btn btn-primary float-right'])}}
                {!! Form::close() !!}
                    @foreach($users as $user)
                    @if($user->user_id==$old->user_id)
                    <b>Student Name:</b> {{$user->first_name}} {{$user->last_name}}<br>
                    <b>Course:</b> {{$user->course}}<br>
                    @endif
                    @endforeach
                    <b>Type of Feedback:</b> 
                    @if($old->feedback_type==0)
                      Suggestion
                    @elseif($old->feedback_type==1)
                      Complaint
                    @else 
                      Others
                    @endif
                </p>
                <p>
                    <b>Message:</b><br>
                    {{$old->body}}
                </p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="sort" id="option3">
      <div class="mx-4 mt-4">
        <div class="accordion" id="feedback">
          @foreach($types as $type)
          <div class="card">
            <div class="card-header" id="feedbackPost{{$type->id}}" data-toggle="collapse" data-target="#collapse{{$type->id}}" aria-expanded="false" aria-controls="collapse{{$type->id}}">
              <h6 class="text-primary">
                <span class="float-left @if($type->read==0)font-weight-bold @endif "><b>{{\Carbon\Carbon::parse($new->created_at)->toDayDateTimeString()}}</b> | {{$type->user_id}} | {{$type->subject}}</span>
                <span class="float-right"><i class="fas fa-chevron-down fa-xs"></i></span>
              </h6>
            </div>
          
            <div id="collapse{{$type->id}}" class="collapse" aria-labelledby="feedbackPost{{$type->id}}" data-parent="#feedback">
              <div class="card-body mx-4">
                <p>
                    {!! Form::open(['action' => 'EmailsController@read', 'method' => 'POST']) !!}
                    {{ Form::hidden('feedbackid', $type->id) }}
                    {{Form::submit('Mark as Read', ['class' => 'btn btn-primary float-right'])}}
                    {!! Form::close() !!}
                    @foreach($users as $user)
                    @if($user->user_id==$type->user_id)
                    <b>Student Name:</b> {{$user->first_name}} {{$user->last_name}}<br>
                    <b>Course:</b> {{$user->course}}<br>
                    @endif
                    @endforeach
                    <b>Type of Feedback:</b> 
                    @if($type->feedback_type==0)
                      Suggestion
                    @elseif($type->feedback_type==1)
                      Complaint
                    @else 
                      Others
                    @endif
                </p>
                <p>
                    <b>Message:</b><br>
                    {{$type->body}}
                </p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="filter" id="filter1">
      <div class="mx-4 mt-4">
        <div class="accordion" id="feedback3">
          @foreach($filterAll as $all)
          <div class="card">
            <div class="card-header" id="feedbackPost{{$all->id}}" data-toggle="collapse" data-target="#collapse{{$all->id}}" aria-expanded="false" aria-controls="collapse{{$all->id}}">
              <h6 class="text-primary">
                <span class="float-left @if($all->read==0)font-weight-bold @endif "><b>{{\Carbon\Carbon::parse($new->created_at)->toDayDateTimeString()}}</b> | {{$all->user_id}} | {{$all->subject}}</span>
                <span class="float-right"><i class="fas fa-chevron-down fa-xs"></i></span>
              </h6>
            </div>
          
            <div id="collapse{{$all->id}}" class="collapse" aria-labelledby="feedbackPost{{$all->id}}" data-parent="#feedback3">
              <div class="card-body mx-4">
                <p>
                    {!! Form::open(['action' => 'EmailsController@read', 'method' => 'POST']) !!}
                    {{ Form::hidden('feedbackid', $all->id) }}
                    {{Form::submit('Mark as Read', ['class' => 'btn btn-primary float-right'])}}
                    {!! Form::close() !!}
                    @foreach($users as $user)
                    @if($user->user_id==$all->user_id)
                    <b>Student Name:</b> {{$user->first_name}} {{$user->last_name}}<br>
                    <b>Course:</b> {{$user->course}}<br>
                    @endif
                    @endforeach
                    <b>Type of Feedback:</b> 
                    @if($all->feedback_type==0)
                      Suggestion
                    @elseif($all->feedback_type==1)
                      Complaint
                    @else 
                      Others
                    @endif
                </p>
                <p>
                    <b>Message:</b><br>
                    {{$all->body}}
                </p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="filter" id="filter2">
      <div class="mx-4 mt-4">
        <div class="accordion" id="feedback">
          @foreach($filterUnread as $unread)
          <div class="card">
            <div class="card-header" id="feedbackPost{{$unread->id}}" data-toggle="collapse" data-target="#collapse{{$unread->id}}" aria-expanded="false" aria-controls="collapse{{$unread->id}}">
              <h6 class="text-primary">
                <span class="float-left @if($unread->read==0)font-weight-bold @endif "><b>{{\Carbon\Carbon::parse($new->created_at)->toDayDateTimeString()}}</b> | {{$unread->user_id}} | {{$unread->subject}}</span>
                <span class="float-right"><i class="fas fa-chevron-down fa-xs"></i></span>
              </h6>
            </div>
          
            <div id="collapse{{$unread->id}}" class="collapse" aria-labelledby="feedbackPost{{$unread->id}}" data-parent="#feedback">
              <div class="card-body mx-4">
                <p>
                    {!! Form::open(['action' => 'EmailsController@read', 'method' => 'POST']) !!}
                    {{ Form::hidden('feedbackid', $unread->id) }}
                    {{Form::submit('Mark as Read', ['class' => 'btn btn-primary float-right'])}}
                    {!! Form::close() !!}
                    @foreach($users as $user)
                    @if($user->user_id==$unread->user_id)
                    <b>Student Name:</b> {{$user->first_name}} {{$user->last_name}}<br>
                    <b>Course:</b> {{$user->course}}<br>
                    @endif
                    @endforeach
                    <b>Type of Feedback:</b> 
                    @if($unread->feedback_type==0)
                      Suggestion
                    @elseif($unread->feedback_type==1)
                      Complaint
                    @else 
                      Others
                    @endif
                </p>
                <p>
                    <b>Message:</b><br>
                    {{$unread->body}}
                </p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="filter" id="filter3">
      <div class="mx-4 mt-4">
        <div class="accordion" id="feedback">
          @foreach($filterRead as $read)
          <div class="card">
            <div class="card-header" id="feedbackPost{{$read->id}}" data-toggle="collapse" data-target="#collapse{{$read->id}}" aria-expanded="false" aria-controls="collapse{{$read->id}}">
              <h6 class="text-primary">
                <span class="float-left @if($read->read==0)font-weight-bold @endif "><b>{{\Carbon\Carbon::parse($new->created_at)->toDayDateTimeString()}}</b> | {{$read->user_id}} | {{$read->subject}}</span>
                <span class="float-right"><i class="fas fa-chevron-down fa-xs"></i></span>
              </h6>
            </div>
          
            <div id="collapse{{$read->id}}" class="collapse" aria-labelledby="feedbackPost{{$read->id}}" data-parent="#feedback">
              <div class="card-body mx-4">
                <p>
                    {!! Form::open(['action' => 'EmailsController@read', 'method' => 'POST']) !!}
                    {{ Form::hidden('feedbackid', $read->id) }}
                    {{Form::submit('Mark as Read', ['class' => 'btn btn-primary float-right'])}}
                    {!! Form::close() !!}
                    @foreach($users as $user)
                    @if($user->user_id==$read->user_id)
                    <b>Student Name:</b> {{$user->first_name}} {{$user->last_name}}<br>
                    <b>Course:</b> {{$user->course}}<br>
                    @endif
                    @endforeach
                    <b>Type of Feedback:</b> 
                    @if($read->feedback_type==0)
                      Suggestion
                    @elseif($read->feedback_type==1)
                      Complaint
                    @else 
                      Others
                    @endif
                </p>
                <p>
                    <b>Message:</b><br>
                    {{$read->body}}
                </p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
@endsection

@section('modal')
{{--     @include('inc.checkFormModal')
    @include('inc.viewStudentModal') --}}
@endsection
