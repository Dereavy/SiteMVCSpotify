<?php
include_once("model/artistModel.php");

class Controller {
	public $model;
	
	public function __construct()  
    {  
        $this->model = new artistModel();
    } 

	public function invoke()
	{
		if (!isset($_GET['search']))
		{
			// aucun artis
			$artist = $this->model->getArtistList($_GET['search']);
			include 'view/artistsearch.php';
		}
		else
		{
			// show the requested artist
			$artist = $this->model->getArtist($_GET['artist']);
			include 'view/artistlist.php';
		}
	}
}

?>