<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Network\Session;
use Cake\Core\Configure;
use Cake\Auth\DefaultPasswordHasher;

class TimetablesTable extends Table
{
	public function initialize(array $config)
	{
		parent::initialize($config);
		
		$this->setTable('timetables');
		$this->setDisplayField('id');
		$this->setPrimaryKey('id');
	}
	
	public function validationTimetable(Validator $validator){
		
		$validator->notEmpty('teacher_id',Configure::read('FIELD_REQUIRED'))
		->notEmpty('grade_id',Configure::read('FIELD_REQUIRED'))
		->notEmpty('subject_id',Configure::read('FIELD_REQUIRED'))
		->notEmpty('period',Configure::read('FIELD_REQUIRED'))
		->notEmpty('weekday',Configure::read('FIELD_REQUIRED'))
		;
		return $validator;
				
	}
	
		
}
?>