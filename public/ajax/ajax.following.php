<?php
    require_once '../../app/models/connection.class.php';
    require_once '../../app/core/global.functions.php';
    $pdoConn = Connection::make(require_once '../../config/database.config.php');
    session_start();
    $user_name = $_SESSION['user_name'];
        $stmt = $pdoConn->prepare(
            "select user_name,full_name,pic_name from members
            inner join followers on members.user_name=followers.followed_person
            where followers.follower=? and not followers.followed_person=?
            order by full_name"
        );
        $stmt->execute([$user_name,$user_name]);
        if($stmt->rowCount()){
            $html = '';
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($res as $row){
                if($row['pic_name']) $file = $row['pic_name'];
                else $file='no_pic.gif';
                $html .= "
                <div class='post-div'>
                    <div class='post-div-top'>
                        <div class='pic-name' style=\"background-image:url(assets/profile_pics/{$file});\"></div>
                        <div class='user-name'>{$row['full_name']}</div>";

                $html.="<button class='unfollow' value='{$row['user_name']}'>Following</button>";

                $html.="</div>
                </div>";
            }
            echo $html;
        }