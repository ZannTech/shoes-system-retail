<?php
class dbConfig
{
    public $conn;
    function __construct()
    { 
       $this->conn = new mysqli("localhost", "root", "", "pos");
        if($this->conn->connect_error) {
            exit('Error connecting to database'); //Should be a message a typical user could understand in production
        }
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->conn->set_charset("utf8mb4");
        
    }
}

/**
 * Formats
 */
class Formats
{
    
    function __construct(){}
    
    public function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
    public function format_count($number)
    {
        if ($number < 1000) {
        // Anything less than a million
            $format = $number;

        }else if($number < 1000000){
          $format = $number / 1000;
         $format = floor($format*100)/100;
         $format = $format .'K';
        }else if ($number < 1000000000) {
         // Anything less than a billion
         $format = $number / 1000000;
         $format = floor($format*100)/100;
         $format = $format .'M';
        } else {
            // At least a billion
        $format = $number / 1000000000;
         $format = floor($format*100)/100;
         $format = $format .'B';
        }
        return $format;
    } 
    function formatTimeStamp($format,$timestamp)
    {
        return date($format,strtotime($timestamp));
    }
    
}


/**
 * APK
 */
class POS extends dbConfig
{
   
    private $frm;
    function __construct($frm)
    {
        parent::__construct();
        $this->frm = $frm;
    }
    
    public function insertCategory($data)
    {
        $response = array();
        if (!is_array($data)) {
            $response['error'] = true;
            $response['msg'] = "Pass array data of Category";
        }else{
            $stmt = $this->conn->prepare("INSERT INTO category (name) VALUES (?)");
            $stmt->bind_param("s", $data['name']);
            $run = $stmt->execute();
            $stmt->close();
            if ($run) {
                $response['error'] = false;
                $response['msg'] = "Category: ".$data['name']." Inserted";
            }
            else{
                $response['error'] = true;
                $response['msg'] = "Category: ".$data['name']." Not Inserted";
            }
        }
        return $response;
    }
    public function getCategoryById($category_id)
    {
            $stmt = $this->conn->prepare("SELECT * FROM category WHERE cat_id = ?");
            $stmt->bind_param("i", $category_id);
            $stmt->execute();
            $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            if ($arr) {
                return $arr[0];
            }
            return false;
    }
    public function getCategories($offset)
    {
            $stmt = $this->conn->prepare("SELECT * FROM category");
            $stmt->execute();
            $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            if ($arr) {
                return $arr;
            }
            return false;
    }
    public function deleteCategory($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM category WHERE cat_id = ?");
            $stmt->bind_param("i", $id);
            $run  = $stmt->execute();
            $stmt->close();
            if ($run) {
                return true;
            }
            return false;
    }

    public function insertBrand($data)
    {
        $response = array();
        if (!is_array($data)) {
            $response['error'] = true;
            $response['msg'] = "Pass array data of Brand";
        }else{
            $stmt = $this->conn->prepare("INSERT INTO brand (name) VALUES (?)");
            $stmt->bind_param("s", $data['name']);
            $run = $stmt->execute();
            $stmt->close();
            if ($run) {
                $response['error'] = false;
                $response['msg'] = "Brand: ".$data['name']." Inserted";
            }
            else{
                $response['error'] = true;
                $response['msg'] = "Brand: ".$data['name']." Not Inserted";
            }
        }
        return $response;
    }
    public function getBrandById($brandid)
    {
            $stmt = $this->conn->prepare("SELECT * FROM brand WHERE brand_id = ?");
            $stmt->bind_param("i", $brandid);
            $stmt->execute();
            $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            if ($arr) {
                return $arr[0];
            }
            return false;
    }
    public function getBrands($offset)
    {
            $stmt = $this->conn->prepare("SELECT * FROM brand");
            $stmt->execute();
            $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            if ($arr) {
                return $arr;
            }
            return false;
    }


    public function deleteBrand($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM brand WHERE brand_id = ?");
            $stmt->bind_param("i", $id);
            $run  = $stmt->execute();
            $stmt->close();
            if ($run) {
                return true;
            }
            return false;
    }

    public function deleteSupply($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM supplies WHERE product_ID = ?");
            $stmt->bind_param("s", $id);
            $run  = $stmt->execute();
            $stmt->close();
            if ($run) {
                $this->deleteSalesBYPID($id);
                return true;
            }
            return false;
    }
    public function deleteSalesBYPID($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM sales WHERE product_id = ?");
            $stmt->bind_param("s", $id);
            $run  = $stmt->execute();
            $stmt->close();
            if ($run) {
                return true;
            }
            return false;
    }
     public function insertSalePurchase($saleid)
    {
            $response = array();
        
            $stmt = $this->conn->prepare("INSERT INTO purchase (sale_id) VALUES (?)");
            $stmt->bind_param("i", $saleid);
            $run = $stmt->execute();
            $last_r = $stmt->insert_id;
            $stmt->close();
            if ($run) {
                $response['error'] = false;
                $response['msg'] = $last_r;
            }
            else{
                $response['error'] = true;
                $response['msg'] = "Error while inserting sale receipt";
            } 
        return $response;
    }
    public function insertSaleReceipt($saleid)
    {
            $response = array();
        
            $stmt = $this->conn->prepare("INSERT INTO salereceipt (sale_id) VALUES (?)");
            $stmt->bind_param("i", $saleid);
            $run = $stmt->execute();
            $last_r = $stmt->insert_id;
            $stmt->close();
            if ($run) {
                $response['error'] = false;
                $response['msg'] = $last_r;
            }
            else{
                $response['error'] = true;
                $response['msg'] = "Error while inserting sale receipt";
            } 
        return $response;
    }
    public function insertCustomer($data)
    {
            $response = array();
        
            $stmt = $this->conn->prepare("INSERT INTO customer (customer_name,customer_address,customer_phone) VALUES (?,?,?)");
            $stmt->bind_param("sss", $data['customerName'], $data['customerAddress'], $data['customerPhone']);
            $run = $stmt->execute();
            $last_r = $stmt->insert_id;
            $stmt->close();
            if ($run) {
                $response['error'] = false;
                $response['msg'] = $last_r;
            }
            else{
                $response['error'] = true;
                $response['msg'] = "Error while inserting sale receipt";
            } 
        return $response;
    }
    public function insertService($data)
    {
            $response = array();
        
            $stmt = $this->conn->prepare("INSERT INTO services (sale_id,customer_id,service_date,return_date,service_charges) VALUES (?,?,?,?,?)");
            $stmt->bind_param("iissd", $data['saleid'], $data['customerId'], $data['serviceDate'], $data['returndate'], $data['serviceCharges']);
            $run = $stmt->execute();
            $last_r = $stmt->insert_id;
            $stmt->close();
            if ($run) {
                $response['error'] = false;
                $response['msg'] = $last_r;
            }
            else{
                $response['error'] = true;
                $response['msg'] = "Error while inserting sale receipt";
            } 
        return $response;
    }
    public function insertServiceReceipt($service_id)
    {
            $response = array();
        
            $stmt = $this->conn->prepare("INSERT INTO servicereceipt (service_id) VALUES (?)");
            $stmt->bind_param("i", $service_id);
            $run = $stmt->execute();
            $last_r = $stmt->insert_id;
            $stmt->close();
            if ($run) {
                $response['error'] = false;
                $response['msg'] = $last_r;
            }
            else{
                $response['error'] = true;
                $response['msg'] = "Error while inserting service receipt";
            } 
        return $response;
    }
    public function deleteSaleReceipt($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM salereceipt WHERE id = ?");
            $stmt->bind_param("i", $id);
            $run  = $stmt->execute();
            $stmt->close();
            if ($run) {
                return true;
            }
            return false;
    }
    public function getSaleBySID($sid)
    {
            $stmt = $this->conn->prepare("SELECT s.*,sa.dateofpurchase 
                FROM supplies s,sales sa
                WHERE sa.sale_id = ? AND sa.product_id = s.product_ID");
            $stmt->bind_param('i',$sid);
            $stmt->execute();
            $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            if ($arr) {
                return $arr;
            }
            return false;
    }

    public function updateCustomerPhone($data)
    {
        $stmt = $this->conn->prepare("UPDATE customer SET customer_phone = ? WHERE c_id = ?");
        $stmt->bind_param("si",$data['customerPhone'],$data['customerID']);
        if($stmt->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
        $stmt->close();
    }
    public function getServiceByID($sid)
    {
            $stmt = $this->conn->prepare("SELECT *
                FROM services
                WHERE service_id = ? LIMIT 1
                ");
            $stmt->bind_param('i',$sid);
            $stmt->execute();
            $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            if ($arr) {
                return $arr[0];
            }
            return false;
    }
    public function updateService($data)
    {
        $data['customerID'] = $this->getServiceByID($data['serviceId'])['customer_id'];
        $stmt = $this->conn->prepare("UPDATE services SET return_date = ? WHERE service_id = ?");
        $stmt->bind_param("si",$data['returndate'],$data['serviceId']);
        if($stmt->execute() && $this->updateCustomerPhone($data))
        {
            return true;
        }
        else
        {
            return false;
        }
        $stmt->close();
    }
    public function getServicesReport()
    {
            $stmt = $this->conn->prepare("SELECT s.*,sa.*,sr.*,c.*
                FROM supplies s,sales sa,services sr,customer c
                WHERE sr.sale_id = sa.sale_id AND sa.product_id = s.product_ID AND sr.customer_id = c.c_id
                ORDER BY sr.service_id DESC
                ");
            
            $stmt->execute();
            $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            if ($arr) {
                return $arr;
            }
            return false;
    }

    public function getServiceBySalePID($pid)
    {
            $stmt = $this->conn->prepare("SELECT s.*,sa.*,sr.*,c.*
                FROM supplies s,sales sa,services sr,customer c
                WHERE sa.product_id = ? AND sa.sale_id = sr.sale_id AND sr.customer_id = c.c_id  AND sa.product_id = s.product_ID
                ORDER BY sr.service_id DESC LIMIT 1
                ");
            $stmt->bind_param('s',$pid);
            $stmt->execute();
            $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            if ($arr) {
                return $arr;
            }
            return false;
    }

    public function getServiceBySaleID($saleid)
    {
            $stmt = $this->conn->prepare("SELECT s.*,sa.*,sr.*,c.*
                FROM supplies s,sales sa,services sr,customer c
                WHERE sr.sale_id = ? AND sr.customer_id = c.c_id AND sr.sale_id = sa.sale_id AND sa.product_id = s.product_ID
                ORDER BY sr.service_id DESC LIMIT 1
                ");
            $stmt->bind_param('i',$saleid);
            $stmt->execute();
            $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            if ($arr) {
                return $arr;
            }
            return false;
    }
     
    public function getSalePurchaseByID($purid)
    {
            $stmt = $this->conn->prepare("SELECT s.*,sa.dateofpurchase 
                FROM supplies s,sales sa,purchase pr
                WHERE pr.id = ? AND pr.sale_id = sa.sale_id AND sa.product_id = s.product_ID");
            $stmt->bind_param('i',$purid);
            $stmt->execute();
            $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            if ($arr) {
                return $arr;
            }
            return false;
    }
    public function getSaleReceiptByID($srid)
    {
            $stmt = $this->conn->prepare("SELECT s.*,sa.dateofpurchase 
                FROM supplies s,sales sa,salereceipt sr
                WHERE sr.id = ? AND sr.sale_id = sa.sale_id AND sa.product_id = s.product_ID");
            $stmt->bind_param('i',$srid);
            $stmt->execute();
            $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            if ($arr) {
                return $arr;
            }
            return false;
    }
    public function getSaleByID($sid)
    {
            $stmt = $this->conn->prepare("SELECT * FROM sales WHERE sale_id = ? LIMIT 1");
            $stmt->bind_param("i", $sid);
            $stmt->execute();
            $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            if ($arr) {
                return $arr;
            }
            return false;
    }


     
    public function getSupplyByPID($pid)
    {
            $stmt = $this->conn->prepare("SELECT * FROM supplies WHERE product_ID = ? LIMIT 1");
            $stmt->bind_param("s", $pid);
            $stmt->execute();
            $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            if ($arr) {
                return $arr;
            }
            return false;
    }

    public function getSupplies()
    {
            $stmt = $this->conn->prepare("SELECT * FROM supplies ORDER BY dateofentery ASC");
            
            $stmt->execute();
            $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            if ($arr) {
                return $arr;
            }
            return false;
    }
     
    public function insertSupply($data)
    {
        $response = array();
         
        if (!is_array($data)) {
            $response['error'] = true;
            $response['msg'] = "Pass array as parameter";
        }
        else if ($this->getSupplyByPID($data['pid'])) {

                $response['error'] = true;
                $response['msg'] = $data['pid']." Already in Database";
        }
        else{

             
            $stmt = $this->conn->prepare("INSERT INTO supplies (product_ID,category,color,price,brand,size,dateofentery) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sisdids",$data['pid'],$data['category'],$data['color'],$data['price'],$data['brand'],$data['size'],$data['dateofentry']);
            $run = $stmt->execute();
            $l_app_id = $stmt->insert_id;
            $stmt->close();
            if ($run) {
                
                $response['error'] = false;
                $response['msg'] = $l_app_id;
                
            }
            else{
                $response['error'] = true;
                $response['msg'] = "Error while inserting this item";
            }
            
            
        }
        return $response;
    }

    public function updateSupply($data)
    {
        $response = array();
         
        if (!is_array($data)) {
            $response['error'] = true;
            $response['msg'] = "Pass array as parameter";
        }
        else if (!$this->getSupplyByPID($data['ppid'])) {

                $response['error'] = true;
                $response['msg'] = $data['pid']." not exist in Database";
        }
        else if($this->getSupplyByPID($data['pid']) && $data['pid'] != $data['ppid']){
            $response['error'] = true;
                $response['msg'] = $data['pid']." already in Database";
        }
        else{

             
            $stmt = $this->conn->prepare("UPDATE supplies SET product_ID = ?,category = ? ,color = ? ,price = ? ,brand = ? ,size = ? ,dateofentery = ? WHERE product_ID = ?");
            $stmt->bind_param("sisdidss",$data['pid'],$data['category'],$data['color'],$data['price'],$data['brand'],$data['size'],$data['dateofentry'],$data['ppid']);
            $run = $stmt->execute();
            $stmt->close();
            if ($run) {
                
                $response['error'] = false;
                $response['msg'] = $data['pid']." Updated in Database";
                
            }
            else{
                $response['error'] = true;
                $response['msg'] = "Error while updating this item";
            }
            
            
        }
        return $response;
    }

    public function getSalesByID($pid)
    {
            $stmt = $this->conn->prepare("SELECT s.*,sa.dateofpurchase AS DOP,sa.sale_id
                FROM supplies s,sales sa 
                WHERE sa.product_id = ?
                ORDER BY sa.sale_id DESC
                LIMIT 1");
            $stmt->bind_param('s',$pid);
            $stmt->execute();
            $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            if ($arr) {
                return $arr;
            }
            return false;
    }

    public function getSalesReport()
    {
            $stmt = $this->conn->prepare("SELECT s.*,sa.dateofpurchase AS DOP,sa.sale_id
                FROM supplies s,sales sa 
                WHERE sa.product_id = s.product_ID
                ORDER BY sa.dateofpurchase ASC");
            
            $stmt->execute();
            $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            if ($arr) {
                return $arr;
            }
            return false;
    }
     
     
}


/**
 * User
 */
class User extends dbConfig
{
    private $userdata;
    function __construct()
    {
        parent::__construct();
    }

    public function setSession($data)
    {
        $_SESSION['user'] = $data;
        return true;
    }
    public function getSession()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        else
        {
            return false;
        }
    }

    public function insertUser($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO users (user_login,user_pass,display_name) VALUES (?, ?, ?)");
        $stmt->bind_param("sss",$data['username'],$data['password'],$data['display_name']);
        if($stmt->execute())
        {

            return $stmt->insert_id;
        }
        else
        {
            return false;
        }
        $stmt->close();
    }
    public function insertUserMeta($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO usermeta (user_id,meta_key,meta_value) VALUES (?, ?, ?)");
        $stmt->bind_param("iss",$data['uid'],$data['meta_key'],$data['meta_value']);
        if($stmt->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
        $stmt->close();
    }
    public function Ismeta($user,$key)
    {
       $stmt = $this->conn->prepare("SELECT * FROM usermeta WHERE user_id = ? AND meta_key = ?");
        $stmt->bind_param("is", $user,$key);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result)
        {
            return true;
        }
        return false;
    }

    public function updateAvatar($avatar)
    {
        if (!$this->getSession()) {
            return false;
        }
        if ($this->updateUserMeta($this->getSession(),"avatar",$avatar)) {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function updateUserMeta($id,$key,$value)
    {
        $stmt = $this->conn->prepare("UPDATE usermeta SET meta_value = ? WHERE user_id = ? AND meta_key = ?");
        $stmt->bind_param("sis",$value,$id,$key);
        $exc = $stmt->execute();
        $stmt->close();
        if($exc && $this->Ismeta($id,$key))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function updateUserColumn($column,$value,$id)
    {
        $stmt = $this->conn->prepare("UPDATE users SET $column = ? WHERE ID = ?");
        $stmt->bind_param("si",$value,$id);
        $exc = $stmt->execute();
        $stmt->close();
        if($exc)
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }
    public function UpdatePassword($password,$id)
    {
       $password = password_hash($password, PASSWORD_DEFAULT);
       if ($this->updateUserColumn("user_pass",$password,$id)) {
           return true;
       }
       return false;
    } 

    public function deletemetaById($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM usermeta WHERE user_id = ?");
        $stmt->bind_param("i",$id);
        if ($stmt->execute()) {
           return true;
        }
        $stmt->close();
        return false;
    }
    public function deleteById($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE ID = ?");
        $stmt->bind_param("i",$id);
        if ($stmt->execute()) {
           return true;
        }
        $stmt->close();
        return false;
    }
    public function isUserId($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows === 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    

    public function isUserByusername($username)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE user_login = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows === 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    
    public function getusermeta($id,$key)
    {
        $stmt = $this->conn->prepare("SELECT * FROM usermeta WHERE user_id = ? AND meta_key = ?");
        $stmt->bind_param("is",$id,$key);
        $stmt->execute();
        $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if ($arr) {
            return $arr[0]['meta_value'];
        }
        return false;
    }
    public function avatar()
    {
        if (!$this->getSession()) {
            return "";
        }else{
            if(!$this->getusermeta($this->getSession(),"avatar"))
            {
                return "";
            }
            else
            {
               return $this->getusermeta($this->getSession(),"avatar"); 
            }
        }
    }
    public function setData()
    {
        $this->userdata = array(); 
        if ($this->getSession()) {
            $stmt = $this->conn->prepare("SELECT u.user_login,u.ID,u.user_registered,u.display_name FROM users u WHERE u.ID = ?");
            $stmt->bind_param("i", $_SESSION['user']);
            $stmt->execute();
            $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            
            $this->userdata = $arr[0];
        }
    }
    public function isUser($username)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE user_login = ?");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows === 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    
    public function Login($username,$password)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE user_login = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if ($arr) {
            if(password_verify($password,$arr[0]['user_pass']))
            {
                if ($this->setSession($arr[0]['ID'])) {
                return true;
                }
                return false;
            }
            return false;
        }
        else
        {
            return false;
        }
    } 
    public function display_column_by_id($column,$Id)
    {
        $stmt = $this->conn->prepare("SELECT $column FROM users WHERE ID = ?");
        $stmt->bind_param("i", $Id);
        $stmt->execute();
        $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if($arr)
        {
            return $arr[0];
        }
        return "";
    }
    public function display_column_by_username($column,$username)
    {
        $stmt = $this->conn->prepare("SELECT $column FROM users WHERE user_login = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if($arr)
        {
            return $arr[0];
        }
        return "";
    }
     
    public function display_name()
    {
        if (isset($this->userdata['display_name'])) {
            return $this->userdata['display_name'];
        }
        else if(isset($this->userdata['user_login']))
        {
            return $this->userdata['user_login'];
        }
        else
        {
            return "";
        }
    }
    public function updateUser($id,$column,$value)
    {
        
        $stmt = $this->conn->prepare("UPDATE users SET $column = ? WHERE ID = ?");
        $stmt->bind_param("si",$value,$id);
        if($stmt->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
        $stmt->close();
    }
    public function AddNew($data)
    {
        $response = array();
        if($this->getSession())
        {
                $display_name = ucfirst($data['username']);
                 
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                $data['display_name'] = $display_name;
                $last_in = $this->insertUser($data);
                if ($last_in) {
                    $metadata = array(
                    0 => array('uid' => $last_in, 'meta_key' => 'first_name','meta_value' => ucfirst($data['username'])),
                    1 => array('uid' => $last_in, 'meta_key' => 'last_name','meta_value' => " "),
                    2 => array('uid' => $last_in, 'meta_key' => 'avatar','meta_value' => $data['avatar']),
                    3 => array('uid' => $last_in, 'meta_key' => 'gender','meta_value' => $data['gender']),
                    4 => array('uid' => $last_in, 'meta_key' => 'capabilities','meta_value' => $data['capabilities'])
                    );
                    foreach ($metadata as $key => $datam) {
                        $inmeta = $this->insertUserMeta($datam);
                    }
                    $response['error'] = false;
                    $response['msg'] = "User Created Successfuly!";
                }else{
                    $response['error'] = true;
                    $response['msg'] = "Error while inserting user";
                }
        
       }
       else
       {
         $response['error'] = true;
         $response['msg'] = "Please login to add new user!";
       }
       return $response;
    }
    public function updateProfile($data)
    {
        if($this->getSession())
        {
        $metadata = array(
                    0 => array('uid' => $this->getSession(), 'meta_key' => 'first_name','meta_value' => $data['first_name']),
                    1 => array('uid' => $this->getSession(), 'meta_key' => 'last_name','meta_value' => $data['last_name']),
                    3 => array('uid' => $this->getSession(), 'meta_key' => 'gender','meta_value' => $data['gender'])
                );
        foreach ($metadata as $key => $datam) {
            $update = $this->updateUserMeta($datam['uid'],$datam['meta_key'],$datam['meta_value']);
           if(!$update)
           {
             $this->insertUserMeta($data);
           }
        }
        $display_name = $data['first_name']. " " . $data['last_name'];

        $this->updateUser($this->getSession(),"display_name",$display_name);
        return true;
       }
       else
       {
        return false;
       }
    }
    
    public function joineddate()
    {
        if (isset($this->userdata['user_registered'])) {
            return $this->userdata['user_registered'];
        }
        return "";
    }
    public function getAll()
    {
        $stmt = $this->conn->prepare("SELECT ID,user_login as username,user_registered as joined,display_name as fullname FROM users ORDER BY ID DESC");
        $stmt->execute();
        $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if($arr)
        {
            return $arr;
        }
        return "";
    }
    public function isAdmin($id)
    {
        return 'admin' == $this->getusermeta($id,'capabilities');
    }
    public function isStaff($id)
    {
        return 'staff' == $this->getusermeta($id,'capabilities');
    }
    
    public function Logout()
    {
        if(isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        return true;
    }
}
