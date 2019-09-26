<?php
/**
 * Created by PhpStorm.
 * User: pcc
 * Date: 11/02/2018
 * Time: 17:00
 */


//Start of recommendation DB part
function db_insert($sql)
{
    try {
        $dbconnection = db_connect();

        //execute sql to insert record
        $dbconnection->exec($sql);

        //echo "New record created successfully";
    } catch (PDOException $e) {
    	go_to_exception_page("db_insert() -> ".$e);
    }

    //close db connection to release memory
    $dbconnection = null;
}

// Add by PCC for sql query
function db_query($sql)
{
    try {
        $dbconnection = db_connect();

        //execute sql to query
        $stmt = $dbconnection->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $dbconnection = null;
        //return results
        return $results;

    } catch (PDOException $e) {
    	go_to_exception_page("db_query() -> ".$e);
    }

    //close db connection to release memory
    $dbconnection = null;
}

function db_select_latestOrderId_byUserId($userId)
{
    if (empty($userId)) {
        return $results = 'userId is not given!';
    } else {
        try {
            //connect DB
            $dbconnection = db_connect();

            //prepare SQL statement
            $stmt = $dbconnection->prepare("select `order_id` from `order` where `user_id`= :userId
                        and `status` = 'OS31' order by `order_id` desc limit 1");
            $stmt->bindParam(":userId", $userId);
            //execute statement
            $stmt->execute();
            //return the results
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $dbconnection = null;
            return $results;

        } catch (PDOException $e) {
        	go_to_exception_page("db_select_latestOrderId_byUserId() -> ".$e);
        }

        $dbconnection = null;
    }

}

function db_select_food_list_byCateName($cate)
{
    if (empty($cate)) {
        return $results='The category cannot be empty!';
    } else {
        try {
            $dbconnection = db_connect();
            $stmt = $dbconnection->prepare("select * from `food`
                    where `food_category` = :cate and `available` = 'Y'");
            $stmt->bindParam(":cate", $cate);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $dbconnection = null;
            return $results;

        } catch (PDOException $e) {
        	go_to_exception_page("db_select_food_list_byCateName() -> ".$e);
        }

        $dbconnection = null;
    }

}

function db_select_allAvailCategories()
{
    try {
        $dbconnection = db_connect();
        $stmt = $dbconnection->prepare("select * from `product` order by productName asc");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dbconnection = null;
        return $results;

    } catch (PDOException $e) {
    	go_to_exception_page("db_select_allAvailCategories() -> ".$e);
    }

    $dbconnection = null;

}


function db_select_orderFoodCateList_byOrderId($orderId)
{
    if(empty($orderId) || (!is_numeric($orderId))){
        return $results="orderId is invalid!";
    }
    else{
        try {
            $dbconnection = db_connect();
            $stmt = $dbconnection->prepare("select distinct `food`.`food_category` from `order_detail` 
											left join `food` on `food`.`food_id` = `order_detail`.`food_id` 
											where `order_detail`.`order_id` = :orderId 
											order by `food`.`food_id` desc");
            $stmt->bindParam(":orderId", $orderId);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $dbconnection = null;
            return $results;

        } catch (PDOException $e) {
        	go_to_exception_page("db_select_orderFoodCateList_byOrderId() -> ".$e);
        }
    }

    $dbconnection = null;

}

function db_select_food_list_byTagName($tagName)
{
    if (empty($tagName)) {
        return $results='The tagName cannot be empty!';
    } else {
        try {
            $dbconnection = db_connect();
            $stmt = $dbconnection->prepare("select * from `product` order by `productName` desc limit 4");
            $stmt->bindParam(":tagName", $tagName);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $dbconnection = null;
            return $results;

        } catch (PDOException $e) {
        	go_to_exception_page("db_select_food_list_byTagName() -> ".$e);
        }

        $dbconnection = null;
    }

}

function db_select_highest_Price_food_list()
{
	try {
		$dbconnection = db_connect();
		$stmt = $dbconnection->prepare("select * from `food` fd where fd.`available` = 'Y' order by fd.`price` desc limit 10");
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$dbconnection = null;
		return $results;
		
	} catch (PDOException $e) {
		go_to_exception_page("db_select_highest_Price_food_list() -> ".$e);
	}
	
	$dbconnection = null;
}

function db_select_lowest_Price_food_list()
{
    try {
        $dbconnection = db_connect();
        $stmt = $dbconnection->prepare("select * from `product` order by `productName` asc limit 10");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $dbconnection = null;
        return $results;
        
    } catch (PDOException $e) {
        go_to_exception_page("db_select_lowest_Price_food_list() -> ".$e);
    }
    
    $dbconnection = null;
}

function db_select_all_food_name_tag()
{
	try {
		$dbconnection = db_connect();
		$stmt = $dbconnection->prepare("select distinct `productName`  from `product`");
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$dbconnection = null;
		return $results;
		
	} catch (PDOException $e) {
		go_to_exception_page("db_select_all_food_name_tag() -> ".$e);
	}
	
	$dbconnection = null;
}

function db_select_all_food_cat($cat)
{
	try {
		$dbconnection = db_connect();
		$stmt = $dbconnection->prepare("select distinct `productName` from `product`");
		//$stmt->bindParam(":cat", $cat);
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$dbconnection = null;
		return $results;
		
	} catch (PDOException $e) {
		go_to_exception_page("db_select_all_food_cat() -> ".$e);
	}
	
	$dbconnection = null;
}

function db_select_food_by_food_category_name($foodCate, $foodName)
{
    if($foodCate == "All"){
        $foodCate = "";
    }
    
	try {
	    $sql = "select  * from `product` where `productName` like :name";
	    	    
		$dbconnection = db_connect();
		$stmt = $dbconnection->prepare($sql);
		$paramArray = array(":name" => "%" . $foodName . "%");
		$stmt->execute($paramArray);
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$dbconnection = null;
		return $results;
		
	} catch (PDOException $e) {
		go_to_exception_page("db_select_food_by_food_category_name() -> ".$e);
	}
	
	$dbconnection = null;
}



?>