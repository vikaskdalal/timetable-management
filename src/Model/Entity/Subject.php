<?php 
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Subject extends Entity
{
	protected $_accessible = [
			'*' => true,
			'id'=>False
			
	];
}

?>