<?php
namespace PhpBenchmarksPhalcon\RestApi\models;
/**
 * Shadow Commenttype with array conversion
 * Inspired by phpbenchmarks/code-igniter-common
 */
use PhpBenchmarksRestData\CommentType;
use PhpBenchmarksPhalcon\RestApi\services\Translator;

class ShadowCommentType extends CommentType{
	private $translator;
	
	public function __construct($entity,Translator $translator){
		$this->translator=$translator;
		if ( ! empty($entity)){
			$this->id=$entity->getId();
			$this->name=$entity->getName();
		}
	}

	public function toArray(){
		return [
				'id' => $this->id,
				'name' => $this->name,
				'translated' => $this->translator->trans('translated.3000'),
		];
	}

}
