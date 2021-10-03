<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterNewUserController extends Controller {

    const REGISTER_USER_OK = 'ok';

    const REGISTER_USER_FAIL = 'fail';

    const USER_FAIL_MESSAGE = 'Ya existe un usuario con ese email';
    /**
     * @Route("/user/new", name="register_new_user")
     * @param Request $request
     *
     * @return Response
     */
    public function registerNewUserAction(Request $request) {
        $email = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $request->get('email')]);
        if($email) {
            return new JsonResponse([
                'status' => self::REGISTER_USER_FAIL,
                'message' => self::USER_FAIL_MESSAGE
            ]);
        }
        $user = $this->registerUser($request);
        if (!isset($_SESSION['_sf2_attributes']['_security.main.target_path']) || !strpos($_SESSION['_sf2_attributes']['_security.main.target_path'], 'crear-oferta')) {
            return new JsonResponse([
                'host' => $request->getHost(),
                'page' => $this->generateUrl('configurer', [

                ]),
            ]);
        }

        $params = $this->getConfigParams($_SESSION['_sf2_attributes']['_security.main.target_path'], $user);

        return new JsonResponse([
            'status' => self::REGISTER_USER_OK,
            'message' => '',
            'host' => $request->getHost(),
            'page' => $this->generateUrl('contract_new_register', $params),
        ]);
    }

    /**
     * @param Request $request
     * @return UserInterface|mixed
     */
    private function registerUser(Request $request) {
        /** @var User $user */
        $user = $this->get('fos_user.user_manager')->createUser();
        $user->setPlainPassword($request->get('pasword'));
        $user->setName($request->get('name'));

        $passwordEncoder = $this->get('security.encoder_factory')->getEncoder($user);
        $password = $passwordEncoder->encodePassword($user->getPlainPassword(), $user->getSalt());

        $user->setPassword($password);
        $user->setEnabled(FALSE);
        $user->setEmail($request->get('email'));
        $user->setUsername($request->get('email'));

        $user->setEnabled(TRUE);
        $user->setEmail($request->get('email'));
        $user->setAddress($request->get('address'));
        $user->setCif($request->get('cif'));
        $user->setOwner($request->get('owner'));
        $user->setCp($request->get('cp'));
        $user->setPopulation($request->get('population'));
        $user->setPhone($request->get('phone'));
        $aceptarComunicacion = $request->get('aceptarComunicacion') ?: false;
        $user->setAceptarComunicacion($aceptarComunicacion);
        $this->get('fos_user.user_manager')->updatePassword($user);
        $this->get('fos_user.user_manager')->updateUser($user, true);

        return $user;
    }

    /**
     * @param $url
     *
     * @param User $user
     *
     * @return mixed
     */
    private function getConfigParams($url, $user) {
        $params = [];
        $keys = ['idMachine', 'colorPercent', 'pages', 'duration'];
        $arrayParams = explode('/', substr($url,strpos($url,'crear-oferta') + strlen('crear-oferta') + 1));
        foreach ($keys as $key => $value) {

           $params[$value] = (isset($arrayParams[$key])) ? $arrayParams[$key] : 0;
        }
        $params['idUser'] = $user->getId();
        return $params;
    }
}