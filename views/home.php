<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Calculator</title>
	<style>
		header {
			background: #e3e3e3;
			padding: 2em;
			text-align: center;
		}
		section {
			height: 80vh;
		}

		div {
			margin-top: 1rem;
			margin-bottom: 1rem;
			align-content: center;
		}

		input {
			width: 500px;
			height: 40px;
		}

		form {
			align-self:center;
		}

	</style>
</head>
<body>
<header><h1>No. Of Bags Calculator</h1></header>
<section>
	<div>
		<form action="/" method="post">
			<div>
				<label for="width">Width</label>
				<input type="number" placeholder="Enter width" name="width">
			</div>

			<div>
				<label for="width">Length</label>
				<input type="number" placeholder="Enter length" name="length">
			</div>

			<div>
				<label for="width">Height</label>
				<input type="number" placeholder="Enter height" name="height">
			</div>

			<button type="submit">Submit</button>
			<button type="reset">Reset</button>
		</form>
	</div>
</section>

</body>
</html>
