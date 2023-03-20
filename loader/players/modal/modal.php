


<!-- Add -->
<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title">Add Coupon</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="players/function.php"  enctype="multipart/form-data">
                <div class="modal-body">
                      <div class="row">
                        

                          <div class="col-12">
                            <label for="Lastname" class="col-sm-12 control-label" >Amount Coupon</label>
                            <input type="number" class="form-control"  onchange="this.value = parseInt(this.value);" name="Loadamount" required placeholder="Amount Coupon">
                              <input type="text" value="<?php echo $user['Balance']; ?>" name="Balance" hidden> 
                            <input type="text" value="<?php echo $user['Id']; ?>" name="Loadbyadmin" hidden> 
                            <input type="text"   id="Id" name="Playername" hidden  > 
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




