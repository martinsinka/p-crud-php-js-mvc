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
            $sub_array[] = '<button type="button" onClick="delete('.$row["prod_id"].');" id="'.$row["prod_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
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
}

?>