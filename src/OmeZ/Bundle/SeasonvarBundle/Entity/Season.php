<?php
namespace OmeZ\Bundle\SeasonvarBundle\Entity;

/**
 * Show season description
 * 
 * @author Alexander Sergeychik
 */
class Season {

	/**
	 * The ID
	 * 
	 * @var integer
	 */
	private $id;
	
	/**
	 * Show reference
	 * 
	 * @var Show
	 */
	protected $show;
	
	/**
	 * Season number
	 * 
	 * @var integer
	 */
	protected $number;
		
	/**
	 * Season description
	 * 
	 * @var string
	 */
	protected $description;
	
	/**
	 * Season thumbnail image URL
	 * 
	 * @var string
	 */
	protected $thumbnailUrl;
	
	/**
	 * Season href
	 * 
	 * @var string
	 */
	protected $href;
	
	
	public function getId() {
		return $this->id;
	}

		
	
	
}
