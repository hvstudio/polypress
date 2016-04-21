<?php
/**
 * Created by PhpStorm.
 * User: northys
 * Date: 21.2.15
 * Time: 16:55
 */

namespace Libs;


use Brabijan\SeoComponents\DI\ITargetSectionProvider;
use Brabijan\SeoComponents\TargetSection;
use Doctrine\ORM\Query;
use Kdyby\Doctrine\EntityManager;
use Nette\Object;

class CategoryRepository extends Object implements ITargetSectionProvider
{

	/** @var EntityManager */
	private $em;

	/** @var OptionRepository */
	private $optionRepository;


	/**
	 * @param EntityManager $em
	 * @param OptionRepository $optionRepository
	 */
	public function __construct(EntityManager $em, OptionRepository $optionRepository)
	{
		$this->em = $em;
		$this->optionRepository = $optionRepository;
	}


	/**
	 * @param bool $includeRoot
	 * @return array
	 */
	public function getNames($includeRoot = TRUE)
	{
		$return = [];
		$repository = $this->getRepository();
		$categories = $repository->createQueryBuilder('c')
			->select('c.id, c.name')
			->orderBy('c.name', 'ASC')
			->getQuery()
			->getResult();
		if ($includeRoot) {
			$return['root'] = $this->optionRepository->getByName('site_name');
		}
		foreach ($categories as $category) {
			$return[$category['id']] = $category['name'];
		}

		return $return;
	}


	/**
	 * @return array
	 */
	public function getTree()
	{
		$repository = $this->getRepository();

		return $repository->findBy(['parent' => NULL], ['position' => 'ASC']);
	}


	/**
	 * @param $id
	 * @return array
	 */
	public function getTreeFromId($id)
	{
		$repository = $this->getRepository();

		return $repository->findBy(['parent' => $id]);
	}


	/**
	 * @param $id
	 * @return mixed|null|object
	 */
	public function getById($id)
	{
		$repository = $this->getRepository();

		return $repository->findOneBy(['id' => $id]);
	}


	/**
	 * @return \Kdyby\Doctrine\EntityRepository
	 */
	public function getRepository()
	{
		return $this->em->getRepository(Category::class);
	}


	/**
	 * @return TargetSection
	 */
	public function getTargetSection()
	{
		$targetSection = new TargetSection('Categories');
		/** @var Category $category */
		foreach ($this->getRepository()->findAll() as $category) {
			$targetSection->addTarget($category->getName(), $category->getTarget());
		}

		return $targetSection;
	}

}
