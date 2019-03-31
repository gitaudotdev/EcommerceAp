<?php
/**
 * Created by PhpStorm.
 * User: Ted
 * Date: 28/07/2018
 * Time: 13:43
 */

class DB_Functions
{
    private $conn;

    function __construct()
    {
        require_once 'db_connect.php';
        $db = new DB_Connect();
        $this->conn =$db->connect();
    }


    function __destruct()
    {
        // TODO: Implement __destruct() method.
    }
/*
 * check user exist
 * return true/false
 */
    function checkUserExists($phone)
    {
        $stmt = $this->conn->prepare("SELECT * FROM User WHERE Phone=?");
        $stmt->bind_param("s",$phone);
        $stmt->execute();
        $stmt->store_result();


        if($stmt->num_rows>0)
        {
            $stmt->close();
            return true;
        }else{
            $stmt->close();
            return false;
        }
    }
/*
 * Register new User
 * return User object if user was created
 * return false and show error message if have exception
 *
 */

    public function registerNewUser($phone,$name,$birthdate,$address){
        $stmt = $this->conn->prepare("INSERT INTO User(Phone,Name,Birthdate,Address)VALUES(?,?,?,?) ");
        $stmt->bind_param("ssss",$phone,$name,$birthdate,$address);
        $result=$stmt->execute();
        $stmt->close();


        if($result)
        {
            $stmt=$this->conn->prepare("SELECT *FROM User WHERE Phone= ?");
            $stmt->bind_param("s",$phone);
            $stmt->execute();
            $user =$stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        }
        else
            return false;
    }

    /*
 * Get User Information
 * return User object if user exists
 * return NULL if user doesnt exist
 *
 */

    public function getUserInformation($phone)
    {
        $stmt = $this->conn->prepare("SELECT * FROM User WHERE  Phone=?");
        $stmt->bind_param("s",$phone);


        if($stmt->execute())
        {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $user;
        }
        else
            return NULL;
    }



    /*
     *Get Banner
     *return list of Banners
     */
    public function getBanners()
    {
        //select 3 newest banners
        $result =$this->conn->query("SELECT *FROM Banner ORDER BY ID LIMIT 3");

        $banners = array();

        while ($item =$result->fetch_assoc())
            $banners[] =$item;
        return $banners;

    }
    /*
      *Get Banner
      *return list of Banners
     */
    public function getMenu()
    {

        $result =$this->conn->query("SELECT *FROM Menu ");

        $menu = array();

        while ($item =$result->fetch_assoc())
            $menu[] =$item;
        return $menu;

    }
    /*
     *Get Drink base Menu ID
     *return List of Drink
     */
    public function getDrinkByMenuID($menuId)
    {
        $query ="SELECT * FROM Drink WHERE MenuId='".$menuId."'";
        $result =$this->conn->query($query);

        $drinks = array();

        while ($item =$result->fetch_assoc())
            $drinks[] =$item;
        return $drinks;

    }

    /*
     *update Avatar Url
     *return TRUE or FALSE
     */
    public function updateAvatar($phone,$fileName)
    {
        return $result= $this->conn->query("UPDATE user SET avatarUrl ='$fileName' WHERE Phone ='$phone'");

    }

    /*
     *update Get Drinks
     *return List of Drinks or Empty
     */
    public function getAllDrinks()
    {
        $result= $this->conn->query("SELECT * FROM  drink WHERE 1") or die($this->conn->error);

        $drinks = array();
        while ($item= $result->fetch_assoc())
            $drinks[] = $item;
        return $drinks;
    }
     /*
     *INSERT NEW ORDER
     *return TRUE or FALSE
     */
    public function insertNewOrder($orderPrice,$orderComment,$orderAddress,$orderDetail,$userPhone)
    {
        $stmt = $this->conn->prepare("INSERT INTO `order`(`OrderStatus`, `OrderPrice`, `OrderDetail`, `OrderComment`, `OrderAddress`, `UserPhone`) VALUES (0,?,?,?,?,?) ")or die($this->conn->error);
        $stmt->bind_param("sssss",$orderPrice,$orderDetail,$orderComment,$orderAddress,$userPhone);
        $result =$stmt->execute();
        $stmt->close();

        if($result)
            return true;
        else
            return false;

    }
    /*Insert new Menu Category
     *
     *
     */
    public function insertNewCategory($name,$imgPath)
    {
        $stmt = $this->conn->prepare("INSERT INTO `menu`(`Name`, `Link`) VALUES (?,?)")or die($this->conn->error);
        $stmt->bind_param("ss",$name,$imgPath);
        $result =$stmt->execute();
        $stmt->close();

        if($result)
            return true;
        else
            return false;

    }
    /*
     * UPDATE Category
     *Return TRUE or FALSE
     *
     */
    public function updateCategory($id,$name,$imgPath)
    {
        $stmt = $this->conn->prepare("UPDATE 'menu' SET 'Link'=?,'Name'=? WHERE 'ID'=?");
        $stmt->bind_param("sss",$imgPath,$name,$id);
        $result = $stmt->execute();
        return $result;
    }
    /*
     * DELETE Category
     *Return TRUE or FALSE
     *
     */
    public function deleteCategory($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM 'menu' WHERE 'ID'=?");
        $stmt->bind_param("s",$id);
        $result = $stmt->execute();
        return $result;
    }
}