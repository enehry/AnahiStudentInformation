<div class="container">


	<div class="text-center">
		<h3>
			SCHEDULE
		</h3>

		<small><?php  
		if(!empty($viewmodel)){
		echo 'GRADE: '.$viewmodel[0]['grade'].' SECTION: '.$viewmodel[0]['section'];}
	?></small>
	</div>
	<?php Messages::displayCustomMsg(); ?>

	<div class="row">
	<div class="ml-auto mb-4">

		<button class="btn btn-success" name="selectthis" value="selectthis" form="addsched">Set as my Sched</button>
	</div>

	</div>

<div class="row">
	<div class="ml-auto mt-2 mb-2">
		<button class="btn btn-danger" name="delete" value="delete" form="addsched"><i class="fa fa-trash"></i></button>
	</div>
</div>

	<div class="table-responsive">
	<table class="table table-sm">
	  <thead>
	    <tr>
	    <th scope="col">Select All</th>
	      <th scope="col">Subject Code</th>
	      <th scope="col">Subject</th>
	      <th scope="col">Mon</th>
	      <th scope="col">Tue</th>
	      <th scope="col">Wed</th>
	      <th scope="col">Thu</th>
	      <th scope="col">Fri</th>
	      <th scope="col">Start Time</th>
	      <th scope="col">End Time</th>
	      <th scope="col">Teacher</th>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php foreach ($viewmodel as $sched_data):?>
	    <tr>
	      <td><input type="checkbox" name="selected[]" form="addsched" value="<?php echo  $sched_data['schedtempid']; ?>"></td>
	      <td><?php echo $sched_data['subjectcode']; ?></td>
	      <td><?php echo $sched_data['description']; ?></td>
	      <td class=""><?php if($sched_data['m'] == '1'){
	      	echo '<i class="fa fa-check" ></i>';
	      }	else { echo '<i class="fa fa-times"; ></i>'; } ?></td>
	      <td class=""><?php if($sched_data['t'] == '1'){
	      	echo '<i class="fa fa-check" ></i>';
	      }	else { echo '<i class="fa fa-times"; ></i>'; } ?></td>
	      <td class=""><?php if($sched_data['w'] == '1'){
	      	echo '<i class="fa fa-check" ></i>';
	      }	else { echo '<i class="fa fa-times"; ></i>'; } ?></td>
	      <td class=""><?php if($sched_data['th'] == '1'){
	      	echo '<i class="fa fa-check" ></i>';
	      }	else { echo '<i class="fa fa-times"; ></i>'; } ?></td>
	      <td class=""><?php if($sched_data['f'] == '1'){
	      	echo '<i class="fa fa-check" ></i>';
	      }	else { echo '<i class="fa fa-times"; ></i>'; } ?></td>
	      <td><?php echo $sched_data['starttime']; ?></td>
	      <td><?php echo $sched_data['endtime']; ?></td>
	      <td><?php echo $sched_data['lastname']; ?></td>
	    </tr>
	<?php    endforeach;       ?>
	  </tbody>
	</table>
	</div>

	<br>
	<br>
	<br>



	<div class="table-responsive">
	<table class="table table-sm">
	  <thead>
	    <tr>
	      <th scope="col">Subject Code</th>
	   
	      <th scope="col">Mon</th>
	      <th scope="col">Tue</th>
	      <th scope="col">Wed</th>
	      <th scope="col">Thu</th>
	      <th scope="col">Fri</th>
	      <th scope="col">Start Time</th>
	      <th scope="col">End Time</th>
	      <th scope="col">TRN<small class="text-muted"> (Teacher for this subj.) </small></th>
	      <th scope="col">Semester</th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr>
	      <td><input type="text" name="subjectcode"  class="form-control form-control-sm" form="addsched"></td>
	     
	      <td class="text-center"><input type="checkbox" name="day[]" class="form-check-input " value="0" form="addsched"></td>
	      <td class="text-center"><input type="checkbox" name="day[]" class="form-check-input" value="1" form="addsched" ></td>
	      <td class="text-center"><input type="checkbox" name="day[]" class="form-check-input " value="2" form="addsched" ></td>
	      <td class="text-center"><input type="checkbox" name="day[]" class="form-check-input" value="3" form= "addsched" "></td>
	      <td class="text-center"><input type="checkbox" name="day[]" class="form-check-input " value="4" form="addsched"></td>
	      <td><input class="form-control form-control-sm" type="time" value="12:00:00" id="example-time-input" name="starttime" form="addsched"></td>
	      <td><input class="form-control form-control-sm" type="time" value="12:00:00" id="example-time-input" name="endtime" form="addsched"></td>
	      <td><input type="text" name="trn" class="form-control form-control-sm" form="addsched"></td>
	      <td>
	      	<select class="form-control-sm" form
	      	="addsched" name="term">
	      	<option selected="selected" disabled="disabled" >Choose Semester</option>
	      	<option>First</option>
	      	<option>Second</option>			
	      </select>
	  	  </td>
	    </tr>
	  </tbody>
	  	
	</table>
	
	</div>

	<div class="">
			<form action="<?php $_SERVER['PHP_SELF'];  ?>" method="post" id="addsched" >
	  		<input type="submit" name="add" value="Add" class="btn btn-success float-right mr-4 mt-0" form="addsched">
	  		</form>
	</div>
</div>