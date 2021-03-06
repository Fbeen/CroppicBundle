<?php

namespace Fbeen\CroppicBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Fbeen\CroppicBundle\Entity\Image;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TwigExtension extends \Twig_Extension
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('croppic', array($this, 'initCroppic'), array("is_safe" => array("html"))),
        );
    }

    public function initCroppic($elementId, $filename = NULL, $events = array())
    {
        $uploadUrl = $this->container->get('router')->generate('fbeen_croppic_save');
        $cropUrl = $this->container->get('router')->generate('fbeen_croppic_crop');
        $helper = $this->container->get('fbeen.imagehelper');

        $token = $this->container->get('security.csrf.token_manager')->refreshToken('fbeen_croppic');

        $rules = array(
            'uploadUrl:"' . $uploadUrl . '"',
            'cropUrl:"' . $cropUrl . '"',
            'imgEyecandy:false',		
            'uploadData:{"crsf_token":"' . $token . '"}',
            'outputUrlId:"appbundle_band_image"',
            'rotateFactor:90',
            'onReset:function(){ console.log("onReset")}',
//            'loaderHtml:\'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> \'',
        );
        
        if($filename)
        {
            $rules[] = 'loadPicture:"' . $helper->getUrl($filename, 'original') . '"';
        }
        
        foreach($events as $event => $value)
        {
            $rules[] = $event . ':' . $value;
        }
        
        return '<script>
            var croppicOptions = {' . implode(',', $rules) . '};
            var croppic = new Croppic("' . $elementId . '", croppicOptions);
            </script>';
    }

    public function getName()
    {
        return 'app_extension';
    }
}

