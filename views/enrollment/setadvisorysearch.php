<div class="container">
  <div class="row">
    <div class="col-md-6">
       <form action="<?php echo ROOT_URL;?>enrollment/setadvisorysearch" method="post" id="setadviser">
        <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search.. (LRN/Teacher's Name)"  name="searchitem">
        <div class="input-group-append">
        
        <button name="btnsearch" value="search" class="btn btn-outline-dark"> Search</button>

        </div>

        </div>

        </form>
 
      </div>
      <div class="-col-md-6">
      	<button name="delete" value="delete" form="setadviser" class="btn btn-danger btn-delete"> Delete advisory</button>
      </div>
     
  </div>
  <div class="row">
    <div class="col-md-12">
    		<div class="row mb-3">
	        <div class="col">
	        <select class="form-control" name="grade" form="setadviser">
	          <option selected="true" disabled="disabled">Grade</option>
	          <option>11</option>
             <option>12</option>
	        </select>
	        </div>
	        <div class="col">
	        <select class="form-control" name="section" form="setadviser">
	          <option selected="true" disabled="disabled">Section</option>
	          <option>ICT - A</option>
            <option>ICT - B</option>
            <option>ICT - C</option>
	        </select>
	        </div>
	        <div class="col">
	        <select class="form-control" name="term" form="setadviser">
	          <option selected="true" disabled="disabled">Semester</option>
	          <option>First</option>
	          <option>Second</option>
	        </select>
	        </div>
	        <div class="col">
	        <button name="btnset" value="btnset" class="btn btn-success ml-4" form="setadviser">Set as Adviser</button>
	        </div>
	        </div>

            <table class="table table-striped table-sm">
	    
              <thead class="th">
                <tr>
                  <th scope="col"></th>
                  <th scope="col">#</th>
                  <th scope="col">TRN</th>
                  <th scope="col">Adviser</th>
                  <th scope="col">Advisory class</th>
                </tr>
              </thead>
              <tbody>
          <?php $count = 0 ?>
          <?php foreach($viewmodel as $item): ?>
                <tr>
                  <td><input form="setadviser" type="checkbox" name="selected[]" value ="<?php echo $item['tbladvisoryclassid'].','.$item['trn']; ?>"></td>
                 
                  <th scope="row"><?php $count++; echo $count; ?> </th>

                  <td><a href="<?php echo ROOT_URL; ?>teachers/teacherprofile/<?php echo $item['tblteacherid'];?>"><?php echo $item['trn']?></a></td>
                  <td><?php echo $item['lastname'].', '.$item['firstname'].' '.$item['middlename']?></td>
                  <td><?php  if(isset($item['grade']) && isset($item['section'])){
                  	echo 'G'.$item['grade'].'   '.$item['section'];}
                  	else {
                  		echo "N/A";
                  	} ?></td>
                 
                </tr>
          <?php endforeach;  ?>
              </tbody>
            </table>
          </div>
    </div>
  </div>
  <?php
  $pagination = new Pagination();
  $pagination->setPage($GLOBALS['page'],$GLOBALS['per_page'],$GLOBALS['total_rows']);
  $pagination->paginate(ROOT_URL.'enrollment/setadvisorysearch/'.$GLOBALS['searchkey'].'/');


   ?>
</div>