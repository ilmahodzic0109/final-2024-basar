<?php
require_once dirname(__FILE__)."/../config.php";
class ExamDao {

    private $conn;

  
    public function beginTransaction() {
       $this->conn->beginTransaction();
    }
  
    public function commit() {
      $this->conn->commit();
    }
  
    public function rollback() {
       $this->conn->rollBack();
    }

    /**
     * constructor of dao class
     */
    public function __construct(){
        try {
          /** TODO
           * List parameters such as servername, username, password, schema. Make sure to use appropriate port
           */

          $this->conn = new PDO("mysql:host=" . Config::DB_HOST() . ";dbname=" . Config::DB_NAME() . ";charset=utf8;port=" . Config::DB_PORT(), Config::DB_USER(), Config::DB_PASSWORD(), [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          ]);

          /** TODO
           * Create new connection
           */
          echo "Connected successfully";
        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }
    }

    protected function query($query, $params)
    {
      $stmt = $this->conn->prepare($query);
      $stmt->execute($params);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** TODO
     * Implement DAO method used to get customer information
     */
    public function get_customers(){
      return $this->query("SELECT * FROM customers;", []);
    }

    /** TODO
     * Implement DAO method used to get customer meals
     */
    public function get_customer_meals($customer_id) {
      return $this->query("select f.name as food_name, f.brand as food_brand, m.created_at as meal_date
        from foods f 
        join meals m on m.food_id  = f.id 
        WHERE m.customer_id = :id;", ["id" => $customer_id]);
    }

    /** TODO
     * Implement DAO method used to save customer data
     */
    public function add_customer($data){
      return $this->query("insert into customers (first_name, last_name, birth_date, status) values (:first_name, :last_name, :birth_date, 1);", ["first_name" => $data["first_name"], "last_name" => $data["last_name"], "birth_date" => $data["birth_date"]]);
    }

    /** TODO
     * Implement DAO method used to get foods report
     */
    public function get_foods_report(){
      return $this->query("select f.name as name, f.brand as brand, f.image_url as image, 
(SELECT quantity from food_nutrients fn where fn.food_id = f.id and nutrient_id = 1) as energy,
(SELECT quantity from food_nutrients fn where fn.food_id = f.id and nutrient_id = 2) as protein,
(SELECT quantity from food_nutrients fn where fn.food_id = f.id and nutrient_id = 3) as fat,
(SELECT quantity from food_nutrients fn where fn.food_id = f.id and nutrient_id = 4) as carbs,
(SELECT quantity from food_nutrients fn where fn.food_id = f.id and nutrient_id = 5) as fiber
from foods f;", []);
    }
}
?>
