<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/header.php" ?>

<div id="binding">
<div id="left">

</div>

<div id="right">
	<form id="sign-up">
		<div class="input">
			<label>Name:</label>
				<input type="text" name="name">
		</div>

		<div class="input"><label>Medium:</label>
				<select name="medium">
					<option>Photography</option>
					<option>Music</option>
					<option>Graphic Design</option>
					<option>Writing</option>
				</select>
		</div>

		<div class="input"><label>Causes:</label>	
				<select name="causes">
					<option>Local Agriculture</option>
					<option>Violence Against Women</option>
					<option>HIV/AIDS</option>
					<option>Wildlife Conservation</option>
				</select>
		</div>

		<div class="input">
			<label>Location:</label>
				<select name="country">
					<option>United States</option>
				</select>
				<select name="city-state">
					<option>New York</option>
				</select>
		</div>
	</form>
</div>
</div>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php" ?>