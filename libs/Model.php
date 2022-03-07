<?php
class Model {
    protected $_pdo = NULL;
    protected $_sta = NULL;
    protected $_host = DB_HOST;
    protected $_user = DB_USER;
    protected $_pwd = DB_PWD;
    protected $_database = DB_NAME;
    protected $_table = '';
    protected $_prefix = DEFAULT_PREFIX;
    protected $_sql = '';
    protected $_error = false;
    
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c khÃ¡Â»Å¸i tÃ¡ÂºÂ¡o
    public function __construct($params = array()) {
        if ($params) {
            $this->_host = $params ['host'];
            $this->_user = $params ['user'];
            $this->_pwd = $params ['pwd'];
            $this->_database = $params ['database'];
        }
        $this->connect ();
    }
    
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c kÃ¡ÂºÂ¿t nÃ¡Â»â€˜i cÃ†Â¡ sÃ¡Â»Å¸ dÃ¡Â»Â¯ liÃ¡Â»â€¡u
    public function connect() {
        try {
            $this->_pdo = new PDO ( $this->_host . ';dbname=' . $this->_database, $this->_user, $this->_pwd );
            $this->_pdo = new PDO ( $this->_host . ';dbname=' . $this->_database, $this->_user, $this->_pwd );
            $this->_pdo->query ( 'set names "utf8"' );
        } catch ( PDOException $ex ) {
            die ( $ex->getMessage () );
        }
    }
    
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c thiÃ¡ÂºÂ¿t lÃ¡ÂºÂ­p tÃƒÂªn database
    public function setDatabase($database) {
        $this->_database = $database;
    }
    
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c thiÃ¡ÂºÂ¿t lÃ¡ÂºÂ­p tÃƒÂªn bÃ¡ÂºÂ£ng
    public function setTable($table = NULL) {
        if (! empty ( $table )) {
            $this->_table = $this->_prefix . $table;
            return $this->_table;
        }
    }
    
    // FUNCTION SET QUERY
    public function setQuery($sql) {
        $this->_sql = $sql;
    }
    
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c thÃ¡Â»Â±c thi cÃƒÂ¢u truy vÃ¡ÂºÂ¥n
    public function execute($options = array()) {
        //echo '<h3>'.$this->_sql.'</h3>';
        $this->_sta = $this->_pdo->prepare ( $this->_sql );
        if ($options) {
            for($i = 0; $i < count ( $options ); $i ++) {
                $this->_sta->bindParam ( $i + 1, $options [$i] );
            }
        }
        $this->_sta->execute ();
        return $this->_sta;
    }
    
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c Ã„â€˜Ã¡Â»ï¿½c mÃƒÂ´tk dÃƒÂ²ng dÃ¡Â»Â¯ liÃ¡Â»â€¡u $fetch=true trÃ¡ÂºÂ£ vÃ¡Â»ï¿½ Array; $fetch=false trÃ¡ÂºÂ£ vÃ¡Â»ï¿½ Object
    public function read($fetch = true) {
        if (! $result = $this->execute ()) {
            return false;
        }
        if ($fetch == true) {
            return $result->fetch ( PDO::FETCH_ASSOC );
        } else {
            return $result->fetch ( PDO::FETCH_OBJ );
        }
    }
    
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c Ã„â€˜Ã¡Â»ï¿½c nhiÃ¡Â»ï¿½u dÃƒÂ²ng dÃ¡Â»Â¯ liÃ¡Â»â€¡u $fetch=true trÃ¡ÂºÂ£ vÃ¡Â»ï¿½ Array; $fetch=false trÃ¡ÂºÂ£ vÃ¡Â»ï¿½ Object
    public function readAll($fetch = true, $options = array()) {
        if ($options) {
            if (! $result = $this->execute ( $options )) {
                return false;
            }
        } else {
            if (! $result = $this->execute ()) {
                return false;
            }
        }
        if ($fetch == true) {
            return $result->fetchAll ( PDO::FETCH_ASSOC );
        } else {
            return $result->fetchAll ( PDO::FETCH_OBJ );
        }
    }
    
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c tÃ¡ÂºÂ¡o dÃƒÂ²ng dÃ¡Â»Â¯ liÃ¡Â»â€¡u insert hoÃ¡ÂºÂ·c update
    public function createData($option = array(), $type = "insert")
    {
        if ($option) {
            $data = array();
            if ($type == "insert") {
                $cols = $vals = '';
                foreach ($option as $key => $value) {
                    $cols .= ", `$key`";
                    $vals .= is_null($value) ? (", NULL") : (", '".addslashes($value)."'");
                }
                $data['cols'] = substr($cols, 2);
                $data['vals'] = substr($vals, 2);
                return $data;
            }
            if ($type == "update") {
                foreach ($option as $key => $value) {
                    $data[] = "`" . $key . "`='" . addslashes($value) . "'";
                }
                return implode(',', $data);
            }
        }
        $this->_error = true;
    }
    
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c tÃ¡ÂºÂ¡o Ã„â€˜iÃ¡Â»ï¿½u kiÃ¡Â»â€¡n truy vÃ¡ÂºÂ¥n
    public function createWhere($option = array(), $concat = false)
    {
        $sql = '';
        if ($option) {
            if (isset($option['where'])) {
                $sql = $option['where'];
            }else{
                $str= '';
                foreach ($option as $key => $value) {
                    $str .= " AND `" . addslashes($key). "`='" . addslashes($value) . "'";
                }
                $sql = substr($str, 5);
            }
            if($concat == false){
                $sql = ' WHERE ' . $sql;
            }else{
                $sql = ' AND ' . $sql;
            }
        }
        return $sql;
    }
    
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c tÃ¡ÂºÂ¡o tÃƒÂ¹y chÃ¡Â»ï¿½n cho SQL
    public function createOptions($options = []){
        $sql = '';
        $default = [
            'limit' => [
                'position' => 0,
                'length' => DEFAULT_LENGTH
            ]
        ];
        $options = array_merge($default, $options);
        if ($options) {
            if (array_key_exists('sort', $options)) {
                $column = isset($options['sort']['column']) ? $options['sort']['column'] : NULL;
                $order = isset($options['sort']['order']) ? $options['sort']['order'] : NULL;
                if($column !== NULL && $order !== NULL){
                    $sql .= ' ORDER BY ' . addslashes($column) . ' ' . addslashes($order);
                }
            }
            if (array_key_exists('limit', $options)) {
                $position = isset($options['limit']['position']) ? $options['limit']['position'] : 0;
                $length = isset($options['limit']['length']) ? $options['limit']['length'] : 50;
                $sql .= ' LIMIT ' . addslashes($position) . ', ' . addslashes($length);
            }
        }
        return $sql;
    }
    
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c tÃ¡ÂºÂ¡o string tÃ¡Â»Â« mÃ¡ÂºÂ£ng truy vÃ¡ÂºÂ¥n
    public function convertId($option = array())
    {
        $array = array();
        if($option){
            foreach ($option as $value) {
                $value = trim($value);
                if (! empty($value)) {
                    $array[] = "'" . trim($value) . "'";
                }
            }
        }
        return implode(',', $array);
    }
    
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c Ã„â€˜Ã¡ÂºÂ¿m dÃƒÂ²ng trÃ¡ÂºÂ£ vÃ¡Â»ï¿½ khi truy vÃ¡ÂºÂ¥n
    public function getRowCount()
    {
        return $this->_sta->rowCount();
    }
    
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c trÃ¡ÂºÂ£ vÃ¡Â»ï¿½ id cuÃ¡Â»â€˜i cÃƒÂ¹ng cÃ¡Â»Â§a bÃ¡ÂºÂ£ng
    public function getLastId()
    {
        return $this->_pdo->lastInsertId();
    }
    
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c thÃƒÂªm mÃ¡Â»â„¢t dÃƒÂ²ng dÃ¡Â»Â¯ liÃ¡Â»â€¡u
    public function insertRecord($table, $data)
    {
        $data = $this->createData($data);
        if (! $this->_error) {
            $this->_sql = 'INSERT INTO `' . $this->setTable($table) . '` (' . $data['cols'] . ') VALUES (' . $data['vals'] . ')';
            //echo '<h3>'.$this->_sql.'</h3>';
            $this->execute();
            return $this->getLastId();
        }
        return false;
    }
    public function insertRecords($table, $datas)
    {
        $column_list=$value_list="";
        if($datas!=[]){
            foreach ($datas as $data){
                $data = $this->createData($data);
                $column_list= $data['cols'];
                $value_list.= ' (' . $data['vals'] . ') ,';
            }
            if (!$this->_error) {
                $value_list=substr($value_list, 0, -1);
                $this->_sql = 'INSERT INTO `' . $this->setTable($table) . '` (' . $column_list . ') VALUES '.$value_list;
                //echo '<h3>'.$this->_sql.'</h3>';
                $this->execute();
                return $this->getRowCount();
            }
        }
        return false;
    }
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c cÃ¡ÂºÂ­p nhÃ¡ÂºÂ­t mÃ¡Â»â„¢t hoÃ¡ÂºÂ·c nhiÃ¡Â»ï¿½u dÃƒÂ²ng dÃ¡Â»Â¯ liÃ¡Â»â€¡u
    public function updateRecord($table, $data, $where)
    {
        $data = $this->createData($data, 'update');
        $where = $this->createWhere($where);
        if (! $this->_error) {
            $this->_sql = 'UPDATE `' . $this->setTable($table) . '` SET ' . $data .  $where;
            $this->execute();
            return $this->getRowCount();
        }
        return false;
    }
    
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c load mÃ¡Â»â„¢t dÃƒÂ²ng dÃ¡Â»Â¯ liÃ¡Â»â€¡u tÃ¡Â»Â« bÃ¡ÂºÂ£ng
    public function loadRecord($table, $where = array(), $fetch = true)
    {
        $this->_sql = 'SELECT * FROM `'. $this->setTable($table) . '`' . $this->createWhere($where);
        return $this->read($fetch);
    }
    
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c load nhiÃ¡Â»ï¿½u dÃƒÂ²ng dÃ¡Â»Â¯ liÃ¡Â»â€¡u tÃ¡Â»Â« bÃ¡ÂºÂ£ng
    public function loadRecords($table, $where = array(), $fetch = true, $options = array())
    {
        $this->_sql = 'SELECT * FROM `' . $this->setTable($table) . '`' . $this->createWhere($where) . $this->createOptions($options);
        //echo '<h3>'.$this->_sql.'</h3>';
        return $this->readAll($fetch);
    }
    
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c xÃƒÂ³a mÃ¡Â»â„¢t hoÃ¡ÂºÂ·c nhiÃ¡Â»ï¿½u dÃƒÂ²ng
    public function deleteRecord($table, $where)
    {
        if ($table && $where) {
            $this->_sql = "DELETE FROM `" . $this->setTable($table) .'`'. $this->createWhere($where);
            $this->execute();
            return $this->getRowCount();
        }
        return false;
    }
    public function getInfo() {
        $sql = "SELECT * FROM information";
        $this->setQuery($sql); 
        $list = $this->readAll();
        $arr=[];
        foreach ($list as $l) {
            if($l["id"]==1){
                $arr['logo'] = $l["image"];
            }
            if($l["id"]==2){
                $arr['hotline'] = $l["des"];
            }
            if($l["id"]==3){
                $arr['email'] = $l["des"];
            }
            if($l["id"]==4){
                $arr['title'] = $l["des"];
            }
            if($l["id"]==5){
                $arr['addressfooter'] = $l["des"];
            }
            if($l["id"]==6){
                $arr['maphome'] = $l["des"];
            }
            if($l["id"]==7){
                $arr['copyright'] = $l["des"];
            }
            if($l["id"]==8){
                $arr['banner'] = $l["image"];
            }
            if($l["id"]==9){
                $arr['website'] = $l["des"];
            }
        }
        return $arr;
    }
    public function getListfollow() {
        $sql = "SELECT * FROM follow WHERE status=1";
        $this->setQuery($sql); 
        $list = $this->readAll();        
        return $list;
    }
    public function countRowTabel($table, $where = array()){
        if ($table && $where) {
            $sql = 'SELECT COUNT(*) as record FROM `'. $this->setTable($table) .'`'. $this->createWhere($where);
            $this->setQuery($sql);
            return $this->read();
        }
    }
    
    // PhÃ†Â°Ã¡Â»â€ºc thÃ¡Â»Â©c ngÃ¡ÂºÂ¯t kÃ¡ÂºÂ¿t nÃ¡Â»â€˜i database
    public function disconnect()
    {
        $this->_pdo = NULL;
    }
    
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c ngÃ¡ÂºÂ¯t kÃ¡ÂºÂ¿t nÃ¡Â»â€˜i database tÃ¡Â»Â± Ã„â€˜Ã¡Â»â„¢ng
    public function __destruct()
    {
        $this->disconnect();
    }
    
}
?>