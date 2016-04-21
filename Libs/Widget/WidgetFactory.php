<?php

namespace Libs;

use Nette\DI\Container;
use Nette\Object;

class WidgetFactory extends Object
{

	/** @var Container */
	private $container;


	public function __construct(Container $container)
	{
		$this->container = $container;
	}


	public function createWidget(Haul $haul)
	{
		$widgetName = $haul->getWidget()->getFactory();

		return $this->container->createInstance($widgetName, array("haul" => $haul));
	}

}