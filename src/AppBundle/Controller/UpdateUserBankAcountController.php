<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class UpdateUserBankAcountController
 * @package AppBundle\Controller
 * @Route("/user-account", name="user_account")
 */
class UpdateUserBankAcountController extends Controller {

    /**
     * @Route("/update/{user}/{account}", name="user_account_update")
     * @param User $user
     * @param $account
     *
     * @return JsonResponse
     */
    public function updateAction(User $user, $account) {

        if (!$user) {
            return new JsonResponse([
                'error' => true,
                'message' => 'No se encuentra el usuario en la base de datos',
            ]);
        }
        $user->setIbanCode($account);
        $this->get('fos_user.user_manager')->updateUser($user);

        return new JsonResponse([
            'error' => false,
            'message' => 'Los datos han sido guardados correctamente',
        ]);
    }
}
