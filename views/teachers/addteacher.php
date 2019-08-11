<!-- Default form register -->
<form 
action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data"
class="text-center border border-light p-5">

    <p class="h4 mb-4">Register a Teacher</p>
    <div class="form-row mb-4">
        <div class="col-xs-12 col-lg-4">
            <img src="../assets/images/user.png" class="img-fluid user-img">
            <div class="form-group mb-auto m-camera">
                <label for="image-upload"><i class="fa fa-camera fa-lg upload-camera"></i></label>
                <input type="file" name="image-upload" id="image-upload" class="form-control-file student-upload-img">
                <br>
                <small class="text-muted mb-auto
                small-text">note: you can upload image</small>
            </div>
        </div>
        <div class="col-lg-4 mt-auto">
            <!-- sex -->
                <label class="float-left mb-auto text-muted"><small>Sex</small></label>
                <select name="sex" class="form-control" placeholder = "Sex">
                  <option>Male</option>
                  <option>Female</option>
                </select>
        </div>
        <div class="col-lg-4 mt-auto">
            <!-- LRN -->
            <label class="float-left mb-auto text-muted"><small>Teacher's Reference Number</small></label>
            <input type="text" class="form-control" name="trn" placeholder="Teacher's Reference Number">
        </div>
    </div>

    <div class="form-row">
        <div class="col-xs-12 col-md-4 mb-1">
            <!-- First name -->
            <label class="float-left mb-auto text-muted"><small>First name</small></label>
            <input type="text" class="form-control" placeholder="First name" name="firstname">
        </div>
        <div class="col-xs-12 col-md-4 mb-1">
            <!-- Middle name -->
            <label class="float-left mb-auto text-muted"><small>Middle name</small></label>
            <input type="text" class="form-control" placeholder="Middle name" name="middlename">
        </div>
        <div class="col-xs-12 col-md-4 mb-1">
            <!-- Last name -->
            <label class="float-left mb-auto text-muted"><small>Last name</small></label>
            <input type="text" class="form-control" placeholder="Last name" name="lastname">
        </div>
    </div>

    
    <div class="form-row">
        <div class="col-xs-12 col-md-4 mb-1">
            <!-- Bday -->
            <label class="float-left mb-auto text-muted"><small>Birthdate</small></label>
            <input type="date" class="form-control" placeholder="Birthdate" name="birthdate">
        </div>
        <div class="col-xs-12 col-md-4 mb-1">
            <!-- Mother Tongue -->
            <label class="float-left mb-auto text-muted"><small>Position</small></label>
            <input type="text" class="form-control" placeholder="Position" name="position">
        </div> 
        <div class="col-xs-12 col-md-4 mb-1">
            <!-- ethnic group -->
            <label class="float-left mb-auto text-muted"><small>Department</small></label>
            <input type="text" class="form-control" placeholder="Department" name="department">
        </div>
    </div>
    <div class="form-row">
        <div class="col-xs-12 col-lg-12 mb-1">
            <!-- Home address -->
            <label class="float-left mb-auto text-muted"><small>Street</small></label>
            <input type="text" class="form-control" placeholder="Street" name="homeaddress">
        </div>
    </div>
    <div class="form-row">
        <div class="col-xs-12 col-md-4 mb-1">
            <!-- barangay -->
            <label class="float-left mb-auto text-muted"><small>Barangay</small></label>
            <input type="text" class="form-control" placeholder="Barangay" name="barangay">
        </div>
        <div class="col-xs-12 col-md-4 mb-1">
            <!-- Municipality -->
            <label class="float-left mb-auto text-muted"><small>Municipality</small></label>
            <input type="text" class="form-control" placeholder="Municipality" name="municipality">
        </div>
        <div class="col-xs-12 col-md-4 mb-1">
            <!-- email -->
            <label class="float-left mb-auto text-muted"><small>Province</small></label>
            <input type="text" class="form-control" placeholder="Province" name="province">
        </div>
    </div>
    <div class="form-row">
        <div class="col-xs-12 col-md-4 mb-1">
          
        </div>
        <div class="col-xs-12 col-md-4 mb-1">
            <!-- contact number -->
            <label class="float-left mb-auto text-muted"><small>Contact number</small></label>
            <input type="text" class="form-control" placeholder="Contact number" name="contactnumber">
        </div>
        <div class="col-xs-12 col-md-4 mb-1">
            <!-- email -->
            <label class="float-left mb-auto text-muted"><small>Email</small></label>
            <input type="email" class="form-control" placeholder="Email" name="email">
        </div>
    </div>
    <hr>
    <div class="form-row">
        <div class="col-xs-12 col-md-4 mb-1">
          <!-- usertype -->
            <label class="float-left mb-auto text-muted"><small>User Type</small></label>
            <select class="form-control" name="usertype">
                <option value="teacher">
                    Teacher
                </option>
                <option value="admin">
                    Admin
                </option>
            </select>
        </div>
        <div class="col-xs-12 col-md-4 mb-1">
            <!-- pass -->
            <label class="float-left mb-auto text-muted"><small>Password</small></label>
            <input type="password" class="form-control" placeholder="*******" name="password">
        </div>
        <div class="col-xs-12 col-md-4 mb-1">
            <!-- repass -->
            <label class="float-left mb-auto text-muted"><small>Retype Password</small></label>
            <input type="password" class="form-control" placeholder="*******" name="repassword">
        </div>
    </div>
  
    <!-- Save button -->
    <br>
    <br>
    <br>
    <button class="btn btn-primary my-4 btn-block" type="submit" name="add" value="add">Save</button>

    



</form>

<!-- Default form register -->