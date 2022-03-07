<?php

class AdminorderModel extends Model{
    
    // Phương thức khới tạo
    public function __construct(){
        parent::__construct();
    }    
    public function getList(){
        $sql = 'SELECT * FROM `order`';
        $this->setQuery($sql);
        $order = $this->readAll();   
        if($order){
            return $order;
        }else{
            return false;
        }
    }
    public function getCountorder(){
        $sql = 'SELECT * FROM `order`';
        $this->setQuery($sql);
        $order = $this->readAll();   
        if($order){
            return count($order);
        }else{
            return 0;
        }
    }
    public function getCountorderstatus($status){
        $sql = 'SELECT id FROM `order` WHERE status='.$status;
        $this->setQuery($sql);
        $order = $this->readAll();   
        if($order){
            return count($order);
        }else{
            return 0;
        }
    }
    public function getListproduct(){
        $sql = 'SELECT * FROM product WHERE isDelete=0 AND `status`=1 LIMIT 2';
        $this->setQuery($sql);
        $order = $this->readAll();   
        if($order){
            return $this->readAll();
        }else{
            return false;
        }
    }
    public function getStatus($id){
        $status="";
        if($id==0){
            $status="Khởi tạo";
        }
        if($id==1){
            $status="Xác nhận";
        }
        if($id==2){
            $status="Đang vận chuyển";
        }
        if($id==3){
            $status="Đã giao hàng";
        }
        if($id==-1){
            $status="Hủy đơn";
        }
        return $status;
    }
}

?>