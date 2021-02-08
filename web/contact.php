<?php
require('config.php');
class Contact extends Dbconfig {	
    protected $hostName;
    protected $userName;
    protected $password;
	protected $dbName;
	private $contactTable = 'contacts';
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 		
			$database = new dbConfig();            
            $this -> hostName = $database -> serverName;
            $this -> userName = $database -> userName;
            $this -> password = $database ->password;
			$this -> dbName = $database -> dbName;			
            $conn = new mysqli($this->hostName, $this->userName, $this->password, $this->dbName);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            } else{
                $this->dbConnect = $conn;
                die();
            }
        }
    }
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}   	
	public function contactList(){		
		$sqlQuery = "SELECT * FROM ".$this->contactTable." ";
		if(!empty($_POST["search"]["value"])){
			$sqlQuery .= 'where(id LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR name LIKE "%'.$_POST["search"]["value"].'%" ';			
			$sqlQuery .= ' OR email LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR phone LIKE "%'.$_POST["search"]["value"].'%" ';
			$sqlQuery .= ' OR title LIKE "%'.$_POST["search"]["value"].'%") ';			
		}
		if(!empty($_POST["order"])){
			$sqlQuery .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$sqlQuery .= 'ORDER BY id DESC ';
		}
		if($_POST["length"] != -1){
			$sqlQuery .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}	
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		
		$sqlQuery1 = "SELECT * FROM ".$this->contactTable." ";
		$result1 = mysqli_query($this->dbConnect, $sqlQuery1);
		$numRows = mysqli_num_rows($result1);
		
		$contactData = array();	
		while( $contact = mysqli_fetch_assoc($result) ) {		
			$contactRows = array();			
			$contactRows[] = $contact['id'];
			$contactRows[] = ucfirst($contact['name']);
			$contactRows[] = $contact['email'];		
			$contactRows[] = $contact['phone'];	
			$contactRows[] = $contact['title'];
			$contactRows[] = $contact['time'];					
			$contactRows[] = '<button type="button" name="update" id="'.$contact["id"].'" class="btn btn-warning btn-xs update">Update</button>';
			$contactRows[] = '<button type="button" name="delete" id="'.$contact["id"].'" class="btn btn-danger btn-xs delete" >Delete</button>';
			$contactData[] = $contactRows;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"  	=>  $numRows,
			"recordsFiltered" 	=> 	$numRows,
			"data"    			=> 	$contactData
		);
		echo json_encode($output);
	}
	public function getContact(){
		if($_POST["contactId"]) {
			$sqlQuery = "
				SELECT * FROM ".$this->contactTable." 
				WHERE id = '".$_POST["contactId"]."'";
			$result = mysqli_query($this->dbConnect, $sqlQuery);	
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			echo json_encode($row);
		}
	}
	public function updateContact(){
		if($_POST['contactId']) {	
			$updateQuery = "UPDATE ".$this->contactTable." 
			SET name = '".$_POST["contactName"]."', email = '".$_POST["contactEmail"]."', phone = '".$_POST["contactPhone"]."', title = '".$_POST["contactTitle"]."' , time = '".$_POST["contactTime"]."'
			WHERE id ='".$_POST["contactId"]."'";
			$isUpdated = mysqli_query($this->dbConnect, $updateQuery);		
		}	
	}
	public function addContact(){
		$insertQuery = "INSERT INTO ".$this->contactTable." (name, email, phone, title, time) 
			VALUES ('".$_POST["contactName"]."', '".$_POST["contactEmail"]."', '".$_POST["contactPhone"]."', '".$_POST["contactTitle"]."', '".$_POST["contactTime"]."')";
		$isUpdated = mysqli_query($this->dbConnect, $insertQuery);		
	}
	public function deleteContact(){
		if($_POST["contactId"]) {
			$sqlDelete = "
				DELETE FROM ".$this->contactTable."
				WHERE id = '".$_POST["contactId"]."'";		
			mysqli_query($this->dbConnect, $sqlDelete);		
		}
	}
}
?>