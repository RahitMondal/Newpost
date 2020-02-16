<?php
    class PageController{
        public function home(){
            require_once '../app/views/body.view.php';
        }

        public function friends(){
            require_once '../app/views/friends.view.php';
        }

        public function edit(){
            require_once '../app/views/edit.view.php';
        }
    }