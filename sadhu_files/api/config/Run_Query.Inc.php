<?php 
session_start();
$doc_root  = preg_replace("!{$_SERVER['SCRIPT_NAME']}$!", '', $_SERVER['SCRIPT_FILENAME']); # ex: /var/www
require_once($doc_root .'/jainapp/config/vi-config.php');

class Run_Query
{
    var $CONN;
	function Run_Query($dbmame)
	{
		//	global $dbhost , $dbusername , $dbpassword;
			$conn = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
			
			if(!($conn))	
		{
			die("Not Connected to the Database");
		}
		else
		{
			$con = mysql_select_db(DB_NAME,$conn);
			$this->CONN = $conn;
			return $this->CONN;
		}	
	}
	
	
	function Select($sql = "")
	{
			$record = array() ;
			if(!$this->CONN)
				return false;
			if($sql == "")
				return false;
		else
		{
		    $res = mysql_query($sql , $this->CONN);
			if(!$res)			
			{
				echo mysql_error($this->CONN);
			    return false;
		}
			else
			{ 
			    $count = 0;
				while($row = mysql_fetch_array($res))
				{
				    $record[$count] = $row ;
					$count++ ;
				}
			    return $record;
			}
		}
	}
	
	
	function Insert($sql = "")
	{
			$insertid = "" ;
			if(!$this->CONN)
				return false;
			if($sql == "")
				return false;
			else
		{
		    $res = mysql_query($sql , $this->CONN);
			if(!$res)			
			{
			    return false;
			}
			else
			{
			    $insertid = mysql_insert_id($this->CONN);
			    return $insertid;
			}
		}
	}
	
    
	function Update($sql = "")
	{
			$res = "" ;
			if(!$this->CONN)
				return false;
			if($sql == "")
				return false;
		else
		{
		    $res = mysql_query($sql , $this->CONN);
			if(!$res)			
			{
			    return false;
			}
			else
			{
			    return $res;
			}
		}
	}	
	
	
	function Delete($sql = "")
	{
			if(!$this->CONN)
				return false;
			if($sql == "")
				return false;
		else
		{
		    $res = mysql_query($sql , $this->CONN);
			if(!$res)			
			{
			    return false;
			}
			else
			{
			    return $res;
			}
		}
	}
	
	
	function EmptyTable($TableName = "")
	{
			if(!$this->CONN)
				return false;
			if($TableName == "")
				return false;
		else
		{
		    $sql = "truncate table `$TableName`" ;
		    $res = mysql_query($sql , $this->CONN);
			if(!$res)			
			{
			    return false;
			}
			else
			{
			    return $res;
			}
		}
	}
/*---------------------------------------------------------------------------------
Start , Mostly Used Functions
---------------------------------------------------------------------------------*/
	function Redirect($Med)
	{
	    return header("location:$Med");
	}
	
	//function to change single quote(') by back quote (`)
	function Replace_To_New($Med)
	{
	    $Temp = str_replace("'","`",$Med) ; 
		return $Temp ;
	}

	//function to change back quote(`) by single quote (')
	function Replace_To_Old($Med)
	{
	    $Temp = str_replace("`","'",$Med) ; 
		return $Temp ;
	}
		
/*---------------------------------------------------------------------------------
Start , Mostly Used Functions
---------------------------------------------------------------------------------*/
}
?>
