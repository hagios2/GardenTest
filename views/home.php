<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>Calculator</title>
	<style>
		header {
			background: #e3e3e3;
			padding: 2em;
			text-align: center;
		}
		/*section {*/
		/*	height: 80vh;*/
		/*}*/

		/*div {*/
		/*	margin-top: 1rem;*/
		/*	margin-bottom: 1rem;*/
		/*	align-content: center;*/
		/*}*/

		/*input, select {*/
		/*	width: 300px;*/
		/*	height: 40px;*/
		/*}*/

		/*form {*/
		/*	align-self:center;*/
		/*}*/

	</style>
</head>
<body>
<header><h1>No. Of Bags Calculator</h1></header>
<section>
	<div class="container mt-3">
		<form action="/calculate" method="post">
			<div class="row">
				<div class="col-md-3">
					<label for="exampleInputEmail1" class="form-label">Width</label>
					<input type="number" name="width" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
				</div>
				<div class="col-md-3">
					<label for="exampleInputPassword1" class="form-label">Length</label>
					<input type="number" name="length" class="form-control" id="exampleInputPassword1">
				</div>
				<div class="col-md-3">
					<label for="exampleInputPassword1" class="form-label">Unit For Dimensions</label>
					<select class="form-select" name="unitForDimensions" aria-label="Default select example">
						<option >Select dimension</option>
						<option value="metres">Metres</option>
						<option value="feet">Feet</option>
						<option value="yards">Yards</option>
					</select>
				</div>
<!--				<div class="col-md-1 mt-4">-->
<!--					<button type="submit" class="btn btn-primary">Submit</button>-->
<!--				</div>-->
			</div>
			<div class="row mt-3">
				<div class="col-md-3">
					<label for="exampleInputEmail1" class="form-label">Depth</label>
					<input type="number" name="depth" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
				</div>
				<div class="col-md-3">
					<label for="exampleInputPassword1" class="form-label">Unit For Depth</label>
					<select class="form-select" name="unitForDepth" aria-label="Default select example">
						<option >Select dimension</option>
						<option value="inches">Inches</option>
						<option value="centimetres">Centimetres</option>
					</select>
				</div>
<!--				<div class="col-md-1 mt-4">-->
<!--					<button type="submit" class="btn btn-primary">Submit</button>-->
<!--				</div>-->
			</div>

			<div class="col-md-1 mt-4">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
