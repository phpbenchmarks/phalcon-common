<?php
namespace PhpBenchmarksPhalcon\RestApi\models;
/**
 * Shadow User with array conversion and translations
 * Inspired by phpbenchmarks/code-igniter-common
 */
use PhpBenchmarksRestData\User;
use PhpBenchmarksPhalcon\RestApi\services\Translator;

class ShadowUser extends User{
	private $translator;
	
	public function __construct($entity,Translator $translator){
		$this->translator=$translator;
		if ( ! empty($entity)){
			$this->id=$entity->getId();
			$this->login=$entity->getLogin();
			$this->createdAt=$entity->getCreatedAt();
			$this->comments=$entity->getComments();
		}
	}

	public function toArray(){
		$comments = [];
		foreach ($this->comments as $comment){
			$shadow = new ShadowComment($comment,$this->translator);
			$comments[] = $shadow->toArray();
		}
		$result = [
			'id'		 => $this->id,
			'login'		 => $this->login,
			'createdAt'	 => $this->createdAt->format('Y-m-d H:i:s'),
			'translated' => $this->translator->trans('translated.1000'),
			'comments'	 => $comments
		];
		return $result;
	}

}
