<?php
require_once "cred.php";

date_default_timezone_set('Europe/London');

spl_autoload_register(function ($class) {
    $class = strtolower($class);
    include_once('class.' . $class . '.php');
});
class Customer{

  public $id;
  public $number;
  public $queueID;
  public $token;

    public function __construct($id){
    $mysqli = new mysqli(G::$host, G::$user, G::$pass, "qr");
        $res = $mysqli->query("SELECT * FROM `customers` WHERE id =".$id);
	while ($row = mysqli_fetch_array($res))
	{
            $this->id = $row['id'];
            $this->number = $row['number'];
            $this->queueID = $row['queue_id'];
            $this->token = $row['token'];
        }
    }
    public static function create($queueID, $number){
    $mysqli = new mysqli(G::$host, G::$user, G::$pass, "qr");
        //$token = md5($token.$number);
        $sql = "INSERT INTO `customers`(`number`, `queue_id`) VALUES($number, $queueID)";
        $mysqli->query($sql);
        return $mysqli->insert_id;
    }

    public function getQueueID(){
      return $this->queueID;
    }

    public function getNumber(){
      return $this->number;
    }
}

?>
