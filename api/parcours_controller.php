<?php
// Headers 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE');
header('Content-Type: application/json');

include_once('../business-Layer/service/parcours_service.php');
include_once('../data-Layer/model/parcours.php');
include_once('rest_constants.php');

$req_type = $_SERVER['REQUEST_METHOD'];

$parcours_service = new ParcoursService();

switch($req_type)
{
    case Rest::GET:
      if(isset($_GET["id"]) && $_GET["id"] != ' ') {
    
         $parcours_id = $_GET["id"];

         echo $parcours_service->getById($parcours_id);
      } 
      else 
         echo $parcours_service->get();
      break;

    case Rest::POST:

         echo $parcours_service->post(Get_Param());
		 
      break;

    case Rest::PUT:
		
	  	if(isset($_GET["id"]) && $_GET["id"] != ' ') {

			   $parcours_id = $_GET["id"];

			   echo $parcours_service->put($parcours_id,Get_Param());
      } 
      break;
    
    case Rest::DELETE:
	  	if(isset($_GET["id"]) && $_GET["id"] != ' ') {

		  	 $parcours_id = $_GET["id"];

         echo $parcours_service->delete($parcours_id);
      } 
      break;
}

function Get_Param(){
   if(isset($_POST['name']))
       return new Parcours($_POST['name'],$_POST['command']);
   else {
       $jsondata = json_decode(file_get_contents("php://input"), true);
       return new Parcours($jsondata['parcours']['name'],$jsondata['parcours']['command']);
   }
}