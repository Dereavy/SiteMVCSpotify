<?php
include_once "Spotify.php"
class Artist {
	public $imgURL;
 	public $name;
 	public $spotifyId;

 	public function __construct($name, $imgURL, $spotifyId){
 		$this->spotifyId = $spotifyId;
 		$this->imgURL = $imgURL;
 		$this->name = $name;
 	}
}

?>