<?php

namespace App\Controller;

use App\Helper\PolicialHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class RespostasController extends AbstractController
{
    /**
     * @Route("/saude/respostas", name="respostas", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $policial = PolicialHelper::criarPolicialPeloRg($this->getDoctrine(), '123456789');

        return new Response((string)$policial);

        $error = array();

        $data = array();
        $error[] = 'POST é o único método permitido.';

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
