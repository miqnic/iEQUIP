@foreach($transaction_forms as $form)
<div class="modal" id="checkForm{{$form->transaction_id}}">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Transaction Form Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="mt-2 alert @if($form->approval==1) alert-success @elseif($form->approval==-1) alert-warning @else alert-danger @endif" role="alert"> 
                    <div class="row text-center">
                        <div class="col-md-4 offset-md-1">
                        Transaction Form:<br>
                        <b>{{$form->transaction_id}}</b>
                        </div>
                        <div class="col-md-4 offset-md-2">
                        Request Status:<br>
                        <b> 
                            @if($form->approval==1)
                                APPROVED
                            @elseif($form->approval==-1)
                                PENDING
                            @else
                                DECLINED
                            @endif
                        </b>
                        </div>
                    </div>
                </div>

                {{-- <div class="row pt-2 text-center">
                    <div class="col-md-5">
                        <p><strong>Date Submitted:</strong><br>{{\Carbon\Carbon::parse($form->submitted_date)->toFormattedDateString()}}</p>
                        <p><strong>Date Approved:</strong><br>01/02/2019</p> <!--not yet working-->
                    </div>
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Start Date:</strong><br>{{\Carbon\Carbon::parse($form->start_date)->toFormattedDateString()}}</p>
                                <p><strong>End Date:</strong><br>{{\Carbon\Carbon::parse($form->due_date)->toFormattedDateString()}}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Start Time:</strong><br>{{$form->start_time}}</p>
                                <p><strong>End Time:</strong><br>{{$form->end_time}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row px-2 text-center">
                    <div class="col-md-6">
                    <p><strong>Date Claimed:</strong><br>02/02/2019</p> <!--not yet working-->
                    </div>
                    <div class="col-md-6">
                    <p><strong>Date Returned:</strong><br>02/02/2019</p> <!--not yet working-->
                    </div>
                </div>--}}

                <div class="formInfo row pt-3">
                    <div class="col-md-6">
                    <p>
                        <strong>Date Submitted:</strong> {{\Carbon\Carbon::parse($form->submitted_date)->toFormattedDateString()}}<br>
                        <strong>Date Claimed:</strong> 02/02/2019<br>
                        <strong>Start Date:</strong> {{\Carbon\Carbon::parse($form->start_date)->toFormattedDateString()}}<br>
                        <strong>Start Time:</strong> {{$form->start_time}}
                    </p>
                    </div>
                    <div class="col-md-6">
                    <p>
                        <strong>Date Approved:</strong> 01/02/2019<br> <!--not yet working-->
                        <strong>Date Returned:</strong> 02/02/2019<br>
                        <strong>End Date:</strong> {{\Carbon\Carbon::parse($form->due_date)->toFormattedDateString()}}<br>
                        <strong>End Time:</strong> {{$form->end_time}}
                    </p>
                    </div>
                </div>

                <p class="legend pl-3 pt-2 text-danger">* Equipment/s not returned</p>
                <table class="table table-md table-bordered mt-3 text-center">
                    <thead>
                        <tr>
                            <th>Equipment Code</th>
                            <th>Equipment Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($equipments as $equipment)
                        @if($equipment->transaction_id==$form->transaction_id)
                        <tr @if($equipment->returned==0 && $form->approval==1) class="text-danger"  @endif>
                            <td>{{$equipment->equipID}}</td>
                            <td>{{$equipment->equip_name}}</td>     
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach