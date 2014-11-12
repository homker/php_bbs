<?php
include 'conn.php';
if (@$_COOKIE['cookie']=='fy') 
{
	if (@$_SESSION['rt']=='1') 
	{
		$list="list";
        $session="session";
		$bglist=new db($list);
		$bgsession=new db($session);
		include 'bg.htm';
		if (@$_GET['ID']) 
		{
			$lcondition="ID=$ID";
			$scondition="ContentID=$ID";
			if($bglist->del($lcondition)&&$bgsession->del($scondition))
				echo "<script language=\"javascript\">alert('删除成功');location.href='bg.php';</script>";
		}
		if (@$_GET['SID']) 
		{
			$scondition="ID=$SID";
			if($bgsession->del($scondition))
				echo "<script language=\"javascript\">alert('删除成功');location.href='bg.php';</script>";;
		}
	}
	else
	{
		echo "<script language=\"javascript\">
			alert('这个页面不是谁想看就能看的，小样去找管理员拿权限');
			location.href='list.php';
		</script>";
	}
}
else
{
	echo "<script language=\"javascript\">
			alert('请先行登入');
			location.href='index.htm';
		</script>";
}

?>