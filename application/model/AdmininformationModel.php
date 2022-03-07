<?php

class AdmininformationModel extends Model{
    
    // Phương thức khới tạo
    public function __construct(){
        parent::__construct();
    }    
    public function getList(){
        $sql = 'SELECT * FROM information';
        $this->setQuery($sql);
        $information = $this->readAll();   
        if($information){
            return $this->readAll();
        }else{
            return false;
        }
    }
}

?>