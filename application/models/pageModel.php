<?php

class pageModel extends Model {


	public function __construct() {

		parent::__construct();
	}

  public function countAllItems() {
    $data['veda_vedanga'] = $this->countItem("?details.collection.category=Veda+Vedanga");
    $data['shastra'] = $this->countItem("?details.collection.category=Shastra");
    $data['ithihasa_purana'] = $this->countItem("?details.collection.category=Ithihasa+Purana");
    $data['sahithya'] = $this->countItem("?details.collection.category=Sahithya");
    $data['kosha'] = $this->countItem("?details.collection.category=Kosha");
		$data['journal'] = $this->countItemJournal();
    return $data;
  }

  public function countItem($query) {
		$url = API_URL . 'book'.$query;
		$data = $this->getDataFromApi($url);
		$data = json_decode($data, true);
		return sizeof($data);
	}

	public function countItemJournal() {
		$url = API_URL . 'distinct/journal';
		$data = $this->getDataFromApi($url);
		$data = json_decode($data, true);
		return(sizeof($data['values']));
	}

  public function getDataFromApi($url){

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, True);

		$result = curl_exec($curl);
		curl_close($curl);

		return $result;
	}
}


?>
