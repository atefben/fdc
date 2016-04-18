<?php
  namespace Codebird;

  require_once ('vendor/codebird.php');
  //Twitter OAuth Settings
  $CONSUMER_KEY = 'ySvUeuj3wMO6v3NDtgeweh36Z';
  $CONSUMER_SECRET = 'Sp7J0tKsWG0jtFvrBuU3ZfDt9s60uDQ5tsWVK6H6RJsfQwkJtz';
  $ACCESS_TOKEN = '16978941-uNvxs6vVs8jsLQMKfc9SOZqYDYi2nSTITh4JDyVvK';
  $ACCESS_TOKEN_SECRET = 'IIBk7XHHPDwADVzzwvTRtHgEuBQt4NO0y4RUPrYOV8KCt';
  //Get authenticated
  Codebird::setConsumerKey($CONSUMER_KEY, $CONSUMER_SECRET);
  $cb = Codebird::getInstance();
  $cb->setUseCurl(false);
  $cb->setToken($ACCESS_TOKEN, $ACCESS_TOKEN_SECRET);
  //retrieve posts
  $q = $_POST['q'];
  $count = $_POST['count'];
  $api = $_POST['api'];
  //https://dev.twitter.com/docs/api/1.1/get/statuses/user_timeline
  //https://dev.twitter.com/docs/api/1.1/get/search/tweets
  $params = array(
  'screen_name' => $q,
  'q' => $q,
  'count' => $count
  );
  //Make the REST call
  $data = (array) $cb->$api($params);

  echo json_encode($data);
?>