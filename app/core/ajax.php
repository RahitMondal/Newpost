<?php
    require_once '../../app/models/connection.class.php';
    require_once '../../app/core/global.functions.php';
    $pdoConn = Connection::make(require_once '../../config/database.config.php');
    $post_description = sanitize($_POST['post_desc']);
    $user_id = sanitize($_POST['user_id']);
    $stmt = $pdoConn->prepare(
        "insert into posts(user_id,post_description)
        values(?,?)"
    );
    $stmt->execute([$user_id,$post_description]);

    $stmt = $pdoConn->prepare("select post_description,post_time from posts order by post_time desc");
    $stmt->execute();
    $html = '';
    if($stmt->rowCount()){
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($res as $row){
            $html += "<div class='post-div'>
            <div class='post_desc'>{$row['post_description']}</div>
            <div class='post_time'>{$row['post_time']}</div>
            </div>";
        }
    }
    echo $html;
?>