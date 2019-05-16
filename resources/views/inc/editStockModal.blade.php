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
                <div class="row">
                <div class="col-md-6">
                    <label for="equipCode">Equipment Code</label>
                    <input type="text" class="form-control" id="equipCode" placeholder="Enter equipment code" value="{{$equipment_modal->equipID}}" disabled>
                    {{Form::hidden('currentEquipName', $equipment_modal->equip_name)}}
                </div>
                <div class="col-md-6">
                    <label for="availability">Status</label>
                    {{Form::select('availability', array(
                            'Available' => 'Available',
                            'Under Maintenance' => 'Under Maintenance',
                            'Reserved' => 'Reserved'), NULL, array('class' => 'form-control', 'required' => ''))}}

                </div> 
                </div>
                <label class="pt-3" for="remarks">Remarks</label>
                {{Form::textarea('description', '',['class' => 'form-control', 'placeholder' => 'Enter specifications here', 'required' => ''])}}   
                
            </div>

            <div class="modal-footer">
            {{Form::submit('Edit Equipment', ['class' => 'btn btn-success'])}}
            <button type="button" class="btn btn-outline-secondary" data-target="#itemList-{{$equipment_modal->equipID}}" data-dismiss="modal" data-toggle="modal">Cancel</button>
            </div>
        </div>
        </div>
</div>
@endforeach
{!! Form::close() !!}
