<?php
	include 'conn.php';
	if(@$_POST['apply'])
	{
		//echo "this is a test";
		$applyname=$_POST['applyname'];
		$applyword=$_POST['applyword'];
		$applycheck= new check($conn,$applyname,$applyword);
		switch ($applycheck->cc) {
			case '1':
				{
					//echo "this is a test";
					$dbname="login";
					$applyin=new db($dbname);
					$value=array('LoginName'=>$applyname,'PassWord'=>$applyword,'Access'=>2);
					if($result=$applyin->insert($value)) echo "注册成功";
					else echo "you are fail~!";
				}
				break;
			default:
				echo "<script language=\"javascript\">alert('用户名被占用');</script>";break;
				break;
		}

	}

?>
