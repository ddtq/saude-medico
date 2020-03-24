<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class RespostasController extends AbstractController
{
    /**
     * @Route("/saude/respostas", name="respostas", methods={"GET","POST"})
     */
    public function index(Request $request)
    {
        $error = array();

        $data = array();

        if ($request->isMethod('GET')) {
            $error[] = 'POST é o único método permitido.';
        }

        if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
            $data = json_decode($request->getContent(), true);
            $request->request->replace(is_array($data) ? $data : array());
        } else {
            $error[] = 'Cabeçalho deve ter "Content-Type=application/json"';
        }


        return $this->json([
            'result' => 'Caso suspeito',
            'mensagem' => '<p>Baseado em sua resposta, é provável que essa situação .... . </p><p>Procure um posto de saúde. Em breve um médico da Coroporação poderá entrar em contato para repassar informações. Fique atento ao telefone informado no formulário.</p>',
            'erros' => $error,
            'dados_recebidos' => $data
        ]);
    }
}
