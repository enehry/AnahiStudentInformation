
<div class="container">
      <div class="row">
      	<div class="col-lg-2"></div>
        <div class="col-lg-8 profile-box" >
   			<div class="header-student-profile text-center mb-4">
   				<h3>Student's Profile</h3>
   			</div>
          <div class="panel panel-info">
            <div class="panel-heading text-center">
              <h3 class="panel-title mb-auto"><?php echo $viewmodel['lrn']; ?></h3>
              <small class="text-muted">Learners Reference Number</small>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12 col-lg-12 mt-3 mb-3" align="center"> 
                	<div class="img-cropper">
                	<img alt="User Pic" class="img-fluid" id="circle" src="<?php echo ROOT_URL?>assets/images/students/<?php 
                if($viewmodel['profileimagename']){

                 echo $viewmodel['profileimagename'];}
                 else {
                 echo 'user.png';
                 } ?>">
             </div>
                <h3 class="text-center mt-2">
                	<?php echo $viewmodel['lastname'].','
                	.$viewmodel['firstname'].' '.$viewmodel['middlename']; ?>

                </h3>
             
                </div>
             
           	
               			
                
               
               </div>

              
               </div>
               <div class="row">
                <div class=" col-md-12 col-lg-12"> 
                <div class="buttons float-right mb-4 mr-4">
                  <?php if(isset($_SESSION['is_logged_in']) && $_SESSION['user_data']['usertype'] == 'adviser' ||
                  $_SESSION['user_data']['usertype'] == 'admin'): ?>
                	<a href="<?php echo ROOT_URL?>students/editstudent/<?php echo $viewmodel['tblstudentid']; ?>">
                		<i class="fa fa-edit fa-lg"></i>
                	</a>
                <?php endif; ?>
                </div>
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Date of Birth</td>
                        <td><?php echo $viewmodel['birthdate'];?></td>
                      </tr>
                      <tr>
                        <td>Sex</td>
                        <td><?php echo $viewmodel['sex'];?></td>
                      </tr>
                      <tr>
                        <td>Religion</td>
                        <td><?php echo $viewmodel['religion']; ?></td>
                      </tr>
                      <tr>
                        <td>Mother tongue</td>
                        <td><?php echo $viewmodel['mothertongue']; ?></td>
                      </tr>
                      <tr>
                        <td>Etnic group</td>
                        <td><?php echo $viewmodel['ethnicgroup']; ?></td>
                      </tr>
                      <tr>
                        <td>Contact number</td>
                        <td><?php echo $viewmodel['contactnumber']; ?></td>
                      </tr>
                       <tr>
                        <td class="text-muted"><small>Home Address</small></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Street</td>
                        <td><?php echo $viewmodel['homeaddress']; ?></td>
                      </tr>
                      <tr>
                        <td>Barangay</td>
                        <td><?php echo $viewmodel['barangay']; ?></td>  
                      </tr>
                      <tr>
                        <td>Municipality</td>
                        <td><?php echo $viewmodel['municipality']; ?></td>  
                      </tr>
                      <tr>
                        <td>Province</td>
                        <td><?php echo $viewmodel['province']; ?></td>  
                      </tr>
                      <tr>
                        <td class="text-muted"><small>Parents/Guardian</small></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Father's name</td>
                        <td><?php echo $viewmodel['fathername']; ?></td>
                      </tr>
                      <tr>
                        <td>Father's occupation</td>
                        <td><?php echo $viewmodel['foccupation']; ?></td>  
                      </tr>
                      <tr>
                        <td>Father's contact number</td>
                        <td><?php echo $viewmodel['fcontact']; ?></td>  
                      </tr>
                   	  <tr>
                        <td>Mother's name</td>
                        <td><?php echo $viewmodel['mothername']; ?></td>
                      </tr>
                      <tr>
                        <td>Mother's occupation</td>
                        <td><?php echo $viewmodel['moccupation']; ?></td>  
                      </tr>
                      <tr>
                        <td>Mother's contact number</td>
                        <td><?php echo $viewmodel['mcontact']; ?></td>  
                      </tr>
                      <tr>
                        <td>Guardian's name</td>
                        <td><?php echo $viewmodel['guardianname']; ?></td>
                      </tr>
                      <tr>
                        <td>Guardian's relationship</td>
                        <td><?php echo $viewmodel['grelationship']; ?></td>  
                      </tr>
                      <tr>
                        <td>Guardian's contact number</td>
                        <td><?php echo $viewmodel['gcontact']; ?></td>  
                      </tr>

                     
                    </tbody>
                  </table>
                 </div>
                </div>
              </div>
            </div>
                 <div class="panel-footer float-right">
                       
                 </div>
            
          </div>
          <div class="col-lg-2"></div>
        </div>
 