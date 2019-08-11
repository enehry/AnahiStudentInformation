<?php
class EnrollmentModel extends Model{
	public function Index(){
		
	return;
	}
	public function seniorhigh(){

		$post = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
		$searchkey = '%%';
		if(isset($post['btnsearch'])){


			global $searchkey;

			$searchkey = '%'.$post['searchitem'].'%';
		}
		if(isset($post['btnenroll'])){
					
					$this->query('SELECT grade,section,term FROM tbladvisoryclass
						WHERE trn = :trn');
					$this->bind(':trn',$_SESSION['user_data']['trn']);
					$grsec = $this->single();

					$grade = $grsec['grade'];
					$section = $grsec['section'];
					$term = $grsec['term'];
					$adviser = $_SESSION['user_data']['trn'];

				


					if(!empty($grsec)){

					
						foreach($post['selected'] as $enrollLrn){

								$this->query('INSERT INTO tblenrollmentshs (lrn,trn,grade,section,sy,term)
									VALUES (:lrn,:trn,:grade,:section,:sy,:term)');
								$this->bind(':lrn',$enrollLrn);
								$this->bind(':trn',$adviser);
								$this->bind(':grade',$grade);
								$this->bind(':section',$section);
								$this->bind(':sy',SCHOOL_YEAR);
								$this->bind(':term',$term);

								$this->execute();
								if($this->lastInsertId()){
									echo "STUDENT SUCCESFULLY ENROLLED";

									Messages::setMsg('STUDENT SUCCESFULLY ENROLLED','successMsg');
								}
							}
						
					} else {
					

						Messages::setMsg('You have no advisory class','error');
					}


			
					/*foreach($post['selected'] as $enrollLrn){

					$this->query('INSERT INTO tblenrollmentshs (lrn,trn,grade,section,sy,term)
						VALUES (:lrn,:trn,:grade,:section,:sy,:term)');
					$this->bind(':lrn',$enrollLrn);
					$this->bind(':trn',$_SESSION['user_data']['trn']);
					$this->bind(':grade',$post['grade']);
					$this->bind(':section',$post['section']);
					$this->bind(':sy',SCHOOL_YEAR);
					$this->bind(':term',$post['term']);

					$this->execute();
					if($this->lastInsertId()){
						echo "STUDENT SUCCESFULLY ENROLLED";
					}
				}*/
				

		}
		// getting max id in advisory class to show only 1 updated record
		$this->query('SELECT grade,section FROM tbladvisoryclass
			WHERE trn = :trn AND tbladvisoryclassid = (SELECT MAX(tbladvisoryclassid) FROM tbladvisoryclass WHERE trn = :trn)');
		$this->bind(':trn',$_SESSION['user_data']['trn']);
		$gr_sec = $this->single();




		// display the grade and section of previous SY

		//split school year
		$schyr = explode('-',SCHOOL_YEAR);

		$schyr1 = intval($schyr[0]-1);
		$schyr2 = intval($schyr[1]-1);

		$sy = $schyr1.'-'.$schyr2;


		$this->query('SELECT s.lrn,s.tblstudentid,s.firstname,s.middlename,s.lastname,e.grade,e.section,e.sy FROM tblstudents s 
			LEFT JOIN tblenrollmentshs e 
			ON s.lrn = e.lrn 
			WHERE e.sy = :sy 
			AND e.section = :section
			AND (s.lrn LIKE :search
			OR s.lastname	LIKE :search
			OR s.firstname LIKE :search
			OR s.middlename LIKE :search)
			ORDER BY e.grade DESC,s.lastname');

		$this->bind(':sy',$sy);
		$this->bind(':grade',$gr_sec['grade']);
		$this->bind(':section',$gr_sec['section']);
		$this->bind(':search',$searchkey);


		$rows = $this->resultSet();

		return $rows;
	}
	public function enrollmentsearchshs(){
		$q = intval($_GET['id']);

		
		$this->query('SELECT * FROM tblstudents WHERE tblstudentid = :id');
		$this->bind(':id',$q);

		$rows =	$this->resultSet();
		print_r($rows);

		return $rows;
	}

	public function setadvisoryclass(){
		$post = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);



		$this->query('SELECT COUNT(*) as count
						FROM tblteachers t
						LEFT JOIN tbladvisoryclass a 
						ON t.trn = a.trn');
		$res = $this->single();

	
		// set per page
		$GLOBALS['per_page'] = 10;
		//get total records
		$GLOBALS['total_rows'] = $res['count'];

		// set 1 if the page url is empty
		if(!empty($_GET['id'])){
			$GLOBALS['page'] = $_GET['id'];
			} else {
				$GLOBALS['page'] = 1;
			}
			//get offset which is the starting page 
		$GLOBALS['offset'] = ($GLOBALS['page']-1)*$GLOBALS['per_page'];




		if(isset($post['btnset'])){
			
				
			
			if(isset($post['grade']) && isset($post['section'])){

				if(isset($post['selected'])){
					foreach($post['selected'] as $selectedadviser){
					$split = explode(",",$selectedadviser);

					$this->query('INSERT INTO tbladvisoryclass (trn,grade,section,sy,term)
						VALUES (:trn,:grade,:section,:sy,:term)');

					$this->bind(':trn',$split[1]);
					$this->bind(':grade',$post['grade']);
					$this->bind(':section',$post['section']);
					$this->bind(':sy',SCHOOL_YEAR);
					$this->bind(':term',$post['term']);



					$this->execute();

					


					if($this->lastInsertId()){
						$this->query('UPDATE tblteachers SET
								usertype = "adviser"
								WHERE trn = :trn');
						$this->bind(':trn',$split[1]);
						$this->execute();
						Messages::setMsg('Adviser successfully set','successMsg');
					}
				}

				} else {
					Messages::setMsg('Please select students','error');
				}


			} else {
				Messages::setMsg('Please select Grade and Section','error');
			}

		}
		if(isset($post['delete'])){
			
			if(isset($post['selected'])){
				foreach ($post['selected'] as $deleteid) {
					$split_id = explode(",",$deleteid);
					$this->query('SELECT grade,section FROM tbladvisoryclass
						WHERE trn = :trn
						AND sy = :sy
						AND term = :term');
					$this->bind(':trn',$split_id[1]);
					$this->bind(':sy',SCHOOL_YEAR);
					$this->bind(':term',TERM);
					$res = $this->single();


					$this->query('DELETE FROM tblgradesshs 
						WHERE grade = :grade 
						AND section = :section
						AND sy = :sy
						AND term = :term');
					$this->bind(':grade',$res['grade']);
					$this->bind(':section',$res['section']);
					$this->bind(':sy',SCHOOL_YEAR);
					$this->bind(':term',TERM);
					$this->execute();

					$this->query('DELETE FROM tblschedshs 
						WHERE grade = :grade 
						AND section = :section
						AND sy = :sy
						AND term = :term');
					$this->bind(':grade',$res['grade']);
					$this->bind(':section',$res['section']);
					$this->bind(':sy',SCHOOL_YEAR);
					$this->bind(':term',TERM);
					$this->execute();

					$this->query('DELETE FROM tblenrollmentshs 
						WHERE grade = :grade 
						AND section = :section
						AND sy = :sy
						AND term = :term');
					$this->bind(':grade',$res['grade']);
					$this->bind(':section',$res['section']);
					$this->bind(':sy',SCHOOL_YEAR);
					$this->bind(':term',TERM);
					$this->execute();

					$this->query('DELETE FROM tbladvisoryclass WHERE
					tbladvisoryclassid = :deleteid');
					$this->bind(':deleteid',$split_id[0]);
					$this->execute();

					$this->query('UPDATE tblteachers SET
								usertype = "teacher"
								WHERE trn = :trn');
					$this->bind(':trn',$split_id[1]);
					$this->execute();			

					Messages::setMsg('Adviser successfully remove','successMsg');
				}
			}
		}
		


		$this->query('SELECT a.tbladvisoryclassid,t.trn,t.firstname,t.middlename,
						t.lastname,a.grade,a.section 
						FROM tblteachers t
						LEFT JOIN tbladvisoryclass a 
						ON t.trn = a.trn
						ORDER BY a.grade DESC,t.lastname
						LIMIT :offset,:per_page');
		$this->bind(':offset',$GLOBALS['offset']);
		$this->bind(':per_page',$GLOBALS['per_page']);

		

		$rows = $this->resultSet();

		

		return $rows;
	}


	public function juniorhigh(){
		return;
	}



	public function setadvisorysearch(){
		$post = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

		$searchkey = '%'.$_GET['id'].'%';
		$GLOBALS['searchkey'] = $_GET['id'];

		if(isset($post['btnsearch'])){


			if(empty($post['searchitem'])){
				header('Location:'.ROOT_URL.'enrollment/setadvisoryclass');
			} else {
				header('Location:'.ROOT_URL.'enrollment/setadvisorysearch/'.$post['searchitem'].'/');
			}
		}

		if(isset($post['btnset'])){
			
				
			
			if(isset($post['grade']) && isset($post['section'])){

				if(isset($post['selected'])){
					foreach($post['selected'] as $selectedadviser){
					$split = explode(",",$selectedadviser);

					$this->query('INSERT INTO tbladvisoryclass (trn,grade,section,sy,term)
						VALUES (:trn,:grade,:section,:sy,:term)');

					$this->bind(':trn',$split[1]);
					$this->bind(':grade',$post['grade']);
					$this->bind(':section',$post['section']);
					$this->bind(':sy',SCHOOL_YEAR);
					$this->bind(':term',$post['term']);



					$this->execute();

					


					if($this->lastInsertId()){
						$this->query('UPDATE tblteachers SET
								usertype = "adviser"
								WHERE trn = :trn');
						$this->bind(':trn',$split[1]);
						$this->execute();
						Messages::setMsg('Adviser successfully set','successMsg');
					}
				}

				} else {
					Messages::setMsg('Please select students','error');
				}


			} else {
				Messages::setMsg('Please select Grade and Section','error');
			}

		}
		if(isset($post['delete'])){
			
			if(isset($post['selected'])){
				foreach ($post['selected'] as $deleteid) {
					$split_id = explode(",",$deleteid);

					$this->query('SELECT grade,section FROM tbladvisoryclass
						WHERE trn = :trn
						AND sy = :sy
						AND term = :term');
					$this->bind(':trn',$split_id[1]);
					$this->bind(':sy',SCHOOL_YEAR);
					$this->bind(':term',TERM);
					$res = $this->single();


					$this->query('DELETE FROM tblgradesshs 
						WHERE grade = :grade 
						AND section = :section
						AND sy = :sy
						AND term = :term');
					$this->bind(':grade',$res['grade']);
					$this->bind(':section',$res['section']);
					$this->bind(':sy',SCHOOL_YEAR);
					$this->bind(':term',TERM);
					$this->execute();

						$this->query('DELETE FROM tblschedshs 
						WHERE grade = :grade 
						AND section = :section
						AND sy = :sy
						AND term = :term');
					$this->bind(':grade',$res['grade']);
					$this->bind(':section',$res['section']);
					$this->bind(':sy',SCHOOL_YEAR);
					$this->bind(':term',TERM);
					$this->execute();

					$this->query('DELETE FROM tbladvisoryclass WHERE
					tbladvisoryclassid = :deleteid');
					$this->bind(':deleteid',$split_id[0]);
					$this->execute();

					$this->query('UPDATE tblteachers SET
								usertype = "teacher"
								WHERE trn = :trn');
					$this->bind(':trn',$split_id[1]);
					$this->execute();		

					
				}
			}
			Messages::setMsg('Adviser successfully remove','successMsg');
		}
		$this->query('SELECT COUNT(*) as count
						FROM tblteachers t
						LEFT JOIN tbladvisoryclass a 
						ON t.trn = a.trn WHERE 
						a.sy = :sy AND
						a.term = :term OR
						t.trn LIKE :search');
		$this->bind(':sy',SCHOOL_YEAR);
		$this->bind(':term',TERM);
		$this->bind(':search',$searchkey);
		$res = $this->single();

		echo $res['count'];

	
		// set per page
		$GLOBALS['per_page'] = 10;
		//get total records
		$GLOBALS['total_rows'] = $res['count'];

		// set 1 if the page url is empty
		if(!empty($_GET['key'])){
			$GLOBALS['page'] = $_GET['key'];
			} else {
				$GLOBALS['page'] = 1;
			}
			//get offset which is the starting page 
		$GLOBALS['offset'] = ($GLOBALS['page']-1)*$GLOBALS['per_page'];
		
		$this->query('SELECT a.tbladvisoryclassid,t.trn,t.firstname,t.middlename,
				t.lastname,a.grade,a.section 
				FROM tblteachers t
				LEFT JOIN tbladvisoryclass a 
				ON t.trn = a.trn WHERE 
				a.sy = :sy AND
				a.term = :term OR
				t.trn LIKE :search
				ORDER BY a.grade DESC,t.lastname
				LIMIT :offset,:per_page');
				$this->bind(':search',$searchkey);
				$this->bind(':sy',SCHOOL_YEAR);
				$this->bind(':term',TERM);
				$this->bind(':offset',$GLOBALS['offset']);
				$this->bind(':per_page',$GLOBALS['per_page']);

		$rows = $this->resultSet();
		

		return $rows;
	}

	public function enrollmentadmin(){

		$post = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
		if(isset($post['btnsearch'])){
			if(!empty($post['searchitem'])){
				header('Location:'.ROOT_URL.'enrollment/enrollmentadminsearch/'.$post['searchitem']);
			} else {
				
				header('Location'.ROOT_URL.'enrollment/enrollmentadmin');
			}
		}

		if(isset($post['btnset'])){
			if(!empty($post['selected']) && isset($post['grade']) && isset($post['section'])){
						$this->query('SELECT trn FROM tbladvisoryclass WHERE grade = :grade
							AND :section = section AND sy = :sy AND term = :term');
						$this->bind(':grade',$post['grade']);
						$this->bind(':section',$post['section']);
						$this->bind(':sy',SCHOOL_YEAR);
						$this->bind(':term',TERM);
						$trn = $this->single();
	
						echo $trn['trn'];

				foreach ($post['selected'] as $enrollStudents) {
					$lrn = explode('#', $enrollStudents);
					$this->query('INSERT into tblenrollmentshs(lrn,trn,grade,section,sy,term)
						VALUES(:lrn,:trn,:grade,:section,:sy,:term)');
					$this->bind(':lrn',$lrn[0]);
					$this->bind(':trn',$trn['trn']);
					$this->bind(':grade',$post['grade']);
					$this->bind(':section',$post['section']);
					$this->bind(':sy',SCHOOL_YEAR);
					$this->bind(':term',TERM);
					$this->execute();

				}
				if($this->lastInsertId()){

				Messages::setMsg('Students successfully enrolled','successMsg');
				header('Location:'.ROOT_URL.'enrollment/enrollmentadmin');
				exit;
				} 
				

			} else {
					Messages::setMsg('Please select grade,section,term and select a students','error');
				}
		}
		if(isset($post['delete'])){
			if(!empty($post['selected'])){
				foreach ($post['selected'] as $deleteStudents) {
					$id = explode('#', $deleteStudents);
					$this->query('DELETE FROM tblenrollmentshs
						WHERE enrollmentid = :id');
					$this->bind(':id',$id[1]);

					$this->execute();
				}
			if($this->rowCount() > 0){
				Messages::setMsg('Students remove','error');
			}
			}
		}


		$this->query('SELECT COUNT(*) as count FROM tblstudents');
		$res = $this->single();

	
		// set per page
		$GLOBALS['per_page'] = 10;
		//get total records
		$GLOBALS['total_rows'] = $res['count'];

		// set 1 if the page url is empty
		if(!empty($_GET['id'])){
			$GLOBALS['page'] = $_GET['id'];
		} else {
			$GLOBALS['page'] = 1;
		}
		//get offset which is the starting page 
		$GLOBALS['offset'] = ($GLOBALS['page']-1)*$GLOBALS['per_page'];

		$this->query('SELECT s.lrn,s.tblstudentid,s.firstname,s.middlename,s.lastname,e.grade,e.section,e.enrollmentid FROM tblstudents s LEFT JOIN tblenrollmentshs e ON s.lrn = e.lrn ORDER BY e.grade DESC, s.lastname
			LIMIT :offset,:per_page');
		$this->bind(':offset',$GLOBALS['offset']);
		$this->bind(':per_page',$GLOBALS['per_page']);
		$rows = $this->resultSet();



		return $rows;
	}
	public function enrollmentadminsearch(){

		$post = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

		if(isset($post['btnsearch'])){
			if(!empty($post['searchitem'])){
				header('Location:'.ROOT_URL.'enrollment/enrollmentadminsearch/'.$post['searchitem']);
			} else {
				header('Location:'.ROOT_URL.'enrollment/enrollmentadmin');
			}
		}

		if(isset($post['btnset'])){
			if(!empty($post['selected']) && isset($post['grade']) && isset($post['section'])){
						$this->query('SELECT trn FROM tbladvisoryclass WHERE grade = :grade
							AND :section = section AND sy = :sy
							AND term = :term');
						$this->bind(':grade',$post['grade']);
						$this->bind(':section',$post['section']);
						$this->bind(':sy',SCHOOL_YEAR);
						$this->bind(':term',TERM);
						$trn = $this->single();
	
						echo $trn['trn'];

				foreach ($post['selected'] as $enrollStudents) {
					$lrn = explode('#', $enrollStudents);
					$this->query('INSERT into tblenrollmentshs(lrn,trn,grade,section,sy,term)
						VALUES(:lrn,:trn,:grade,:section,:sy,:term)');
					$this->bind(':lrn',$lrn[0]);
					$this->bind(':trn',$trn['trn']);
					$this->bind(':grade',$post['grade']);
					$this->bind(':section',$post['section']);
					$this->bind(':sy',SCHOOL_YEAR);
					$this->bind(':term',TERM);
					$this->execute();

				}
					if($this->lastInsertId()){

				Messages::setMsg('Students successfully enrolled','successMsg');
				header('Location:'.ROOT_URL.'enrollment/enrollmentadmin');
				exit;
				} 
				

			} else {
					Messages::setMsg('Please select grade,section,term and select a students','error');
				}
		}
		if(isset($post['delete'])){
			if(!empty($post['selected'])){
				foreach ($post['selected'] as $deleteStudents) {
					$id = explode('#', $deleteStudents);
					$this->query('DELETE FROM tblenrollmentshs
						WHERE enrollmentid = :id');
					$this->bind(':id',$id[1]);

					$this->execute();
				}
			if($this->rowCount() > 0){
				Messages::setMsg('Students remove','error');
			}
			}
		}


		$searchkey = '%'.$_GET['id'].'%';

		$this->query('SELECT COUNT(*) as count FROM tblstudents s
			LEFT JOIN tblenrollmentshs e ON s.lrn = e.lrn 
			WHERE s.lrn LIKE :search
			OR s.lastname LIKE :search
			OR s.middlename LIKE :search
			OR s.firstname LIKE :search');
		$this->bind(':search',$searchkey);
		$res = $this->single();

	
		// set per page
		$GLOBALS['per_page'] = 10;
		//get total records
		$GLOBALS['total_rows'] = $res['count'];

		// set 1 if the page url is empty
		if(!empty($_GET['key'])){
			$GLOBALS['page'] = $_GET['key'];
		} else {
			$GLOBALS['page'] = 1;
		}
		//get offset which is the starting page 
		$GLOBALS['offset'] = ($GLOBALS['page']-1)*$GLOBALS['per_page'];

		$this->query('SELECT s.lrn,s.tblstudentid,s.firstname,s.middlename,s.lastname,e.grade,e.section,e.enrollmentid FROM tblstudents s 
			LEFT JOIN tblenrollmentshs e 
			ON s.lrn = e.lrn 
			WHERE s.lastname LIKE :search
			OR s.middlename LIKE :search
			OR s.firstname LIKE :search
			OR e.lrn LIKE :search
			ORDER BY e.grade DESC, s.lastname
			LIMIT :offset,:per_page');
		$this->bind(':offset',$GLOBALS['offset']);
		$this->bind(':per_page',$GLOBALS['per_page']);
		$this->bind(':search',$searchkey);
		$rows = $this->resultSet();



		return $rows;
	}
} 