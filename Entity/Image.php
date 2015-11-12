<?php

namespace Fbeen\CroppicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Image
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Image
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="originalname", type="string", length=255)
     */
    private $originalname;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=32, nullable=true)
     */
    private $type;

    /**
     * @Assert\File(
     *     maxSize="6000000",
     *     mimeTypes = {"image/png", "image/gif", "image/jpeg", "image/jpg"},
     * )
     */
    private $img;
    
    public function __toString()
    {
        return $this->filename;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set filename
     *
     * @param string $filename
     *
     * @return Image
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set originalname
     *
     * @param string $originalname
     *
     * @return Image
     */
    public function setOriginalname($originalname)
    {
        $this->originalname = $originalname;

        return $this;
    }

    /**
     * Get originalname
     *
     * @return string
     */
    public function getOriginalname()
    {
        return $this->originalname;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Image
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets image file.
     *
     * @param UploadedFile $img
     */
    public function setImg(UploadedFile $img = null)
    {
        $this->img = $img;
    }

    /**
     * Get image file.
     *
     * @return UploadedFile
     */
    public function getImg()
    {
        return $this->img;
    }
}
