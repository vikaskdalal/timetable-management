<?php 
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Subject extends Entity
{
	protected $_accessible = [
			'*' => true,
			'id'=>False
			
	];
	protected function _getSubjectWithCode()
	{
		return $this->subject_name. ' (' . $this->subject_code.')';
	}
}

?>