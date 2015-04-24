<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/controller/access.controller.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/app/controller/search.controller.php";


$styles = "

#content {
	padding: 0 40px;
}

.result {
	padding: 40px 10%;
	border-bottom: 1px solid black;
	text-align: center;
}

.result:after {
	content: \"\";
	display: block;
	clear: both;
}

.photo {
	width: 150px;
	height: 150px;
	background-color: transparent;
	border-radius: 50%;
	text-align: center;
	display: inline-block;
	margin-right: 60px;
	vertical-align: middle;
}

.photo img {
	width: 150px;
	border-radius: 50%;
}

.info {	
	width: 50%;
	display: inline-block;
	text-align: left;
	white-space: nowrap;
	padding-top: 10px;
	vertical-align: middle;
}

.name h2 {
	font-size: 1.7em;
	line-height: 1em;
	font-weight: 700;
	letter-spacing: 10px;
	text-transform: uppercase;
	display: inline-block;
	margin-top: 0;
	margin-bottom: 30px;
}

h3 {
	font-size: 1.1em;
	text-transform: uppercase;
	font-weight: 600;
	letter-spacing: 8px;
	margin-top: 0;
}

.occupation h3 {
	margin-bottom: 5px;
}

.location h3 {
	margin-top: 0;
	margin-bottom: 30px;
	font-weight: 200;
}

.summary {
	font-weight: 200;
	letter-spacing: 3px;
	line-height: 1.2em;
	width: 400px;
	white-space: pre-wrap;
}
";

include $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php"; ?>

<h2>Search Results</h2>

<div id="content">

<?php echo $result; ?>

</div>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>