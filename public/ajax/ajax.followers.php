<?php
    require_once '../../app/models/connection.class.php';
    require_once '../../app/core/global.functions.php';
    $pdoConn = Connection::make(require_once '../../config/database.config.php');
    session_start();
    $user_name = $_SESSION['user_name'];
        $stmt = $pdoConn->prepare(
            "select user_name,full_name,pic_name from members
            inner join followers on members.user_name=followers.follower
            where followers.followed_person=? and not followers.follower=?
            order by full_name"
        );
        $stmt->execute([$user_name,$user_name]);
        if($stmt->rowCount()){
            $html = '';
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($res as $row){
                $stmt = $pdoConn->prepare("select * from followers where followed_person=? and follower=?");
                $stmt->execute([$row['user_name'],$user_name]);
                if($row['pic_name']) $file = $row['pic_name'];
                else $file='no_pic.gif';
                $html .= "
                <div class='post-div'>
                    <div class='post-div-top'>
                        <div class='pic-name' style=\"background-image:url(assets/profile_pics/{$file});\"></div>
                        <div class='user-name'>{$row['full_name']}</div>";

                if($stmt->rowCount()) $html.="<button class='unfollow' value='{$row['user_name']}'>Following</button>";
                else $html.="<button class='follow' value='{$row['user_name']}' >Follow</button>";

                $html.="</div>
                </div>";
            }
            echo $html;
        }
