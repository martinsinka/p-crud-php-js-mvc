<?php

require_once("../config/connection.php");
require_once("../models/Product.php");

$product = new Product();

switch($_GET["op"]){
    case "listar":
        $products = $product->getProduct();
        $data = Array();
        foreach($products as $product){
            $sub_array = array();
            $sub_array[] = $product["prod_nom"];
            $sub_array[] = '<button type="button" onClick="edit('.$product["prod_id"].');" id="'.$product["prod_id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="delete('.$product["prod_id"].');" id="'.$product["prod_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
        }

        $response = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($response);

        break;
}

?>