<?php

/*
 * This file is part of the win-and-donic sample project.
 *
 * Copyright (c) Gridonic AG <hello@gridonic.ch>
 */

namespace App\Controller;


use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/v1/user")
 */
class UserApiController extends Controller
{
    /**
     * @Route("/all", name="api_user_all")
     * @Method("GET")
     *
     * @return JsonResponse
     */
    public function getUsers()
    {
        $userRepository = $this->getDoctrine()->getRepository('App:User');

        $data = array();
        /** @var User $user */
        foreach ($userRepository->findAll() as $user) {
            $data[] = array(
                'id' => $user->getId(),
                'username' => $user->getUsername(),
            );
        }

        return new JsonResponse($data);
    }
}
