<?php
require_once __DIR__ . '/vendor/autoload.php';
session_name('goc');
session_start();

$fb = new Facebook\Facebook([
  'app_id' => '577901012401084',
  'app_secret' => 'ab50f8180f68e6634886a996b3671817',
  'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // optional
$loginUrl = $helper->getLoginUrl('http://iladid3.ddns.net/login_fb-callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '"><span><img class="fb-image"  src="footerfacebookicon.png"></img></span></a>';

?>
