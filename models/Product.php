<?php

class Product extends ConnectionDB
{
    /**
     * Lista de productos
     */
    public function getProduct()
    {
        $connection = parent::connection();
        parent::setNames();

        $sql = "SELECT * FROM tm_producto WHERE prod_est = 1";
        $sql = $connection->prepare($sql);
        $sql->execute();

        $response = $sql->fetchAll();
        return $response;

    }

    /**
     * Productos por id
     */
    public function getProductById($productId)
    {
        $connection = parent::connection();
        parent::setNames();

        $sql = "SELECT * FROM tm_producto WHERE prod_id = :id";
        $sql = $connection->prepare($sql);
        $sql->bindValue(':id', $productId);
        $sql->execute();

        return $sql->fetchAll();

    }

    /**
     * Eliminarion de productos
     */
    public function deleteProduct($productId)
    {
        $connection = parent::connection();
        parent::setNames();

        $sql = "UPDATE tm_producto
            SET
                est = 0,
                prod_fech_elim = now()
            WHERE
                prod_id = :productId";
        $sql = $connection->prepare($sql);
        $sql->bindValue(':productId', $productId);
        $sql->execute();
        return $sql->fetchAll();
    }

    /**
     * Creacion de productos
     */
    public function insertProduct($productName)
    {
        $connection = parent::connection();
        parent::setNames();

        $sql = "INSERT INTO tm_producto (prod_id, prod_nom, prod_fech_crea, prod_fech_modi, prod_fech_elim, prod_est)
                VALUES (NULL, :productName , now(), NULL, NULL, '1');";
        $sql = $connection->prepare($sql);
        $sql->bindValue(':productName', $productName);
        $sql->execute();return $sql->fetchAll();
    }

    /**
     * Modificacion de productos
     */
    public function updateProduct($productId, $productName)
    {
        $connection = parent::connection();
        parent::setNames();

        $sql = "UPDATE tm_producto
                SET
                    prod_nom = :productName,
                    prod_fech_modi = now()
                WHERE
                    prod_id = :productId";
        $sql = $connection->prepare($sql);
        $sql->bindValue(':productName', $productName);
        $sql->bindValue(':productId', $productId);
        $sql->execute();
        return $sql->fetchAll();
    }
}

?>