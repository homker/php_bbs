<?php
include 'conn.php';
if (@$_COOKIE['cookie']=='fy') 
{
		$list="list";
        $session="session";
        $ds_session="dssession";
		$bglist=new db($list);
		$bgsession=new db($session);
		$bgds_session=new db($ds_session);
		include 'personal.htm';
		
}
else
{
	echo "<script language=\"javascript\">
			alert('请先行登入');
			location.href='index.htm';
		</script>";
}

?>