<div class="modal fade" id="editStockModal-{{$equipment_modal->equipID}}" tabindex="-1">
        <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
            <h4 class="modal-title">Edit Stock Details</h4>
            <button type="button" class="close"  data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
            <form>
                <div class="row">
                <div class="col-md-6">
                    <label for="equipCode">Equipment Code</label>
                    <input type="text" class="form-control" id="equipCode" placeholder="Enter equipment code" value="{{$equipment_modal->equipID}}" disabled>
                </div>
                <div class="col-md-6">
                    <label for="availability">Status</label>
                    <select id="inputState" class="form-control">
                        @if ($equipment_modal->equip_avail == 0)
                            <option selected>Available</option>
                            <option>Under Maintenance</option>
                            <option>Reserved</option>
                        @elseif ($equipment_modal->equip_avail > 0)
                            <option>Available</option>
                            <option>Under Maintenance</option>
                            <option selected>Reserved</option>
                        @else
                            <option>Available</option>
                            <option selected>Under Maintenance</option>
                            <option>Reserved</option>
                        @endif
                    
                    </select>
                </div> 
                </div>
                <label class="pt-3" for="remarks">Remarks</label>
                <textarea class="form-control" name="remarks" rows="3" placeholder="Enter remarks here (eg. item condition)"></textarea>
            </form>
            </div>

            <div class="modal-footer">
            <button type="submit" class="btn btn-success" data-target="#itemList-{{$equipment->equipID}}" data-dismiss="modal" data-toggle="modal">Save Changes</button>
            <button type="button" class="btn btn-outline-secondary" data-target="#itemList-{{$equipment->equipID}}" data-dismiss="modal" data-toggle="modal">Cancel</button>
            </div>
        </div>
        </div>
    </div>