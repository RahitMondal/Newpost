<?php
    class Query{
        protected $pdoConn;
        public function __construct($pdoConn){
            $this->pdoConn = $pdoConn;
        }
        public function insert($fields,$values){
            try{
                $stmt = $this->pdoConn->prepare("select user_id from members where user_name='{$values[0]}'");
                $stmt->execute();
                if($stmt->rowCount()){
                    header("Location: /?error=That user name is not available!");die();
                }
                $stmt = $this->pdoConn->prepare("select user_id from members where email_id='{$values[1]}'");
                $stmt->execute();
                if($stmt->rowCount()){
                    header("Location: /?error=That email is already registered!");die();
                }
                $stmt = $this->pdoConn->prepare("insert into members(".implode(',',$fields).") values('".implode('\',\'',$values)."')");
                $stmt->execute();
                $stmt = $this->pdoConn->prepare("insert into followers values(?,?)");
                $stmt->execute([$values[0],$values[0]]);
                return true;
            }catch(PDOException $e){
                print("error inserting - ".$e->getMessage());
                return false;
            }
        }

        public function update($table,$pairs,$condition){
            try{
                //die("update {$table} set ".implode(',',$pairs).$condition);
                $stmt = $this->pdoConn->prepare("update {$table} set ".implode(',',$pairs).$condition);
                $stmt->execute();
                return true;
            }catch(PDOException $e){
                print("error updating - ".$e->getMessage());
                return false;
            }
        }

        public function fetchDetails($table,$user_name){
            $stmt = $this->pdoConn->prepare("select * from {$table} where user_name='{$user_name}'");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function validateLogin($user_email,$password){
            $stmt = $this->pdoConn->prepare("select user_name,password from members where user_name=? or email_id=?");
            $stmt->execute([$user_email,$user_email]);
            if($stmt->rowCount()){
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                //die(var_dump($res));
                if(password_verify($password,$res[0]['password'])){
                    $_SESSION['user_name'] = $res[0]['user_name'];
                }
                else $_SESSION['msg'] = 'Wrong login credentials!';
            }else $_SESSION['msg'] = 'Wrong login credentials!';
            /*$user_name = $stmt->rowCount();
            echo $user_name;
            echo $stmt->fetchColumn();die();
            if($user_name) $_SESSION['user_name'] = $user_name;
            else $_SESSION['msg'] = 'Wrong login credentials!';*/
        }

    }