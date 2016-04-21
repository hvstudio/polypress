<?php

namespace Libs;

use Brabijan\SeoComponents\DI\ITargetProvider;
use Brabijan\SeoComponents\Router\Target;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Kdyby\Doctrine\Entities\BaseEntity;
use Librette\Doctrine\Sortable\ISortable;
use Librette\Doctrine\Sortable\TSortable;

/**
 * @ORM\Entity
 * @ORM\Table(name="categories")
 */
class Category extends BaseEntity implements ISortable, ITargetProvider
{

	use TSortable;

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $name;

	/**
	 * @ORM\Column(type="string", length=1000, nullable=true)
	 */
	protected $description;

	/**
	 * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
	 * @ORM\JoinColumn(name="parent", referencedColumnName="id")
	 */
	protected $parent;

	/**
	 * @ORM\OneToMany(targetEntity="Category", mappedBy="parent", orphanRemoval=true, cascade={"persist", "remove"})
	 */
	protected $children;


	public function __construct()
	{
		$this->children = new ArrayCollection();
	}


	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}


	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}


	/**
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}


	/**
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}


	/**
	 * @param string $description
	 */
	public function setDescription($description)
	{
		$this->description = $description;
	}


	/**
	 * @return Category
	 */
	public function getParent()
	{
		return $this->parent;
	}


	/**
	 * @param Category $parent
	 */
	public function setParent($parent)
	{
		$this->parent = $parent;
	}


	/**
	 * @return ArrayCollection
	 */
	public function getChildren()
	{
		return $this->children;
	}


	/**
	 * @param Category $child
	 */
	public function addChildren(Category $child)
	{
		$this->children[] = $child;
		$child->setParent($this);
	}


	public function hasChild($child, $recursive = TRUE)
	{
		return $child->hasParent($this, $recursive);
	}


	public function hasParent($parent, $recursive = TRUE)
	{
		return $this->parent === $parent || ($recursive && $this->parent && $this->parent->hasParent($parent));
	}


	/**
	 * @return array
	 */
	public function toArray()
	{
		return [
			'name' => $this->name,
			'parent' => ($this->parent !== NULL) ? $this->parent->getId() : NULL,
			'description' => $this->description,
		];
	}


	/**
	 * @return Target
	 */
	public function getTarget()
	{
		return new Target("Front:Category", "default", $this->id);
	}

}
