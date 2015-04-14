<?php $debug = 1; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Forger: A Worldwide Network</title>
        <meta name="description" content="Elevating Creativity That Makes A Difference">

		<link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="/css/fawn.css" media="screen">

		<?php if (isset($styles)) { echo "<style>$styles</style>"; } ?>
		<?php if (isset($head)) { echo $head; } ?>

		<?php include $_SERVER["DOCUMENT_ROOT"] . "/js/analytics.js" ?>
	</head>
	<body>

	<?php if ( $debug === 1 ) { ?><div id="debug"><?php echo var_dump($_SESSION); ?></div> <?php } ?>