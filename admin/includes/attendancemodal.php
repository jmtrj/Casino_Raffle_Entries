<!-- Add -->
<div class="modal fade" id="importtmt">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"> ADD ATTENDANCE</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="function.php"  enctype="multipart/form-data">

                    <div class="form-group">
                            <label>EMPLOYEE LIST</label>
                            <select class="form-control select2bs4" name="Id" style="width: 100%;" required>
                              <option value="" hidden>CHOOSE</option>
                               <?php $sql = "SELECT * FROM `employeelist` where  Status ='Active' ";$query = $conn->query($sql); while($prow = $query->fetch_assoc()){ echo "<option value='".$prow['Id']."'>".$prow['Firstname']." ".$prow['Lastname']."</option>"; } ?>
                            </select>
                      </div>


                   <div class="form-group">
                     <label>Time-in</label>
                     <input type="text" class="form-control" name="Timein" required>
                   
                  </div>
                 

                   <div class="form-group">
                    <label>Time-out</label>
                     <input type="text" class="form-control" name="Timeout" required>

                   
                  </div>



                     <div class="form-group">
                            <label>EMPLOYEE LIST</label>
                            <input type="date" class="form-control" name="Date" required>
                      </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-primary btn-flat" name="Attendanceadd"><i class="fa fa-save"></i>Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Add -->
<div class="modal fade" id="edittmt">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Attendance Maintenance</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="function.php"  enctype="multipart/form-data">
                   <div class="form-group">
                    <label for="description" class="col-sm-3 control-label">Timein</label>

                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="Timein" name="Timein" required>
                         <input type="text" class="form-control" hidden id="Id" name="Id" required>
                    </div>
                  </div>



                   <div class="form-group">
                    <label for="description" class="col-sm-3 control-label">Timout</label>

                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="Timeout" name="Timeout" required>
                    </div>
                  </div>




                   <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">Date</label>
                        <div class="col-sm-12">
                             <input type="date" class="form-control" id="Date" name="Date" required>
                        </div>
                       
                  </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-primary btn-flat" name="Attendanceedit"><i class="fa fa-save"></i> Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>



