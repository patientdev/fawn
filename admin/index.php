<?php 

include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/access.controller.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "app/controller/admin.controller.php";

$styles = <<< CSS

#content {
  padding: 0;
}

#search-wrapper {
  padding: 40px 0;
  background-image: url(/img/header-background.jpg);
  background-position: 10% 50%; 
  margin-bottom: 10px;
}

#search {
  text-align: center;
  padding: 40px 0;
  background-color: rgba(255, 255, 255, 0.5);
  border-top: 2px solid rgba(0, 0, 0, 0.5);
  border-bottom: 2px solid rgba(0, 0, 0, 0.5);
  overflow: visible;
  white-space: nowrap;
}

#search h3 {
  letter-spacing: 9px;
  font-size: 1.4em;
  margin-top: 0; margin-bottom: 40px;
}

#search select {
  width: 100%;
  border: none;
  border-radius: 0;
  height: 50px;
  background-color: white;
  font-size: 1em;
  font-style: italic;
  letter-spacing: 4px;
  background-color: rgba(240, 240, 240, 1);
  font-weight: 300;
}

#search p {
  display: inline-block;
  margin: 0 30px;
  font-size: 1.1em;
  font-style: italic;
  letter-spacing: 4px;
  line-height: 1.3em;
}

#results {
  padding: 0 40px;
}

.result:after {
  content: "";
  display: block;
  clear: both;
}

.result a span {
  position:absolute; 
  width:100%;
  height:100%;
  top:0;
  left: 0;

  /* edit: added z-index */
  z-index: 1;

  /* edit: fixes overlap error in IE7/8, 
   make sure you have an empty gif */
  background-image: url('empty.gif');
}

table {
  border-collapse: collapse;
}

tr.result {
  border: none;
}

td {
  padding: 10px;
  position: relative;
}

#newusers img {
  width: 40px;
  background-color: transparent;
  border-radius: 50%;
  text-align: center;
  display: inline-block;
  margin-right: 10px;
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

.info h3 {
  font-size: 1.1em;
  text-transform: uppercase;
  font-weight: 400;
  letter-spacing: 8px;
  margin-top: 0;
}

.occupation h3 {
  margin-bottom: 5px;
}

.location h3 {
  margin-top: 0;
  margin-bottom: 30px;
  font-weight: 300;
}

.drop-down h5 {
  overflow: hidden;
}

.drop-down h5:after {
  position: absolute;
  top: 0; right: 0;
  padding: 15px 15px 12px 18px;
}

#newusers h2 {
  text-align: center;
}

#newusers p {
  text-align: center;
}

@media only screen and (max-width: 840px) {

  #search {
  position: relative;
  font-size: 1em;
  margin-top: 0;
  text-align: center;
  white-space: normal;
  padding: 20px 0;
  clear: both;
  display: none;
}

  #search-wrapper {
    margin-bottom: 0;
    padding: 10px 0 0 0;
  }

  #search h3, #sentence p {
  font-size: 1.2em;
  letter-spacing: 3px;
  font-weight: 300;
  margin-bottom: 20px;
  color: white;
}

  #sentence p {
  display: block;
  margin: 10px 0;
}

  .drop-down {
  width: 240px;
}

  .drop-down h5 {
    font-size: 1em;
    width: 100%;
    position: relative;
    padding-right: 66px;
  }

  .drop-down li {
    font-size: 1em;
  }

  .drop-down h5:after {
    position: absolute;
    right: 0; top: 0;
    padding: 15px 15px 12px 22px;
  }

  #search-button {
    text-align: center;
    padding: 0 10px 10px 10px;
  }

  #search-button:after {
    content: "";
    clear: both;
    display: block;
  }

  #search-button h2 {
    display: inline-block;
    float: left;
    margin: 0;
    padding: 5px 0;
  }

  #search-button button {
    float: right;
  }

  #search-wrapper {
  }

  #results img {
    width: 60px;
}

  .result {
    margin: auto;
    padding: 20px;
  }

  .photo {
    margin-right: 0;
    margin: 0;
    display: block;
    width: 100%;
    height: 60px;
    text-align: center;
  }

  .info {
    font-size: .9em;
    white-space: normal;
    display: block;
    width: 100%;
    text-align: center;
  }

  .name h2 {
    font-size: 1.2em;
    letter-spacing: 3px;
    margin: 10px 0 20px 0;
  }

  #results {
    padding: 0;
}

}

CSS;

include_once $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php";

?>

<div id="newusers">
<h2>New Users</h2>

<?php echo $results; ?>
</div>
<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>