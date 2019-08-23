<?php  class DBController {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "atm-toys";
	private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
  if (empty(getenv("DATABASE_URL"))){
      try {
      $conn = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->user, $this->password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
          echo "Connection Error: {$e->getMessage()}";
      }
  }  else {
    $db = parse_url(getenv("DATABASE_URL"));
    $conn = new PDO("pgsql:" . sprintf(
        "host=%s;port=%s;user=%s;password=%s;dbname=%s",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
    ));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

//		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function runQuery($query) {
            $result = $this->conn->prepare($query);
            if ($result->execute()) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $resultset[] = $row;
            }
            if (!empty($resultset)) {
                return $resultset;
            }
            } else {
                die($result->error);
            }
//		$result = mysqli_query($this->conn,$query);
//		while($row=mysqli_fetch_assoc($result)) {
//			$resultset[] = $row;
//		}		
//		if(!empty($resultset))
//			return $resultset;
	}
	
	function numRows($query) {
            $result = $this->conn->prepare($query);
            if ($result->execute()) {
            $rowcount = $result->rowCount();
            return $rowcount;
            } else {
                die($result->error);
            }
//            $result  = mysqli_query($this->conn,$query);
//		$rowcount = mysqli_num_rows($result);
//		return $rowcount;	
	}
        
        function add($query, $name, $code, $image, $price) {
           $result = $this->conn->prepare($query);
           $result->bindParam(':name', $name);
           $result->bindParam(':code', $code);
           $result->bindParam(':image', $image);
           $result->bindParam(':price', $price);
           if ($result->execute()) {
               return true;
           }
           return $result->error;
//            $result = mysqli_query($this->conn, $query);
//            return $result;
        }
        
        function printError() {
            return mysqli_error($this->conn);
        }
}
	

// $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=atm-toys', 'root', '');
//		echo "done";
//		$db = parse_url(getenv("DATABASE_URL"));
//		$pdo = new PDO("pgsql:" . sprintf(
//		    "host=%s;port=%s;user=%s;password=%s;dbname=%s",
//		    $db["host"],
//		    $db["port"],
//		    $db["user"],
//		    $db["pass"],
//		    ltrim($db["path"], "/")
//		));
//		
//		$sql = "SELECT * FROM tblproduct";
//		$stmt = $pdo->prepare($sql);
//		//Thi?t l?p ki?u d? li?u tr? v?
//		$stmt->setFetchMode(PDO::FETCH_ASSOC);
//		$stmt->execute();
//		$resultSet = $stmt->fetchAll();
//				
//	
//		  
//			foreach ($resultSet as $row) {
//			echo '<li>' .
//				$row['product'] . ' --' . $row['tblproduct'] 
//				. '</li>';
//			}
//		
//            $db_connection = pg_connect("host=localhost dbname=dcf3epem6n9n41 user=umdtkojayrzqbv password=");
//            $result = pg_query($db_connection, "SELECT * FROM tblproduct");
//            $myPDO = new PDO('pgsql:host=localhost;dbname=atm-toys', 'root', '');
//            $result = $myPDO->query("SELECT * FROM tblproduct");


 ?>

