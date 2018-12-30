<?php
namespace PhpBenchmarksPhalcon\RestApi\services;

use Phalcon\Translate\Adapter\NativeArray;

/**
 * A translator class for Phalcon benchmarks
 * @author jc
 */
class Translator {
	
	const TRANSLATION_DIR = __DIR__ ."/../translations/";
	
	private $locale;
	private $fallbackLocale;
	private $catalog;
	
	/**
	 * @param string $locale
	 * @param string $fallbackLocale
	 */
	public function __construct($locale,$fallbackLocale){
		$this->Locale=$locale;
		$this->fallbackLocale=$fallbackLocale;
	}
	
	private function getDir($locale){
		return self::TRANSLATION_DIR. $locale. '/phpbenchmarks.php';
	}
	
	private function loadCatalog(){
		$messages = [];
		$file=$this->getDir($this->locale);
		if (!file_exists($file)) {
			$file=$this->getDir($this->fallbackLocale);
		}
		if(file_exists($file)){
			$messages= include $file;
		}
		return new NativeArray(['content' => $messages]);
	}
	
	/**
	 * @return \Phalcon\Translate\Adapter\NativeArray
	 */
	public function getCatalog(){
		if(!isset($this->catalog)){
			$this->catalog=$this->loadCatalog();
		}
		return $this->catalog;
	}
	
	/**
	 * @param string $locale
	 */
	public function setLocale($locale) {
		$this->assertValidLocale($locale);
		$this->locale = $locale;
		$this->catalog=null;
		if (class_exists('Locale', false)) {
			\Locale::setDefault($locale);
		}
	}
	
	protected function assertValidLocale($locale){
		if (1 !== preg_match('/^[a-z0-9@_\\.\\-]*$/i', $locale)) {
			throw new \InvalidArgumentException(sprintf('Invalid "%s" locale.', $locale));
		}
	}

	/**
	 * @param string $fallbackLocale
	 */
	public function setFallbackLocale(string $fallbackLocale) {
		$this->fallbackLocale = $fallbackLocale;
	}

	/**
	 * Returns the translation string of the given key
	 * @param string $translateKey
	 * @param array $placeholders
	 * @return string
	 */
	public function trans(string $translateKey, array $placeholders=null){
		return $this->getCatalog()->t($translateKey,$placeholders);
	}
	
	
}

