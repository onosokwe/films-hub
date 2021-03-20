<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'db_brillojob');

class appStart {
	private static $connect;
	public function connect($db){
		if(!empty($db)){
			$connect = new MySQLi(HOST,USER,PASSWORD,$db);
		} else {$connect = new MySQLi(HOST,USER,PASSWORD,DATABASE);}
		return $connect;
	}
}

class sqlOps extends appStart {
	public $conn;
	public $sql;
	public $result;
	public function __construct($db=''){
    	$this->conn = $this->connect($db);
		$this->result = NULL;
	}
	public function strEscape($string){ 
		$string = strip_tags(htmlentities(htmlspecialchars(stripslashes(trim($string)))));
		$escString = $this->conn->real_escape_string($string);
		return $escString; 
	}
	private function myquery($sql){ 
		$this->sql = $sql; 
		$this->result = $this->conn->query($this->sql); 
		if($this->result){return $this->result;} 
		else { die ($this->conn->error."; Problem with Query \"".$this->sql."\"\n"); }
	}
	public function insert($table, $cols, $values){
		$cols = (is_array($cols)) ? implode(',',$cols) : $cols;
		$values = (is_array($values)) ? implode(',',$values) : $values;
		if(substr($values,0,1) == '('){
			$sql = $this->myquery("INSERT INTO {$table} ({$cols}) VALUES {$values}");
		} else {
			$sql = $this->myquery("INSERT INTO {$table} ({$cols}) VALUES ({$values})");
		}
		if($sql){ return $this->conn->affected_rows; } else { return FALSE; }
	}
	public function insert_check($table, $cols, $vals,$where=''){
		if(empty($where)){ die("Please, define a 'WHERE ..' clause for this operation"); }
		$slct = $this->select($table, $cols, $where);
		if(!$this->result->num_rows){
			return $this->insert($table, $cols, $vals);
		}else{return 0;} 
	}
	public function select($table, $cols='', $where='', $orderBy='', $limit=''){
		$sel = "SELECT {$cols} FROM {$table} {$where} {$orderBy} {$limit}";
		if($this->myquery($sel)){ 
			return $this->result->num_rows; 
		} return FALSE;
	}
	public function select_f($table,$cols='',$where='',$orderBy='',$limit=''){
		$list = $this->select($table,$cols,$where,$orderBy,$limit); return ($list) ? $this->result : false;
	}
	public function select_fetch($table, $cols='', $where='', $orderBy='', $limit=''){
		if($sel = $this->select($table,$cols,$where,$orderBy,$limit)){
			$fetch = array(); 
			$sn = 0;
			while($row = $this->result->fetch_assoc()){	
				$fetch[] = $row;
			} return $fetch;
		} else { return ($sel === 0) ? $sel : FALSE; }
	}
	public function update($table, $colsVals, $where){
		if(empty($where)){ die("Please, define a WHERE"); }
		if(empty($colsVals)){ die("Please, specify COLUMN=['VALUE']"); }
		if(is_array($where)){ 
			list($where,$whrUNIQUE) = $where; 
			if($this->select($table,'',$whrUNIQUE)){ return FALSE; }
		}
		$colsVals = (is_array($colsVals)) ? implode(',',$colsVals) : $colsVals; 
		$sql = $this->myquery("UPDATE {$table} SET {$colsVals} {$where}"); 
		if($sql){ return $this->conn->affected_rows; } else { return FALSE; } 
	}
    public function totalSales($month){
        $tbl = 'tbl_orders'; $yr = date('Y');
        if($month !== ''){$yend = $month."-31"; $ystart = $month."-01";}else {$yend = $ystart = '';}
        $where = "(`ordered_on` >='$ystart' AND `ordered_on` <='$yend')";
        $sql1 = $this->myquery("SELECT SUM(`film_price`) FROM {$tbl} WHERE {$where}");
        $row = mysqli_fetch_assoc($sql1);
        if (!is_null($row)) {$total = array_sum(array_values($row)); return $total;} else {return '0';}
    }
    public function totalPurchase(){
        $tbl = 'tbl_orders';
        $where = "(`status` ='2')";
        $sql1 = $this->myquery("SELECT COUNT(`status`) FROM {$tbl} WHERE {$where}");
        $row = mysqli_fetch_assoc($sql1);
        if (!is_null($row)) {$total = array_sum(array_values($row)); return $total;} else {return '0';}
    }

}
?>