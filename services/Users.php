<?php
namespace PhpBenchmarksPhalcon\RestApi\services;

use PhpBenchmarksRestData\Service;
use PhpBenchmarksPhalcon\RestApi\models\ShadowUser;

/**
 * Service for collection of Users.
 *
 */
class Users{
	private $users;
	public function __construct(){
		$this->users=Service::getUsers();
	}

	/**
	 * Serialized collection
	 */
	public function serialize(){
		return $this->convert($this->users);
	}

	/**
	 * Convert an array of User
	 * into an array.
	 * 
	 * @param array $objects
	 * @return array 
	 */
	private function convert(array $objects){
		$result = [];
			foreach ($objects as $entity){
				$user = new ShadowUser($entity);
				$result[] = $user->toArray();
			}
		}
		return $result;
	}

}
