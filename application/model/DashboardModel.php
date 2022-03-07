<?php

class DashboardModel extends Model{
    
    // Phương thức khởi tạo
    public function __construct(){
        parent::__construct();
    }
    public function getBanners(){
        $option = [
            'sort' => [
                'column' => "pos",
                'order' => "ASC"
            ]
            ,
            'limit' => ['position' => 0,'length' => 10]
        ];
        return $this->loadRecords("banner", ['status' => 1], true, $option);
    }
    
    public function getProductPromotion($page=1,$length=20){
        $begin = ($page - 1) * $length;
        $result['page']=$page;
        $header="SELECT p.* ";
        $headercount="SELECT count(*) as count";
        
        $sql = ' FROM product AS p 
                        WHERE p.status = 1 AND p.promotionstatus =1 ';   
        
        $sortSql ='';
        if (Session::get ( 'sort_price' ) == false){
            Session::set ( 'sort_price', 'down');
        }
        $sortPrice = Session::get ('sort_price');
        if($sortPrice == 'down'){
            $sortSql = ' ORDER BY p.price_sale DESC';
        }else{
            $sortSql = ' ORDER BY p.price_sale ASC';
        }
        
        
        $limit= " LIMIT $begin,$length";
        
        $this->_sql = $header.$sql.$sortSql.$limit;
        $result['data']= $this->readAll();
        
        $this->_sql = $headercount.$sql.$sortSql;
        $count=$this->read();
        return  array_merge($result, $count);
    }
    
    public function getProductNew($page=1,$length=20){  
        $begin = ($page - 1) * $length;
        $result['page']=$page;
        $header="SELECT p.* ";
        $headercount="SELECT count(*) as count";
        
        $sql = ' FROM product AS p
                        WHERE p.status = 1 AND p.newstatus =1 ';
        
        $sortSql ='';
        if (Session::get ( 'sort_price' ) == false){
            Session::set ( 'sort_price', 'down');
        }
        $sortPrice = Session::get ('sort_price');
        if($sortPrice == 'down'){
            $sortSql = ' ORDER BY p.price_sale DESC';
        }else{
            $sortSql = ' ORDER BY p.price_sale ASC';
        }
        
        
        $limit= " LIMIT $begin,$length";
        
        $this->_sql = $header.$sql.$sortSql.$limit;
        $result['data']= $this->readAll();
        
        $this->_sql = $headercount.$sql.$sortSql;
        $count=$this->read();
        return  array_merge($result, $count);
    }

    public function getProductHot($page=1,$length=20){
        
        $begin = ($page - 1) * $length;
        $result['page']=$page;
        $header="SELECT p.* ";
        $headercount="SELECT count(*) as count";
        
        $sql = ' FROM product AS p
                        WHERE p.status = 1 AND p.hotstatus =1 ';
        
        $sortSql ='';
        if (Session::get ( 'sort_price' ) == false){
            Session::set ( 'sort_price', 'down');
        }
        $sortPrice = Session::get ('sort_price');
        if($sortPrice == 'down'){
            $sortSql = ' ORDER BY p.price_sale DESC';
        }else{
            $sortSql = ' ORDER BY p.price_sale ASC';
        }
        
        
        $limit= " LIMIT $begin,$length";
        
        $this->_sql = $header.$sql.$sortSql.$limit;
        $result['data']= $this->readAll();
        
        $this->_sql = $headercount.$sql.$sortSql;
        $count=$this->read();
        return  array_merge($result, $count);
       
    }

    public function getProductPopular($page=1,$length=20){
        
        $begin = ($page - 1) * $length;
        $result['page']=$page;
        $header="SELECT p.* ";
        $headercount="SELECT count(*) as count";
        
        $sql = ' FROM product AS p
                        WHERE p.status = 1 AND p.popularstatus =1 ';
        
        $sortSql ='';
        if (Session::get ( 'sort_price' ) == false){
            Session::set ( 'sort_price', 'down');
        }
        $sortPrice = Session::get ('sort_price');
        if($sortPrice == 'down'){
            $sortSql = ' ORDER BY p.price_sale DESC';
        }else{
            $sortSql = ' ORDER BY p.price_sale ASC';
        }
        
        
        $limit= " LIMIT $begin,$length";
        
        $this->_sql = $header.$sql.$sortSql.$limit;
        $result['data']= $this->readAll();
        
        $this->_sql = $headercount.$sql.$sortSql;
        $count=$this->read();
        return  array_merge($result, $count);
        
    }

    public function getProductCategory($id, $sort='',$page=1,$length=20){
        $begin = ($page - 1) * $length;
        $result['page']=$page;
        $header="SELECT p.* ";
        $headercount="SELECT count(*) as count";

        $sql =  "           FROM product p , category c
                            WHERE p.id_category=c.id AND 
                            			p.status = 1 AND ( c.id = $id OR c.id_parent = $id) " ;        
        
        
        $sortSql ='';

        if (Session::get ( 'sort_price' ) == false){
            Session::set ( 'sort_price', 'down');
        }
        $sortPrice = Session::get ('sort_price');   
        if($sortPrice == 'down'){
            $sortSql = ' ORDER BY p.price_sale DESC';    
        }else{
            $sortSql = ' ORDER BY p.price_sale ASC';
        }

        if($sort == 'new'){
            $sortSql .= ' ,p.newstatus DESC';
        }
        if($sort == 'promotion'){
            $sortSql .= ' ,p.promotionstatus DESC';
        }
        if($sort == 'hot'){
            $sortSql .= ' ,p.hotstatus DESC';
        }
        
        $limit= " LIMIT $begin,$length";
        
        $this->_sql = $header.$sql.$sortSql.$limit;
        $result['data']= $this->readAll();
        
        $this->_sql = $headercount.$sql.$sortSql;
        $count=$this->read();
        return  array_merge($result, $count);
            
            
    }

    public function searchPorduct($keyword,$page=1,$length=20){
              
        $begin = ($page - 1) * $length;
        $result['page']=$page;
        $header="SELECT p.* ";
        $headercount="SELECT count(*) as count";
        
        $sql = " FROM product AS p                         
                        WHERE p.status = 1 AND p.name" . $_SESSION['lang'] ."  LIKE '%" . $keyword . "%'";
        
        $limit= " LIMIT $begin,$length";
        
        $this->_sql = $header.$sql.$limit;
        $result['data']= $this->readAll();
        
        $this->_sql = $headercount.$sql;
        $count=$this->read();
        return  array_merge($result, $count);
    }

    public function getNewsEventHome($page=1,$length=20){
        $begin = ($page - 1) * $length;
        $option = [
            'sort' => [
                'column' => "create_at",
                'order' => "DESC"
            ],
            'limit' => ['position' => $begin,'length' => $length]
        ];
        //'statushome' => 1,
        return $this->loadRecords("newsevent", [ 'status' =>1], true, $option);
    }

    public function getSimilarProduct($id){
        $infoProduct = $this->loadRecord('product',['id' => $id]);       
        $this->_sql = 'SELECT p.*
                        FROM product AS p 
                        WHERE p.status = 1 AND p.id_category =' . $infoProduct['id_category'] . ' LIMIT 0,20';        
        return $this->readAll();         
    }
    public function getListhome(){
        $sql = "SELECT * FROM product LIMIT 10";
        $this->setQuery($sql);
        return $this->readAll();    
    }
}

?>