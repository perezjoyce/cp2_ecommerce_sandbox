<form action="../controllers/process_register.php" method="POST" id="form_register">

                <div class="text-center my-5">Edit Profile</div>

                <div class="form-group">
                  <label>First Name</label>
                  <input type="text" class="form-control" id="fname" name="fname">
                  <p class="validation text-danger"></p>
                </div>

                <div class="form-group">
                  <label>Last Name</label>
                  <input type="text" class="form-control" id="lname" name="lname">
                  <p class="validation text-danger"></p>
                </div>

                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" id="email" name="email">
                  <p class="validation text-danger"></p>
                </div>
                    
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control" id="username" name="username">
                  <p class="validation text-danger"></p>
                </div>

                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" id="password" name="password">
                  <p class="validation text-danger"></p>
                </div>

                <div class="form-group">
                  <label>Confirm Password</label>
                  <input type="password" class="form-control" id="cpass" name="cpass">
                  <p class="validation text-danger"></p>
                </div>

                <p id="error_message"></p>

                <div class="d-flex flex-lg-row flex-md-row flex-sm-column my-5">
                  <button type="button" class="btn btn-outline-success mr-1 flex-fill" id="btn_register">SAVE</button>
                  <input type="reset" class="btn btn-outline-warning flex-fill" id="btn_clear" value="CLEAR">
                </div>
                
              </form>