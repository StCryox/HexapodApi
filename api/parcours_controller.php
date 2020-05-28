<?php
// Headers 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE');
header('Content-Type: application/json');

include_once('../config/database.php');
include_once('../service/service.php');
include_once('../model/parcours.php');

$db = new Database();
$dbConn = $db->connect();

$service = new ParcoursService($dbConn);

$req_type = $_SERVER['REQUEST_METHOD'];

switch($req_type)
{
    case 'GET' :
		 
      if(isset($_GET["id"]) && $_GET["id"] != ' ') {
    
        $parcours_id = $_GET["id"];
    
        $query = 'SELECT * FROM hexapod WHERE parcours_id = ' . $parcours_id;
    
        echo $service->read($query);
      } 
      else if (isset($_GET["name"]) && $_GET["name"] != ' ')
      {
        $parcours_name = $_GET["name"];
    
        $query = "SELECT * FROM hexapod WHERE parcours_name = '" . $parcours_name . "'";

        echo $service->read($query);
      }
      else {

        $query = 'SELECT * FROM hexapod';

        echo $service->read($query);
      }
    
        break;

    case 'POST' :

		 echo $service->create(JSON_Param());
		 
        break;

    case 'PUT' :
		
		if(isset($_GET["id"]) && $_GET["id"] != ' ') {

			   $parcours_id = $_GET["id"];

			   echo $service->update($parcours_id,JSON_Param());
      } 
      else if (isset($_GET["name"]) && $_GET["name"] != ' ')
      {
         $parcours_name = $_GET["name"];

			   echo $service->update($parcours_name,JSON_Param());
      }
      else {
        echo "Choisir un parcours a modifier";
      }
	
        break;
    
    case 'DELETE' :
		if(isset($_GET["id"]) && $_GET["id"] != ' ') {

		  	 $parcours_id = $_GET["id"];

			   echo $service->delete($parcours_id);
      } 
      else if (isset($_GET["name"]) && $_GET["name"] != ' ')
      {
         $parcours_name = $_GET["name"];

         echo $service->delete($parcours_name); 
      }
      else {
         echo "Choisir un parcours a supprimer";
      }
          break;
}

function JSON_Param(){
   $jsondata = json_decode(file_get_contents("php://input"), true);
   echo $jsondata;
  //return new Parcours($jsondata->parcours[0]->name,$jsondata->parcours[0]->command);
  //return new Parcours($jsondata->parcours->name,$jsondata->parcours->command);
}