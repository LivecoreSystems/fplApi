<?php

namespace LivecoreSystems\FplApi;

use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Cookie\CookieJar;

class FplLib
{

    CONST BASE_URL = 'https://fantasy.premierleague.com/';
    CONST AUTH_URL = 'https://users.premierleague.com/accounts/';

    protected $client;
    protected $authClient;
    protected $cookieJar;

    public function __construct()
    {   
        $domain = 'premierleague.com';
        $values = ['pl_profile' => 'eyJzIjogIld6SXNNalF6TmpBd05qUmQ6MWh5UlBKOlNhWGlObUVFRjNia21DQzR0V21HbENSVVc4OCIsICJ1IjogeyJpZCI6IDI0MzYwMDY0LCAiZm4iOiAiR2ljaGltdSIsICJsbiI6ICJNdWhvcm8iLCAiZmMiOiA4fX0=',"csrftoken"=>"xr2R41ykxKJ0iVyKhxg20z06aOSBzwCbt4UQw6TBR6feXxWURqsIu50ig71ENNlN","sessionid"=>"dz63j1x7nwkjvx6li4yu8es9eutl3l1y"];

        $this->cookieJar = CookieJar::fromArray($values, $domain);
        
        $this->cookieJar= new CookieJar;
        $this->client = new Client([
            'headers' => ['User-Agent' => 'FplLib/1.0','Content-Type'=>'application/x-www-form-urlencoded'],
            'cookies' => $this->cookieJar
        ]);
        $this->authClient = new GuzzleClient($this->client, self::getAuthOperations());
        $this->client = new GuzzleClient($this->client, self::getGeneralOperations());
    }

    public static function getGeneralOperations()
    {
        $description = new Description(
            [
                'baseUri' => self::BASE_URL,
                'operations' => [
                    'bootstrapStatic' => [
                        'httpMethod' => 'GET',
                        'uri' => '/api/bootstrap-static/',
                        'responseModel' => 'getResponse',
                    ],
                    'me' => [
                        'httpMethod' => 'GET',
                        'uri' => '/api/me/',
                        'responseModel' => 'getResponse',
                    ],
                    'entry' => [
                        'httpMethod' => 'GET',
                        'uri' => '/api/entry/{entryId}/',
                        'responseModel' => 'getResponse',
                        'parameters' => [
                            'entryId' => [
                                'type' => 'string',
                                'location' => 'uri',
                            ],
                        ],
                    ],
                    'entryHistory' => [
                        'httpMethod' => 'GET',
                        'uri' => '/api/entry/{entryId}/history/',
                        'responseModel' => 'getResponse',
                        'parameters' => [
                            'entryId' => [
                                'type' => 'string',
                                'location' => 'uri',
                            ],
                        ],
                    ],
                    'entryPicks' => [
                        'httpMethod' => 'GET',
                        'uri' => '/api/entry/{entryId}/event/{eventId}/picks/',
                        'responseModel' => 'getResponse',
                        'parameters' => [
                            'entryId' => [
                                'type' => 'string',
                                'location' => 'uri',
                            ],
                            'eventId' => [
                                'type' => 'string',
                                'location' => 'uri',
                            ],
                        ],
                    ],
                    'elementSummary' => [
                        'httpMethod' => 'GET',
                        'uri' => '/api/element-summary/{elementId}/',
                        'responseModel' => 'getResponse',
                        'parameters' => [
                            'elementId' => [
                                'type' => 'string',
                                'location' => 'uri',
                            ],
                        ],
                    ],
                    'leaguesClassicStandings' => [
                        'httpMethod' => 'GET',
                        'uri' => '/api/leagues-classic-standings/{leagueId}/',
                        'responseModel' => 'getResponse',
                        'parameters' => [
                            'leagueId' => [
                                'type' => 'string',
                                'location' => 'uri',
                            ],
                        ],
                    ],
                    'fixtures' => [
                        'httpMethod' => 'GET',
                        'uri' => '/api/fixtures/?event={event}',
                        'responseModel' => 'getResponse',
                        'parameters' => [
                            'event' => [
                                'type' => 'string',
                                'location' => 'uri',
                            ],
                        ],
                    ],
                ],
                'models' => [
                    'getResponse' => [
                        'type' => 'object',
                        'additionalProperties' => ['location' => 'json'],
                    ],
                    "getRawResponse"=> [
                      "type"=> "object",
                      "properties"=> [
                        "body"=> [
                          "location"=> "body",
                          "type"=> "string"
                        ]
                      ]
                    ]
                ],
            ]
        );
        return $description;
    }

    public function getAuthOperations(){
        $description = new Description(
            [
                'baseUri' => self::AUTH_URL,
                'operations' => [
                    'login' => [
                        'httpMethod' => 'POST',
                        'uri' => 'login/',
                        'responseModel' => 'getResponse',
                        'parameters'=>[
                            'password'=>[
                                'type' => 'string',
                                'location' => 'body',
                            ],
                            'login'=>[
                                'type' => 'string',
                                'location' => 'body',
                            ],
                            'redirect_uri'=>[
                                'type' => 'string',
                                'location' => 'body',
                            ],
                            'app'=>[
                                'type' => 'string',
                                'location' => 'body',
                            ]
                        ]
                    ],
                    'logout' => [
                        'httpMethod' => 'POST',
                        'uri' => '/api/entry/{entryId}/',
                        'responseModel' => 'getResponse',
                        'parameters' => [
                            'entryId' => [
                                'type' => 'string',
                                'location' => 'uri',
                            ],
                        ],
                    ],
                ],
                'models' => [
                    'getResponse' => [
                        'type' => 'object',
                        'additionalProperties' => ['location' => 'json'],
                    ]
                ],
            ]
        );
        return $description;
    }

    public function getClient(){   
        return $this->client;
    }

    public function getAuthClient(){
        return $this->authClient;
        //$cookieJar = $this->authClient->getConfig('cookies');
        //return $cookieJar->toArray();
    }

    public function getCookies(){
        return $this->cookieJar;
    }
}
