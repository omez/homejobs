<?php
namespace OmeZ\Bundle\SeasonvarBundle\Grabber;

use GuzzleHttp\Client as HttpClient;

/**
 * Abstract grabber
 * 
 * @author Alexander Sergeychik
 */
abstract class AbstractGrabber {
	
	/**
	 * Http client
	 * 
	 * @var HttpClient
	 */
	protected $httpClient;
	
	/**
	 * Constructs grabber
	 * 
	 * @param HttpClient $httpClient
	 */
	public function __construct(HttpClient $httpClient) {
		$this->httpClient = $httpClient;
	}
	
	/**
	 * Returns client
	 *
	 * @return HttpClient
	 */
	public function getHttpClient() {
		return $this->httpClient;
	}
	
}
