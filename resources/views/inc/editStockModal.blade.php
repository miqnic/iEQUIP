@foreach ($equipments as $equipment_modal)
<div class="modal fade" id="editStockModal-{{$equipment_modal->equipID}}" tabindex="-1">
        <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
            <h4 class="modal-title">Edit Stock Details</h4>
            <button type="button" class="close"  data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                {!! Form::open(['action' => 'EquipmentsController@editSingleEquipment', 'method' => "POST", 'enctype' => 'multipart/form-data']) !!}
                @csrf
                <div class="row">
                <div class="col-md-6">
                    <label for="equipCode">Equipment Code</label>
                    <input type="text" class="form-control" id="equipCode" placeholder="Enter equipment code" value="{{$equipment_modal->equipID}}" disabled>
                    {{Form::hidden('currentEquip', $equipment_modal->equipID)}}
                </div>
                <div class="col-md-6">
                    <label for="availability">Status</label>
                    {{Form::select('availability', array(
                            '0' => 'Available',
                            '-1' => 'Under Maintenance',
                            '1' => 'Reserved'), $equipment_modal->equip_avail, array('class' => 'form-control custom-select', 'required' => ''))}}

                </div> 
                </div>
                <label class="pt-3" for="remarks">Remarks</label>
                {{Form::textarea('remarks', $equipment_modal->equip_remarks,['class' => 'form-control', 'placeholder' => 'Enter specifications here', 'rows' => '3', 'required' => ''])}}   
                
            </div>

            <div class="modal-footer">
            {{Form::submit('Edit Stock', ['class' => 'btn btn-success'])}}
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
            </div>
            {!! Form::close() !!}
        </div>
        </div>
</div>
@endforeach
