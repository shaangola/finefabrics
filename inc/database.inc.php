<?php

class Database
{
    // Connection parameters
	
	var $host = "";
    var $user = "";
    var $password = "";
    var $database = "";

    var $persistent = false;

	// Database connection handle 
    var $conn = NULL;

    // Query result 
    var $result = false;

//    function DB($host, $user, $password, $database, $persistent = false)
    public function __construct()
    {
		$config = new Config();

		$this->host = $config->host;
		$this->user = $config->user;
		$this->password = $config->password;
		$this->database = $config->database;
   	
	}

    function open()
    {
        // Choose the appropriate connect function 
        if ($this->persistent) {
            $func = 'mysql_pconnect';
        } else {
            $func = 'mysqli_connect';
        }
        // Connect to the MySQL server 
        $this->conn = $func($this->host, $this->user, $this->password);
        if (!$this->conn) {
		header("Location: error.html");
		//echo "-->".mysqli_error();
	    //exit;
            return false;
        }

        // Select the requested database 
        //echo $this->database;
        //var_dump($this->conn);
        //die;
        if (!mysqli_select_db($this->conn,$this->database)) {
           
            return false;
        }

        return true;
    }

    function close()
    {
        return (@mysqli_close($this->conn));
    }

    function error()
    {
        return (mysqli_error());
    }

    function query($sql = '')
    {
        $this->result = mysqli_query( $this->conn,$sql);
		return ($this->result != false);
    }

	
	
	function rs_insert($table,$field,$values){
		$sql="insert into $table($field) values($values)";
		$this->result = @mysqli_query($this->conn,$sql);
		return ($this->result);
	}
	function rs_delete($table,$cond){
		$sql="delete from $table where $cond";
		$this->result = @mysqli_query($this->conn,$sql);
		return ($this->numRows()==0?false:true);
	}
	function isFound($table,$cond){
		$sql="select 1 from $table where $cond";
		$this->result = @mysqli_query($this->conn,$sql);
		return ($this->numRows()==0?false:true);
	}
	function getCount($table,$field,$cond){
		$sql="select $field as count from $table where $cond";
		$this->result = @mysqli_query($this->conn,$sql);
		$fdata=@mysqli_fetch_array($this->result, MYSQL_BOTH);
		return ($fdata['count']);
	}

	
    function affectedRows()
    {
        return (@mysqli_affected_rows($this->conn));
    }

    function numRows()
    {
        return (@mysqli_num_rows($this->result));
    }

    function numCols()
    {
        return @mysqli_num_fields($this->result);
    }
	
	function fieldName($field)
    {
       return (@mysqli_field_name($this->result,$field));
    }
	 function insertID()
    {
        return (@mysqli_insert_id($this->conn));
    }
    
    function fetchArray()
    {
        return (@mysqli_fetch_array($this->result, MYSQL_BOTH));
    }

    function fetchAssoc()
    {
        return (@mysqli_fetch_assoc($this->result));
    }

    function freeResult()
    {
        return (@mysqli_free_result($this->result));
    }

}



?>