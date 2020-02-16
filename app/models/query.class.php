<?php
    class Query{
        protected $pdoConn;
        public function __construct($pdoConn){
            $this->pdoConn = $pdoConn;
        }
        public function insert($table,$fields,$values){
            try{
                $stmt = $this->pdoConn->prepare("insert into {$table}(".implode(',',$fields).") values('".implode('\',\'',$values)."')");
                $stmt->execute();
                return 1;
            }catch(PDOException $e){
                print("error inserting - ".$e->getMessage());
                return 0;
            }
        }
    }