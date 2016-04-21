<?php

namespace App\Presenters;

use Kdyby\Autowired\AutowireComponentFactories;
use Kdyby\Autowired\AutowireProperties;
use Nette;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{



	use AutowireComponentFactories, AutowireProperties;


	/**
	 * @var string
	 */
	public $theme = 'Default';


	/**
	 * @param $name
	 */
	public function setTheme($name) {
		$this->theme = $name;
	}
	
	
	/** @return CssLoader */
	protected function createComponentCss()
	{
		return $this->webLoader->createCssLoader($this->theme);
	}


	/** @return JavaScriptLoader */
	protected function createComponentJs()
	{
		return $this->webLoader->createJavaScriptLoader($this->theme);
	}

	/**
	 * Formats layout template file names.
	 * @return array
	 */
	public function formatLayoutTemplateFiles()
	{
		$name = $this->getName();
		//$module = preg_replace("#:?[a-zA-Z_0-9]+$#", "", $name);
		$presenter = substr($name, strrpos(':' . $name, ':'));
		$layout = $this->layout ? $this->layout : 'layout';
		return array(
			APP_DIR . "/Templates/$this->theme/$presenter/@layout.latte",
			APP_DIR . "/Templates/$this->theme/@$layout.latte"
		);
	}

	/**
	 * Formats view template file names.
	 * @return array
	 */
	public function formatTemplateFiles()
	{

		$name = $this->getName();
		//$module = preg_replace("#:?[a-zA-Z_0-9]+$#", "", $name);
		$presenter = substr($name, strrpos(':' . $name, ':'));
		return array(
			APP_DIR . "/Templates/$this->theme/$presenter/$this->view.latte",
		);
	}


}
