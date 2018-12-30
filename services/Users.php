<?php
namespace PhpBenchmarksPhalcon\RestApi\services;

use PhpBenchmarksRestData\Service;
use PhpBenchmarksPhalcon\RestApi\models\ShadowUser;
use Phalcon\DiInterface;

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
	public function serialize(DiInterface $di){
		$translator=$di->get("translator");
		return $this->convert($this->users,$translator);
	}

	/**
	 * Convert an array of User
	 * into an array.
	 * 
	 * @param array $objects
	 * @return array 
	 */
	private function convert(array $objects,Translator $translator){
		$result = [];
			foreach ($objects as $entity){
				$user = new ShadowUser($entity,$translator);
				$result[] = $user->toArray();
			}
		return $result;
	}

}
