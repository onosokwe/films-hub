<?php
include_once('sql.php');
date_default_timezone_set ("Africa/Lagos");

class LAM_SHOP extends sqlOps {
	public $conn;
	public function __construct(){
		$this->conn = new sqlOps(); 
		return $this->conn;
	}

	// Hash a string and returns the hashed value as Password or boolean
	public function passwordIt($pass){
		if($pass !== ""){
			return password_hash($pass, PASSWORD_DEFAULT);
		} else {return FALSE;}
	}

	// Verify if a password matches the hash; returns the hash
	public function verifyPassword($password, $hash){
		if($password && $hash !== ""){
			if(password_verify($password, $hash)){return true;} else return false;
		} else return false;
	}

	// Checks if email is registered; returns Boolean
	public function isEmailRegistered($email){
		$email = $this->conn->strEscape($email);
		if($email){
			$table = "tbl_users"; $cols = "*";
			$where = "WHERE `user_email` = '$email'";
			if($this->conn->select($table,$cols,$where) > 0){
				return TRUE;
			} else {return FALSE;}
		} return FALSE;
	}

	// Checks if email and plain password entered matches; 
	// Returns user details if match and FALSE if not match
	public function isEmailPasswordMatch($email, $pass){
		$table = "tbl_users"; 
		$cols = "*";
		$where = "WHERE `user_email` = '$email'";
		if($fet = $this->conn->select_fetch($table,$cols,$where)){
			$hash  = $fet[0]['user_pass'];
			if($this->verifyPassword($pass, $hash)){
				$user = array($fet[0]['user_id'], $fet[0]['user_username'], $fet[0]['user_name'], $fet[0]['user_email'], $fet[0]['user_bday'], $fet[0]['status'], $fet[0]['user_level'], $fet[0]['user_address'], );
				return $user;
			} else {return false;}
		} else {return false;}
	}

	// Get films
	public function films(){
		$table = "tbl_films"; 
		$col = "*"; 
		$where = "WHERE sn > 0 AND status = '1'"; 
		$orderby = "ORDER BY sn DESC";
		$items = $this->conn->select_f($table,$col,$where,$orderby); 
		if($items){return $items;} else return false;
	}

	// Get Genres
	public function getGenres(){
		$table = "tbl_genres"; 
		$col = "*"; 
		$where = "WHERE sn > 0 AND status = '1'"; 
		$orderby = "ORDER BY sn DESC";
		$items = $this->conn->select_f($table,$col,$where,$orderby); 
		if($items){return $items;} else return false;
	}

	// Get orders
	public function getOrders(){
		$table = "tbl_orders"; 
		$col = "*"; 
		$where = "WHERE sn > 0 AND status = '1'"; 
		$orderby = "ORDER BY sn DESC";
		$items = $this->conn->select_f($table,$col,$where,$orderby); 
		if($items){return $items;} else return false;
	}

	// Get monthly orders
	public function getMonthlyOrders($month){
		$table = "tbl_orders"; 
		$col = "*"; 
		if($month !== ''){$yend = $month."-31"; $ystart = $month."-01";}else {$yend = $ystart = '';}
		$where = "WHERE (`ordered_on` >='$ystart' AND `ordered_on` <='$yend') AND status = '1'"; 
		$orderby = "ORDER BY sn DESC";
		$items = $this->conn->select_f($table,$col,$where,$orderby); 
		if($items){return $items;} else return false;
	}

	// Get user
	public function getUser($email){
		$table = "tbl_users"; 
		$col = "*"; 
		$where = "WHERE `user_email`='$email' AND status = '1'"; 
		$orderby = "ORDER BY sn DESC";
		$items = $this->conn->select_f($table,$col,$where,$orderby); 
		if($items){return $items;} else return false;
	}

	// Get orders
	public function getUserOrders($email){
		$table = "tbl_orders"; 
		$col = "*"; 
		$where = "WHERE `user_address`='$email' AND status = '1'"; 
		$orderby = "ORDER BY sn DESC";
		$items = $this->conn->select_f($table,$col,$where,$orderby); 
		if($items){return $items;} else return false;
	}

	// Create Orders
	public function createOrders($oid,$uid,$email,$cart,$total){
		$c = count($cart);
		$on = date('Y-m-d'); $at = date('h:i:s');
		foreach($cart as $key => $value){
			$id = $value['item_id'];
			$title = $value['item_title'];
			$year = $value['item_year'];
			$price = $value['item_price'];
			$avatar = $value['item_avatar'];
			$genre = $value['item_genre'];
			$table = "tbl_orders"; 
			$cols = "`order_id`,`order_total`,`film_id`,`film_title`,`film_year`,`film_price`,`film_avatar`,`film_genre`,`user_id`,`user_address`,`ordered_on`,`ordered_at`,`status`"; 
			$vals = "'$oid','$total','$id','$title','$year','$price','$avatar','$genre','$uid','$email','$on','$at','1'"; 
			$where = "WHERE (`film_id` = '$id' AND `user_id` = '$uid') AND `status` = '1'";
			if($this->conn->insert_check($table,$cols,$vals,$where)){$c--;}else {$c--;}
		} 
		if($c === 0){return true;} else {return FALSE;}
	}

	// Add User (generate username)
	public function addUser($name, $email, $address, $date, $pass){
		$table = "tbl_users"; 
		$username = (explode('@',$email)); 
		$username = $username[0]; 
		$uname = strtolower($username).rand(1000,9999);
		$code = rand(10000000,99999999); $on = date('Y-m-d'); $at = date('h:i:s');
		$pass = $this->passwordIt($pass);
        $col = "`user_id`,`user_name`,`user_username`,`user_email`,`user_address`,`user_pass`,`user_level`,`user_bday`,`status`,`created_on`,`created_at`";
        $values = "'$code','$name','$uname','$email','$address','$pass','2','$date','1','$on','$at'";
        $where = "WHERE (`user_id` = '$code' OR `user_email` = '$email') AND `status` = '1'";
        if($this->conn->insert_check($table,$col,$values,$where)){return true;} else return false;
    }

	// Update User
	public function updateUser($name, $bday, $address, $email){
		$table = "tbl_users"; 
        $col = "`user_name`= '$name',`user_address` = '$address',`user_bday` = '$bday'";
        $where = "WHERE (`user_email` = '$email') AND `status` = '1'";
        if($this->conn->update($table,$col,$where)){return true;} else return false;
    }

	// Delete Genre
	public function delGenre($genreid){
		$table = "tbl_genres"; 
        $col = "`status`= '2'";
        $where = "WHERE (`genre_id` = '$genreid') AND `status` = '1'";
        if($this->conn->update($table,$col,$where)){return true;} else return false;
    }

	// Delete Film
	public function delFilm($id){
		$table = "tbl_films"; 
        $col = "`status`= '2'";
        $where = "WHERE (`film_id` = '$id') AND `status` = '1'";
        if($this->conn->update($table,$col,$where)){return true;} else return false;
    }

	// Update Password
	public function updatePassword($email,$oldpass,$newpass){
		$table = "tbl_users"; 
		if($this->isEmailRegistered($email)){
			if($uu = $this->isEmailPasswordMatch($email, $oldpass)){
				$pass = $this->passwordIt($newpass);
				$col = "`user_pass` = '$pass'";
        		$where = "WHERE (`user_email` = '$email') AND `status` = '1'";
        		if($this->conn->update($table,$col,$where)){return true;} else return false;
			} else return false;
		} else return false;
    }

	public function addFilm($title, $year, $price, $genre, $imagePath){
		$table = "tbl_films"; 
		$code = rand(10000000,99999999); $on = date('Y-m-d'); $at = date('h:i:s');
        $col = "`film_id`,`film_title`,`film_year`,`film_price`,`film_genre`,`film_avatar`,`status`,`created_on`,`created_at`";
        $values = "'$code','$title','$year','$price','$genre','$imagePath','1','$on','$at'";
        $where = "WHERE (`film_title` = '$title' OR `film_id` = '$code') AND `status` = '1'";
        if($this->conn->insert_check($table,$col,$values,$where)){return true;} else return false;
    }

	public function addGenre($name){
		if ($name != ""){
			$table = "tbl_genres"; 
			$code = rand(10000000,99999999); $on = date('Y-m-d'); $at = date('h:i:s');
	        $col = "`genre_id`,`genre_name`,`status`,`created_on`,`created_at`";
	        $values = "'$code','$name','1','$on','$at'";
	        $where = "WHERE (`genre_name` = '$name' OR `genre_id` = '$code') AND `status` = '1'";
        	if($this->conn->insert_check($table,$col,$values,$where)){return true;} else return false;
        } else return false;
	}

	public function uploadImages($image){
		$errSize = $errExt = false;
		define("FOLDER","C:/xampp/htdocs/apps/brillo/uploads/");
		define("URL","http://localhost/apps/brillo/uploads/");
	    $illegal = array_merge(array_map('chr', range(0,31)), ["<",">",":",'"',"/","\\","|","?","*"," ","../","%","_"]);	
		$file_name = str_replace($illegal, "-", $image);
		$file_name = str_replace(",","-",$file_name);
		$pathinfo = pathinfo($file_name);
		$file_size = $_FILES['image']['size'];	
		$file_type = $_FILES['image']['type'];
		$file_name = $pathinfo['filename'] ? $pathinfo['filename'] : '';
		$file_name = strtolower($file_name);
		$file_base = $pathinfo['basename'] ? $pathinfo['basename'] : '';
		$file_ext = (explode('.',$pathinfo['basename']));	
		$file_ext =	strtolower(end($file_ext));
		$file_tmp = $_FILES['image']['tmp_name'];
		$extension = array("jpeg","jpg","png");
		if ($file_name !== ""){
			if (in_array($file_ext, $extension) === true) {
				if ($file_size < 2394686) {	
					$filenametoupload = SHA1($file_name);
					$filenametoupload = $filenametoupload.time();
					$filenametoupload = $filenametoupload.'.'.$file_ext;
					$moved = move_uploaded_file($file_tmp,FOLDER.$filenametoupload);
					$pathtoupload = URL.$filenametoupload;
					if ($moved) {
						return $pathtoupload;
					} else return NULL;
				} else return NULL;
			} else return NULL;
		} else return NULL;
	} 

    public function sendRegisterMail($name,$email){
        $headers = "From: FilmsHub <noreply@brilloconnectz.com> \r\n";
        $headers.= "Reply-To: FilmsHub <noreply@brilloconnectz.com> \r\n"; 
        $headers.= "Return-Path: FilmsHub <noreply@brilloconnectz.com> \r\n";
        $headers.= "Organization: FilmsHub \r\n";
        $headers.= "X-Sender: <noreply@brilloconnectz.com> \n";
        $headers.="X-Mailer: PHP/" . phpversion()." \r\n";
        $headers.= "MIME-Version: 1.0" . "\r\n";
        $headers.= "Content-type: text/html; charset=utf-8 \r\n";
        $headers.= "X-Priority: 1 (Highest) \r\n";
        $headers.= "X-MSMail-Priority: High \n";
        $headers.= "Importance: High \n";
        $to = $email; 
        $subject = "Welcome - FilmsHub"; 
        $body = '
        <div style="font-family: Roboto; color: #333; margin-left: 0; margin-right: 10%">
            <h1 style="color: #212529;font-size: 18px;">Password Reset</h1>
            <div style="font-size: 16px">
                <p>Dear ' .$name.' ('. $email .'), your account on FilmsHub has been created.</p>
                <p>If you did not request this, please ignore this email.</p> 
            </div>
        </div>';
        if (mail($to, $subject, $body, $headers, '-fnoreply@brilloconnectz.com')){return true;} else {return false;}
    }


}
?>