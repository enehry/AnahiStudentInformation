<?php 

	class Forms extends Model{


		public function createSF10($lrn,$schoolYear){

				if(isset($lrn) && isset($schoolYear)){

				$this->query('SELECT * FROM tblStudents 
					WHERE lrn = :lrn');
				$this->bind(':lrn',$lrn);
				$stData = $this->single();

				$this->query('SELECT * FROM tblgradesshs g LEFT JOIN
					tblsubject s ON g.subjectcode = s.subjectcode
					WHERE g.lrn = :lrn AND g.sy = :sy ORDER BY s.type ASC,s.description');
				$this->bind(':lrn',$lrn);
				$this->bind(':sy',$schoolYear);
				$stGrades = $this->resultSet();

				$inputFileName = '../Anahi/excel/SF10.xlsx';

				$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load($inputFileName);

				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);

				// Add column headers
				$objPHPExcel->getActiveSheet()
							->setCellValue('F8',$stData['lastname'])
							->setCellValue('Y8',$stData['firstname'])
							->setCellValue('AZ8',$stData['middlename'])
							->setCellValue('C9',$stData['lrn'])
							->setCellValue('AA9',$stData['birthdate'])
							->setCellValue('AN9',$stData['sex']);

				// Redirect output to a client’s web browser (Excel2007)
				
				if(!empty($stGrades)){

					$countFirst = 31;
					$countSecond = 74;
					$firstSem = false;
					$SecondSem = false;


					foreach($stGrades as $grades) {
						if($grades['term'] == 'First'){
							$firstSem = true;
							$objPHPExcel->getActiveSheet()
							->setCellValue('A'.$countFirst,$grades['type'])
							->setCellValue('I'.$countFirst,$grades['description'])
							->setCellValue('AT'.$countFirst,$grades['mid'])
							->setCellValue('AY'.$countFirst,$grades['final']);
							$countFirst++;
						} else if ($grades['term'] == 'Second'){
							$secondSem = true;
							$objPHPExcel->getActiveSheet()
							->setCellValue('A'.$countSecond,$grades['type'])
							->setCellValue('I'.$countSecond,$grades['description'])
							->setCellValue('AT'.$countSecond,$grades['mid'])
							->setCellValue('AY'.$countSecond,$grades['final']);
							$countSecond++;
						}
					}

					if($firstSem){
						$objPHPExcel->getActiveSheet()
							->setCellValue('AS23',$stGrades[0]['grade'])
							->setCellValue('BA23',$schoolYear)
							->setCellValue('AS25',$stGrades[0]['section']);
					}
					if($secondSem){
						$objPHPExcel->getActiveSheet()
							->setCellValue('AS66',$stGrades[0]['grade'])
							->setCellValue('BA66',$schoolYear)
							->setCellValue('AS68',$stGrades[0]['section']);							
					}

				}

		

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				ob_end_clean();
				header('Content-Type: application/openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="' . $inputFileName . '"');
				header('Cache-Control: max-age=0');
				$objWriter->save('php://output');
				exit;
				} else {
					echo "ERROR";
				}


		}
	}