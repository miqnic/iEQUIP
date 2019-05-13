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
                <h3>Transaction Form: {{$form->transaction_id}}</h3>
                <h3>Status: 
                    @if($form->approval==1)
                        APPROVED
                    @else 
                        DECLINED
                    @endif
                </h3><br>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Start Date:</strong> {{\Carbon\Carbon::parse($form->start_date)->toFormattedDateString()}}</p>
                        <p><strong>End Date:</strong> {{\Carbon\Carbon::parse($form->due_date)->toFormattedDateString()}}</p>
                        <p><strong>Start Time:</strong> {{$form->start_time}}</p>
                        <p><strong>End Time:</strong> {{$form->start_time}}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Date Submitted:</strong> {{\Carbon\Carbon::parse($form->submitted_date)->toFormattedDateString()}}</p>
                        <p><strong>Date Approved:</strong> 01/02/2019</p> <!--not yet working-->
                        <p><strong>Date Claimed:</strong> 02/02/2019</p> <!--not yet working-->
                        <p><strong>Date Returned:</strong> 02/02/2019</p> <!--not yet working-->
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Equipment Code</th>
                            <th>Equipment Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($form->equipment as $equip)
                        <tr>
                            <td>{{$equip->equipID}}</td> <!--not yet working-->
                            <td>{{$equip->equip_name}}</td> 
                            <!--corresponding borrowedequip not appearing. throwing items with null transac IDs instead-->
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