<?php

namespace Libs;

use Doctrine\ORM\Query;
use Kdyby\Doctrine\EntityManager;
use Kdyby\Doctrine\EntityRepository;
use Nette\Object;

/**
 * Class WidgetRepository
 * @package Libs
 */
class WidgetRepository extends Object
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
	 * @return mixed|null|Widget
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
		return $this->em->getRepository(Widget::class);
	}
}
