<?php

namespace Libs;

use Doctrine\ORM\Mapping as ORM;
use Kdyby\Doctrine\Entities\BaseEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="images")
 */
class Image extends BaseEntity
{
	/**
	 * @var int
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue
	 */
	protected $id;

	/**
	 * @var string
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $name;

	/**
	 * @var string
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $originalName;

	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	protected $path;

	/**
	 * @var string
	 * @ORM\Column(type="text", nullable=true)
	 */
	protected $description;

	/**
	 * @var \DateTime
	 * @ORM\Column(type="datetime")
	 */
	protected $createdAt;

	/**
	 * @var int
	 * @ORM\Column(type="integer")
	 */
	protected $width;

	/**
	 * @var int
	 * @ORM\Column(type="integer")
	 */
	protected $height;

	/**
	 * @var int
	 * @ORM\Column(type="integer")
	 */
	protected $fileSize;

	/**
	 * @var string
	 * @ORM\Column(type="string")
	 */
	protected $mime;

	/**
	 * @return string
	 */
	public function getOriginalName()
	{
		return $this->originalName;
	}

	/**
	 * @param string $originalName
	 */
	public function setOriginalName($originalName)
	{
		$this->originalName = $originalName;
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
	 * @return int
	 */
	public function getWidth()
	{
		return $this->width;
	}

	/**
	 * @param int $width
	 */
	public function setWidth($width)
	{
		$this->width = $width;
	}

	/**
	 * @return int
	 */
	public function getHeight()
	{
		return $this->height;
	}

	/**
	 * @param int $height
	 */
	public function setHeight($height)
	{
		$this->height = $height;
	}

	/**
	 * @return int
	 */
	public function getFileSize()
	{
		return $this->fileSize;
	}

	/**
	 * @param int $fileSize
	 */
	public function setFileSize($fileSize)
	{
		$this->fileSize = $fileSize;
	}

	/**
	 * @return string
	 */
	public function getMime()
	{
		return $this->mime;
	}

	/**
	 * @param string $mime
	 */
	public function setMime($mime)
	{
		$this->mime = $mime;
	}

	/**
	 * @return mixed
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
	public function getPath()
	{
		return $this->path;
	}

	/**
	 * @param string $path
	 */
	public function setPath($path)
	{
		$this->path = $path;
	}

}
