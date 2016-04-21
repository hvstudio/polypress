<?php

namespace Libs;

use Brabijan\SeoComponents\DI\ITargetSectionProvider;
use Brabijan\SeoComponents\TargetSection;
use Doctrine\ORM\Query;
use Kdyby\Doctrine\EntityManager;
use Kdyby\Doctrine\EntityRepository;
use Nette\Object;

class HookRepository extends Object implements ITargetSectionProvider
{

	/** @var EntityManager */
	private $em;

	/**
	 * @param EntityManager $em
	 */
	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}

	/**
	 * @return array
	 */
	public function getAll()
	{
		$repository = $this->getRepository();

		return $repository->findAll();
	}

	/**
	 * @param $id
	 * @return mixed|null|Hook
	 */
	public function getById($id)
	{
		$repository = $this->getRepository();

		return $repository->findOneBy(['id' => $id]);
	}

	public function getByCategory($id)
	{
		$repository = $this->getRepository();
		$hooks = $repository->findBy(['categories.id' => [$id]], ['visibleSince' => 'DESC']);

		return $hooks;
	}

	/**
	 * @return EntityRepository
	 */
	public function getRepository()
	{
		return $this->em->getRepository(Hook::class);
	}


	/**
	 * @return TargetSection
	 */
	public function getTargetSection()
	{
		$targetSection = new TargetSection('Hooks');
		/** @var Category $hook */
		foreach ($this->getRepository()->findAll() as $hook) {
			$targetSection->addTarget($hook->getName(), $hook->getTarget());
		}

		return $targetSection;
	}

}
