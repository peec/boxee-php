<?php
namespace com\boxee\helpers;

/**
 * A movie name normaizer.
 * Basic algorithm to remove garbage from a movie title ( file name ),
 * you can then pass it to a movie API like IMDB.
 * 
 * @author Petter Kjelkenes <kjelkenes@gmail.com>
 *
 */
class MovieNameNormalizer{
	
	private $raw;

	// End signal.
	const END = '_____END';
	
	/**
	 * Array of skip parts meeting "end of title".
	 * We allways expect title to be first.
	 * @var array
	 */
	private $end_of_title =  array(
			'/(uncut|r5|dvdrip|dvd|rip|\[|\()/i', 
			'year' => '/(\d{4})/', 
			'/(\[.*?\])/'
			);
	
	/**
	 * Constructs the object.
	 * @param string $movieName The movie name ( file name of the movie file )
	 */
	public function __construct($movieName){
		$this->raw = strtolower($movieName);
	}
	
	/**
	 * Tries to find movie name and year.
	 * Returns array of 
	 * array(
	 * 		moviename,
	 * 		year or NULL if not found
	 * )
	 */
	public function parse(){
		$title = $this->raw;
		foreach($this->end_of_title as $method => $regexp){
			preg_match($regexp, $this->raw, $matches);
			switch($method){
				case 'year':
					if (isset($matches[1]))$year = $matches[1];
					break;
			}
			if (isset($matches[1])){
				$title = preg_replace($regexp, self::END, $title);
			}
		}
		
		$bits = explode(self::END, $title);
		$name = str_replace(array('-','.','_'), ' ', trim($bits[0],"., \n\r\t-_[]()"));
		return array('t' => $name, 'y' =>(isset($year) ? $year : null));
	}
	
}

