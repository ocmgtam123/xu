<?php

class AdminproductModel extends Model{
    
    // Phương thức khới tạo
    public function __construct(){
        parent::__construct();
    }
    public function getlistCategory($idcheck){
        $sql = 'SELECT * FROM category WHERE status=1 AND id_parent=0 AND isDelete=0';
        $this->setQuery($sql);
        $category = $this->readAll();   
        $list='';
        $i=0;
        foreach ($category as $cat){
            if($cat['id']==$idcheck){$ch='selected="selected"';}else{$ch='';}
            if($idcheck==0&&$i==0){$ch='selected="selected"';}
            $list.='<option value="'.$cat['id'].'" '.$ch.'>'.$cat['nameVN'].'</option>';
            $id=$cat['id'];
            $sql1 = 'SELECT * FROM category WHERE status=1 AND isDelete=0 AND id_parent='.$id;
            $this->setQuery($sql1);
            $category_sub = $this->readAll();
            foreach ($category_sub as $cat_sub){
                if($cat_sub['id']==$idcheck){$ch_sub='selected="selected"';}else{$ch_sub='';}
                $list.='<option value="'.$cat_sub['id'].'" '.$ch_sub.'>&nbsp&nbsp== '.$cat_sub['nameVN'].'</option>';
            }
            $i++;
        }
        return $list;
    }
    public function checkexitName($name){
        $sql = 'SELECT * FROM product WHERE name="'.$name.'" AND status=1';
        $this->setQuery($sql);
        $product = $this->readAll();   
        if($product){
            return true;
        }else{
            return false;
        }
    }
    public function checkexitSlug($slug){
        $sql = 'SELECT * FROM product WHERE slug="'.$slug.'" AND status=1';
        $this->setQuery($sql);
        $product = $this->readAll();   
        if($product){
            return true;
        }else{
            return false;
        }
    }
    public function checkexitSlugid($id,$slug){
        $sql = 'SELECT * FROM product WHERE slug="'.$slug.'" AND status=1 AND id!='.$id;
        $this->setQuery($sql);
        $product = $this->readAll();   
        if($product){
            return true;
        }else{
            return false;
        }
    }
    public function checkexitNameVNid($id,$name){
        $sql = 'SELECT * FROM product WHERE name="'.$name.'" AND status=1 AND id!='.$id;
        $this->setQuery($sql);
        $product = $this->readAll();   
        if($product){
            return true;
        }else{
            return false;
        }
    }
}

?>