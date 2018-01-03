<?php

/*
 * This file is part of the win-and-donic sample project.
 *
 * Copyright (c) Gridonic AG <hello@gridonic.ch>
 */

namespace App\Tests\Functional;

use App\DataFixtures\ORM\LoadUsers;
use Liip\FunctionalTestBundle\Test\WebTestCase;

class ScoreApiControllerTest extends WebTestCase
{
    public function test_SubmitSinglesScore_SuccessAndGameStoredInDatabase()
    {
        $client = $this->makeClient();
        $container = $client->getContainer();

        $fixures = $this->loadFixtures(array(
            LoadUsers::class,
        ))->getReferenceRepository();

        $body = json_encode(array(
            'players' => array(
                'home' => $fixures->getReference('user-julez')->getId(),
                'away' => $fixures->getReference('user-bidu')->getId(),
            ),
            'sets' => array(
                array('home' => 11, 'away' => 9),
                array('home' => 6, 'away' => 11),
                array('home' => 16, 'away' => 14),
            ),
        ));

        $client->request('POST', '/api/v1/score/singles/submit', array(), array(), array(), $body);

        $response = $client->getResponse();
        $this->assertSame(201, $response->getStatusCode());

        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals(array('success' => true), $responseData);

        $gameRepository = $container->get('doctrine.orm.default_entity_manager')->getRepository('App:Game');

        $game = $gameRepository->getLatestGame();

        $this->assertNotNull($game);

        $this->assertCount(3, $game->getSets());

        $set = $game->getSets()[0];
        $this->assertSame(11, $set->getHomeScore());
        $this->assertSame(9, $set->getAwayScore());

        $set = $game->getSets()[1];
        $this->assertSame(6, $set->getHomeScore());
        $this->assertSame(11, $set->getAwayScore());

        $set = $game->getSets()[2];
        $this->assertSame(16, $set->getHomeScore());
        $this->assertSame(14, $set->getAwayScore());

        $this->assertTrue(true);
    }

    static function getPhpUnitXmlDir()
    {
        return __DIR__.'/../..';
    }
}
