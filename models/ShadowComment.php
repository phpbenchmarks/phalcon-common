<?php
namespace PhpBenchmarksPhalcon\RestApi\models;
/**
 * Shadow User with array conversion
 */
use PhpBenchmarksRestData\Comment;
use PhpBenchmarksPhalcon\RestApi\services\Translator;

class ShadowComment extends Comment{
	private $translator;
	public function __construct($entity = null,Translator $translator=null){
		$this->translator=$translator;
		if ( ! empty($entity))
		{
			$this->setId($entity->getId());
			$this->setMessage($entity->getMessage());
			$this->setType($entity->getType());
		}
	}

	public function toArray(){
		$type = new ShadowCommentType($this->getType(),$this->translator);
		$result = [
			'id'		 => $this->getId(),
			'message'	 => $this->getMessage(),
			'translated' => $this->translator->trans('translated.2000'),
			'type'		 => $type->toArray()
		];
		return $result;
	}

}
