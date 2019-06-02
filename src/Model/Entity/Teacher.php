<?php 
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Teacher extends Entity
{
	protected $_accessible = [
			'*' => true,
			'id'=>False
			
	];
	protected function _getNameDesignation()
	{
		return $this->name . ' (' . $this->designation.')';
	}
}

?>