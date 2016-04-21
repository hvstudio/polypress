<?php

namespace Libs;

use Doctrine\ORM\Mapping as ORM;
use Kdyby\Doctrine\Entities\BaseEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="widgets")
 */
class Widget extends BaseEntity
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $icon;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $name;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $code;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $description;

	/**
	 * @var array
	 * @ORM\COlumn(type="array")
	 */
	protected $globalOptions = [];

	/**
	 * @ORM\Column(type="string")
	 */
	protected $factory;


	/**
	 * @ORM\OneToMany(targetEntity="Haul", mappedBy="widget")
	 **/
	protected $hauls;

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
	public function getCode()
	{
		return $this->code;
	}

	/**
	 * @param string $code
	 */
	public function setCode($code)
	{
		$this->code = $code;
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
	 * @return string
	 */
	public function getFactory()
	{
		return $this->factory;
	}

	/**
	 * @param string $factory
	 */
	public function setFactory($factory)
	{
		$this->factory = $factory;
	}

	/**
	 * @return mixed
	 */
	public function getWidgets()
	{
		return $this->widgets;
	}

	/**
	 * @param mixed $widgets
	 */
	public function setWidgets($widgets)
	{
		$this->widgets = $widgets;
	}

	/**
	 * @return array
	 */
	public function toArray()
	{
		return [
			'id' => $this->id,
			'name' => $this->name,
			'description' => $this->description,
			'factory' => $this->factory,
			'class' => $this->class,
		];
	}


}
