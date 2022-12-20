<?php

include 'config.php';

if ($usr->Logout()) {
	if (isset($_GET['redir'])) {
		header("Location:".$_GET['redir']);
	}
	else
	{
		header("Location:".$siteurl);
	}
}
else
{
	header("Location:".$siteurl);
}