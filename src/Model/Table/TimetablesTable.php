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
		$this->hasOne('Teachers')
		->setForeignKey([
				'id'
		])
		->setBindingKey([
				'teacher_id'
				
		]);
		$this->hasOne('Grades')
		->setForeignKey([
				'id'
		])
		->setBindingKey([
				'grade_id'
				
		]);
		$this->hasOne('Subjects')
		->setForeignKey([
				'id'
		])
		->setBindingKey([
				'subject_id'
				
		]);
		
	}
	
	public function validationTimetable(Validator $validator){
		$validator->notEmpty('teacher_id',Configure::read('FIELD_REQUIRED'))
		->add('teacher_id', 'customRule', [
				'rule' => function ($value, $context) {
				$gradeId=trim($context['data']['grade_id']);
				$subjectId=trim($context['data']['subject_id']);
				$period=trim($context['data']['period']);
				$weekday=trim($context['data']['weekday']);
				$checkIfAlreadyExists=$this->find('all')
				->where(['grade_id'=>$gradeId,'subject_id'=>$subjectId,'period'=>$period,'weekday'=>$weekday,'teacher_id'=>$value])->toArray();
				if (empty($checkIfAlreadyExists)) {
					return true;
				}
				else{
					return false;
				}
				},
				'message' => 'Same combination already exists',
				])
		->notEmpty('grade_id',Configure::read('FIELD_REQUIRED'))
		->notEmpty('subject_id',Configure::read('FIELD_REQUIRED'))
		->notEmpty('period',Configure::read('FIELD_REQUIRED'))
		->notEmpty('weekday',Configure::read('FIELD_REQUIRED'))
		;
		return $validator;
				
	}
	
		
}
?>