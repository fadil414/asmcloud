<?php // class DBController {
//	private $host = "localhost";
//	private $user = "root";
//	private $password = "";
//	private $database = "atm-toys";
//	private $conn;
//	
//	function __construct() {
//		$this->conn = $this->connectDB();
//	}
//	
//	function connectDB() {
//		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
//		return $conn;
//	}
//	
//	function runQuery($query) {
//		$result = mysqli_query($this->conn,$query);
//		while($row=mysqli_fetch_assoc($result)) {
//			$resultset[] = $row;
//		}		
//		if(!empty($resultset))
//			return $resultset;
//	}
//	
//	function numRows($query) {
//		$result  = mysqli_query($this->conn,$query);
//		$rowcount = mysqli_num_rows($result);
//		return $rowcount;	
//	}
//        
//        function add($query) {
//            $result = mysqli_query($this->conn, $query);
//            return $result;
//        }
//        
//        function printError() {
//            return mysqli_error($this->conn);
//        }
//}

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
//  }


   
$dbconn = pg_connect("host=localhost port=5432 dbname=dcf3epem6n9n41 user=umdtkojayrzqbv password=");
//connect to a database named "postgres" on the host "host" with a username and password
 
if (!$dbconn){
echo "<center><h1>Doesn't work =(</h1></center>";
}else
 echo "<center><h1>Good connection</h1></center>";
pg_close($dbconn);
$conn = pg_connect("host=postgres.jelastic.com port=5432 dbname=postgres user=webadmin password=passw0rd");
if (!$conn) {
 echo "An error occurred.\n";
 exit;
}
 
$result = pg_query($conn, "SELECT * FROM test_table");
if (!$result) {
 echo "An error occurred.\n";
 exit;
}
 
while ($row = pg_fetch_row($result)) {
 echo "value1: $row[0]  value2: $row[1]";
 echo "<br />\n";
}

?>