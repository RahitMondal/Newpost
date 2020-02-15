<?php
    class PageController{
        public function home(){
            require_once 'view/body.view.php';
        }

        public function friends(){
            require_once 'view/friends.view.php';
        }

        public function edit(){
            require_once 'view/edit.view.php';
        }
    }