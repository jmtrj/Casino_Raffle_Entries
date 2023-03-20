


<!-- Add -->
<div class="modal fade" id="claim">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              
            </div>
            <form class="form-horizontal" method="POST" action="claimprizes/function.php"  enctype="multipart/form-data">
                <div class="modal-body">
                      <div class="row">

                        <input type="text" id="Id" name="WinnerId" hidden>

                          <div class="col-12">
                            <center>
                            <label for="Message" class="col-sm-12 control-label" >Are you sure? you want to claim your prize?</label>
                            </center>
                          </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal" aria-label="Close">NO</button> 
                    <button type="submit" class="btn btn-success btn-flat" name="addclaim">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>




