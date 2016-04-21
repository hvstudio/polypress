<?php

namespace Libs;

use Brabijan\SeoComponents\DI\ITargetProvider;
use Brabijan\SeoComponents\Router\Target;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Kdyby\Doctrine\Entities\BaseEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="hooks")
 */
class Hook extends BaseEntity implements ITargetProvider
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	protected $id;

	/**
	 * @ORM\ManyToMany(targetEntity="Category")
	 * @ORM\JoinColumn(name="id", referencedColumnName="id")
	 */
	protected $categories;

	/**
	 * @ORM\OneToOne(targetEntity="App\Model\Security\User")
	 * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
	 */
	protected $author;

	/**
	 * @ORM\Column(type="boolean")
	 */
	protected $visible;

	/**
	 * @Orm\Column(type="datetime", nullable=true)
	 */
	protected $visibleSince;

	/**
	 * @ORM\Column(type="datetime", nullable=true)
	 */
	protected $visibleTo;

	/**
	 * @ORM\Column(type="boolean")
	 */
	protected $expanded;

	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $createdAt;

	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $updatedAt;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $name;

	/**
	 * @ORM\ManyToOne(targetEntity="Image")
	 * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
	 **/
	protected $image;

	/**
	 * @ORM\Column(type="string", length=500000, nullable=true)
	 */
	protected $lede;

	/**
	 * @ORM\OneToMany(targetEntity="Haul", mappedBy="hook")
	 * @ORM\OrderBy({"position" = "ASC"})
	 */
	protected $hauls;

	public function __construct()
	{
		$this->categories = new ArrayCollection;
		$this->createdAt = new \DateTime();
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return ArrayCollection
	 */
	public function getCategories()
	{
		return $this->categories;
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
	 * @return Image
	 */
	public function getImage()
	{
		return $this->image;
	}

	/**
	 * @param Image $image
	 */
	public function setImage(Image $image)
	{
		$this->image = $image;
	}

	/**
	 * @return mixed
	 */
	public function getLede()
	{
		return $this->lede;
	}

	/**
	 * @param mixed $lede
	 */
	public function setLede($lede)
	{
		$this->lede = $lede;
	}

	/**
	 * @return mixed
	 */
	public function getVisibleSince()
	{
		return $this->visibleSince;
	}

	/**
	 * @param mixed $visibleSince
	 */
	public function setVisibleSince($visibleSince)
	{
		$this->visibleSince = $visibleSince;
	}

	/**
	 * @return mixed
	 */
	public function getVisibleTo()
	{
		return $this->visibleTo;
	}

	/**
	 * @param mixed $visibleTo
	 */
	public function setVisibleTo($visibleTo)
	{
		$this->visibleTo = $visibleTo;
	}


	/**
	 * @return boolean
	 */
	public function getVisible()
	{
		return $this->visible;
	}

	/**
	 * @param boolean $visible
	 */
	public function setVisible($visible)
	{
		$this->visible = $visible;
	}

	/**
	 * @return \DateTime
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	/**
	 * @param \DateTime $createdAt
	 */
	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;
	}

	/**
	 * @return \DateTime
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}

	/**
	 * @param \DateTime $updatedAt
	 */
	public function setUpdatedAt($updatedAt)
	{
		$this->updatedAt = $updatedAt;
	}

	public function addCategory(Category $category)
	{
		$this->categories[] = $category;
	}

	/**
	 * @return bool
	 */
	public function getExpanded()
	{
		return $this->expanded;
	}

	/**
	 * @param bool $expanded
	 */
	public function setExpanded($expanded)
	{
		$this->expanded = $expanded;
	}

	/**
	 * @return Haul[]|ArrayCollection
	 */
	public function getHauls()
	{
		return $this->hauls;
	}

	public function isVisible()
	{
		$visible = $this->visible;
		if ($visible) {
			if ($this->visibleSince <= new \DateTime) {

			}
		}

		return $visible;
	}

	public function toArray()
	{
		$categories = [];
		if ($this->categories) {
			foreach ($this->getCategories() as $category) {
				$categories[] = $category->id;
			}
		}

		return [
			'name' => $this->getName(),
			'categories' => $categories,
			'lede' => $this->getLede(),
			'visible' => $this->getVisible(),
			'visibleSince' => (is_object($this->getVisibleSince())) ? $this->getVisibleSince()
				->format('Y-m-d') : NULL,
			'visibleTo' => (is_object($this->getVisibleTo())) ? $this->getVisibleTo()
				->format('Y-m-d') : NULL,
			'expanded' => $this->getExpanded(),
		];
	}

	/**
	 * @return Target
	 */
	public function getTarget()
	{
		return new Target("Front:Hook", "default", $this->id);
	}

}
