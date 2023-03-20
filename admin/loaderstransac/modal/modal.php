

<div class="modal fade" id="addcoupon">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Add Coupon</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="admintransaction/function.php"  enctype="multipart/form-data">
                <div class="modal-body">
                      <div class="row">
                         <div class="col-12">
                            <label for="Lastname" class="col-sm-12 control-label" >Load To</label>
                             <select class="form-control select2bs4" name="Loadername" style="width: 100%;"  required>
                              <option value="" hidden>CHOOSE</option>
                               <?php $sql = "SELECT * FROM `tblloader` where  Status ='Active' ";$query = $conn->query($sql); while($prow = $query->fetch_assoc()){ echo "<option value='".$prow['Id']."'>".$prow['Firstname']." ".$prow['Lastname']."</option>"; } ?>
                            </select>
                          </div>
                          <div class="col-12">
                            <label for="Lastname" class="col-sm-12 control-label" >Amount Load</label>
                            <input type="number" class="form-control"  onchange="this.value = parseInt(this.value);" name="Loadamount" required placeholder="Amount Coupon">
                            <input type="text" value="<?php echo $user['id']; ?>" name="Loadbyadmin" hidden> 
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