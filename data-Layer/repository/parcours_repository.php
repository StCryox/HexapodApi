<?php 
# Parcours = course. Hexapod course stored in the DB.

include_once('../data-Layer/config/database.php');
include_once('../data-Layer/model/parcours.php');

  class ParcoursRepository {
 
    private $_conn = null;
    private $_table = 'hexapod';
    private $_parcours_id = null ; 
    private $_parcours_name = null; 
    private $_command = null; 
	
    public function __construct() {
	  $db = new Database();
      $this->_conn =  $db->connect();
    }

	private function getDataToObject($dataFromQuery) {
        
		$num = $dataFromQuery->rowCount();
		$parcours_arr = array();
		
		if($num > 0) {				
			while($row = $dataFromQuery->fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				 $parcours = new Parcours($parcours_id,$parcours_name,$command);
				 array_push($parcours_arr,$parcours);
			}
			return $parcours_arr;
		}
        else 
            return false;
	}
	
	private function exist($value){
		
				  $query = 'SELECT * FROM ' . $this->_table . ' WHERE parcours_id = :parcours_id';

				  $stmt = $this->_conn->prepare($query);
				  
				  $this->_parcours_id = trim($value, '"');

				  $stmt->bindParam(':parcours_id', $this->_parcours_id);

				  $stmt->execute();
				  
				  $num = $stmt->rowCount();
		
		     if($num > 0) return true;
		     else return false;
	}

    public function read() {
   
		 $query = 'SELECT * FROM hexapod';
		 
		 $stmt = $this->_conn->prepare($query);

		 $stmt->execute();

		 return $this->getDataToObject($stmt);
	}
	
	public function readById($parcours_id) {

		 $query = 'SELECT * FROM hexapod WHERE parcours_id = ' . $parcours_id; 

		 $stmt = $this->_conn->prepare($query);

		 $stmt->execute();

		 return $this->getDataToObject($stmt);
    }
	
    public function create($parcours) {
		
		 if($this->exist($parcours->name) != true){
						 
				  $query = 'INSERT INTO ' . $this->_table . ' 
											SET parcours_name = :parcours_name, command = :command';

				  $stmt = $this->_conn->prepare($query);

				  $this->_parcours_name = htmlspecialchars(strip_tags($parcours->name));
				  $this->_command = htmlspecialchars(strip_tags($parcours->command));

				  $stmt->bindParam(':parcours_name', $this->_parcours_name);
				  $stmt->bindParam(':command', $this->_command);

			 if($stmt->execute())
					 return http_response_code();
		 }
    }

    public function update($id,$parcours) {
					
		 if($this->exist($id)){
						 
				  $query = 'UPDATE ' .  $this->_table . '
										SET parcours_name = :parcours_name, command = :command
										WHERE parcours_id = :parcours_id';
				
				  $stmt = $this->_conn->prepare($query);

				  $this->_parcours_id = $id;
				  $this->_parcours_name = htmlspecialchars(strip_tags($parcours->name));
				  $this->_command = htmlspecialchars(strip_tags($parcours->command));

				  $stmt->bindParam(':parcours_id', $this->_parcours_id);
				  $stmt->bindParam(':parcours_name', $this->_parcours_name);
				  $stmt->bindParam(':command', $this->_command);

				  $this->__parcours_id;
				  $this->__parcours_name;
				  $this->__command;

			 if($stmt->execute())
					return http_response_code();
		 }
    }

 
    public function delete($id) {
		
         if($this->exist($id)){
				  $query = 'DELETE FROM ' . $this->_table . ' WHERE parcours_id = :parcours_id';

				  $stmt = $this->_conn->prepare($query);

				  $this->_parcours_id = $id;
				  
				  $stmt->bindParam(':parcours_id', $this->_parcours_id);

			 if($stmt->execute()) 
			 		return http_response_code();
		 }
	}
  }