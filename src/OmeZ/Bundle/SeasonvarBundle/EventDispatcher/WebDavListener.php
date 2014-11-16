<?php
namespace OmeZ\Bundle\SeasonvarBundle\EventDispatcher;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Http\HttpUtils;

/**
 * Handles requrest to WebDav
 * 
 * @author Alexander Sergeychik
 */
class WebDavListener {

	/**
	 * Http utils
	 * 
	 * @var HttpUtils
	 */
	protected $httpUtils;
	
	protected $path;

	/**
	 * Handles request to WebDav
	 * 
	 * @param string $path - path or route to bind with
	 */
	public function __construct(HttpUtils $httUtils, $path = null) {
		$this->httpUtils = $httUtils;
		$this->path = $path;
	}
	
	/**
	 * Handles request
	 * 
	 * @param GetResponseEvent $event
	 */
	public function handleRequest(GetResponseEvent $event) {
		if (!$this->path) return;
		if (!$this->httpUtils->checkRequestPath($request, $path)) return;
		
		// get server and execute
		$rootDirectory = new DAV\FS\Directory(__DIR__ . '/../tmp');
		
		$server = new DAV\Server($rootDirectory);
		
		$lockBackend = new DAV\Locks\Backend\File('data/locks');
		$lockPlugin = new DAV\Locks\Plugin($lockBackend);
		$server->addPlugin($lockPlugin);
		
		$server->exec();
		
	}
	
}
