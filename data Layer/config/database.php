<?PHP
class Database
{
	private $_host = 'localhost';
	private $_db_name = 'Hexapode';
	private $_username = 'root';
	private $_pwd = '';
	private $_conn;
	
	public function connect(){
		$this->_conn=null;
		
		try {
			$this->_conn = new PDO('mysql:host=' . $this->_host . ';dbname=' . $this->_db_name, $this->_username, $this->_pwd);
			$this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOexception $error){
			echo 'Erreur de connexion :' . $error->getMessage();
		}
		return $this->_conn;
	}
}

