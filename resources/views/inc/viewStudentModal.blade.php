@foreach($transaction_forms as $form)
    <div class="modal" id="viewStudent{{$form->user_id}}">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Student Details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                    <div class="col-md-3 pt-3">
                        <img src = "images\user-account-box.jpg" height= 100;>
                    </div>
                    <div class="col-md-9">
                        @foreach($users as $user)
                            @if($user->user_id==$form->user_id)
                                <p><strong>Student ID: </strong>{{$user->user_id}}</p>
                                <p><strong>Student Name: </strong>{{$user->first_name}} {{$user->last_name}}</p>
                                <p><strong>Course: </strong>{{$user->course}}</p>
                                <p><strong>Penalty: </strong>PHP{{$user->penalty}}.00</p>
                            @endif
                        @endforeach
                    </div>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach