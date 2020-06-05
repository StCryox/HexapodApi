<?php
// Headers 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE');
header('Content-Type: application/json');

include_once('../business-Layer/service/parcours_service.php');
include_once('../data-Layer/model/parcours.php');
include_once('rest_constants.php');

class API {

    private $_parcours_service = null;
    private $_method = '';
    private $_parcours_id = '';
  
    public function __construct() {
        $this->_parcours_service = new ParcoursService();
        $this->run();
    }

    private function run() {
        $this->_method = $this->get_request_method();

        switch($this->_method){
            case Rest::GET:
                if(isset($_GET["id"]) && $_GET["id"] != ' ') {
                    $this->_parcours_id = $_GET["id"];

                    echo $this->_parcours_service->getById($this->_parcours_id);
                } 
                else 
                    echo $this->_parcours_service->get();
            break;

            case Rest::POST:
                    echo $this->_parcours_service->post($this->Get_Param()); 
            break;

            case Rest::PUT:
                if(isset($_GET["id"]) && $_GET["id"] != ' ')
                    $this->_parcours_id = $_GET["id"];

                    echo $this->_parcours_service->put($this->_parcours_id,$this->Get_Param());
            break;

            case Rest::DELETE:
                if(isset($_GET["id"]) && $_GET["id"] != ' ') 
                    $this->_parcours_id = $_GET["id"];

                    echo $this->_parcours_service->delete($this->_parcours_id);
            break;
        }
    }

    private function get_request_method(){
        return $_SERVER['REQUEST_METHOD'];
    }

    private function Get_Param(){

        if($jsondata = json_decode(file_get_contents("php://input"), true))
           {
              return new Parcours($jsondata['parcours']['name'],$jsondata['parcours']['command']);
           }
        else 
        { 
           return new Parcours(null,null);
        }
    }
}

$api = new API();