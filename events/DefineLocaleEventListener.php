<?php

namespace PhpBenchmarksPhalcon\RestApi\events;


use Phalcon\Events\Event;

/**
 * EventListener
 * randomly changes the locale
 * @author jc
 *
 */
class DefineLocaleEventListener {

	const EVENT_NAME = 'defineLocale';
		
	public function onLocaleChange(Event $event,$translator){
			$locales = ['fr_FR', 'en_GB', 'aa_BB'];
			$locale = $locales[rand(0, 2)];
			$translator->setLocale($locale);
		}
}

