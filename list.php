<?php
include 'conn.php';
if (@$_COOKIE['cookie']=='fy') 
{
	$dbname="list";
	$fvalue="*";
	$ID="1";
	$order="Click DESC";
	$list=new db($dbname);
	$fcontent=$list->fetch($fvalue,$ID,$order);
	//var_dump(date('Y-m-d H:i:s'));
	include 'list.htm';
	if (@$_POST['tsubmit']) 
	{
		$title=$_POST['tcontent'];
		$content=htmlcode($_POST['content']);
		
		if (isset($title)&&isset($content)) 
		{
			
			$value=array('Title'=>$title,'Content'=>$content,'UName'=>$usename,'Click'=>0,'Time'=>date('Y-m-d H:i:s'));
			$usenames="UName='$usename'";
			if ($list->inchenck($usenames,$content)||$list->inchenck($usenames,$title,$field="Title"))
			{
				if ($list->insert($value))echo "<script language=\"javascript\">alert('发布成功');location.href='list.php';</script>";
				else echo "<script language=\"javascript\">alert('发布失败');location.href='list.php';</script>";
			}
			else echo "<script language=\"javascript\">alert('不得重复发布大量相似信息~！');location.href='list.php';</script>";
		}
		else echo "<script language=\"javascript\">
					alert('标题，内容不得为空');
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