<!-- Add -->
<div class="modal fade" id="add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"> ADD NEW HUB</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="hubs/function.php"  enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                          <div class="col-12">
                            <label for="User_Id" class="col-sm-12 control-label">Description</label>
                            <input type="text" class="form-control" name="Description"  required  placeholder="Description">
                          </div>
                          <div class="col-12">
                            <label for="User_Id" class="col-sm-12 control-label">Status</label>
                           <select class="form-control" name="Status" required>
                               <option value="ACTIVE"  >ACTIVE</option>
                           <option value="INACTIVE">INACTIVE</option>
                           </select>  
                          </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-success btn-flat" name="add"><i class="fa fa-save"></i> Submit</button> 
                </div>
            </form>
        </div>
    </div>
</div>





<!-- Add -->
<div class="modal fade" id="edit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"> Edit HUB</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="hubs/function.php"  enctype="multipart/form-data">
                <div class="modal-body">
                     <div class="row">
                          <div class="col-12">
                            <label for="User_Id" class="col-sm-12 control-label">Description</label>
                            <input type="text" class="form-control" name="Description" id="Description" required  placeholder="Prize Name">
                             <input type="text" class="form-control" name="Id" id="Id" hidden >

                          </div>
                         
                          <div class="col-12">
                            <label for="User_Id" class="col-sm-12 control-label">Status</label>
                           <select class="form-control" name="Status" id="Status" required>
                            <option value="ACTIVE"  >ACTIVE</option>
                           <option value="INACTIVE">INACTIVE</option>
                           </select>  
                          </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-save"></i>Update</button> 
                </div>
            </form>
        </div>
    </div>
</div>







