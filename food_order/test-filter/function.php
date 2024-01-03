<?php
 function connect() {
    $mysqli = new mysqli('localhost','root','','food_order');
    if($mysqli->connect_errno != 0) {
        return $mysqli->connect_error;
    }else{
        return $mysqli;
    }

 }

 function getCategory() {
    
    $mysqli = connect();
    $res = $mysqli->query("SELECT title FROM tbl_category");
    while($row = $res->fetch_assoc()){
        $categories[] = $row;
    }
    return $categories;

 }

 function getAllProducts()
{
    $mysqli = connect();
    $res = $mysqli->query("SELECT * FROM tbl_food");
    while($row = $res->fetch_assoc()){
        $products[] = $row;
    }
    return $products;

}



function getProductsByCategory($category){
    $mysqli = connect();
    $res = $mysqli->query("SELECT * FROM tbl_food WHERE category_id = '$category'");
    while($row = $res->fetch_assoc()){
        $products[] = $row;
    }
    return $products;


}


