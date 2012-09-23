<?php
namespace com\boxee\helpers;

/**
 * Communicates with http://www.imdbapi.com
 * Thanks to this API!
 * 
 * @author Petter Kjelkenes <kjelkenes@gmail.com>
 *
 */
class IMDB{
	
	/**
	 * Gets imdb info of a filename ( can be denormalized with full of junk info )
	 * @param unknown_type $filename
	 * @return com\boxee\helpers\IMDBResult Returns null on failure.
	 */
	static public function getFileInfo($filename){
		$m = new MovieNameNormalizer($filename);
		$i = $m->parse();
		return self::getInfo($i['t'], $i['y']);
	}
	
	/**
	 * Gets imdb info of exact tile and optionally year.
	 * Returns null on failure.
	 * @param unknown_type $name
	 * @param unknown_type $year
	 * @return com\boxee\helpers\IMDBResult
	 */
	static public function getInfo($name, $year = null){
		$args['t'] = $name;
		if ($year !== null)$args['y'] = $year;
		
		$args = http_build_query($args);
		if ($json = @file_get_contents(sprintf('http://www.imdbapi.com/?%s', $args))){
			$data = json_decode($json);
			if ($data->Response == 'True'){
				$res = new IMDBResult();
				$res->title = $data->Title;
				$res->year = $data->Year;
				$res->rated = $data->Rated;
				$res->released = $data->Released;
				$res->runtime = $data->Runtime;
				$res->genre = $data->Genre;
				$res->director = $data->Director;
				$res->writer = $data->Writer;
				$res->actors = $data->Actors;
				$res->plot = $data->Plot;
				$res->poster = $data->Poster;
				$res->imdbRating = $data->imdbRating;
				$res->imdbVotes = $data->imdbVotes;
				$res->imdbID = $data->imdbID;
				return $res;
			}else{
				return null;
			}
		}
		return null;
	}
	
	
}


class IMDBResult{
	public $title;
	public $year;
	public $rated;
	public $released;
	public $runtime;
	public $genre;
	public $director;
	public $writer;
	public $actors;
	public $plot;
	public $poster;
	public $imdbRating;
	public $imdbVotes;
	public $imdbID;
}
