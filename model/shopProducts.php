<?php
$db = new DataBase;

class shopProducts
{
    function getMajorCategories()
    {
        $sql = " SELECT DISTINCT `major_category` FROM `" . DB_PREFIX . "product_category`; ";
        $result = DataBase::$conn->query($sql);
        $majorCategorie[0] = "";
        if ($result->num_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                if ($row = $result->fetch_assoc()) {
                    array_push($majorCategorie, $row['major_category']);
                }
            }
        }
        return $majorCategorie;
    }
    function checkUploadedProducts()
    {
        $sql = "SELECT * FROM `" . DB_PREFIX . "product` WHERE `name` LIKE '" . str_replace(" ", "", $_POST['productName']) . "_" . $_SESSION['id'] . "' AND `category_id` = " . (explode(',', $_POST['product_category_menu'], 2))[1] . "";
        $result = DataBase::$conn->query($sql);
        if ($result->num_rows == 0) {
            return;
        } else {
            return "product updated!";
        }
    }
    function getCategories_SubCategories()
    {
        $sql = " SELECT `major_category`,`name` FROM `" . DB_PREFIX . "product_category`;  ";
        $result = DataBase::$conn->query($sql);
        $Categories_SubCategories[0] = "";
        if ($result->num_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                if ($row = $result->fetch_assoc()) {
                    array_push($Categories_SubCategories, $row['major_category'] . $row['name']);
                }
            }
        }
        return $Categories_SubCategories;
    }
    function getSubCategories()
    {
        $sql = " SELECT `name` FROM `" . DB_PREFIX . "product_category`;  ";
        $result = DataBase::$conn->query($sql);
        $SubCategories[0] = "";
        if ($result->num_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                if ($row = $result->fetch_assoc()) {
                    array_push($SubCategories, $row['name']);
                }
            }
        }
        return $SubCategories;
    }
    function updateProduct()
    {
        $sql = "UPDATE `" . DB_PREFIX . "product` SET `sex`='" . $_POST['sex'] . "',`description`='" . $_POST['description'] . "',`price`='" . $_POST['price'] . "',`propertie_id`='" . (explode(',', $_POST['Riding_style_menu'], 2))[1] . "',`quantity`='" . $_POST['quantity'] . "',`color`='" . $_POST['color'] . "'WHERE `name` LIKE '" . str_replace(" ", "", $_POST['productName']) . "_" . $_SESSION['id'] . "' AND `category_id` = " . (explode(',', $_POST['product_category_menu'], 2))[1] . "";
        DataBase::$conn->query($sql);
    }
    function uploadProduct()
    {
        $sql = "INSERT INTO `" . DB_PREFIX . "product` ( `name`, `sex`, `description`, `price`, `category_id`, `propertie_id`, `quantity` , `color`) VALUES ('" . str_replace(" ", "", $_POST['productName']) . "_" . $_SESSION['id'] . "','" . $_POST['sex'] . "','" . $_POST['description'] . "','" . $_POST['price'] . "','" . (explode(',', $_POST['product_category_menu'], 2))[1] . "','" . (explode(',', $_POST['Riding_style_menu'], 2))[1] . "','" . $_POST['quantity'] . "', '" . $_POST['color'] . "'); ";
        DataBase::$conn->query($sql);
    }

    function getProducts()
    {
        $sql = "SELECT `nckp1tyung_product`.`name`, `nckp1tyung_product_category`.`name`AS 'categoryName' FROM `" . DB_PREFIX . "product` INNER JOIN `nckp1tyung_product_category` ON `nckp1tyung_product`.`category_id` = `nckp1tyung_product_category`.`id`;";
        $result = DataBase::$conn->query($sql);
        $products[0] = "";
        if ($result->num_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                if ($row = $result->fetch_assoc()) {
                    array_push($products, str_replace(" ", "_", $row['categoryName']) . "_" . $row['name']);
                }
            }
        }
        return $products;
    }

    function getProductNames()
    {
        $sql = "SELECT `nckp1tyung_product`.`name`, `nckp1tyung_product_category`.`name` AS `categoryName`, `nckp1tyung_product`.`name`
        FROM `" . DB_PREFIX . "product` 
            INNER JOIN `nckp1tyung_product_category` ON `nckp1tyung_product`.`category_id` = `nckp1tyung_product_category`.`id`;";
        $result = DataBase::$conn->query($sql);
        $products[0] = "";
        if ($result->num_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                if ($row = $result->fetch_assoc()) {
                    array_push($products, str_replace(" ", "_", $row['categoryName']) . "_" . $row['name'] . "_" . $row['name']);
                }
            }
        }
        return $products;
    }

    function getProductIds()
    {
        $sql = "SELECT `nckp1tyung_product`.`name`, `nckp1tyung_product_category`.`name` AS `categoryName`, `nckp1tyung_product`.`id`
        FROM `" . DB_PREFIX . "product` 
            INNER JOIN `nckp1tyung_product_category` ON `nckp1tyung_product`.`category_id` = `nckp1tyung_product_category`.`id`;";
        $result = DataBase::$conn->query($sql);
        $products[0] = "";
        if ($result->num_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                if ($row = $result->fetch_assoc()) {
                    array_push($products, str_replace(" ", "_", $row['categoryName']) . "_" . $row['name'] . "_" . $row['id']);
                }
            }
        }
        return $products;
    }

    function getProductQuantities()
    {
        $sql = "SELECT `nckp1tyung_product`.`name`, `nckp1tyung_product_category`.`name` AS `categoryName`, `nckp1tyung_product`.`quantity`
        FROM `" . DB_PREFIX . "product` 
            INNER JOIN `nckp1tyung_product_category` ON `nckp1tyung_product`.`category_id` = `nckp1tyung_product_category`.`id`;";
        $result = DataBase::$conn->query($sql);
        $products[0] = "";
        if ($result->num_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                if ($row = $result->fetch_assoc()) {
                    array_push($products, str_replace(" ", "_", $row['categoryName']) . "_" . $row['name'] . "_" . $row['quantity']);
                }
            }
        }
        return $products;
    }
    function getProductsPrices()
    {
        $sql = "SELECT `nckp1tyung_product`.`name`, `nckp1tyung_product_category`.`name` AS `categoryName`, `nckp1tyung_product`.`price`
        FROM `" . DB_PREFIX . "product` 
            INNER JOIN `nckp1tyung_product_category` ON `nckp1tyung_product`.`category_id` = `nckp1tyung_product_category`.`id`;";
        $result = DataBase::$conn->query($sql);
        $products[0] = "";
        if ($result->num_rows > 0) {
            for ($i = 0; $i < $result->num_rows; $i++) {
                if ($row = $result->fetch_assoc()) {
                    array_push($products, str_replace(" ", "_", $row['categoryName']) . "_" . $row['name'] . "_" . $row['price']);
                }
            }
        }
        return $products;
    }

    function deleteProductFromDatabase($removable)
    {
        $sql = "DELETE FROM `" . DB_PREFIX . "product` WHERE `id` = '" . $removable . "'";
        DataBase::$conn->query($sql);
    }
    function moveProductToCart($productId, $sessionId)
    {
        $sql = "INSERT INTO `nckp1tyung_cart_item`( `product_id`, `quantity`, `session_id`) VALUES ('" . $productId . "','1','" . $sessionId . "');";
        DataBase::$conn->query($sql);
    }
    function decreaseProductQuantity($productId, $currentProductQuantity)
    {
        $sql = "UPDATE `nckp1tyung_product` SET `quantity`='" . ($currentProductQuantity - 1) . "' WHERE `id` = " . $productId . "";
        $result = DataBase::$conn->query($sql);
    }
    function getDecreasableProductQuantity($productId)
    {
        $sql = "SELECT `quantity` FROM `" . DB_PREFIX . "product` WHERE `id` = " . $productId . "";
        $result = DataBase::$conn->query($sql);
        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                $productQuantity = $row['quantity'];
            }
        }
        return $productQuantity;
    }
}
