<?php

namespace App\Controller;


use App\Service\Core\EntityService;
use App\Service\Participant\SinglePlayerService;
use App\Service\Score\ScoreSubmissionService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Provides REST Api methods to allow to submit scores to the backend.
 *
 * @Route("/api/v1/score")
 */
class ScoreApiController extends Controller
{
    /**
     * @Route("/singles/submit", name="api_score_submit")
     * @Method("POST")
     *
     * @param Request $request
     * @param ScoreSubmissionService $scoreSubmissionService
     * @param SinglePlayerService $singlePlayerService
     *
     * @param EntityService $entityService
     *
     * @return JsonResponse
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function submitScore(Request $request, ScoreSubmissionService $scoreSubmissionService, SinglePlayerService $singlePlayerService, EntityService $entityService)
    {
        $data = json_decode($request->getContent(), true);

        // TODO: clean code and error handling
        $homeUserId = $data['players']['home'];
        $awayUserId = $data['players']['away'];

        $userRepository = $this->getDoctrine()->getRepository('App:User');
        $homePlayer = $singlePlayerService->getOrCreatePlayer($userRepository->findOneBy(array('id' => $homeUserId)));
        $awayPlayer = $singlePlayerService->getOrCreatePlayer($userRepository->findOneBy(array('id' => $awayUserId)));

        // TODO: throw errors if incorrect data
        if (!empty($data['sets'])) {
            $setScores = array();
            foreach ($data['sets'] as $setData) {
                // TODO: throw errors if incorrect data
                $setScores[] = array($setData['home'], $setData['away']);
            }

            $scoreSubmissionService->submitScore($homePlayer, $awayPlayer, $setScores);

            $entityService->flush();
        }

        return new JsonResponse(array('success' => true), Response::HTTP_CREATED);
    }
}
