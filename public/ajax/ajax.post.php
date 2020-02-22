<?php
    require_once '../../app/models/connection.class.php';
    require_once '../../app/core/global.functions.php';
    $pdoConn = Connection::make(require_once '../../config/database.config.php');
    $post_description = sanitize($_POST['post_desc']);
    session_start();
    if($post_description){
        $user_name = $_SESSION['user_name'];
        $stmt = $pdoConn->prepare(
            "insert into posts(user_name,post_description)
            values(?,?)"
        );
        $stmt->execute([$user_name,$post_description]);
    }

    $stmt = $pdoConn->prepare(
        "select distinct pic_name, full_name, post_description, post_time
        from members
        inner join posts using(user_name)
        inner join followers on (posts.user_name=followers.followed_person) or (posts.user_name=followers.follower)
        where follower=?
        order by post_time desc"
    );
    $stmt->execute([$_SESSION['user_name']]);
    $html = "";
    if($stmt->rowCount()){
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($res as $row){
            if($row['pic_name']) $file = $row['pic_name'];
            else $file='no_pic.gif';
            $html .= "
            <div class='post-div'>
                <div class='post-div-top'>
                    <div class='pic-name' style=\"background-image:url(assets/profile_pics/{$file});\"></div>
                    <div class='user-name'>{$row['full_name']}</div>
                </div>
                <div class='post-desc'>".stripslashes($row['post_description'])."</div>
                <div class='post-time'>{$row['post_time']}</div>
            </div>";
        }
    }
    echo $html;
?>