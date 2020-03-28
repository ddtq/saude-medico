<?php

namespace App\Controller;

use App\Helper\PolicialHelper;
use Datetime;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class SaudePolicialVerifyController extends AbstractController
{
    /**
     * @Route("/saude/policial_verify", name="saude_policial_verify", methods={"GET","POST"})
     */
    public function policialVerify(Request $request)
    {
        $data = array();

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

        $captcha = false;

        // Salva o valor do captcha na sessão
        $session = new Session();

        $sessionFlashBag = $session->getFlashBag()->get('captcha');

        $captchaPhrase = isset($sessionFlashBag[0]) ? $sessionFlashBag[0] : null;

        if (
            "prod" === $this->getParameter('kernel.environment') &&
            (
                !isset($data['captcha']) ||
                strtoupper(trim($data['captcha'])) !== strtoupper($captchaPhrase)
            )
        ) {

            $error[] = 'INVALID CAPTCHA';

            return $this->json(['result' => false, 'captcha' => false, 'errors' => $error]);

        } else {
            $captcha = true;
        }

        if (!isset($data['rg'])) {
            $error[]='Campo rg é obrigatório.';
        } else {
            $rg = $data['rg'];
        }

        if (!isset($data['data_nascimento'])) {
            $error[]='Campo data_nascimento é obrigatório.';
        } else {
            try {
                $dataNascimento = new Datetime($data['data_nascimento']);
            } catch (Exception $e) {
                //throw new Exception(sprintf('Data de nascimento: "%s" em formato incorreto.', $data['data_nascimento']));
                $error[] = sprintf('Data de nascimento: "%s" em formato incorreto.', $data['data_nascimento']);
            }
        }

        if (count($error) > 0) {
            return $this->json(['result' => false, 'captcha' => $captcha, 'errors' => $error]);
        }

        $em = $this->getDoctrine()->getManager('rh');

        try {

            $policial = PolicialHelper::verifyPolicial($em, $rg, $dataNascimento);

            if (!is_null($policial)) {
                $response = true;
            } else {
                $response = false;
            }

        } catch (Exception $e) {
            $error[] = $e->getMessage();
            $response = false;
        }

        return $this->json(['result' => $response, 'captcha' => $captcha, 'errors'=>$error]);

    }

}
