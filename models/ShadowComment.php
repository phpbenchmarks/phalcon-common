<?php
namespace PhpBenchmarksPhalcon\RestApi\models;
/**
 * Shadow User with array conversion
 */
use PhpBenchmarksRestData\Comment;

class ShadowComment extends Comment
{

	public function __construct($entity = null)
	{
		if ( ! empty($entity))
		{
			$this->setId($entity->getId());
			$this->setMessage($entity->getMessage());
			$this->setType($entity->getType());
		}
	}

	public function toArray()
	{
		$type = new ShadowCommentType($this->getType());
		$result = [
			'id'		 => $this->getId(),
			'message'	 => $this->getMessage(),
			'type'		 => $type->toArray()
		];
		return $result;
	}

}
