<?php


namespace App\Commands;


use Libs\Security\Facade\UserFacade;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CreateUser extends Command
{

	protected function configure()
	{
		$this->setName('app:create-user')
			->setDescription('Creates new user');
	}


	protected function execute(InputInterface $input, OutputInterface $output)
	{

		/** @var QuestionHelper $questionHelper */
		$questionHelper = $this->getHelper('question');

		$usernameQuestion = new Question('Username: ');
		$usernameQuestion->setValidator(function ($value) {
			if (trim($value) == '') {
				throw new \Exception('The username can not be empty');
			}

			return $value;
		});

		$passwordQuestion = new Question('Password: ');

		$passwordQuestion->setValidator(function ($value) {
			if (trim($value) == '') {
				throw new \Exception('The password can not be empty');
			}

			return $value;
		});

		$passwordQuestion->setHidden(TRUE);
		$passwordQuestion->setHiddenFallback(FALSE);

		$username = $questionHelper->ask($input, $output, $usernameQuestion);
		$password = $questionHelper->ask($input, $output, $passwordQuestion);

		$name = $questionHelper->ask($input, $output, new Question('Name: '));

		/** @var \Libs\Security\Facade\UserFacade $users */
		$users = $this->getHelper('container')->getByType('Libs\Security\Facade\Users');

		$user = $users->add($username, $password, $name);

		$output->writeln('User ' . $user->getUsername() . ' was successfully created!');

	}
}
