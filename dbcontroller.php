<?php class DBController {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "atm-toys";
	private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
        
        function add($query) {
           $result = mysqli_query($this->conn, $query);
            return $result;
        }
        
        function printError() {
            return mysqli_error($this->conn);
        }
}

//if (empty(getenv("DATABASE_URL"))){
//      $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=atm-toys', 'root', '');
//  }  else {
//    $db = parse_url(getenv("DATABASE_URL"));
//    $pdo = new PDO("pgsql:" . sprintf(
//        "host=%s;port=%s;user=%s;password=%s;dbname=%s",
//        $db["host"],
//        $db["port"],
//        $db["user"],
//        $db["pass"],
//        ltrim($db["path"], "/")
//    ));
// }


  
?>