<?php
    $details = App::get('details');
    $user = $_SESSION['user_name'];
    /*if(file_exists("assets/profile_pics/{$user}.jpg")) $file=$user.'.jpg';
    else if(file_exists("assets/profile_pics/{$user}.png")) $file=$user.'.png';
    else if(file_exists("assets/profile_pics/{$user}.gif")) $file=$user.'.gif';
    else if(file_exists("assets/profile_pics/{$user}.tif")) $file=$user.'.tif';
    else $file='no_pic.gif';*/
    if($details['pic_name']) $pic_name=$details['pic_name'];
    else $pic_name = 'no_pic.gif';
?>
<dropdown>
</dropdown>
<container>
    <det>
        <pic style="background-image:url(
            <?= "assets/profile_pics/{$pic_name}" ?>
        );"></pic>
        <info>
            <ul>
                <li style="text-transform:uppercase;font-size:24px;"><?= $details['full_name'] ?></li>
                <li><?= $details['email_id'] ?></li>
                <li><?= $details['phone'] ?></li>
                <li><?= $details['address'] ?></li>
                <li><?= $details['about'] ?></li>
            </ul>
        </info>
        <post>
            <input id="user_id" type="hidden" value=<?= "'{$details['user_id']}'" ?>>
            <textarea id="post_desc" placeholder="Post something here..."></textarea>
            <button id="post_btn">Post</button>
        </post>
    </det>


    <feed>
        <div id='rec-posts'>
            Recent Posts
        </div>
        <div id="user-posts">

        <?php
            $stmt = App::get('conn')->prepare(
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
            if($html) echo $html;
            else echo "<h3 id='first_msg'>Start following people!</h3>";
        ?>

        </div>
        
    </feed>
</container>

<script src="javascripts/loggedin.js"></script>
<!--<script src="javascripts/follow.js"></script>-->
