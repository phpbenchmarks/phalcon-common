<?php
namespace PhpBenchmarksPhalcon\RestApi\models;
/**
 * Shadow User with array conversion
 */
use PhpBenchmarksRestData\CommentType;

class ShadowCommentType extends CommentType
{

	public function __construct($entity = null)
	{
		if ( ! empty($entity))
		{
			$this->setId($entity->getId());
			$this->setName($entity->getName());
		}
	}

	public function toArray()
	{
		return get_object_vars($this);
	}

}
