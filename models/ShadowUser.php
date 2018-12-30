<?php
namespace PhpBenchmarksPhalcon\RestApi\models;
/**
 * Shadow User with array conversion and translations
 */
use PhpBenchmarksRestData\User;
use PhpBenchmarksPhalcon\RestApi\services\Translator;

class ShadowUser extends User{
	private $translator;
	
	public function __construct($entity = null,Translator $translator=null){
		$this->translator=$translator;
		if ( ! empty($entity)){
			$this->setId($entity->getId());
			$this->setLogin($entity->getLogin());
			$this->setCreatedAt($entity->getCreatedAt());
			foreach ($entity->getComments() as $comment)
				$this->addComment($comment);
		}
	}

	public function toArray(){
		$comments = [];
		foreach ($this->getComments() as $comment){
			$shadow = new ShadowComment($comment,$this->translator);
			$comments[] = $shadow->toArray();
		}
		$result = [
			'id'		 => $this->getId(),
			'login'		 => $this->getLogin(),
			'createdAt'	 => $this->getCreatedAt()->format('Y-m-d H:i:s'),
			'translated' => $this->translator->trans('translated.1000'),
			'comments'	 => $comments
		];
		return $result;
	}

}
