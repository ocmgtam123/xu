<?php

class AdminfollowModel extends Model{
    
    // Phương thức khới tạo
    public function __construct(){
        parent::__construct();
    }    
    public function getList(){
        $sql = 'SELECT * FROM follow';
        $this->setQuery($sql);
        $follow = $this->readAll();   
        if($follow){
            return $this->readAll();
        }else{
            return false;
        }
    }
}

?>