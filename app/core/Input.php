<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 20/09/2016
 * Time: 17:11
 */
namespace Battleheritage\core;

use Battleheritage\core\Message ;

class Input{

    public static function exists($type = 'post'){
        switch($type){
            case 'post';
                if(!empty($_POST)){
                    return true;
                }else{
                    return false;
                }
                break;
            case 'get';
                if(!empty($_GET)){
                    return true;
                }else{
                    return false;
                }
                break;
            default:
                return false;
                break;
        }
    }

    public static function get($item){
        
        if(isset($_POST[$item])){
            return ($_POST[$item]);
        }else if(isset($_GET[$item])){
            return $_GET[$item];
        }
        return '';
    }

    public static function uploadPhoto($photo){
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES[$photo]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES[$photo]["tmp_name"]);
            if($check !== false) {
               //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
            } else {
                      Message::setMessage("File is not an image.","error");
            $uploadOk = 0;
            }
            }
            // Check if file already exists
        if (file_exists($target_file)) {
            Message::setMessage("Sorry, file already exists.","error");
             $uploadOk = 0;
            }
            // Check file size
        if ($_FILES[$photo]["size"] > 500000) {
            Message::setMessage("Sorry, your file is too large.","error");
             $uploadOk = 0;
            }
            // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif" ) {
            Message::setMessage("Sorry, only JPG, JPEG, PNG & GIF files are allowed.","error");
             $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            //Message::setMessage("Sorry, your file was not uploaded.","error");
            // if everything is ok, try to upload file
            } else {
            if (move_uploaded_file($_FILES[$photo]["tmp_name"], $target_file)) {
                Message::setMessage("The file ". basename( $_FILES[$photo]["name"]). " has been uploaded.","success");
            } else{
                Message::setMessage("Sorry, there was an error uploading your file.","error");
             }
            }

    }




}