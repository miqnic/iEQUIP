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
    </div>

    <div class="sort" id="option1">
      <div class="mx-4 mt-4">
        <div class="accordion" id="feedback1">
          @foreach($newest as $new)
          <div class="card">
            <div class="card-header" id="feedbackPost{{$new->id}}" data-toggle="collapse" data-target="#collapse{{$new->id}}" aria-expanded="true" aria-controls="collapse{{$new->id}}">
              <h5 class="pt-2 pb-3 text-primary">
                <span class="float-left"><b>{{\Carbon\Carbon::parse($new->created_at)->toDayDateTimeString()}}</b> | {{$new->user_id}} | {{$new->subject}}</span>
                <span class="float-right"><i class="fas fa-chevron-down fa-xs"></i></span>
              </h5>
            </div>
          
            <div id="collapse{{$new->id}}" class="collapse" aria-labelledby="feedbackPost{{$new->id}}" data-parent="#feedback1">
              <div class="card-body mx-4">
                <p>
                    <button class="btn btn-primary float-right">Mark as Read</button>
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
        <div class="accordion" id="feedback2">
          @foreach($oldest as $old)
          <div class="card">
            <div class="card-header" id="feedbackPost{{$old->id}}" data-toggle="collapse" data-target="#collapse{{$old->id}}" aria-expanded="true" aria-controls="collapse{{$old->id}}">
              <h5 class="pt-2 pb-3 text-primary">
                <span class="float-left"><b>{{\Carbon\Carbon::parse($old->created_at)->toDayDateTimeString()}}</b> | {{$old->user_id}} | {{$old->subject}}</span>
                <span class="float-right"><i class="fas fa-chevron-down fa-xs"></i></span>
              </h5>
            </div>
          
            <div id="collapse{{$old->id}}" class="collapse" aria-labelledby="feedbackPost{{$old->id}}" data-parent="#feedback2">
              <div class="card-body mx-4">
                <p>
                <button class="btn btn-primary float-right">Mark as Read</button>
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
        <div class="accordion" id="feedback3">
          @foreach($types as $type)
          <div class="card">
            <div class="card-header" id="feedbackPost{{$type->id}}" data-toggle="collapse" data-target="#collapse{{$type->id}}" aria-expanded="false" aria-controls="collapse{{$type->id}}">
              <h5 class="pt-2 pb-3 text-primary">
                <span class="float-left"><b>{{\Carbon\Carbon::parse($new->created_at)->toDayDateTimeString()}}</b> | {{$type->user_id}} | {{$type->subject}}</span>
                <span class="float-right"><i class="fas fa-chevron-down fa-xs"></i></span>
              </h5>
            </div>
          
            <div id="collapse{{$type->id}}" class="collapse" aria-labelledby="feedbackPost{{$type->id}}" data-parent="#feedback3">
              <div class="card-body mx-4">
                <p>
                    <button class="btn btn-primary float-right">Mark as Read</button>
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


    {{-- <div class="mx-4 mt-4">
      <div class="accordion" id="feedback">
        <div class="card">
          <div class="card-header" id="feedbackPost1" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <h5 class="pt-2 pb-3 text-primary">
              <span class="float-left"><b>02/02/19</b> | Student ID: 201702012 | Subject: Item Defect</span>
              <span class="float-right"><i class="fas fa-chevron-down fa-xs"></i></span>
            </h5>
          </div>
      
          <div id="collapseOne" class="collapse" aria-labelledby="feedbackPost1" data-parent="#feedback">
            <div class="card-body mx-4">
              <p>
                  <button class="btn btn-primary float-right">Mark as Read</button>
                  <b>Student Name:</b> Nicole Kaye Bilon<br>
                  <b>Course:</b> BSCS-SE<br>
                  <b>Type of Feedback:</b> Complaint
              </p>
              <p>
                  <b>Message:</b><br>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                  sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                  Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
                  sunt in culpa qui officia deserunt mollit anim id est laborum.
              </p>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="feedbackPost2" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              <h5 class="pt-2 pb-3 text-primary">
                  <span class="float-left"><b>02/02/19</b> | Student ID: 201702012 | Subject: Item Defect</span>
                  <span class="float-right"><i class="fas fa-chevron-down fa-xs"></i></span>
              </h5>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#feedback">
            <div class="card-body mx-4">
              <p>
                  <button class="btn btn-primary float-right">Mark as Read</button>
                  <b>Student Name:</b> Nicole Kaye Bilon<br>
                  <b>Course:</b> BSCS-SE<br>
                  <b>Type of Feedback:</b> Complaint
              </p>

              <p>
                  <b>Message:</b><br>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                  sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                  Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
                  sunt in culpa qui officia deserunt mollit anim id est laborum.
              </p>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="feedbackPost3" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            <h5 class="pt-2 pb-3 text-primary">
                <span class="float-left"><b>02/02/19</b> | Student ID: 201702012 | Subject: Item Defect</span>
                <span class="float-right"><i class="fas fa-chevron-down fa-xs"></i></span>
            </h5>
          </div>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#feedback">
            <div class="card-body mx-4">
                <p>
                    <button class="btn btn-primary float-right">Mark as Read</button>
                    <b>Student Name:</b> Nicole Kaye Bilon<br>
                    <b>Course:</b> BSCS-SE<br>
                    <b>Type of Feedback:</b> Complaint
                </p>

                <p>
                    <b>Message:</b><br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
                    sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="feedbackPost4" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
            <h5 class="pt-2 pb-3 text-primary">
              <span class="float-left"><b>02/02/19</b> | Student ID: 201702012 | Subject: Item Defect</span>
              <span class="float-right"><i class="fas fa-chevron-down fa-xs"></i></span>
            </h5>
          </div>
          <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#feedback">
            <div class="card-body mx-4">
                <p>
                    <button class="btn btn-primary float-right">Mark as Read</button>
                    <b>Student Name:</b> Nicole Kaye Bilon<br>
                    <b>Course:</b> BSCS-SE<br>
                    <b>Type of Feedback:</b> Complaint
                </p>

                <p>
                    <b>Message:</b><br>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
                    sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>
          </div>
        </div>
      </div>
    </div> --}}
@endsection

@section('modal')
{{--     @include('inc.checkFormModal')
    @include('inc.viewStudentModal') --}}
@endsection
