<?php

// Configuration
// These keys are available at https://dev.twitter.com/apps

$consumer_key = '';
$consumer_secret = '';

$access_token = '';
$access_token_secret = '';

$twitter_name = ''; // Twitter username
$tweet_count = '1'; // How many tweets to pull from Twitter

// End of configuration

$oauth_array = array(
'count' => $tweet_count,
'oauth_consumer_key' => $consumer_key,
'oauth_nonce' => time(),
'oauth_signature_method' => 'HMAC-SHA1',
'oauth_timestamp' => time(),
'oauth_token' => $access_token,
'oauth_version' => '1.0',
'screen_name' => $twitter_name);

$oauth_header = array();

foreach ($oauth_array as $key => $value) {
	array_push($oauth_header, $key . '=' . $value);
}

$oauth_header = implode('&', $oauth_header);
$oauth_header = rawurlencode($oauth_header);

$signature_base = 'GET&' . rawurlencode('https://api.twitter.com/1.1/statuses/user_timeline.json') . '&' . $oauth_header;
$signature_keys = rawurlencode($consumer_secret) . '&' . rawurlencode($access_token_secret);
$oauth_signature = base64_encode(hash_hmac('sha1', $signature_base, $signature_keys, true));
$oauth_signature = rawurlencode($oauth_signature);

$oauth_array['oauth_signature'] = $oauth_signature;
ksort($oauth_array);

$oauth_header = array();

foreach ($oauth_array as $key => $value) {
	array_push($oauth_header, $key . '=' . $value);
}

$oauth_header = implode(',', $oauth_header);

// cURL request to Twitter

$oauth_send = curl_init();

curl_setopt($oauth_send, CURLOPT_HTTPHEADER, array('Authorization: OAuth ' . $oauth_header)); // OAuth header
curl_setopt($oauth_send, CURLOPT_URL, 'https://api.twitter.com/1.1/statuses/user_timeline.json?count=' . $tweet_count . '&screen_name=' . $twitter_name); // URL to request
curl_setopt($oauth_send, CURLOPT_HEADER, false); // Don't return header
curl_setopt($oauth_send, CURLOPT_RETURNTRANSFER, true); // Return as string
curl_setopt($oauth_send, CURLOPT_SSL_VERIFYPEER, false); // Don't verify

$returned_string = curl_exec($oauth_send);
curl_close($oauth_send);

$latest_tweet = json_decode($returned_string, true);

function fetchTweet($count) {
	global $latest_tweet;
	return $latest_tweet[$count]['text'];
}

?>
