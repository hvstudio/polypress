<?php

namespace Libs\Security;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Nette\Object;
use Nette\Security\AuthenticationException;
use Nette\Security\IAuthenticator;
use Nette\Security\Passwords;

/**
 * Class Authenticator
 * @package App\Model\Security
 */
class Authenticator extends Object implements IAuthenticator
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

	/**
	 * @param array $credentials
	 * @return null|User
	 * @throws AuthenticationException
	 */
	public function authenticate(array $credentials)
	{
		list($username, $password) = $credentials;

		$user = $this->users->findOneBy(['username' => $username]);

		if (!$user) {
			throw new AuthenticationException('The username is incorrect.', self::IDENTITY_NOT_FOUND);

		} elseif (!Passwords::verify($password, $user->password)) {
			throw new AuthenticationException('The password is incorrect.', self::INVALID_CREDENTIAL);

		} elseif (Passwords::needsRehash($user->password)) {
			$user->setPassword(Passwords::hash($password));
			$this->em->persist($username)
				->flush();
		}

		return $user;
	}
}
