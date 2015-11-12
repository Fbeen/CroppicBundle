<?php

namespace Fbeen\CroppicBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Fbeen\CroppicBundle\Entity\Image;
use Fbeen\CroppicBundle\Form\ImageType;
use Fbeen\CroppicBundle\Entity\Crop;
use Fbeen\CroppicBundle\Form\CropType;

/**
 * @Route("/fbeen/croppic")
 */
class CroppicController extends Controller
{
    /**
     * @Route("/save", name="fbeen_croppic_save")
     * @Method({"POST"})
     */
    public function saveAction(Request $request)
    {
        $token = $this->get('security.csrf.token_manager')->getToken('fbeen_croppic');
        
        if($request->get('crsf_token') != $token)
        {
            return new JsonResponse(array(
                'status' => 'error',
                'message' => 'csrf token is ongeldig. Probeer het nog eens.'
            ));
        }
        
        if(!$request->files->has('img'))
        {
            return new JsonResponse(array(
                'status' => 'error',
                'message' => 'did not find any uploaded file'
            ));
        }
        
        $em = $this->getDoctrine()->getManager();
            
        $image = new Image(); 
        $image->setImg($request->files->get('img'));
        
        $errors = $this->get('validator')->validate($image);
 
        if(count($errors)) {
            return new JsonResponse(array(
                'status' => 'error',
                'message' => $errors[0]->getMessage()
            ));
        }
        
        
        $helper = $this->get('fbeen.imagehelper');
        $helper->upload($image);

        $em->persist($image);
        $em->flush();

        list($width, $height) = getimagesize( $helper->getPath($image->getFilename(), 'original') );

        return new JsonResponse(array(
            'status' => 'success',
            'url'    => $helper->getUrl($image->getFilename(), 'original'),
            'width'  => $width,
            'height' => $height
        ));
    }
    
    /**
     * @Route("/crop", name="fbeen_croppic_crop")
     * @Method({"POST"})
     */
    public function cropAction(Request $request)
    {
        $crop = new Crop();
        
        $form = $this->createForm(new CropType(), $crop);
        
        $form->handleRequest($request);

        if ($form->isValid())
        {
            $helper = $this->get('fbeen.imagehelper');
            $helper->crop($crop);
            
            return new JsonResponse(array(
                'status' => 'success',
                'url' => $helper->getUrl(basename($crop->getImgUrl()), 'cropped')
            ));
         }
        
        return new JsonResponse(array(
            'status' => 'error',
            'message' => 'Validation failed'
        ));
    }
}