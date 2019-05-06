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
                <div class="mt-2 alert @if($form->approval==1) alert-success @else alert-danger @endif" role="alert"> 
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
                            @else 
                                DECLINED
                            @endif
                        </b>
                        </div>
                    </div>
                </div>

                <div class="row pt-2 text-center">
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
                </div>

                <table class="table table-md table-bordered mt-3 text-center">
                    <thead>
                        <tr>
                            <th>Equipment Code</th>
                            <th>Equipment Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($equipments as $equipment)
                        <tr>
                            @if($equipment->transaction_id==$form->transaction_id)
                                <td>{{$equipment->equipID}}</td>
                                <td>{{$equipment->equip_name}}</td> 
                            @endif
                        </tr>
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