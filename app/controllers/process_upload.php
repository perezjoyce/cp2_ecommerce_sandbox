<?php

    require_once "connect.php";
    require_once "functions.php";
    require_once "../sources/class.upload.php";

    if(isset($_POST['id'])) {
        $id = $_POST['id'];

        $target_dir = "../../uploads/" . $id."/"; // folder
        // $filename = $_FILES['upload']['name'];
        $filename = uniqid(); //RANDOM FILENAME
        $uploader = new Upload($_FILES['upload']);
        $imageFileType = strtolower(pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION));
        //$target_file = $target_dir . basename($filename) . ".". $imageFileType;

        //VALIDATION
        // to limit file size to 1 MB
        if ($_FILES['upload']['size'] > 1000000) {
            // REDIRECTING PAGE WITH ERROR MSG IN URL QUERY STRING
            $errorMsg = urlencode("Sorry, your file is too large.");
            header("Location: ../views/profile.php?id=$id&uploadError=" . $errorMsg);
            exit;
        } 

        // to limit type of files 
        if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg') {
            $errorMsg = urlencode("Only JPG, JPEG and PNG Files are allowed.");
            header("Location: ../views/profile.php?id=$id&uploadError=" . $errorMsg);
            exit;
        }

        else {

            $uploader->file_new_name_body = $filename; // rename uploaded file
            $uploader->Process($target_dir); // actual uploading process
            //move_uploaded_file($_FILES['upload']['tmp_name'], $target_file);
            // SET PERMISSION ON FOLDER. TYPE IN TERMINAL : sudo chmod -R  777 app/controllers/uploads/ for file permission for the folder

            // resize uploaded file and copy in another file
            $uploader->file_new_name_body = $filename . "_80x80";
            $uploader->image_resize = true;
            $uploader->image_convert = 'jpg';
            $uploader->image_x = 80;
            $uploader->image_y = 80;
            $uploader->image_ratio_y = false;
            $uploader->image_ratio = true;
            $handle->image_ratio_crop = 'TBLR';
            $uploader->Process($target_dir); // actual uploading of new photo with new size
            if ($uploader->processed) {
                $uploader->Clean();
            }
            
            //$filename = $filename . "." . $imageFileType;
            $sql = "UPDATE tbl_users SET profile_pic='uploads/$id/$filename' WHERE id = $id";
            mysqli_query($conn, $sql);
            header("Location: ../views/profile.php?id=$id");
        }

    }

