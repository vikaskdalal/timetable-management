<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Network\Session;
use Cake\Core\Configure;
use Cake\Auth\DefaultPasswordHasher;

class GradesTable extends Table
{
	public function initialize(array $config)
	{
		parent::initialize($config);
		
		$this->setTable('grades');
		$this->setDisplayField('id');
		$this->setPrimaryKey('id');
	}
	
		
}
?>