<?php

namespace Libs\Security;

use Kdyby\Doctrine\EntityManager;
use Kdyby\Doctrine\EntityRepository;
use Nette\Security\Passwords;

/**
 * Class UserManager
 * @package Libs\Security
 */
class UserManager
{
	/** @var EntityManager */
	private $em;
	/** @var EntityRepository */
	private $users;

	/**
	 * @param EntityManager $em
	 */
	public function __construct(EntityManager $em)
	{
		$this->em = $em;
		$this->users = $em->getRepository(User::class);
	}

	public function add($username, $password)
	{
		$user = new User;
		$user->setUsername($username);
		$user->setPassword(Passwords::hash($password));

		$this->em->persist($user)
			->flush();
	}

}
