<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Codeigniter Star Demo by Mark Mirandilla</title>
	<script type="text/javascript" src="/assets/rating/jquery-1.5.2.min.js"></script>
	<script type="text/javascript" src="/assets/rating/jquery-ui-1.8.12.custom.min"></script>
	<script type="text/javascript" src="/assets/rating/jquery.ui.stars.min.js"></script>
	<link type="text/css" rel="stylesheet" href="/css/jquery.ui.stars.min.css" />
</head>
<body>
	<?php echo $star; ?>
	<br>
	<input type="button" id="rating_button" name="rating_button" value="Get Value">
</body>
<script>
	$('#rating_button').click(function(){
		alert($("input[name=mystar]").val());
	});
</script>
</html>
