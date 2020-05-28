<?php 
# Parcours = course. Hexapod course stored in the DB.
# HTTP request type handled : GET -- POST -- PUT -- DELETE 

  class ParcoursService {
 
    private $_conn = null;
    private $_table = 'hexapod';
    private $_parcours_id = null ; 
    private $_parcours_name = null; 
    private $_command = null; 
	
    public function __construct($db) {
      $this->_conn = $db;
    }

    private function getDataToJSON($dataFromQuery) {
        
        $num = $dataFromQuery->rowCount();
		
        if($num > 0) {
            $parcours_arr = array();
            $parcours_arr['parcours'] = array();

            while($row = $dataFromQuery->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $parcours_item = array(
                    'Id'       => $parcours_id,
                    'Nom'      => $parcours_name,
                    'Commande' => $command
                );
				
                array_push($parcours_arr['parcours'],$parcours_item);
            }

            return json_encode($parcours_arr);    
        }
        else {
            return json_encode(
                array('message' => 'Parcours non trouver')
            );
        }
    }
	
	private function exist($value){
		
				  $query = 'SELECT * FROM ' . $this->_table . ' WHERE parcours_name = :parcours_id OR parcours_id = :parcours_id';

				  $stmt = $this->_conn->prepare($query);
				  
				  $this->_parcours_id = trim($value, '"');

				  $stmt->bindParam(':parcours_id', $this->_parcours_id);

				  $stmt->execute();
				  
				  $num = $stmt->rowCount();
		
		     if($num > 0) return true;
		     else return false;
	}

    public function read($query) {
   
		 $stmt = $this->_conn->prepare($query);

		 $stmt->execute();

		 return $this->getDataToJSON($stmt);
    }
	
    public function create($parcours) {

		if(empty($parcours)){
			        
			return json_encode(
				array('message' => 'Champs vide !')
			); 
		}	
		else{
		
		 if($this->exist($parcours->name) != true){
						 
				  $query = 'INSERT INTO ' . $this->_table . ' 
											SET parcours_name = :parcours_name, command = :command';

				  $stmt = $this->_conn->prepare($query);

				  $this->_parcours_name = htmlspecialchars(strip_tags($parcours->name));
				  $this->_command = htmlspecialchars(strip_tags($parcours->command));

				  $stmt->bindParam(':parcours_name', $this->_parcours_name);
				  $stmt->bindParam(':command', $this->_command);

			 if($stmt->execute()) {
					return json_encode(
						array('message' => 'Parcours creer !')
					);
			 }
			 else {
					printf("Error: %s.\n", $stmt->error);

					return json_encode(
						array('message' => 'Parcours non creer.')
					);
			 }
		 }
		 else {
		  return json_encode(
					array('message' => 'Parcours existant !')
				);
		 }
		}
    }

    public function update($id_OR_name,$parcours) {

		if(empty($parcours)){
			        
			return json_encode(
				array('message' => 'Champs vide !')
			); 
		}	
		else{
					
		 if($this->exist($id_OR_name)){
						 
				  $query = 'UPDATE ' .  $this->_table . '
										SET parcours_name = :parcours_name, command = :command
										WHERE parcours_id = :parcours_id OR parcours_name = :parcours_value';
				
				echo $query;

			     // UPDATE `hexapod` SET `parcours_name`='toto',`command`='aaaaaa' WHERE `parcours_id`= test OR `parcours_name`='test'; 

				  $stmt = $this->_conn->prepare($query);

				  $this->_parcours_id = $id_OR_name;
				  $parcours_value = trim($id_OR_name, '"');
				  $this->_parcours_name = htmlspecialchars(strip_tags($parcours->name));
				  $this->_command = htmlspecialchars(strip_tags($parcours->command));

				  $stmt->bindParam(':parcours_id', $this->_parcours_id);
				  $stmt->bindParam(':parcours_value', $this->parcours_value);
				  $stmt->bindParam(':parcours_name', $this->_parcours_name);
				  $stmt->bindParam(':command', $this->_command);

				  echo 'testtttt';
				  echo $id_OR_name;
				  echo $this->__parcours_id;
				  echo $this->_parcours_value;
				  echo $this->__parcours_name;
				  echo $this->__command;

			 if($stmt->execute()) {	
					return json_encode(
						array('message' => 'Parcours modifier !')
					);
			 }
			 else {
					printf("Error: %s.\n", $stmt->error);

					return json_encode(
						array('message' => 'Parcours non modifier.')
					);
			 }
		 }
		 else {
			// return trim($id_OR_name, '"');
			 
		  return json_encode(
					array('message' => 'Parcours non existant. ')
				);
		 }	
		}
    }

 
    public function delete($id_OR_name) {
		
         if($this->exist($id_OR_name)){
				  $query = 'DELETE FROM ' . $this->_table . ' WHERE parcours_id = :parcours_id OR parcours_name = :parcours_id';

				  $stmt = $this->_conn->prepare($query);

				  $this->_parcours_id = trim($id_OR_name, '"');
				  
				  $stmt->bindParam(':parcours_id', $this->_parcours_id);

			 if($stmt->execute()) {
					return json_encode(
						array('message' => 'Parcours supprimer !')
					);
			 }
			 else {
					printf("Error: %s.\n", $stmt->error);

					return json_encode(
						array('message' => 'Parcours non supprimer.')
					);
			 }
		 }
		 else {
		  return json_encode(
					array('message' => 'Parcours non existant. ')
				);
		 }	
    }
  }