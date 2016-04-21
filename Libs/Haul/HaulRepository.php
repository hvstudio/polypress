<?php

namespace Libs;

use Doctrine\ORM\Query;
use Kdyby\Doctrine\EntityManager;
use Kdyby\Doctrine\EntityRepository;
use Nette\Object;

class HaulRepository extends Object
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
	public function getHauls()
	{
		$repository = $this->getRepository();

		return $repository->findAll();
	}

	/**
	 * @param $id
	 * @return mixed|null|Haul
	 */
	public function getById($id)
	{
		$repository = $this->getRepository();

		return $repository->findOneBy(['id' => $id]);
	}

	/**
	 * @return EntityRepository
	 */
	public function getRepository()
	{
		return $this->em->getRepository(Haul::class);
	}
}
