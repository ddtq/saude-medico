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
     * @Route("/saude/policial_verify", name="saude_policial_verify", methods={"GET","POST"})
     */
    public function policialVerify(Request $request)
    {
        $error = array();

        if ($request->isMethod('GET')) {
            $error[] = 'POST é o único método permitido.';
        }

        if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
            $data = json_decode($request->getContent(), true);
            $request->request->replace(is_array($data) ? $data : array());
        } else {
            $error[] = 'Cabeçalho deve ter "Content-Type=application/json"';
        }

        if (!isset($data['rg'])) {
            $error[]='Campo rg é obrigatório.';
        } else {
            $rg = $data['rg'];
        }

        if (!isset($data['data_nascimento'])) {
            $error[]='Campo data_nascimento é obrigatório.';
        } else {
            $dataNascimento= new \Datetime($data['data_nascimento']);
        }
        
        if (count($error) > 0) {
            return $this->json(['result' => false, 'errors'=>$error]);
        }

        

        $em = $this->getDoctrine()->getManager('rh');

        $policial = PolicialHelper::verifyPolicial($em, $rg, $dataNascimento);

        if (!is_null($policial)) {
            $response = true;
        } else {
            $response = false;
        }

        return $this->json(['result' => $response, 'errors'=>$error]);

    }

}
