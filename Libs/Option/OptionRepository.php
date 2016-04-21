<?php

namespace Libs;

use Doctrine\ORM\Query;
use Kdyby\Doctrine\EntityManager;
use Nette\Object;

class OptionRepository extends Object
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
	 * @param $options
	 * @return EntityManager
	 */
	public function update($options)
	{
		$repository = $this->getRepository();
		foreach ($options as $name => $value) {
			$option = $repository->findOneBy(['name' => $name]);
			if (!$option instanceof Option) {
				$option = new Option;
				$option->setName($name);
			}
			$option->setValue($value);
			$this->em->persist($option);
		}

		return $this->em->flush();
	}

	/**
	 * @return array
	 */
	public function getAll()
	{
		$repository = $this->getRepository();
		$options = [];
		foreach ($repository->findAll() as $option) {
			$options[$option->name] = $option->value;
		}

		return $options;
	}

	/**
	 * @return array
	 */
	public function getByName($name)
	{
		//dump($name);
		$repository = $this->getRepository();
		$option = $repository->findOneBy(['name' => $name]);

		return $option ? $option->getValue() : NULL;
	}

	/**
	 * @return \Kdyby\Doctrine\EntityRepository
	 */
	public function getRepository()
	{
		return $this->em->getRepository(Option::class);
	}
}
