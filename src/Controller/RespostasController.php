<?php

namespace App\Controller;

use App\Entity\Triagem;
use App\Helper\PolicialHelper;
use App\Repository\TriagemRepository;
use JsonSchema\Exception\InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;


class RespostasController extends AbstractController
{
    /**
     * @Route("/saude/respostas", name="respostas", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->validarRequisicao($request);

        /**
         * @var $triagemRepository TriagemRepository
         */
        $triagemRepository = $this->getDoctrine()->getManager()->getRepository(Triagem::class);

        /**
         * @var $triagem Triagem|null
         */
        $triagem = $triagemRepository->createFromRequest($this->getDoctrine(), $request);

        //analisar triagem e incluir resultado antes de retornar

//        $this->getDoctrine()->getEntityManager()->persist($triagem);
//
//        $this->getDoctrine()->getEntityManager()->flush();


//        $policial = PolicialHelper::criarPolicialPeloRg($this->getDoctrine(), '123456789');
//
//        return new Response((string)$policial);
//
//
//        if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
//            $data = json_decode($request->getContent(), true);
//            $request->request->replace(is_array($data) ? $data : array());
//        } else {
//            $error[] = 'Cabeçalho deve ter "Content-Type=application/json"';
//        }
//
//        return $this->json([
//            'result' => 'Caso suspeito',
//            'mensagem' => '<p>Baseado em sua resposta, é provável que essa situação .... . </p><p>Procure um posto de saúde. Em breve um médico da Coroporação poderá entrar em contato para repassar informações. Fique atento ao telefone informado no formulário.</p>',
//            'erros' => $error,
//            'dados_recebidos' => $data
//        ]);

    }

    protected function validarRequisicao(Request $request)
    {
        if (0 !== strpos($request->headers->get('Content-Type'), 'application/json')) {
            throw new \InvalidArgumentException("A requisição precisa conter cabeçalho application/json");
        }

        $data = json_decode($request->getContent(), true);

        if(
            !isset($data['policial']['rg']) ||
            !isset($data['policial']['data_nascimento']) ||
            !isset($data['policial']['telefone']) ||
            !isset($data['respostas']) ||
            !is_array($data['respostas'])
        ) {
            throw new \InvalidArgumentException("A requisição não contém todas as informações.");
        }

        try {
            $dataNascimento = new \DateTime($data['policial']['data_nascimento']);
        } catch(\Exception $e) {
            throw new \InvalidArgumentException("Formato da data de nascimento está incorreto");
        }

        if (!PolicialHelper::verifyPolicial($this->getDoctrine()->getManager('rh'), $data['policial']['rg'], $dataNascimento)) {
            throw new \InvalidArgumentException("O rg do policial ou data de nascimento não coincidem");
        }
    }
}
