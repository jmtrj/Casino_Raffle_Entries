
<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Are you sure, you want to Approve?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-horizontal" method="POST" action="approvals/function.php"  enctype="multipart/form-data">
                <div class="modal-body">
                      <div class="row">
                          <div class="col-12">
                            <label for="Lastname" class="col-lg-12 control-label" >Proof</label>
                               <input type="text" value="" id="Id" name="Id"   hidden> 
                            <input type="text" value="<?php echo $user['Id']; ?>" name="ApprovedBy" hidden> 
                            <input type="file"  class="form-control" name="file"  required> 
                          </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-flat" name="Approved"> <i class="fa fa-check"></i> Approved</button> 
                </div>
            </form>
        </div>
    </div>
</div>




