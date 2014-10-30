<?php
namespace OmeZ\Bundle\BelinfonetBundle\Service;

use Symfony\Component\BrowserKit\Client;

/**
 * Website crawler
 * 
 * @author Alexander Sergeychik
 */
class WebsiteCrawler {

	const SITE_ROOT = 'https://www.adsl.by/001.htm';
	
	/**
	 * Client
	 * 
	 * @var Client
	 */
	protected $httpClient;
	
	protected $username;
	protected $password;
	
	public function __construct($httpClient, $username, $password) {
		
		$this->setHttpClient($httpClient);
		$this->setCredentials($username, $password);
	}
	
	
	public function getHttpClient() {
		return $this->httpClient;
	}
	
	public function setHttpClient(Client $client) {
		$this->httpClient = $client;
	}
	
	public function setCredentials($username, $password) {
		$this->username = $username;
		$this->password = $password;
		return $this;
	}

	
	public function isRequiresCredit() {

		$client = $this->getHttpClient();
		
		
	}
	
	
}
