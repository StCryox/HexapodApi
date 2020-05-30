<?php 
# HTTP request type handled : GET -- POST -- PUT -- DELETE 

include_once('../data-Layer/repository/parcours_repository.php');
include_once('../api/rest_constants.php');

  class ParcoursService {
	
	private $parcours_repository = null;

	public function __construct() {
		$this->parcours_repository = new ParcoursRepository();
	  }
	
	private function getServerStatus($status) {
		$server_status = NULL;

		switch ($status) {
			case Rest::HTTP_OK:
				$server_status = $status.' : Requête traitée avec succès';
				break;
			case Rest::HTTP_CREATED:
				$server_status = $status.' : Requête traitée avec succès et création d’un document.';
				break;
			case Rest::HTTP_ACCEPTED:
				$server_status = $status.' : Requête traitée.';
				break;
			case Rest::NOT_MODIFIED:
				$server_status = $status.' : Document non modifié depuis la dernière requête.';
				break;
			case Rest::BAD_REQUEST:
				$server_status = $status.' : La syntaxe de la requête est erronée.';
				break;
			case Rest::NOT_FOUND:
				$server_status = $status.' : Ressource non trouvée.';
				break;	
			case Rest::NOT_ALOWED:
				$server_status = $status.' : Méthode de requête non autorisée.';
				break;
			case Rest::CONFLICT:
				$server_status = $status.' : La requête ne peut être traitée en l’état actuel.';
				break;
			case Rest::PRECONDITION_FAILED:
				$server_status = $status.' : Préconditions envoyées par la requête non vérifiées.';
				break;
			case Rest::INTERNAL_ERROR:
				$server_status = $status.' : Erreur interne du serveur.';
				break;					
		}
		return $server_status;
	}
	
	public function get() {
		$results = $this->parcours_repository->read();
		
	   if($results != false) {
			return json_encode($results);	
	   }
        else {
            return json_encode(
                array('message' => 'Parcours non trouver')
            );
        }
	}

	public function getById($id) {
		$results = $this->parcours_repository->readById($id);

	   if($results != false) {
			foreach ($results as $parcours) {
				return json_encode($parcours);  
			}	
	   }
        else {
            return json_encode(
                array('message' => 'Parcours non trouver')
            );
        }
	}

	public function post($parcours) {
		$status = $this->parcours_repository->create($parcours);
		return $this->getServerStatus($status);
	}

	public function put($id,$parcours) {
		$status = $this->parcours_repository->update($id,$parcours);
		return $this->getServerStatus($status);
	}

	public function delete($id) {
		$status = $this->parcours_repository->delete($id);
		return $this->getServerStatus($status);
	}
	
  }