<?php 
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Grade extends Entity
{
	protected $_accessible = [
			'*' => true,
			'id'=>False
			
	];
}

?>