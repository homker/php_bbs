<?php
	header("Content-type:text/html;charset=utf-8");
	date_default_timezone_set('PRC');
	session_start();
         /*         连接到数据库           */
	$conn=mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS)or die("无法连接到服务器");
	$db=mysql_select_db(SAE_MYSQL_DB,$conn);
	$query=mysql_query("set names 'utf8'");
	if(@$_GET['out'])
	{
		setcookie("cookie","ann");
		echo "<script language=\"javascript\">location.href='index.htm';</script>";
	}
 		/*             规范提交到数据库的html代码            */
	   function htmlcode($contents)
	   {
	   	$contents= str_replace("/n" , "<br/>", str_replace(" ","&nbsp;",$contents));
	   	return $contents;
	   }

 /*             建立一个可以写入数据和读出数据的类            */

	   class db
	   {
	   		public $dbname;
	   		public $query;
	   		public $array;
	   		public $order="ID";
	   		public function __construct($dbname)
	   		{
	   			$this->dbname=$dbname;
	   		}
	   		public function insert($dataArray) 
	   		{
        		$field = "";
        		$value = "";
        		if( !is_array($dataArray) || count($dataArray)<=0) 
        		{
            		$this->halt('没有要插入的数据');
            		return false;
        		} 
        		while(list($key,$val)=each($dataArray)) 
        		{
            		$field .="$key,";
            		$value .="'$val',";
        		}
        		$field = substr( $field,0,-1);
        		$value = substr( $value,0,-1);
        		$sql = "insert into $this->dbname($field) values($value)";
        		$this->query=mysql_query($sql);
        		return $this->query;
    		}


	   		/*public function insert($value)
	   		{

	   			foreach ($value as $key => $value) 
	   			{

	   			}
	   			 echo "INSERT INTO $this->dbname($key)values('$value')";
	   			
	   			//}
	   			$this->query=mysql_query($sql);
	   			return $this->query;
	   		}*/
                   
	   		public function fetch($dbfield="*",$ID="1",$order="ID ASC")
	   		{
	   			$sql="SELECT $dbfield FROM $this->dbname WHERE $ID ORDER BY $order";
	   			$this->query=mysql_query($sql);
	   			return $this->query;
	   		}

	   		public function del($condition)
	   		{
	   			$sql="DELETE FROM $this->dbname WHERE $condition ";
	   			$this->query=mysql_query($sql);
	   			return $this->query;
	   		}
	   		public function update($set,$condition)
	   		{
	   			$sql="UPDATE $this->dbname SET $set WHERE $condition";
	   			$this->query=mysql_query($sql);
	   			return $this->query;

	   		}
	   		public function inchenck($usename,$content,$field="Content")
  			{
  				$sql="SELECT $field FROM $this->dbname WHERE $usename AND $field LIKE '%$content%'";
  				$this->query=mysql_query($sql);
  				$row=mysql_num_rows($this->query);
  				if ($row>=3) return false;
  				else return true;
  			}
	   };

	   /*******************权限认证*****************************/
	    class check
	    {
	    	public $cc;
		function __construct($conn,$usename,$password)//密码验证
 	 		{
  				$sql = "select * from login";
  				$result = mysql_query($sql,$conn);
  				$num = mysql_num_rows($result);
    			$flag=0;
  				while ($row = mysql_fetch_array($result))
  				{
  					if (($usename == @$row['LoginName'])&&($password == @$row['PassWord']))
  					{
  						$_SESSION['un'] = @$row['LoginName'];
  						$_SESSION['rt'] =  @$row['Access'];
						return ($this->cc=0); break;
  					}
  					elseif ($row['LoginName']!=$usename)
  					{
  						$flag++;
  						if($flag==$num)
  						{ 
  							return ($this->cc=1);
  						}
  					}
  					elseif((@$row['LoginName']==$usename)&&(@$row['PassWord']!=$password))
  					{
  						return ($this->cc=2);
  		    			break;
  					}
  				}
  			}
  		}
/////////////////////////////////////////the end of php
////////////////////////////////////////power by homker

