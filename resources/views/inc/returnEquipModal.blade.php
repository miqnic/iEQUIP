{!! Form::open(['action' => 'EquipmentsController@returnEquipment', 'method' => "POST", 'enctype' => 'multipart/form-data']) !!}
@csrf
{{Form::hidden('currentForm', $form->transaction_id)}}

<div class="modal fade" id="returnEquip-{{$form->transaction_id}}" tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
    
            <div class="modal-header">
                <h4 class="modal-title">Return Equipment</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
    
            <div class="modal-body">
                <small class="py-2">Select the item/s that are returned</small>
                <table class="table table-bordered table-responsive-sm text-center">
                <thead>
                    <tr>
                    <th></th>
                    <th>Equipment Code</th>
                    <th>Equipment Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($equipments as $equipment)
                        @if ($equipment->transaction_id === $form->transaction_id)
                            <tr>
                                <td class="align-middle">
                                    <div class="checkbox pt-1">
                                            
                                    <label>{{Form::checkbox("checkbox-$equipment->equipID","$equipment->equipID")}}</label>
                                    </div>
                                </td>
                                <td class="align-middle">{{$equipment->equipID}}</td>
                                <td class="align-middle">{{$equipment->equip_name}}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
                </table>
            </div>
    
            <div class="modal-footer">
                {{Form::submit('Return Equipment', ['class' => 'btn btn-danger'])}}
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
            </div>
    
            </div>
        </div>
        </div>
{!! Form::close() !!}