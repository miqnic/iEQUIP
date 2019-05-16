<div class="modal fade" id="confirmCancellation{{$form->transaction_id}}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
    
            <div class="modal-header">
                <h4 class="modal-title">Cancel Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body m-3">
                Click Confirm to cancel Transaction #: {{$form->transaction_id}}
            </div>
            <div class="modal-footer">
                {!! Form::open(['action' => 'TransactionFormsController@cancelForm', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                {{Form::hidden('currentForm', $form->transaction_id)}}
                {{Form::hidden('decision', 'Cancel')}}
                {{ Form::submit('Confirm', array('class' => 'btn btn-success','name'=>'claimed')) }}
                {!! Form::close() !!}
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
            </div>
            </div>
        </div>
</div>