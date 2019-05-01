<div class="modal fade" id="editItemModal" tabindex="-1">
        <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
            <h4 class="modal-title">Edit Item Details</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
            <form>
                <label for="itemName">Item Name</label>
                <input type="text" class="form-control" id="itemName" placeholder="Enter item name" value="Wacom CINTIQ 13HD Tablet">
                <div class="row">
                <div class="col-md-4">
                    <label class="pt-3" for="category">Category</label>
                    <select id="category" class="form-control">
                        <option>Cameras & Accessories</option>
                        <option selected>Art Tools</option>
                        <option>Sports Equipment</option>
                        <option>Gaming Devices</option>
                        <option>Laptops & Accessories</option>
                        <option>Miscellaneous</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="pt-3" for="remarks">Base Price (PHP)</label>
                    <input type="text" class="form-control" id="itemName" placeholder="Enter amount" value="86,830.00">
                </div>
                <div class="col-md-4">
                    <label class="pt-3" for="remarks">Penalty Fee (PHP)</label>
                    <input type="text" class="form-control" id="penalty" placeholder="Enter amount" value="500.00">
                </div>
                </div>
                    <label class="pt-3" for="remarks">Specifications</label>
                    <textarea class="form-control" name="remarks" rows="5" placeholder="Enter specifications here"></textarea>
                <div class="row">
                <div class="col-md-4">
                <label class="pt-3" for="remarks">Item Quantity</label>
                <input type="text" class="form-control" id="itemName" placeholder="Enter quantity" value="6">
                </div>
                <div class="col-md-4">
                    <label class="pt-3" for="itemImage">Item Image</label>
                    <input type="file">
                </div>
                </div>
            </form>
            </div>

            <div class="modal-footer">
            <button type="submit" class="btn btn-success" data-target="#itemList" data-dismiss="modal" data-toggle="modal">Save Changes</button>
            <button type="button" class="btn btn-outline-secondary" data-target="#itemList" data-dismiss="modal" data-toggle="modal">Cancel</button>
            </div>
        </div>
        </div>
    </div>