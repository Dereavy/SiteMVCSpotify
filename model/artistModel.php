<?php

include_once("model/classes/Spotify.php");

class artistModel {
	public function getArtistList($search=" ", $page=1)
	{
// Retourne tout les artistes correspondant a la recherche
		return Spotify::searchArtist($search, $page);
	}
	
	public function getArtist($id)
	{
		$allBooks = $this->getArtistList();
		return $allArtists[$id];
	}
	
	
}

?>