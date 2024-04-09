<?php 

class Filemanager {

    function fileUpload($msg) {

        $uploadOk = 0;
        $maxFileSize = 15;
        define('TARGET_DIR',"../uploads/");
        define('IMG_EXTS', array('.jpg','.jpeg','.png','.gif'));   
        $maxFileSize = $maxFileSize * 1024 * 1024 ;
        $fileName = basename($_FILES["fileToUpload"]["name"]);
        $fileNameArray = preg_split("/\./",$fileName);
        $selectOption =(explode(',', $_POST['product_category_menu'],2))[0];
        $fileName = $selectOption."_".str_replace(" ", "", $_POST['productName'])."_".$_SESSION['id'].".".$fileNameArray[1];
        $target_file = TARGET_DIR . $fileName;
        
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } 
        else {
            $msg .= "the uploaded ".$_FILES["fileToUpload"]["name"]." file is not an image.";
            $uploadOk = 0;
        }
    
        if ($_FILES["fileToUpload"]["size"] > ($maxFileSize)) {
            $msg .=  "the upploaded picture is too big! ".$maxFileSize ."";
            $uploadOk = 0;
        }
    
        if($uploadOk == 1) {
            foreach(IMG_EXTS as $ext) {
                $imgFile = TARGET_DIR . $_SESSION['id'].$ext;
                if (file_exists($imgFile)) {
                    unlink($imgFile);
                }
            }
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        }
        
        return $msg;
    }
}
?>