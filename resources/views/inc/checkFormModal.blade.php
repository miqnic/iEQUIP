@foreach ($transaction_forms as $form)
<div class="modal fade in" id="checkForm{{$form->transaction_id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Transaction Form Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="formInfo row">
                    <div class="col-md-12">
                        <small><b>Legend:</b> <i class="fas fa-exclamation-triangle text-danger"></i> - due date has passed</small>
                        <table class="table table-sm mt-1">
                            <tr>
                                <th>ID and Status</th>
                                <td>
                                    {{$form->transaction_id}} 
                                    @if($form->approval==1)
                                        @if($form->claimed==1 and $form->returned==0)
                                        <span class="badge badge-success">Approved</span>
                                        <span class="badge badge-primary">Claimed</span>
                                        @elseif($form->claimed==1 and $form->returned==1)
                                        <span class="badge badge-success">Returned</span>
                                        @else
                                        <span class="badge badge-success">Approved</span>
                                        <span class="badge badge-warning">Unclaimed</span>
                                        @endif
                                    @elseif($form->approval==0)
                                    <span class="badge badge-warning">Pending</span>
                                    @elseif($form->approval==-1)
                                    <span class="badge badge-danger">Declined</span>
                                    @else 
                                    <span class="badge badge-danger">Cancelled</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Date Submitted</th>
                                <td>{{\Carbon\Carbon::parse($form->submitted_date)->toFormattedDateString()}}</td>
                            </tr>
                            <tr>
                                <th>Date Responded</th>
                                @if($form->approval!=0)
                                <td>{{\Carbon\Carbon::parse($form->approval_date)->toFormattedDateString()}}</td>
                                @else 
                                <td>N/A</td>
                                @endif
                            </tr>
                            @if($form->approval==1)
                            <tr>
                                <th>Date Claimed</th>
                                @if($form->claimed==1)
                                <td>{{\Carbon\Carbon::parse($form->claimed_date)->toFormattedDateString()}}</td>
                                @else 
                                <td>N/A</td>
                                @endif
                            </tr>
                            <tr>
                                <th>Date Returned</th>
                                @if($form->returned==1)
                                <td>{{\Carbon\Carbon::parse($form->returned_date)->toFormattedDateString()}}</td>
                                @else 
                                <td>N/A</td>
                                @endif
                            </tr>
                            @elseif($form->approval==-1)
                            <tr>
                                <th>Reason for Declining</th>
                                <td></td>
                                {{-- <td>{{$form->decline_reason}}</td> --}}
                            </tr>
                            @elseif($form->approval==-2)
                            <tr>
                                <th>Date Cancelled</th>
                                <td>{{\Carbon\Carbon::parse($form->cancelled_date)->toFormattedDateString()}}</td>
                            </tr>
                            @endif
                            <tr>
                                <th>Start Date and Time</th>
                                <td>{{\Carbon\Carbon::parse($form->start_date)->toFormattedDateString()}} {{\Carbon\Carbon::parse($form->start_time)->format('h:i A')}}</td>
                            </tr>
                            <tr>
                                <th>End Date and Time</th>
                                <td>
                                    {{\Carbon\Carbon::parse($form->due_date)->toFormattedDateString()}} {{\Carbon\Carbon::parse($form->end_time)->format('h:i A')}}
                                    @if($form->approval==1 && $form->claimed==1 && $form->returned==0 && \Carbon\Carbon::parse($form->due_date)->isPast())
                                    <i class="fas fa-lg fa-exclamation-triangle text-danger"></i>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Purpose</th>
                                <td>{{$form->purpose}}</td>
                            </tr>
                        </table>

                        <table class="table table-sm table-striped mt-3 text-center">
                            <thead class="bg-dark text-light">
                                <tr>
                                    <th>Equipment Code</th>
                                    <th>Equipment Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $cart)
                                    @foreach($equipments as $equipment)
                                        @if($cart->equipID == $equipment->equipID && $cart->transaction_id == $form->transaction_id)
                                            <tr>
                                                <td>{{$equipment->equipID}}</td>
                                                <td>
                                                    {{$equipment->equip_name}}
                                                    @if($form->approval==1 && $form->claimed==1 && $form->returned==0 && \Carbon\Carbon::parse($form->due_date)->isPast())
                                                    <i class="fas fa-lg fa-exclamation-triangle text-danger"></i>
                                                    @endif
                                                </td>     
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
