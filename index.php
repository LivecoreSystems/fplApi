<?php
include_once "vendor/autoload.php";
include_once "src/FplLib.php";

use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Cookie\CookieJar;
use Livecore\FplLib\FplLib;


// $domain = 'premierleague.com';
// $values = ['pl_profile' => 'eyJzIjogIld6SXNNalF6TmpBd05qUmQ6MWh5UlBKOlNhWGlObUVFRjNia21DQzR0V21HbENSVVc4OCIsICJ1IjogeyJpZCI6IDI0MzYwMDY0LCAiZm4iOiAiR2ljaGltdSIsICJsbiI6ICJNdWhvcm8iLCAiZmMiOiA4fX0=',"csrftoken"=>"xr2R41ykxKJ0iVyKhxg20z06aOSBzwCbt4UQw6TBR6feXxWURqsIu50ig71ENNlN","sessionid"=>"dz63j1x7nwkjvx6li4yu8es9eutl3l1y"];

//$jar = CookieJar::fromArray($values, $domain);
//

/////////////////////////////////////WORKING EXAMPLE????????????//////////////////////////
// $client = new Client(array(
//     'cookies' => true
// ));


// $response = $client->request('POST', 'https://users.premierleague.com/accounts/login/', [
//     'timeout' => 30,
//     'form_params' => [
//         'password'=>'solideogloria',
// 	    'login'=>'Smuhoro95@gmail.com',
// 	    'redirect_uri'=>'https://fantasy.premierleague.com/',
// 	    'app'=>'plfpl-web'
//     ]
// ]);

// // and using the same client

// $response = $client->request('GET', 'https://fantasy.premierleague.com/api/me/');
// print_r($response->getBody()->getContents());
// die();
///////***************************************************/////////////////////////////////


/*
//$jar = new CookieJar();
$client = new Client(array(
    'cookies' => $jar
));

$response = $client->request('GET', 'https://fantasy.premierleague.com/api/entry/5352731/', [
   
]);
$stream = $response->getBody();
$contents = $stream->getContents();
print_r($contents);
$it = $jar->getIterator();
while ($it->valid()) {
    var_dump($it->current());
    $it->next();
}
die();
$response = $client->request('POST', 'https://users.premierleague.com/accounts/login/', [
    'timeout' => 30,
    'form_params' => [
		'password'=>'solideogloria',
	    'login'=>'Smuhoro95@gmail.com',
	    'redirect_uri'=>'https://fantasy.premierleague.com/a/login/',
	    'app'=>'plfpl-web'
	]
]);

$it = $jar->getIterator();
while ($it->valid()) {
    var_dump($it->current());
    $it->next();
}
//$newCookies = $response->getHeader('set-cookie');
//print_r($newCookies);
*/


$fpl = new FplLib();
$auth = $fpl->getAuthClient();
$client = $fpl->getClient();

print_r($auth->login([
	'password'=>'jacobkababa.21',
    'login'=>'jgachuri@yahoo.com',
    'redirect_uri'=>'https://fantasy.premierleague.com/',
    'app'=>'plfpl-web'
]));

print_r($fpl->getCookies());
print_r($client->me());
//print_r($client->entry(['entryId'=>'5352731']));
//print_r($client->bootstrapStatic());
