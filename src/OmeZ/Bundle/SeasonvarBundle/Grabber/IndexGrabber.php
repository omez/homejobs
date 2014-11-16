<?php
namespace OmeZ\Bundle\SeasonvarBundle\Grabber;

use Symfony\Component\DomCrawler\Crawler;

class IndexGrabber extends AbstractGrabber {

	const ROOT_URL = 'http://seasonvar.ru';
	
	
	protected function fetchIndexPage() {
		$httpClient = $this->getHttpClient();
		$response = $httpClient->get(self::ROOT_URL);
		
		return $response->getBody();
	}
	
	
	public function getShows() {
		
		$crawler = new Crawler(null, self::ROOT_URL);
		$crawler->addHtmlContent((string)$this->fetchIndexPage(), 'utf-8');
		
		$fetch = array('_text', 'href', 'data');
		$info = $crawler->filter('a[data^="/serialinfo/"]')->extract($fetch);
		
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
				'season_id' => (int)$id,
				'title' => trim($data['_text']),
				'href' => $data['href']
			);
		}
		
		return $shows;
	}
	

	public function getLatestUpdates() {
		
		$crawler = new Crawler(null, self::ROOT_URL);
		$crawler->addHtmlContent((string)$this->fetchIndexPage(), 'utf-8');
		
		$info = $crawler->filter('a.film-list-item-link')->extract(array('_href'));
		
		
	}
	
	
}
