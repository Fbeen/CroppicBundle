<?php

namespace Fbeen\CroppicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Crop
 */
class Crop
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    private $imgUrl;

    /**
     * @var integer
     * @Assert\Type(type="integer")
     */
    private $imgInitW;

    /**
     * @var integer
     * @Assert\Type(type="integer")
     */
    private $imgInitH;

    /**
     * @var integer
     * @Assert\Type(type="integer")
     */
    private $imgW;

    /**
     * @var integer
     * @Assert\Type(type="integer")
     */
    private $imgH;

    /**
     * @var integer
     * @Assert\Type(type="integer")
     */
    private $imgX1;

    /**
     * @var integer
     * @Assert\Type(type="integer")
     */
    private $imgY1;

    /**
     * @var integer
     * @Assert\Type(type="integer")
     */
    private $cropW;

    /**
     * @var integer
     * @Assert\Type(type="integer")
     */
    private $cropH;

    /**
     * @var integer
     * @Assert\Type(type="integer")
     */
    private $rotation;


    /**
     * Set imgUrl
     *
     * @param string $imgUrl
     *
     * @return Crop
     */
    public function setImgUrl($imgUrl)
    {
        $this->imgUrl = $imgUrl;

        return $this;
    }

    /**
     * Get imgUrl
     *
     * @return string
     */
    public function getImgUrl()
    {
        return $this->imgUrl;
    }

    /**
     * Set imgInitW
     *
     * @param integer $imgInitW
     *
     * @return Crop
     */
    public function setImgInitW($imgInitW)
    {
        $this->imgInitW = $imgInitW;

        return $this;
    }

    /**
     * Get imgInitW
     *
     * @return integer
     */
    public function getImgInitW()
    {
        return $this->imgInitW;
    }

    /**
     * Set imgInitH
     *
     * @param integer $imgInitH
     *
     * @return Crop
     */
    public function setImgInitH($imgInitH)
    {
        $this->imgInitH = $imgInitH;

        return $this;
    }

    /**
     * Get imgInitH
     *
     * @return integer
     */
    public function getImgInitH()
    {
        return $this->imgInitH;
    }

    /**
     * Set imgW
     *
     * @param integer $imgW
     *
     * @return Crop
     */
    public function setImgW($imgW)
    {
        $this->imgW = $imgW;

        return $this;
    }

    /**
     * Get imgW
     *
     * @return integer
     */
    public function getImgW()
    {
        return $this->imgW;
    }

    /**
     * Set imgH
     *
     * @param integer $imgH
     *
     * @return Crop
     */
    public function setImgH($imgH)
    {
        $this->imgH = $imgH;

        return $this;
    }

    /**
     * Get imgH
     *
     * @return integer
     */
    public function getImgH()
    {
        return $this->imgH;
    }

    /**
     * Set imgX1
     *
     * @param integer $imgX1
     *
     * @return Crop
     */
    public function setImgX1($imgX1)
    {
        $this->imgX1 = $imgX1;

        return $this;
    }

    /**
     * Get imgX1
     *
     * @return integer
     */
    public function getImgX1()
    {
        return $this->imgX1;
    }

    /**
     * Set imgY1
     *
     * @param integer $imgY1
     *
     * @return Crop
     */
    public function setImgY1($imgY1)
    {
        $this->imgY1 = $imgY1;

        return $this;
    }

    /**
     * Get imgY1
     *
     * @return integer
     */
    public function getImgY1()
    {
        return $this->imgY1;
    }

    /**
     * Set cropW
     *
     * @param integer $cropW
     *
     * @return Crop
     */
    public function setCropW($cropW)
    {
        $this->cropW = $cropW;

        return $this;
    }

    /**
     * Get cropW
     *
     * @return integer
     */
    public function getCropW()
    {
        return $this->cropW;
    }

    /**
     * Set cropH
     *
     * @param integer $cropH
     *
     * @return Crop
     */
    public function setCropH($cropH)
    {
        $this->cropH = $cropH;

        return $this;
    }

    /**
     * Get cropH
     *
     * @return integer
     */
    public function getCropH()
    {
        return $this->cropH;
    }

    /**
     * Set rotation
     *
     * @param integer $rotation
     *
     * @return Crop
     */
    public function setRotation($rotation)
    {
        $this->rotation = $rotation;

        return $this;
    }

    /**
     * Get rotation
     *
     * @return integer
     */
    public function getRotation()
    {
        return $this->rotation;
    }
}

