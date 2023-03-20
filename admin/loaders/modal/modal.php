<!-- Add -->
<div class="modal fade" id="add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"> Add Loader</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="loaders/function.php"  enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                          <div class="col-12">
                            <label for="User_Id" class="col-sm-12 control-label" required>Firstname</label>
                            <input type="text" class="form-control" name="Firstname" placeholder="Firstname">
                          </div>

                          <div class="col-12">
                            <label for="Lastname" class="col-sm-12 control-label" required>Lastname</label>
                            <input type="text" class="form-control" name="Lastname" placeholder="Lastname">
                          </div>
                          <div class="col-12">
                            <label for="Email" class="col-sm-12 control-label" required>Email</label>
                            <input type="Email" class="form-control" name="Email" placeholder="Email">
                          </div>
                          <div class="col-12">
                            <label for="User_Id" class="col-sm-12 control-label">Status</label>
                           <select class="form-control" name="Status" required>
                            <option value="ACTIVE" selected >ACTIVE</option>
                           <option value="INACTIVE">INACTIVE</option>
                           </select>  
                          </div>
                             <div class="col-12">
                            <label for="Lastname" class="col-sm-12 control-label" >HUB</label>
                             <select class="form-control " name="Hub" style="width: 100%;"  required>
                              <option value="" hidden>CHOOSE</option>
                                <?php
                                    $sql = "SELECT Description FROM tblhub WHERE Status = ?";
                                    $stmt = $conn->prepare($sql);
                                    $status = 'Active';
                                    $stmt->bind_param('s', $status);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    while($prow = $result->fetch_assoc()){
                                        echo "<option value='".$prow['Description']."'>".$prow['Description']."</option>";
                                    }
                                    ?>
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

                <h4 class="modal-title"> Edit Loader</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="loaders/function.php"  enctype="multipart/form-data">
                <div class="modal-body">
                     <div class="row">
                          <div class="col-12">
                            <label for="User_Id" class="col-sm-12 control-label" >Firstname</label>
                            <input type="text" class="form-control" id="Firstname" required name="Firstname" placeholder="Firstname">
                              <input type="text" class="form-control" id="Id" name="Id" hidden>
                          </div>

                          <div class="col-12">
                            <label for="Lastname" class="col-sm-12 control-label" >Lastname</label>
                            <input type="text" class="form-control" id="Lastname" required name="Lastname" placeholder="Lastname">
                          </div>
                          <div class="col-12">
                            <label for="Email" class="col-sm-12 control-label" >Email</label>
                            <input type="Email" class="form-control" id="Email" required name="Email" placeholder="Email">
                          </div>
                          <div class="col-12">
                            <label for="User_Id" class="col-sm-12 control-label">Status</label>
                           <select class="form-control" name="Status" id="Status" required>
                            <option value="ACTIVE" selected >ACTIVE</option>
                           <option value="INACTIVE">INACTIVE</option>
                           </select>  
                          </div>
                            <div class="col-12">
                            <label for="Lastname" class="col-sm-12 control-label" >HUB</label>
                               <select class="form-control" name="Hub" id="edit_type" required>
                                    <option id="type_val" hidden ></option>
                                    <?php
                                    $sql = "SELECT Description FROM tblhub WHERE Status = ?";
                                    $stmt = $conn->prepare($sql);
                                    $status = 'Active';
                                    $stmt->bind_param('s', $status);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    while($prow = $result->fetch_assoc()){
                                        echo "<option value='".$prow['Description']."'>".$prow['Description']."</option>";
                                    }
                                    ?>
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





<!-- Add -->
<div class="modal fade" id="reset">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="loaders/function.php"  enctype="multipart/form-data">
                <div class="modal-body">
                     <div class="row">
                          <div class="col-2">
                          </div>
                          <div class="col-9">
                            <label for="User_Id" class="col-sm-12 control-label" >Are you sure? you wamt to reset password </label>
                              <input type="text" class="form-control" id="Reset" name="Id" hidden >
                          </div>
                           <div class="col-1">
                          </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btn-flat" name="reset"> Reset</button> 
                </div>
            </form>
        </div>
    </div>
</div>







<!-- Add -->
<div class="modal fade" id="coupon">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title">Add Coupon</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="loaders/function.php"  enctype="multipart/form-data">
                <div class="modal-body">
                      <div class="row">
                        

                          <div class="col-12">
                            <label for="Lastname" class="col-sm-12 control-label" >Amount Load</label>
                            <input type="number" class="form-control"  onchange="this.value = parseInt(this.value);" name="Loadamount" required placeholder="Amount Coupon">
                            <input type="text" value="<?php echo $user['id']; ?>" name="Loadbyadmin" hidden> 
                            <input type="text"  id="Loadername" name="Loadername"    hidden> 
                          </div>
                    </div>


                   
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-flat" name="addcoupon"> Submit</button> 
                </div>
            </form>
        </div>
    </div>
</div>







