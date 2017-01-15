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

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}


if (isset($accessToken)) {
  // Logged in!
  include('check_if_user.php');
  include('mkdir_function.php');
  //include 'apiMethods.php';

  $fb->setDefaultAccessToken($accessToken);
  try {
    $response = $fb->get('/me?fields=name,email'); // was only /me here
    $userNode = $response->getGraphUser();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // If graph returns error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // If validation fails or other local issues occurs
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
  $user = $userNode->getName();
  $name = $userNode->getField('name');
  $email = $userNode->getField('email');
  //$userName = str_replace(' ','', $name);
  $userExist = check_if_user($user);
  if(empty($userExist)) {
    $path = "Images/" . $user;
    $data = array("userName"=>$user,
		  "name"=>$name,
		  "email"=>$email,
		  "storageLink"=>$path,
		  "trustWorthy"=>100,);
    $url = "https://iladid3.ddns.net/api/users";
    /*$response = postExecute($url, $data);
    $status = $response->$status;
    echo $status;
    if(($status===200)){// and mkdir_func($path)) { 
    } else {
       header('Location: https://iladid3.ddns.net/register.php');
    }*/
  }
  $_SESSION['email'] = $email;
  $_SESSION['login_user'] = $user;
  $_SESSION['facebook_access_token'] = (string) $accessToken;
  header('Location: https://iladid3.ddns.net/home.php');
}


// FROM HERE OTHER CODE!!!

/*
if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Logged in
echo '<h3>Access Token</h3>';
var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
echo '<h3>Metadata</h3>';
var_dump($tokenMetadata);

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId({app-id}); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
    exit;
  }

  echo '<h3>Long-lived</h3>';
  var_dump($accessToken->getValue());
}

$_SESSION['fb_access_token'] = (string) $accessToken;

header('Location: https://iladid3.ddns.net/home.php');
*/
?>

