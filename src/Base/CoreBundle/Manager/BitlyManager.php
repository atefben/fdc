<?php

namespace Base\CoreBundle\Manager;

/**
 * Class BitlyManager
 * @package Base\CoreBundle\Manager
 * \@company Ohwee
 */
class BitlyManager
{

	function bitly_oauth_access_token($code, $redirect, $client_id, $client_secret) {
	  $results = array();
	  $url = 'https://api-ssl.bit.ly/oauth/' . "access_token";
	  $params = array();
	  $params['client_id'] = $client_id;
	  $params['client_secret'] = $client_secret;
	  $params['code'] = $code;
	  $params['redirect_uri'] = $redirect;
	  $output = $this->bitly_post_curl($url, $params);
	  $parts = explode('&', $output);
	  foreach ($parts as $part) {
	    $bits = explode('=', $part);
	    $results[$bits[0]] = $bits[1];
	  }
	  return $results;
	}

	function bitly_oauth_access_token_via_password($username, $password, $client_id, $client_secret) {
	  $results = array();
	  $url = $this->bitly_oauth_access_token . "access_token";
  
	  $headers = array();
	  $headers[] = 'Authorization: Basic '.base64_encode($client_id . ":" . $client_secret);
    
	  $params = array();
	  $params['grant_type'] = "password";
	  $params['username'] = $username;
	  $params['password'] = $password;
  
	  $output = $this->bitly_post_curl($url, $params, $headers);
  
	  $decoded_output = json_decode($output,1);
	  $results = array(
	  	"access_token" => $decoded_output['access_token']
	  );
  
	  return $results;
	}

	function bitly_get($endpoint, $params, $complex=false) {
	  $result = array();
	  if ($complex) {
	    $url_params = "";
	    foreach ($params as $key => $val) {
	      if (is_array($val)) {
	        // we need to flatten this into one proper command
	        $recs = array();
	        foreach ($val as $rec) {
	          $tmp = explode('/', $rec);
	          $tmp = array_reverse($tmp);
	          array_push($recs, $tmp[0]);
	        }
	        $val = implode('&' . $key . '=', $recs);
	      }
	      $url_params .= '&' . $key . "=" . $val;
	    }
	    $url = 'https://api-ssl.bit.ly/v3/' . $endpoint . "?" . substr($url_params, 1);
	  } else {
	    $url = 'https://api-ssl.bit.ly/v3/' . $endpoint . "?" . http_build_query($params);
	  }
	  $result = json_decode($this->bitly_get_curl($url), true);
	  return $result;
	}

	function bitly_post($endpoint, $params) {
	  $result = array();
	  $url = 'https://api-ssl.bit.ly/v3/' . $api_endpoint;
	  $output = json_decode(bitly_post_curl($url, $params), true);
	  $result = $output['data'][str_replace('/', '_', $api_endpoint)];
	  $result['status_code'] = $output['status_code'];
	  return $result;
	}

	function bitly_get_curl($uri) {
	  $output = "";
	  try {
	    $ch = curl_init($uri);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 4);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	    $output = curl_exec($ch);
	  } catch (Exception $e) {
	  }
	  return $output;
	}

	function bitly_post_curl($uri, $fields, $header_array = array()) {
	  $output = "";
	  $fields_string = "";
	  foreach($fields as $key=>$value) { $fields_string .= $key.'='.urlencode($value).'&'; }
	  rtrim($fields_string,'&');
	  try {
	    $ch = curl_init($uri);
    
	    if(is_array($header_array) && !empty($header_array)){
	    	curl_setopt($ch, CURLOPT_HTTPHEADER, $header_array);
	    }
    
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch,CURLOPT_POST,count($fields));
	    curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 2);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	    $output = curl_exec($ch);
	  } catch (Exception $e) {
	  }
	  return $output;
	}
}