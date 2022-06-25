<?php

require_once("../models/Product.php");

$product = new Product();

switch($_GET["op"]){
    case "listar":
        
        $products = $product->getProduct();
        $data = Array();
        foreach($products as $row){
            $sub_array = array();
            $sub_array[] = $row["prod_nom"];
            $sub_array[] = '<button type="button" onClick="edit('.$row["prod_id"].');" id="'.$row["prod_id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="remove('.$row["prod_id"].');" id="'.$row["prod_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
            $data[] = $sub_array;
        }

        $response = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );

        // PARA DATATABLE RESPONDER EN JSON
        echo json_encode($response);

        break;

    case "saveAndEdit":
        $result = $product->getProductById($_POST["productId"]);
        if(empty($_POST["productId"])){
            if(is_array($result) and count($result) == 0){
                $product->insertProduct($_POST["productName"]);
            }
        }else{
            $product->updateProduct($_POST["productId"], $_POST["productName"]);
        }
        break;
    
    case "show":
        $productId = $_POST["productId"];
        $result = $product->getProductById($productId);
        var_dump($result); //////////////////
        if(is_array($result) and count($result) > 0){
            foreach($result as $row){
                $output["productId"] = $row["prod_id"];
                $output["productName"] = $row["prod_nom"];
            }
        }
        break;

    case "remove":
        $product->deleteProduct($_POST["productId"]);
        break; 
}

?>