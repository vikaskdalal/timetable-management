<?php 
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Timetable extends Entity
{
	protected $_accessible = [
			'*' => true,
			'id'=>False
			
	];
}

?>