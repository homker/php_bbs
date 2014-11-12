<?php
//echo"this is a test!";
	include 'conn.php';
	if (@$_POST['login'])
	{
		$usename = $_POST['usename'];
		$password = md5($_POST['password']);
		$logincheck = new check($conn,$usename,$password);
		//var_dump($logincheck->cc);
		switch ($logincheck->cc) {
			case '0':
				{

				setcookie("cookie","fy");
				//echo "you are success~!";
  				echo "<script language=\"javascript\">location.href='list.php';</script>";
				}break;
			case '1':echo "<script language=\"javascript\">alert('用户名错误');location.href='index.htm';</script>";break;
			default:echo "<script language=\"javascript\">alert('密码错误');location.href='index.htm';</script>";break;
		}
		/*if(logincheck($conn,$usename,$password))
		{
			setcookie("cookie","FY");
  			
  			echo "<script language=\"javascript\">location.href='list.php';</script>";
		}*/
	}
	if(@$_POST['apply'])
	{
		//echo "this is a test";
		if (isset($_POST['applyname'])&&isset($_POST['applyword'])) 
		{
			$applyname=$_POST['applyname'];
			$applyword=$_POST['applyword'];
			$applycheck= new check($conn,$applyname,$applyword);
			switch ($applycheck->cc) 
			{
				case '1':
					{
					//echo "this is a test";
						$dbname="login";
						$applyin=new db($dbname);
						$value=array('LoginName'=>$applyname,'PassWord'=>md5($applyword),'Access'=>2);
						if($result=$applyin->insert($value)) echo "注册成功"."<a href='index.htm'>前往登入</a>";
						else echo "you are fail~!";
					}
				break;
				default:
					echo "<script language=\"javascript\">alert('用户名被占用');location.href='apply.htm';</script>";break;
				break;
			}
		}

	}
		 
//include 'index.htm';
?>


