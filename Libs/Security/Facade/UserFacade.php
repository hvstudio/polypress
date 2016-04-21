<?php

namespace Libs\Security\Facade;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Nette\Security\Passwords;

/**
 * Class UserManager
 *
 * @package App\Model\Security
 */
class UserFacade
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
		$this->users = $em->getRepository(\Libs\Security\Entity\User::getClassName());
	}


	/**
	 * @param $username
	 * @param $password
	 * @param string $name
	 *
	 * @return \Libs\Security\Entity\User
	 */
	public function add($username, $password, $name = 'Anonymous')
	{
		$user = new \Libs\Security\Entity\User;
		$user->setUsername($username);
		$user->setPassword(Passwords::hash($password));
		$user->setName($name);

		$this->em->persist($user);
		$this->em->flush();

		return $user;
	}

}
