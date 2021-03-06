<div class="modal fade" id="confirmEquipChanges" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
    
            <div class="modal-header">
                <h4 class="modal-title">Change Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body m-3">
                Are you sure about these changes?
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" data-target="#itemList-{{$equipment->equipID}}" data-dismiss="modal">Confirm</button>
                <button type="button" class="btn btn-outline-secondary" data-target="#itemList-{{$equipment->equipID}}" data-dismiss="modal">Cancel</button>
            </div>
            </div>
        </div>
        </div>