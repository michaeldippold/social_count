<?php 

// IMPORTANT BITS THAT MAKE THINGS WORK GO IN HERE. I think?

defined('C5_EXECUTE') or die(_("Access Denied."));
	
class SocialCountBlockController extends BlockController {
	
// Stuff that came standard issue with this class/object

	protected $btTable = "btSocialCount";
	protected $btInterfaceWidth = "350";
	protected $btInterfaceHeight = "300";

	public function getBlockTypeName() {
		return t('Social Counts');
	}

	public function getBlockTypeDescription() {
		return t('Displays and caches social counts!');
	}

	public function flush_cache()  {
		cache::flush();
	}


	// TAKE NOTICE: THIS NEEDS TO BE NON-STATIC FOR PRODUCTION
	// TEST URL: http://cupcakecanyon.com/new-york-style-cheesecake-cupcakes/
	var $static_url = "http://www.itsahappymedium.com/blog/website-design/your-website-sucks";

	// TAKE NOTICE: THIS IS SET TO 0 FOR TESTING - NEEDS TO BE 60 IN PRODUCTION
	var $socialCacheTTL = 60;

/**
*
* These methods receive the social count data, cache it, and display it.
* Consider either error handling (return 0 if no response) or forced suppression with @file_get_contents: 
* http://stackoverflow.com/questions/272361/how-can-i-handle-the-warning-of-file-get-contents-function-in-php
*/

	public function getTweetCount() {

		$tweetcount = $this->get_TwitterCount($this->getCurrentUrl());
      	$tweet_count = Cache::get('social_counts', $this->getCacheKey("twitter"));

	    if( empty($tweet_count) ) {
	      	Cache::set('social_counts', $this->getCacheKey("twitter"), $tweetcount, $this->socialCacheTTL());
	    	$tweet_count = Cache::get('social_counts', $this->getCacheKey("twitter"));
	    } 

	    return $tweet_count ;
    }

    public function getLikeCount() {

		$likecount = $this->get_FacebookCount($this->getCurrentUrl());
      	$like_count = Cache::get('social_counts', $this->getCacheKey("facebook"));

	      if( empty($like_count) ) {
	      	Cache::set('social_counts', $this->getCacheKey("facebook"), $likecount, $this->socialCacheTTL());
	      	$like_count = Cache::get('social_counts', $this->getCacheKey("facebook"));
	      } 
	    return $like_count ;
    }

    public function getPlusOnes() {

		$plusones = $this->get_PlusOnes();
      	$plues_ones = Cache::get('social_counts', $this->getCacheKey("googleplus"));

	      if( empty($plus_ones) ) {
	      	Cache::set('social_counts', $this->getCacheKey("googleplus"), $plusones, $this->socialCacheTTL());
	      	$plus_ones = Cache::get('social_counts', $this->getCacheKey("googleplus"));
	      } 
	    return $plus_ones ;
    }

    public function getPins() {

		$pins = $this->get_pinterest();
      	$pinterest_count = Cache::get('social_counts', $this->getCacheKey("pinterest"));

	      if( empty($pinterest_count) ) {
	      	Cache::set('social_counts', $this->getCacheKey("pinterest"), $pins, $this->socialCacheTTL());
	      	$pinterest_count = Cache::get('social_counts', $this->getCacheKey("pinterest"));
	      } 
	    return $pinterest_count ;
    }

/**
*
* These methods retrieve social count data and returen it.
*
*/

    public function get_TwitterCount($url) {

		$json_string = file_get_contents('http://urls.api.twitter.com/1/urls/count.json?url=' . $url);
	    $json = json_decode($json_string, true);
	 
	    return intval( $json['count'] );
	}

	public function get_FacebookCount($url) {

		$json_string = file_get_contents('http://graph.facebook.com/?ids=' . $url);
	    $json = json_decode($json_string, true);
	 
	    return intval( $json[$url]['shares'] );
	}

	public function get_PlusOnes()  {

		// PULLED FROM: http://toolspot.org/script-to-get-shared-count.php

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"'.rawurldecode("{$this->getCurrentUrl()}").'","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
		$curl_results = curl_exec ($curl);
		curl_close ($curl);
		$json = json_decode($curl_results, true);
		return isset($json[0]['result']['metadata']['globalCounts']['count'])?intval( $json[0]['result']['metadata']['globalCounts']['count'] ):0;
		//return $json[0]['result']['metadata']['globalCounts']['count'];
	}

	public function get_pinterest() {

		// PULLED FROM: http://toolspot.org/script-to-get-shared-count.php

		$return_data = $this->file_get_contents_curl('http://api.pinterest.com/v1/urls/count.json?url='. $this->getCurrentUrl() );
		$json_string = preg_replace('/^receiveCount\((.*)\)$/', "\\1", $return_data);
		$json = json_decode($json_string, true);
		return isset($json['count'])?intval($json['count']):0;
	}

	private function file_get_contents_curl($url){

		// PULLED FROM: http://toolspot.org/script-to-get-shared-count.php

		$ch=curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
		$cont = curl_exec($ch);
		if(curl_error($ch))
		{
		die(curl_error($ch));
		}
		return $cont;
	}

	public function total_all_counts() {
		$output = 0
		+ $this->getTweetCount()
		+ $this->getLikeCount()
		+ $this->getPlusOnes()
		+ $this->getPins();
		return $output;
	}


/**
*
* These methods handle the cache keys and set the cache timeout.
*
*/

	public function getCacheKey($social_media_type) { 

		$db = Loader::db();
		$records = $db->GetAll('select * from btSocialCount');

		return $social_media_type . $records['0']['bID'];

	}

	public function socialCacheTTL() {
      return (int)$this->socialCacheTTL;
    }

   	function getCurrentUrl(){
   		global $c;
   		$nh = Loader::helper('navigation');
  		$cpl = $nh->getCollectionURL($c);
  		return $cpl;
	}


}
