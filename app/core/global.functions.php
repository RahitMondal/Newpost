<?php
    function storeImage(){
        if($_FILES){
            $name = $_FILES['pic']['name'];
            switch($_FILES['pic']['type']){
                case 'image/jpeg': $ext = 'jpg';break;
                case 'image/gif': $ext = 'gif';break;
                case 'image/png': $ext = 'png';break;
                case 'image/tiff': $ext = 'tif';break;
                default: $ext = '';
            }
            if($ext){
                $new_name = "assets/profile_pics/{$_SESSION['user_name']}.{$ext}";
                 //delete image if exists
                if(file_exists($new_name)) unlink($new_name);
                move_uploaded_file($_FILES['pic']['tmp_name'],''.$new_name);
            }
            return $ext;
        }
    }
    function sanitize($value){
        return htmlspecialchars(addslashes(trim($value)));
    }