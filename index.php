<?php
include_once "vendor/autoload.php";
include_once "src/FplApi.php";

use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Cookie\CookieJar;
use LivecoreInteractive\FplApi\FplApi;


$fpl = new FplApi();
$auth = $fpl->getAuthClient();
$client = $fpl->getClient();

$auth->login([
	'password'=>'password',
    'login'=>'your-email',
    'redirect_uri'=>'https://fantasy.premierleague.com/',
    'app'=>'plfpl-web'
]);
echo "<br><br>";
print_r($fpl->getCookies()); /////prints out cookies have been set
echo "<br><br>";
print_r($client->me());///////////////print out logged in user account
print_r($client->entry(['entryId'=>'5352731']));///////////////print out entry
print_r($client->bootstrapStatic());///////////////print out whole data
