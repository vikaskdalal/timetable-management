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
				'valueField' => 'subject_name'
		])->toArray();
		$getAllTeachers=$teachersTable->find('list',[
				'keyField' => 'id',
				'valueField' => 'name'
		])->toArray();
		
		/* store new entry in the database */
		$timetablesTableEntity=$timetablesTable->newEntity();
		if($this->request->is('post')){
			print_r($timetablesTableEntity);exit;
			$formData=$this->request->getData();
			$timetablesTableEntity=$timetablesTable->newEntity($formData);
			$timetablesTable->save($timetablesTableEntity);
			
		}
		$this->set('timetableEntity',$timetablesTableEntity);
		$this->set('teachers',$getAllTeachers);
		$this->set('grades',$getAllGrades);
		$this->set('subjects',$getAllSubjects);
		$this->set('weekdays',$weekdays);
		
	}
}