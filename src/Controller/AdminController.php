<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
class AdminController extends AppController
{
	public function index(){
		
	}
	
	
	public function addNewClass(){
		$gradesTable=TableRegistry::getTableLocator()->get('Grades');
		$gradesTableEntity=$gradesTable->newEntity();
		if($this->request->is('post')){
			$formData=$this->request->getData();
			$gradesTableEntity=$gradesTable->newEntity($formData);
			print_r($gradesTableEntity);
			$gradesTable->save($gradesTableEntity);
			
		}
	}
	
	public function addNewSubject(){
		$subjectTable=TableRegistry::getTableLocator()->get('Subjects');
		$subjectTableEntity=$subjectTable->newEntity();
		if($this->request->is('post')){
			$formData=$this->request->getData();
			$subjectTableEntity=$subjectTable->newEntity($formData);
			$subjectTable->save($subjectTableEntity);
			
		}
	}
	public function addNewTeacher(){
		$teachersTable=TableRegistry::getTableLocator()->get('Teachers');
		$teachersTableEntity=$teachersTable->newEntity();
		if($this->request->is('post')){
			$formData=$this->request->getData();
			$teachersTableEntity=$teachersTable->newEntity($formData);
			$teachersTable->save($teachersTableEntity);
			
		}
	}
	
	public function manageTimetable(){
		$weekdays=Configure::read("WEEK_DAYS");
		$teachersTable=TableRegistry::getTableLocator()->get('Teachers');
		$subjectTable=TableRegistry::getTableLocator()->get('Subjects');
		$gradesTable=TableRegistry::getTableLocator()->get('Grades');
		$timetablesTable=TableRegistry::getTableLocator()->get('Timetables');
		/* get all the data from db */
		$getAllGrades=$gradesTable->find('list',[
				'keyField' => 'id',
				'valueField' => 'grade_name'
		])->toArray();
		$getAllSubjects=$subjectTable->find('list',[
				'keyField' => 'id',
				'valueField' => 'subject_with_code'
		])->toArray();
		$getAllTeachers=$teachersTable->find('list',[
				'keyField' => 'id',
				'valueField' => 'name_designation'
		])->toArray();
		
		/* store new entry in the database */
		$timetablesTableEntity=$timetablesTable->newEntity();
		if($this->request->is('post')){
			$formData=$this->request->getData();
			$timetablesTableEntity= $timetablesTable->patchEntity($timetablesTableEntity, $this->request->getData(),
					['validate' => 'timetable']);
			if(!$timetablesTableEntity->getErrors()){
				$timetablesTable->save($timetablesTableEntity);
			}
			//print_r($timetablesTableEntity);exit;
			//$timetablesTableEntity=$timetablesTable->newEntity($formData);
			//print_r($timetablesTableEntity);
			
			
		}
		$this->set('timetableEntity',$timetablesTableEntity);
		$this->set('teachers',$getAllTeachers);
		$this->set('grades',$getAllGrades);
		$this->set('subjects',$getAllSubjects);
		$this->set('weekdays',$weekdays);
		
	}
	
	public function accessTimetable(){
		$timetablesTable=TableRegistry::getTableLocator()->get('Timetables');
		$teachersTable=TableRegistry::getTableLocator()->get('Teachers');
		$subjectTable=TableRegistry::getTableLocator()->get('Subjects');
		$gradesTable=TableRegistry::getTableLocator()->get('Grades');
		$weekdays=Configure::read("WEEK_DAYS");
		$getRecess=Configure::read("SOTRE_RECESS");
		
		$getAllGrades=$gradesTable->find('list',[
				'keyField' => 'id',
				'valueField' => 'grade_name'
		])->toArray();
		$getTableData=$timetablesTable->find('all')
		->where(['grade_id'=>1])
		->contain(['Teachers','Grades','Subjects'])->enableHydration(false)->toArray();
		//echo "<pre>";
		$this->set('weekdays',$weekdays);
		$this->set('getTableData',$getTableData);
		$this->set("getRecess",$getRecess);
		$this->set('getAllGrades',$getAllGrades);
		
	}
}