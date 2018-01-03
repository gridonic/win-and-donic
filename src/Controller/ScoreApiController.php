<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Provides REST Api methods to allow to submit scores to the backend.
 *
 * @Route("/api/v1/score")
 */
class ScoreApiController extends Controller
{
    /**
     * @Route("/submit", name="api_score_submit")
     */
    public function submitScore()
    {
        return new JsonResponse(array('hello' => 'world'));
    }
}
