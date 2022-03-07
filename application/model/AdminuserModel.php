<?php

class AdminuserModel extends Model{
    
    // Phương thức khới tạo
    public function __construct(){
        parent::__construct();
    }
    public function getList(){
        $sql = 'SELECT * FROM user';
        $this->setQuery($sql);
        $user = $this->readAll();   
        if($user){
            return $this->readAll();
        }else{
            return false;
        }
    }
}

?>