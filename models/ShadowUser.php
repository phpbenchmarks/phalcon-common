<?php
namespace PhpBenchmarksPhalcon\RestApi\models;
/**
 * Shadow User with array conversion
 */
use PhpBenchmarksRestData\User;

class ShadowUser extends User
{

	public function __construct($entity = null)
	{
		if ( ! empty($entity))
		{
			$this->setId($entity->getId());
			$this->setLogin($entity->getLogin());
			$this->setCreatedAt($entity->getCreatedAt());
			foreach ($entity->getComments() as $comment)
				$this->addComment($comment);
		}
	}

	public function toArray()
	{
		$comments = [];
		foreach ($this->getComments() as $comment)
		{
			$shadow = new ShadowComment($comment);
			$comments[] = $shadow->toArray();
		}
		$result = [
			'id'		 => $this->getId(),
			'login'		 => $this->getLogin(),
			'createdAt'	 => $this->getCreatedAt(),
			'comments'	 => $comments
		];
		return $result;
	}

}
