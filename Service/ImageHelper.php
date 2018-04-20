<?php

namespace Fbeen\CroppicBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Fbeen\CroppicBundle\Entity\Image;
use Fbeen\CroppicBundle\Entity\Crop;

class ImageHelper
{
    private $container;
    
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    public function upload(Image $image)
    {
        // the file property can be empty if the field is not required
        if (null === $image->getImg()) {
            return;
        }
        
        $uploadDir = $this->container->getParameter('fbeen_croppic.upload.filepath') . $this->container->getParameter('fbeen_croppic.upload.original');
        
        $extension = '.' . $image->getImg()->guessExtension();
        if($extension == '.jpeg')
            $extension = '.jpg';
        
        $filename = uniqid() . $extension;

        // move takes the target directory and then the
        // target filename to move to
        $image->getImg()->move(
           $uploadDir,
           $filename
        );

        @mkdir($this->container->getParameter('fbeen_croppic.upload.filepath') . $this->container->getParameter('fbeen_croppic.upload.cropped'), 0777, TRUE);
    
        $image->setFilename($filename);
        $image->setOriginalname($image->getImg()->getClientOriginalName());
    }
    
    public function getPath($filename, $subdir)
    {
        return $this->container->getParameter('fbeen_croppic.upload.filepath') . 
                $this->container->getParameter('fbeen_croppic.upload.' . $subdir) . '/' . $filename;
    }
    
    public function getUrl($filename, $subdir)
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        
        return $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath() . $this->container->getParameter('fbeen_croppic.upload.' . $subdir) . '/' . $filename;
    }
    
    public function crop(Crop $crop)
    {
        $what = getimagesize($crop->getImgUrl());

        switch(strtolower($what['mime']))
        {
            case 'image/png':
                $img_r = imagecreatefrompng($crop->getImgUrl());
                $source_image = imagecreatefrompng($crop->getImgUrl());
                break;
            case 'image/jpeg':
                $img_r = imagecreatefromjpeg($crop->getImgUrl());
                $source_image = imagecreatefromjpeg($crop->getImgUrl());
                break;
            case 'image/gif':
                $img_r = imagecreatefromgif($crop->getImgUrl());
                $source_image = imagecreatefromgif($crop->getImgUrl());
                break;
            default:
                return FALSE;
        }

        // resize the original image to size of editor
        $resizedImage = imagecreatetruecolor($crop->getImgW(), $crop->getImgH());
        imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $crop->getImgW(), $crop->getImgH(), $crop->getImgInitW(), $crop->getImgInitH());
            
        // rotate the rezized image
        $rotated_image = imagerotate($resizedImage, -$crop->getRotation(), 0);
        
        // find new width & height of rotated image
        $rotated_width = imagesx($rotated_image);
        $rotated_height = imagesy($rotated_image);
        
        // diff between rotated & original sizes
        $dx = $rotated_width - $crop->getImgW();
        $dy = $rotated_height - $crop->getImgH();
        
        // crop rotated image to fit into original rezized rectangle
        $cropped_rotated_image = imagecreatetruecolor($crop->getImgW(), $crop->getImgH());
        imagecolortransparent($cropped_rotated_image, imagecolorallocate($cropped_rotated_image, 0, 0, 0));
        imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $crop->getImgW(), $crop->getImgH(), $crop->getImgW(), $crop->getImgH());
        
        // crop image into selected area
        $final_image = imagecreatetruecolor($crop->getCropW(), $crop->getCropH());
        imagecolortransparent($final_image, imagecolorallocate($final_image, 0, 0, 0));
        imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $crop->getImgX1(), $crop->getImgY1(), $crop->getCropW(), $crop->getCropH(), $crop->getCropW(), $crop->getCropH());
        
        // finally output png image
        imagejpeg($final_image, $this->getPath(basename($crop->getImgUrl()), 'cropped'), 100);
    }
}
