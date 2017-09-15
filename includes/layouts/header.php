<?php if( !isset($context_layout) ){
	$context_layout = "public";
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
	<head>
		<title>Widget Corp <?php if( $context_layout == "admin" ){ echo "Admin"; }; ?></title>
		<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />
	</head>
	<body>
    <div id="header">
      <h1>Widget Corp 
      	<?php if( $context_layout == "admin" ){ 
      		echo "Admin"; 
      		}; ?>
      	</h1>
    </div>
