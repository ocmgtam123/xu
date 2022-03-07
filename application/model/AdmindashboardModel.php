<?php

class AdmindashboardModel extends Model{
    
    // Phương thức khới tạo
    public function __construct(){
        parent::__construct();
    }
    public function getList(){
        $sql = 'SELECT * FROM banner';
        $this->setQuery($sql);
        $banner = $this->readAll();   
        if($banner){
            return $this->readAll();
        }else{
            return false;
        }
    }
}

?>