<!-- Add -->
<div class="modal fade" id="add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"> Add Player</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="players/function.php"  enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                          <div class="col-12">
                            <label for="User_Id" class="col-sm-12 control-label">User_Id</label>
                            <input type="text" class="form-control" name="User_Id"  required  placeholder="User_Id">
                          </div>

                          <div class="col-12">
                            <label for="Login Name" class="col-sm-12 control-label" >Login Name</label>
                            <input type="text" class="form-control" name="Loginname"   required placeholder="Login Name">
                          </div>
                          <div class="col-12">
                            <label for="Name" class="col-sm-12 control-label" >Name</label>
                            <input type="text" class="form-control" name="Name"  required  placeholder="Name">
                          </div>
                          <div class="col-12">
                            <label for="User_Id" class="col-sm-12 control-label" >Contactnumber</label>
                            <input type="number" class="form-control" name="Contactnumber"  onchange="this.value = parseInt(this.value);" required  placeholder="ex: 09123456789">
                          </div>
                          <div class="col-12">
                            <label for="User_Id" class="col-sm-12 control-label">Status</label>
                           <select class="form-control" name="Status" required>
                            <option value="ACTIVE" selected >Active</option>
                           <option value="INACTIVE">Inactive</option>
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

                <h4 class="modal-title"> Edit Player</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="players/function.php"  enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                          <div class="col-12">
                            <label for="User_Id" class="col-sm-12 control-label">User_Id</label>
                            <input type="text" class="form-control" name="User_Id"  required  id="User_Id" placeholder="User_Id">
                            <input type="text" id="Id" hidden name="Id">
                          </div>

                          <div class="col-12">
                            <label for="Login Name" class="col-sm-12 control-label" >Login Name</label>
                            <input type="text" class="form-control" name="Loginname"  required  id="Loginname" placeholder="Login Name">
                          </div>
                          <div class="col-12">
                            <label for="Name" class="col-sm-12 control-label" >Name</label>
                            <input type="text" class="form-control" name="Name"  required  id="Name" placeholder="Name">
                          </div>
                          <div class="col-12">
                            <label for="User_Id" class="col-sm-12 control-label">Contactnumber</label>
                            <input type="tel" class="form-control" name="Contactnumber"  required id="Contactnumber" placeholder="ex: 09123456789">
                          </div>
                          <div class="col-12">
                            <label for="User_Id" class="col-sm-12 control-label">Status</label>
                           <select class="form-control" name="Status" id="Status" required>
                            <option value="ACTIVE" selected >Active</option>
                           <option value="INACTIVE">Inactive</option>
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
                    <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-save"></i> Submit</button> 
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Add -->
<div class="modal fade" id="upload">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Import Player</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="players/function.php"  enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                          <div class="col-12">
                            <label for="User_Id" class="col-sm-12 control-label" >Upload files (.csv Only)</label>
                            <input type="file" class="form-control"  required name="file" id="file" >
                          </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-save"></i> Submit</button> 
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

                <h4 class="modal-title">Message</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="players/function.php"  enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                          <div class="col-12"><center>
                            <label for="User_Id" class="col-sm-12 control-label" >Are you sure? you want to reset all VTO?</label>
                            </center>
                          </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-success btn-flat" name="reset"><i class="fa fa-save"></i> Reset</button> 
                </div>
            </form>
        </div>
    </div>
</div>






<!-- Add -->
<div class="modal fade" id="uploadvto">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Valid Turn Over</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="players/function.php"  enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                          <div class="col-12">
                            <label for="User_Id" class="col-sm-12 control-label" >Upload files (.csv Only)</label>
                            <input type="file" class="form-control"  required name="file" id="file" >
                          </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-success btn-flat" name="uploadvto"><i class="fa fa-save"></i> Submit</button> 
                </div>
            </form>
        </div>
    </div>
</div>