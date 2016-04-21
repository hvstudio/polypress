<?php

namespace App\Presenters;

use Nette;


/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{

	public function renderDefault()
	{
		$this->setTheme('Default');
	}

}
