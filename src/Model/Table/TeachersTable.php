<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Network\Session;
use Cake\Core\Configure;
use Cake\Auth\DefaultPasswordHasher;

class TeachersTable extends Table
{
	public function initialize(array $config)
	{
		parent::initialize($config);
		
		$this->setTable('teachers');
		$this->setDisplayField('id');
		$this->setPrimaryKey('id');
	}
	
	public function validationTeacher(Validator $validator){
		$validator->notEmpty('name',Configure::read('FIELD_REQUIRED'))
		->add('name', 'customRule', [
				'rule' => function ($value, $context) {
				$designation=trim($context['data']['designation']);
				$checkIfAlreadyExists=$this->find('all')
				->where(['name'=>$value,'designation'=>$designation])->toArray();
				if (empty($checkIfAlreadyExists)) {
					return true;
				}
				else{
					return false;
				}
				},
				'message' => 'Same Name and Designation already exists.',
				])
				;
				return $validator;
						
	}
}
?>