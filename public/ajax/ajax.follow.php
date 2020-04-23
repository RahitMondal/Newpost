<?php
    require_once '../../app/models/connection.class.php';
    require_once '../../app/core/global.functions.php';
    $pdoConn = Connection::make(require_once '../../config/database.config.php');
    $followed_person = sanitize($_GET['followed_person']);
    if($followed_person!==''){
        session_start();
        $user_name = $_SESSION['user_name'];
        try{
            $stmt = $pdoConn->prepare(
                "insert into followers values(?,?)"
            );
            $stmt->execute([$followed_person,$user_name]);
            echo "Followed!";

        }catch(PDOException $e){
            die();
        }
        
    }