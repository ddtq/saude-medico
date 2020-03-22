<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Policial;
use App\Helper\PolicialHelper;

class SaudePolicialVerifyController extends AbstractController
{
    /**
     * @Route("/saude/policial_verify", name="saude_policial_verify", methods={"POST"})
     */
    public function index(Request $request)
    {
        $error = array();
        if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
            $data = json_decode($request->getContent(), true);
            $request->request->replace(is_array($data) ? $data : array());
        } else {
            $error[] = 'Cabeçalho deve ter "Content-Type=application/json"';
        }

        if (!isset($data['rg'])) $error[]='Campo rg é obrigatório.';
        if (!isset($data['data_nascimento'])) $error[]='Campo data_nascimento é obrigatório.';
        
        $rg = $data['rg'];

        $dataNascimento= new \Datetime($data['data_nascimento']);

        $em = $this->getDoctrine()->getManager('rh');

        $policial = PolicialHelper::verifyPolicial($em, $rg, $dataNascimento);

        if (!is_null($policial)) {
            $response = true;
        } else {
            $response = false;
        }

        return $this->json(['result' => $response, 'errors'=>$error]);
        //return $this->json(['rg' => $rg, 'data_nascimento'=>$dataNascimento->format('Y-m-d')]);
        //return $this->json(['rg' => $data]);
    }
}
