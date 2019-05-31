<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
class AdminController extends AppController
{
	public function index(){
		
	}
	
	
	public function addClass(){
		$gradesTable=TableRegistry::getTableLocator()->get('Grades');
		$gradesTableEntity=$gradesTable->newEntity();
		if($this->request->is('post')){
			$formData=$this->request->getData();
			$gradesTableEntity=$gradesTable->newEntity($formData);
			print_r($gradesTableEntity);
			$gradesTable->save($gradesTableEntity);
			
		}
	}
}