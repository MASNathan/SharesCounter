<?php

namespace MASNathan\Social;

/**
 * SharesCounter - Retrieves the number of shares from a certain social network
 * 
 * @author André Filipe <andre.r.flip@gmail.com>
 * @link https://github.com/ReiDuKuduro/SharesCounter github repository
 * @version 1.0
 */
class SharesCounter extends \APIcaller {

    /**
     * Url of the page you want to get the number of shares
     * @var string
     */
	private $url = '';

	/**
	 * Class constructor
	 * @param string $url URL that you want to "spy"
	 */
	public function __construct($url)
	{
		$this->url = $url;
	}

	/**
	 * Returns the number of shares on twiter
	 * @return integer
	 */
	public function getTwitter()
	{
		$data = $this->setMethod(parent::METHOD_GET)
				->setUrl('https://cdn.api.twitter.com/')
				->setFormat(parent::CONTENT_TYPE_JSON)
				->call('1/urls/count.json', array('url' => $this->url));

		return (int) $data['count'];
	}

	/**
	 * Returns the number of shares on facebook
	 * @return integer
	 */
	public function getFacebook()
	{
		$data = $this->setMethod(parent::METHOD_GET)
				->setUrl('http://graph.facebook.com/')
				->setFormat(parent::CONTENT_TYPE_JSON)
				->call('', array('id' => $this->url));

		return (int) $data['shares'];
	}

	/**
	 * Returns the number of shares on google plus
	 * @return integer
	 */
	public function getGooglePlus()
	{
		$params = array(
			"method"     => "pos.plusones.get",
		    "id"         => "p",
		    "params"     => array(
		    	"nolog"   => true,
		        "id"      => $this->url,
		        "source"  => "widget",
		        "userId"  => "@viewer",
		        "groupId" => "@self"
		    ),
		    "jsonrpc"    => "2.0",
		    "key"        => "p",
		    "apiVersion" =>"v1"
		);
		
		$data = $this->setMethod(parent::METHOD_POST)
				->setUrl('https://clients6.google.com/rpc')
				->setFormat(parent::CONTENT_TYPE_JSON)
				->call('', $params, parent::CONTENT_TYPE_JSON);

		return isset($data['result']['metadata']['globalCounts']['count']) ? intval($data['result']['metadata']['globalCounts']['count']) : 0;
	}

	/**
	 * Returns the number of shares on linkedin
	 * @return integer
	 */
	public function getLinkedIn()
	{
		$data = $this->setMethod(parent::METHOD_GET)
				->setUrl('http://www.linkedin.com/')
				->setFormat(parent::CONTENT_TYPE_JSON)
				->call('countserv/count/share', array('format' => 'json', 'url' => $this->url));

		return (int) $data['count'];
	}

	/**
	 * Returns the number of shares on pinterest
	 * @return integer
	 */
	public function getPinterest()
	{
		$data = $this->setMethod(parent::METHOD_GET)
				->setUrl('http://api.pinterest.com/')
				->setFormat(parent::CONTENT_TYPE_NONE)
				->call('v1/urls/count.json', array('callback' => 'a', 'url' => $this->url));
		$data = json_decode(trim($data, "a()"), true);

		return (int) $data['count'];
	}

	/**
	 * Returns the number of shares on stumbleupon
	 * @return integer
	 */
	public function getStumbleUpon()
	{
		$data = $this->setMethod(parent::METHOD_GET)
				->setUrl('http://www.stumbleupon.com/')
				->setFormat(parent::CONTENT_TYPE_JSON)
				->call('services/1.01/badge.getinfo', array( 'url' => $this->url));

		return (int) $data['result']['views'];
	}
}
