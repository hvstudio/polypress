<?php

namespace Libs;


use Kdyby\Doctrine\EntityManager;
use Nette\Http\FileUpload;
use Nette\Object;
use Nette\Utils\FileSystem;

class ImageStorage extends Object
{

	private $www, $path;
	/** @var EntityManager */
	private $em;

	/**
	 * @param EntityManager $em
	 * @param               $www
	 * @param               $path
	 */
	public function __construct(EntityManager $em, $www, $path)
	{
		$this->www = $www;
		$this->path = $path;
		$this->em = $em;
		FileSystem::createDir($www . '/' . $path);
	}

	/**
	 * @param FileUpload $tmp
	 * @return Image
	 */
	public function save(FileUpload $tmp)
	{
		if ($tmp->isOk() && $tmp->isImage()) {
			$imageSize = $tmp->getImageSize();
			$image = new Image;
			$image->setCreatedAt(new \DateTime());
			$image->setName(uniqid());
			$image->setPath($this->path . '/' . $image->getName());
			$image->setOriginalName($tmp->getName());
			$image->setFileSize($tmp->getSize());
			$image->setWidth($imageSize[0]);
			$image->setHeight($imageSize[1]);
			$image->setMime($tmp->getContentType());
		}
		$tmp->move($this->www . '/' . $image->getPath());
		$this->em->persist($image)
			->flush();

		return $image;
	}

}
