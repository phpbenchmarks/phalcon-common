<?php
namespace PhpBenchmarksPhalcon\RestApi\models;
/**
 * Shadow User with array conversion
 */
use PhpBenchmarksRestData\CommentType;
use PhpBenchmarksPhalcon\RestApi\services\Translator;

class ShadowCommentType extends CommentType{
	private $translator;
	
	public function __construct($entity = null,Translator $translator=null){
		$this->translator=$translator;
		if ( ! empty($entity)){
			$this->setId($entity->getId());
			$this->setName($entity->getName());
		}
	}

	public function toArray(){
		return [
				'id' => $this->getId(),
				'name' => $this->getName(),
				'translated' => $this->translator->trans('translated.3000'),
		];
	}

}
