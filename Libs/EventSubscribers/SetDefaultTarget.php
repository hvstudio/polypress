<?php

namespace Libs\EventSubscribers;

use Libs\OptionRepository;
use Brabijan\SeoComponents\Entity\Target;
use Brabijan\SeoComponents\Router\DbRouter;
use Doctrine\ORM\NoResultException;
use Kdyby\Doctrine\EntityManager;
use Kdyby\Events\Subscriber;
use Nette\Application\Application;
use Nette\DI\Container;
use Nette\Object;

class SetDefaultTarget extends Object implements Subscriber
{

	/** @var OptionRepository */
	private $optionRepository;

	/** @var DbRouter */
	private $dbRouter;

	/** @var EntityManager */
	private $entityManager;


	public function __construct(OptionRepository $optionRepository, Container $container, EntityManager $entityManager)
	{
		$this->optionRepository = $optionRepository;
		$this->dbRouter = $container->getService($container->findByType(DbRouter::class)[0]); // hack because non-autowired DbRouter class
		$this->entityManager = $entityManager;
	}


	/**
	 * Returns an array of events this subscriber wants to listen to.
	 *
	 * @return array
	 */
	public function getSubscribedEvents()
	{
		return array(
			'Nette\Application\Application::onStartup' => 'setDefaultTarget',
		);
	}


	public function setDefaultTarget(Application $application)
	{
		$defaultTargetId = $this->optionRepository->getByName("defaultTarget");

		// is there default target?
		$qb = $this->entityManager->getRepository(Target::class)->createQueryBuilder("t");
		$qb->where("t.id = :id")->setParameter("id", $defaultTargetId);
		try {
			/** @var Target $defaultTarget */
			$defaultTarget = $qb->getQuery()->getSingleResult();
			$this->dbRouter->setDefaultRoute($defaultTarget->targetPresenter, $defaultTarget->targetAction,
				$defaultTarget->targetId);
			return;
		} catch (NoResultException $e) {
		}

		// set to first target
		$qb = $this->entityManager->getRepository(Target::class)->createQueryBuilder("t");
		$qb->orderBy("t.id", "ASC");
		$qb->setMaxResults(1);
		try {
			/** @var Target $defaultTarget */
			$defaultTarget = $qb->getQuery()->getSingleResult();
			$this->dbRouter->setDefaultRoute($defaultTarget->targetPresenter, $defaultTarget->targetAction,
				$defaultTarget->targetId);
			return;
		} catch (NoResultException $e) {
		}
	}

}