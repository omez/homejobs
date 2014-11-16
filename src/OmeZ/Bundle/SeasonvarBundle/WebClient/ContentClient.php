<?php
namespace OmeZ\Bundle\SeasonvarBundle\WebClient;

use GuzzleHttp\Client as HttpClient;
use Symfony\Component\DomCrawler\Crawler;
use Doctrine\Common\Cache\Cache;
use GuzzleHttp\Subscriber\Cache\CacheSubscriber;
use GuzzleHttp\Subscriber\Cache\CacheStorage;

/**
 * Seasonvar content client
 * 
 * @author Alexander Sergeychik
 */
class ContentClient {

	/**
	 * Caching backend
	 * 
	 * @var Cache
	 */
	protected $cacheBackend = null;
	
	/**
	 * HTTP Client
	 * 
	 * @var HttpClient
	 */
	protected $client;
	
	/**
	 * Constructs client
	 * 
	 * @param HttpClient $httpClient
	 */
	public function __construct(Cache $cacheBackend = null) {
		$this->cacheBackend = $cacheBackend;
	}
	
	/**
	 * Returns client
	 * 
	 * @return HttpClient
	 */
	public function getHttpClient() {
		if (!$this->client) {
			
			$client = new HttpClient(array(
				'base_url' => 'http://seasonvar.ru',
				'defaults' => array(
					//'debug' => true
				)
			));
			
			if ($this->cacheBackend) {
				CacheSubscriber::attach($client, array(
					'storage' => new CacheStorage($this->cacheBackend, '__seasonvar')
				));
			}
			
			$this->client = $client;
		}
		return $this->client;
	}
	
	/**
	 * Returns show list
	 * 
	 * @return array - list of available shows
	 */
	public function getShowList() {
		
		$cacheKey = 'shows_list';
		
		if ($this->cacheBackend) {
			$data = $this->cacheBackend->fetch($cacheKey);
			if ($data !== false) return $data;
		}
		
		
		// fetch listing
		$client = $this->getHttpClient();
		$response = $client->get('index.php?onlyjanrnew=all&sortto=name&country=all');
		
		$html = (string)$response->getBody();
		
		$crawler = new Crawler(null, 'http://seasonvar.ru/');
		$crawler->addHtmlContent($html, 'UTF-8');	
		
		$fetch = array('_text', 'href', 'data');
		$info = $crawler->filter('a')->extract($fetch);
		
		$shows = array();
		
		foreach ($info as $data) {
			$data = array_combine($fetch, $data);
			if (empty($data['_text']) || empty($data['href'])) continue;
			
			$id = null;
			if (!empty($data['data']) && preg_match('/^\\/serialinfo\\/(\d+)$/', $data['data'], $matches)) {
				$id = $matches[1];
			} elseif (!empty($data['href']) && preg_match('/^\\/serial\-(\d+)/', $data['href'], $matches)) {
				$id = $matches[1];
			}
			
			$shows[(int)$id] = array(
				'id' => (int)$id,
				'title' => trim($data['_text']),
				'href' => $data['href']
			);
		}		
		
		if ($this->cacheBackend) {
			$this->cacheBackend->save($cacheKey, $shows);
		}
		
		return $shows;
	}
	
	/**
	 * Returs information about show
	 * 
	 * @param string $id
	 * @return array - meta information about show
	 */
	public function getShowInfo($id) {
		
		$list = $this->getShowList();
		
		if (empty($list[$id])) {
			return false;
		} 
		
		$info = array(
			'title' => $list[$id]['title'],				
		);
		
		return $info;
	}
	
	
	public function getSecurityCode() {
		
	}
	
}