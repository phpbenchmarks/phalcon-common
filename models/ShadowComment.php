<?php
namespace PhpBenchmarksPhalcon\RestApi\models;
/**
 * Shadow User with array conversion
 * Inspired by phpbenchmarks/code-igniter-common
 */
use PhpBenchmarksRestData\Comment;
use PhpBenchmarksPhalcon\RestApi\services\Translator;

class ShadowComment extends Comment{
	private $translator;
	public function __construct($entity,Translator $translator){
		$this->translator=$translator;
		if ( ! empty($entity))
		{
			$this->id=$entity->getId();
			$this->message=$entity->getMessage();
			$this->type=$entity->getType();
		}
	}

	public function toArray(){
		$type = new ShadowCommentType($this->getType(),$this->translator);
		$result = [
			'id'		 => $this->id,
			'message'	 => $this->message,
			'translated' => $this->translator->trans('translated.2000'),
			'type'		 => $type->toArray()
		];
		return $result;
	}

}
