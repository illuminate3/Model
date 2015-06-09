<?php

namespace Illuminate3\Model\Subscriber;

use Illuminate\Events\Dispatcher as Events;
use Illuminate3\Model\ModelBuilder;
use App, Artisan;

class SyncWithDatabase
{
	/**
	 *
	 * Let's have the ModelBuilder interact with the FormBuilder.
	 *
	 * @param Events $events
	 */
	public function subscribe(Events $events)
	{
		$events->listen('modelbuilder.build', array($this, 'onBuild'));
	}

	/**
	 * @param ModelBuilder $mb
	 */
	public function onBuild(ModelBuilder $mb)
	{
		$generator = App::make('Illuminate3\Model\MigrationGenerator');
		$generator->setModelBuilder($mb);
		$generator->generateFile();

		Artisan::call('migrate');
	}


}