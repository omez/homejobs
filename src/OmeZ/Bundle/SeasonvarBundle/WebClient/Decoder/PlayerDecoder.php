<?php
namespace OmeZ\Bundle\SeasonvarBundle\WebClient\Decoder;

use Symfony\Component\Process\Process;

/**
 * Decodes seasonvar "security" javascripts
 * 
 * @author Alexander Sergeychik
 */
class PlayerDecoder {

	protected $executable = 'node';
	
	/**
	 * Constructs decoder
	 * 
	 * @param string $nodeExecutable
	 */
	public function __construct($nodeExecutable = null) {
		if ($nodeExecutable !== null) {
			$this->executable = $nodeExecutable;
		}	
	}
	
	/**
	 * Decodes javascript evaluation code
	 * 
	 * @param string $javascript
	 * @return string
	 */
	public function decode($javascript) {
		
		$command = sprintf('%s %s %s', $this->executable, __DIR__ . '/decode.js', escapeshellarg($javascript));
		
		$process = new Process($command);
		$process->run();
		
		$decodedJavascript = $process->getOutput();
		
		return $decodedJavascript;
	}
	
}
