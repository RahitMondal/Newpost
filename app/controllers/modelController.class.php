<?php
    class ModelController{
        public function signup(){
            $user_name = sanitize($_POST['user_name']);
            $email_id = sanitize($_POST['email_id']);
            $password = sanitize($_POST['password']);
            $conf_pass = sanitize($_POST['confirm']);
            $full_name = sanitize($_POST['full_name']);
            if(!preg_match("/^[a-zA-Z0-9]*$/",$user_name)){
                header("Location: /?error=Not a valid user name!");die();
            }else if(!filter_var($email_id,FILTER_VALIDATE_EMAIL)){
                header("Location: /?error=Not a valid email!");die();
            }else if($password!==$conf_pass){
                header("Location: /?error=Passwords doesn't match!");die();
            }
            $hashed_pass = password_hash($password,PASSWORD_DEFAULT);
            $fields = ['user_name','email_id','password','full_name'];
            $values = [$user_name,$email_id,$hashed_pass,$full_name];

            if(App::get('dbUpdate')->insert($fields,$values)){
                App::bind('bodyView','update');
                App::bind('navView','update');
                $_SESSION['user_name'] = $user_name;
                require_once '../app/views/body.view.php';
                //die(var_dump($_SESSION));
            }
            else echo "fail";
        }

        public function update(){
            $ext = storeImage();
            $phone_no = sanitize($_POST['phone']);
            $dob = sanitize($_POST['dob']);
            $address = sanitize($_POST['address']);
            $about = sanitize($_POST['about']);

            $pairs = [
                "phone='{$phone_no}'",
                "dob='{$dob}'",
                "address='{$address}'",
                "about='{$about}'"
            ];
            if($ext){
                $pic_name = $_SESSION['user_name'].".".$ext;
                array_push($pairs,"pic_name='{$pic_name}'");
            }
            //die(var_dump($_SESSION));
            if(App::get('dbUpdate')->update('members',$pairs," where user_name='{$_SESSION['user_name']}'")) header('Location: /');

        }

        public function logout(){
            session_unset();
            session_destroy();
            header("Location: /");
        }

        public function login(){
            $user_email = sanitize($_POST['user_email']);
            $password = sanitize($_POST['password']);
            //$hashed_pass = password_hash($password,PASSWORD_DEFAULT);
            App::get('dbUpdate')->validateLogin($user_email,$password);
            header("Location: /");
        }
    }