<?php

namespace Libs;

use Doctrine\ORM\Mapping as ORM;
use Kdyby\Doctrine\Entities\Attributes\Identifier;
use Kdyby\Doctrine\Entities\BaseEntity;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use Librette\Doctrine\Sortable\ISortable;
use Librette\Doctrine\Sortable\TSortable;

/**
 * @ORM\Entity
 */
class Haul extends BaseEntity implements ISortable
{
	use Identifier;
	use Timestampable;
	use TSortable;

	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	protected $name;

	/**
	 * @var Widget
	 * @ORM\ManyToOne(targetEntity="Hook", inversedBy="haul")
	 * @ORM\JoinColumn(name="hook_id", referencedColumnName="id")
	 **/
	protected $hook;


	/**
	 * @var array
	 * @ORM\Column(type="array", nullable=true)
	 */
	protected $options;

	/**
	 * @var Widget
	 * @ORM\ManyToOne(targetEntity="Widget", inversedBy="widget_instances")
	 * @ORM\JoinColumn(name="widget_id", referencedColumnName="id")
	 **/
	protected $widget;

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
	 * @return Widget
	 */
	public function getHook()
	{
		return $this->hook;
	}

	/**
	 * @param Widget $hook
	 */
	public function setHook($hook)
	{
		$this->hook = $hook;
	}

	/**
	 * @return array
	 */
	public function getOptions()
	{
		return $this->options;
	}

	/**
	 * @param array $options
	 */
	public function setOptions($options)
	{
		$this->options = $options;
	}

	/**
	 * @return Widget
	 */
	public function getWidget()
	{
		return $this->widget;
	}

	/**
	 * @param Widget $widget
	 */
	public function setWidget($widget)
	{
		$this->widget = $widget;
	}

	/**
	 * @return array
	 */
	public function toArray()
	{
		/** TODO tohle je dočasné */
		return $this->getOptions();
	}
}
