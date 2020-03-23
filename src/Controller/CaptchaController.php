<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Gregwar\Captcha\CaptchaBuilder;

class CaptchaController extends AbstractController
{

    /**
     * @Route("/captcha", name="captcha")
     */
    public function captcha()
    {

        $builder = new CaptchaBuilder;

        // Deixa os caracteres mais legíveis
        $builder->setDistortion(false);

        $builder->build(240, $height = 100);

        // Salva o valor do captcha na sessão
        $session = new Session();
        $session->getFlashBag()->add('captcha', $builder->getPhrase());

        // Cria o objeto Response com o conteúdo do arquivo Jpeg
        $response = new Response($builder->get());

        $contentType = 'image/jpeg';
        $disposition = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_INLINE, 
            'image.jpeg'
        );

        $response->headers->set('Content-Type', $contentType);
        $response->headers->set('Content-Disposition', $disposition);

        $response->setStatusCode(Response::HTTP_OK);

        return $response;

    }
}
