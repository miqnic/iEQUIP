{!! Form::open(['action' => 'EquipmentsController@delSingleEquipment', 'method' => "POST", 'enctype' => 'multipart/form-data']) !!}
@csrf
@foreach ($equipments as $equipment_modal)
    <div class="modal fade" id="deleteSingleModal-{{$equipment_modal->equipID}}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
    
            <div class="modal-header">
                <h4 class="modal-title">Deletion Confirmation</h4>
                <button type="button" class="close" data-target="#itemList-{{$equipment_modal->equipID}}" data-dismiss="modal">&times;</button>
            </div>
    
            <div class="modal-body m-3">
                Are you sure you want to delete this item?<br>This process cannot be undone.
                {{Form::hidden('currentEquip', $equipment_modal->equipID)}}
            </div>
    
            <div class="modal-footer">
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                <button type="button" class="btn btn-outline-secondary" data-target="#itemList-{{$equipment_modal->equipID}}" data-dismiss="modal">Cancel</button>
            </div>
    
            </div>
        </div>
    </div>
@endforeach

{!! Form::close() !!}