<div class="container">
  <div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8" >
      <div class="header-edit text-center mb-4">
        <h3>Edit Student's Profile</h3>
      </div>
      <div class="panel panel-info">
        <div class="panel-heading text-center">
          <h3 class="panel-title mb-auto">
            <input type="text" name="lrn" form ="save-form" class="edit-mode" value="<?php echo $viewmodel['lrn']; ?>"></h3>
          <small class="text-muted">Learners Reference Number</small>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12 col-lg-12 mt-3 mb-3" align="center">
              <img alt="User Pic" class="img-fluid" id="circle" src="<?php echo ROOT_URL?>assets/images/students/<?php 
                if($viewmodel['profileimagename']){
                  echo $viewmodel['profileimagename'];
                }
                else {
                  echo 'user.png';
                } ?>">
              <div class="form-group mb-auto m-camera">
                <label for="image-upload"><i class="fa fa-camera fa-lg upload-camera"></i></label>
                <input type="file" name="image-upload" id="image-upload" value="<?php echo $viewmodel['profileimagename']; ?>" form="save-form" class="form-control-file student-upload-img" >
                <br>
                <small class="text-muted mb-auto
                small-text">note: you can upload image</small>
              </div>
              <h3 class="panel-title mt-3 mb-auto">
                <input type="text" name="lastname" form="save-form" class="edit-name col-md-12 text-right" value="<?php echo $viewmodel['lastname']; ?>">
                <input type="text" name="firstname" form="save-form" class="edit-name col-md-12" value="<?php echo $viewmodel['firstname']; ?>">
                <input type="text" name="middlename" form="save-form" class="edit-name col-md-12 text-left" value="<?php echo $viewmodel['middlename']; ?>">
              </h3>
              <div class="text-center">
                <small class="text-muted mr-5">Last name</small>
                <small class="text-muted ">First name</small>
                <small class="text-muted ml-5">Middle name</small>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-md-12 col-lg-12">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="save-form" name="save-form" enctype="multipart/form-data">
              <button class="float-right mb-4 mr-4 btn btn-primary" name="save" value="save">Save</button>
            </form>
            <table class="table table-user-information">
              <tbody>
                <tr>
                <td>Date of Birth</td>
                <td><input type="date" name="birthdate" form="save-form" class="edit-mode" value="<?php echo $viewmodel['birthdate']; ?>">
                </td>
                </tr>
                <tr>
                <td>Sex</td>
                <td><select name="sex" form="save-form" class="edit-select">
                <option><?php echo $viewmodel['sex']; ?></option>
                <option>Male</option>
                <option>Female</option>
                </select> 
                </td>
                </tr>
                <tr>
                <td>Religion</td>
                <td><input type="text" name="religion" form="save-form" class="edit-mode" value="<?php echo $viewmodel['religion']; ?>">
                </td>
                </tr>
                <tr>
                <td>Mother tongue</td>
                <td><input type="text" name="mothertongue" form="save-form" class="edit-mode" value="<?php echo $viewmodel['mothertongue']; ?>">
                </td>
                </tr>
                <tr>
                <td>Ethnic group</td>
                <td><input type="text" name="ethnicgroup" form="save-form" class="edit-mode" value="<?php echo $viewmodel['ethnicgroup']; ?>">
                </td>
                </tr>
                <tr>
                <td>Contact number</td>
                <td><input type="text" name="contactnumber" form="save-form" class="edit-mode" value="<?php echo $viewmodel['contactnumber']; ?>">
                </td>
                </tr>
                <tr>
                <td class="text-muted"><small>Home Address</small></td>
                <td></td>
                </tr>
                <tr>
                <td>Street</td>
                <td><input type="text" name="homeaddress" form="save-form" class="edit-mode" value="<?php echo $viewmodel['homeaddress']; ?>">
                </td>
                </td>
                </tr>
                <tr>
                <td>Barangay</td>
                <td><input type="text" name="barangay" form="save-form" class="edit-mode" value="<?php echo $viewmodel['barangay']; ?>">
                </td>  
                </tr>
                <tr>
                <td>Municipality</td>
                <td><input type="text" name="municipality" form="save-form" class="edit-mode" value="<?php echo $viewmodel['municipality']; ?>">
                </td>  
                </tr>
                <tr>
                <td>Province</td>
                <td><input type="text" name="province" form="save-form" class="edit-mode" value="<?php echo $viewmodel['province']; ?>"></td>  
                </tr>
                <tr>
                <td class="text-muted"><small>Parents/Guardian</small></td>
                <td></td>
                </tr>
                <tr>
                <td>Father's name</td>
                <td><input type="text" name="fathername" form="save-form" class="edit-mode" value="<?php echo $viewmodel['fathername']; ?>"></td>
                </tr>
                <tr>
                <td>Father's occupation</td>
                <td><input type="text" name="foccupation" form="save-form" class="edit-mode" value="<?php echo $viewmodel['foccupation']; ?>"></td>
                </tr>
                <tr>
                <td>Father's contact number</td>
                <td><input type="text" name="fcontact" form="save-form" class="edit-mode" value="<?php echo $viewmodel['fcontact']; ?>"></td></td>  
                </tr>
                <tr>
                <td>Mother's name</td>
                <td><input type="text" name="mothername" form="save-form" class="edit-mode" value="<?php echo $viewmodel['mothername']; ?>"></td>
                </tr>
                <tr>
                <td>Mother's occupation</td>
                <td><input type="text" name="moccupation" form="save-form" class="edit-mode" value="<?php echo $viewmodel['moccupation']; ?>"></td>
                </tr>
                <tr>
                <td>Mother's contact number</td>
                <td><input type="text" name="mcontact" form="save-form" class="edit-mode" value="<?php echo $viewmodel['mcontact']; ?>"></td>
                </tr>
                <tr>
                <td>Guardian's name</td>
                <td><input type="text" name="guardianname" form="save-form" class="edit-mode" value="<?php echo $viewmodel['guardianname']; ?>"></td>
                </tr>
                <tr>
                <td>Guardian's relationship</td>
                <td><input type="text" name="grelationship" form="save-form" class="edit-mode" value="<?php echo $viewmodel['grelationship']; ?>"></td>
                </tr>
                <tr>
                <td>Guardian's contact number</td>
                <td><input type="text" name="gcontact" form="save-form" class="edit-mode" value="<?php echo $viewmodel['gcontact']; ?>"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-2"></div>
  </div>
  <br>
  <br>
</div>