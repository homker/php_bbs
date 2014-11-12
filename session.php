<?php
include 'conn.php';
if (@$_COOKIE['cookie']=='fy') 
{
	if (@$_GET['ID']) 
	{
		$ID=$_GET['ID'];
		$IDs="ID=$ID";
		//var_dump($ID);
		//var_dump($IDs);
		$dbname="list";
		$value="*";
		$tsess=new db($dbname);
		$stcontent=$tsess->fetch($value,$IDs);
		$dbname="session";
		$session=new db($dbname);
		$IDs="ContentID=$ID";
		$sscontent=$session->fetch($value,$IDs);
		include 'session.htm';
		$click=$click+1;
		$set="Click=$click";
		$condition="ID=$ID";
		if (@$_POST['ssubmit']) 
		{
			$content=htmlcode($_POST['scontent']);
			if(isset($content)) $values=array('ContentID'=>$ID,'Content'=>$content,'UserName'=>$usename,'Time'=>date('Y-m-d H:i:s'));
			if($session->insert($values)&&$tsess->update($set,$condition))
			{
				echo "<script language=\"javascript\">alert('发布成功');location.href='session.php?ID=$ID';</script>";
				
				
			}
			else echo "发布失败~!";
		}
		if (@$_POST['ds_submit']) 
		{
			$ds_content=htmlcode(@$_POST['ds_content']);
			$ds_ID=@$_POST['ds_ID'];
			$ds_Name=@$_POST['ds_Name'];
			if(isset($ds_content)) $ds_values=array('ContentID'=>$ds_ID,'Content'=>$ds_content,'UserName'=>$usename,'ToName'=>$ds_Name,'Time'=>date('Y-m-d H:i:s'));
			if($ds_session->insert($ds_values)&&$tsess->update($set,$condition))
			{
				echo "<script language=\"javascript\">alert('发布成功');location.href='session.php?ID=$ID';</script>";
				
				
			}
			else echo "发布失败~!";
		}
	}
	else echo "<script language=\"javascript\">alert('访问页面不存在！');location.href='list.php';</script>";
}
else
{
	echo "<script language=\"javascript\">
			alert('请先行登入');
			location.href='index.htm';
		</script>";
}

?>