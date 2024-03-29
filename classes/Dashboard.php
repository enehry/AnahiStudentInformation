<?php
	class Dashboard extends Model
	{
		
		public function getCount($table){
			$this->query('SELECT count(*) as count 
				FROM '.$table);
			$result = $this->single();
			echo $result['count'];
		}
		public function customCount($table){
			$this->query('SELECT count(*) as count 
				FROM '.$table.' WHERE
				sy = :sy AND
				term = :term');
			$this->bind(':sy',SCHOOL_YEAR);
			$this->bind(':term',TERM);
			$result = $this->single();
			echo $result['count'];
		}
		public function countBoys(){
			$this->query('SELECT count(*) as count 
				FROM tblstudents WHERE sex = "Male"');
			$result = $this->single();
			$totalboys = $result['count'];

			$this->query('SELECT count(*) as count 
				FROM tblstudents');
			$all = $this->single();
			return $percentage = round(($totalboys/$all['count'])*100);
		}
		public function countGirls(){
			$this->query('SELECT count(*) as count 
				FROM tblstudents WHERE sex = "Female"');
			$result = $this->single();

			$this->query('SELECT count(*) as count 
				FROM tblstudents');
			$all = $this->single();
			return $percentage = round(($result['count']/$all['count'])*100);

		}
		public function countStudent($sex){
			$this->query('SELECT count(*) as count 
				FROM tblstudents WHERE sex = "'.$sex.'"');
			$result = $this->single();

			return $result['count'];
		}
		public function countBoysTeacher(){
			$this->query('SELECT count(*) as count 
				FROM tblTeachers WHERE sex = "Male"');
			$result = $this->single();
			$totalboys = $result['count'];

			$this->query('SELECT count(*) as count 
				FROM tblTeachers');
			$all = $this->single();
			return $percentage = round(($totalboys/$all['count'])*100);
		}
		public function countGirlsTeacher(){
			$this->query('SELECT count(*) as count 
				FROM tblTeachers WHERE sex = "Female"');
			$result = $this->single();

			$this->query('SELECT count(*) as count 
				FROM tblTeachers');
			$all = $this->single();
			return $percentage = round(($result['count']/$all['count'])*100);

		}
		public function countTeachers($sex){
			$this->query('SELECT count(*) as count 
				FROM tblTeachers WHERE sex = "'.$sex.'"');
			$result = $this->single();

			return $result['count'];
		}
		public function recentlyEnrolled(){
			$this->query('SELECT * FROM tblenrollmentshs e LEFT JOIN
				tblstudents s ON e.lrn = s.lrn ORDER BY e.enrollmentid DESC LIMIT 0,10');
			$result = $this->resultSet();

			return $result;
		}
		public function getSubjects(){
			$this->query('SELECT * FROM tblsubject ORDER BY DESCRIPTION ASC');
			$rs = $this->resultSet();
			return $rs;
		}

		
	}