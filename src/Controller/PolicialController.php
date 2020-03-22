<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Policial;
use App\Helper\PolicialHelper;

class PolicialController extends AbstractController
{
    /**
     * @Route("/saude/policial", name="policial", methods={"GET"})
     */
    public function index()
    {
        

        
    }
}
