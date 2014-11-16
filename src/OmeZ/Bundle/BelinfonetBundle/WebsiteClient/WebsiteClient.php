<?php
namespace OmeZ\Bundle\BelinfonetBundle\WebsiteClient;

use GuzzleHttp\Client as HttpClient;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Website crawler
 *
 * @author Alexander Sergeychik
 */
class WebsiteClient {
	
	const SITE_ROOT = 'https://www.adsl.by/001.htm';

	/**
	 * Client
	 *
	 * @var HttpClient
	 */
	protected $httpClient;

	protected $username;

	protected $password;

	public function __construct(HttpClient $httpClient, $username = null, $password = null) {
		
		$this->setHttpClient($httpClient);
		$this->setCredentials($username, $password);
	}

	/**
	 * @return HttpClient
	 */
	public function getHttpClient() {
		return $this->httpClient;
	}

	public function setHttpClient(HttpClient $client) {
		$this->httpClient = $client;
	}

	public function setCredentials($username, $password) {
		$this->username = $username;
		$this->password = $password;
		return $this;
	}
	
	public function getAccountInfo() {
		
		$client = $this->getHttpClient();
		
		$options = array();
		
		if ($this->username && $this->password) {
			$options['auth'] = array($this->username, $this->password);
		}
		
		$res = $client->get('https://www.adsl.by/001.htm', $options);
		
		if ($res->getStatusCode() != 200) {
			throw new Exception('Unable to fetch page');
		}
		
		$crawler = new Crawler($res->getBody()->getContents(), $res->getEffectiveUrl());

		$accountNode = $crawler->filter('div.your_acaunt');
		
		$info = array();
		
		
		$idString = $accountNode->filter('h2 > span')->first()->text();
		
		$idString = trim($idString, '()');
		if (preg_match('/^ID:(\d+)$/', $idString, $found)) {
			$info['id'] = $found[1];
		} else {
			throw new Exception('Unable to fetch account ID');
		}
		
		$infoTable = $accountNode->filter('table tr')->each(function(Crawler $node, $i) use (&$info) {
			
			$type = trim($node->filter('td')->first()->text());
			$data = trim($node->filter('td')->last()->text());
			
			switch ($type) {
				case 'Аккаунт': 
					if ($data == 'Включен') {
						$info['enabled'] = true;
					} elseif ($data == 'Вылючен') {
						$info['enabled'] = false;
					} else {
						throw new Exception('Unable to parse activity status');
					}
					break;
					
				case 'Осталось трафика на сумму': 
					$data = preg_replace('/[^\d-]/', '', $data);
					$info['balance'] = (int)$data; 
					break;
			}
			
		});
		
		return $info;
	}

	
	public function reactivate() {
		
		$client = $this->getHttpClient();
		$options = array();
		if ($this->username && $this->password) {
			$options['auth'] = array($this->username, $this->password);
		}
		
		$options['query'] = array(
			'credit' => 'on',
			'_' => '1414699709705',
		);
		
		$res = $client->get('https://www.adsl.by/credit.js', $options);
		
		if ($res->getStatusCode() !== 200) {
			throw new Exception('Unable to renew balance');
		}	
	}
	
	
}
