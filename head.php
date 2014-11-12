<?php

	$usename=$_SESSION['un'];
?>
<div class="header">
	<span name="top" style="float:left">留言板扩展模型</span>
	<div>
		<span style="position:fixed; width:100%; left:1150px;">
			<a href="personal.php"><?php echo $usename ?></a>,你好&#9;
			<a class="backlist" href="list.php">回到列表</a>
			<a href="?out='login'">退出</a>
		</span>
	</div>
<hr style="clear:both;"/>
</div>