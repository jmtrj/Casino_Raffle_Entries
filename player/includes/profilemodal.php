<!-- Add -->
<div class="modal fade" id="profile">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
                    <h4 class="modal-title"><b>Admin Profile</b></h4>
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
           
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="profile_update.php?return=<?php echo basename($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
          		  <div class="form-group">
                  	<label for="username" class="col-sm-12 control-label">Loginname</label>

                  	<div class="col-sm-12">
                    	<input type="text" class="form-control" id="username" name="Loginname" value="<?php echo $user['Loginname']; ?>">
                  	</div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-12 control-label">Password</label>

                    <div class="col-sm-12"> 
                      <input type="password" class="form-control" id="password" name="Password" value="<?php echo $user['Password']; ?>">
                    </div>
                </div>
                <div class="form-group">
                  	<label for="firstname" class="col-sm-12 control-label">Name</label>

                  	<div class="col-sm-12">
                    	<input type="text" class="form-control" id="Name" name="Name" value="<?php echo $user['Name']; ?>">
                  	</div>
                </div>
                <hr>
                <div class="form-group">
                    <label for="curr_password" class="col-sm-12 control-label">Current Password:</label>

                    <div class="col-sm-12">
                      <input type="password" class="form-control" id="curr_password" name="curr_password" placeholder="input current password to save changes" required>
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="save"><i class="fa fa-check-square-o"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>