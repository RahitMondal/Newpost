<?php
    class ModelController{
        public function signup(){
            $user_name = htmlspecialchars(trim($_POST['user_name']));
            $email_id = htmlspecialchars(trim($_POST['email_id']));
            $password = htmlspecialchars(trim($_POST['password']));
            $full_name = htmlspecialchars(trim($_POST['full_name']));

            $fields = ['user_name','email_id','password','full_name'];
            $values = [$user_name,$email_id,$password,$full_name];

            if(App::get('dbUpdate')->insert('members',$fields,$values)) echo "success";
            else echo "fail";
        }
    }