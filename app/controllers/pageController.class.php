<?php
    class PageController{
        public function home(){
            if(isset($_SESSION['user_name'])){
                App::bind('bodyView','loggedin');
                App::bind('navView','loggedin');
                //fetch details
                $details = App::get('dbUpdate')->fetchDetails('members',$_SESSION['user_name']);
                App::bind('details',$details[0]);
            }else{
                App::bind('bodyView','signUp');
                App::bind('navView','login');
            }

            require_once '../app/views/body.view.php';
        }

        public function friends(){
            require_once '../app/views/friends.view.php';
        }

        public function edit(){
            App::bind('bodyView','update');
            App::bind('navView','loggedin');
            //fetch details
            $details = App::get('dbUpdate')->fetchDetails('members',$_SESSION['user_name']);
            App::bind('details',$details[0]);
            require_once '../app/views/body.view.php';
        }
    }