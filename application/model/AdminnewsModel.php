<?php

class AdminnewsModel extends Model{
    
    // Phương thức khới tạo
    public function __construct(){
        parent::__construct();
    }    
    public function getList(){
        $sql = 'SELECT * FROM news';
        $this->setQuery($sql);
        $news = $this->readAll();   
        if($news){
            return $this->readAll();
        }else{
            return false;
        }
    }
    public function checkexitName($title){
        $sql = 'SELECT title FROM news WHERE title="'.$title.'"';
        $this->setQuery($sql);
        $news = $this->readAll();   
        if($news){
            return true;
        }else{
            return false;
        }
    }
    public function checkexitSlug($slug){
        $sql = 'SELECT slug FROM news WHERE slug="'.$slug.'"';
        $this->setQuery($sql);
        $news = $this->readAll();   
        if($news){
            return true;
        }else{
            return false;
        }
    }
    public function checkexitNameid($id,$title){
        $sql = 'SELECT id,title FROM news WHERE title="'.$title.'" AND id!='.$id;
        $this->setQuery($sql);
        $news = $this->readAll();   
        if($news){
            return true;
        }else{
            return false;
        }
    }
    public function checkexitSlugid($id,$slug){
        $sql = 'SELECT id,slug FROM news WHERE slug="'.$slug.'" AND id!='.$id;
        $this->setQuery($sql);
        $news = $this->readAll();   
        if($news){
            return true;
        }else{
            return false;
        }
    }
}

?>