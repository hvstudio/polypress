<?php

namespace App\Presenters;

use App\Forms\SignFormFactory;
use Nette;


/**
 * Sign in/out presenters.
 */
class SignPresenter extends BasePresenter
{

	/** @var SignFormFactory @inject */
	public $factory;


	public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('You have been signed out.');
		$this->redirect('in');
	}


	/**
	 * Sign-in form factory.
	 *
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignInForm()
	{
		$form = $this->factory->create();
		$form->onSuccess[] = function ($form) {
			$form->getPresenter()->redirect('Homepage:');
		};

		return $form;
	}

}
