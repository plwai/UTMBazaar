
<html>
<head>
<meta http-equiv="Content-Type" content ="text/html; charset=Cp1252">
<title>Shopping Cart</title>
</head>
<body>
<?php
$this->load->library('table');
$this->table->set_heading(array('Id', 'Name', 'Price','Quantity','Buy'));

foreach($listProduct as $p){
	$this->table->add_row(array($p->id, $p->name, $p->price, $p->quantity, anchor('shoppingcart/buy/'.$p->id,'Order Now')));}
	$this->table->set_template(array('table_open'=>'<table border="1" cellpadding="3" cellspacing="3"">'));
	echo $this->table->generate();
?>
</body>
</html>