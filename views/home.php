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
						<option value="Metres">Metres</option>
						<option value="Feet">Feet</option>
						<option value="Yards">Yards</option>
					</select>
				</div>
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
						<option value="Inches">Inches</option>
						<option value="Centimetres">Centimetres</option>
					</select>
				</div>
			</div>

			<div class="col-md-1 mt-4">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</section>
<section>
	<div class="container mt-3">
		<table class="table">
			<thead>
			<tr>
				<th scope="col">Width</th>
				<th scope="col">Length</th>
				<th scope="col">Depth</th>
				<th scope="col">Number of Bags</th>
				<th scope="col">Cost</th>
			</tr>
			</thead>
			<tbody>
			<?php if (count ($gardens) > 0) : ?>
				<?php foreach ($gardens as $garden) : ?>
					<tr>
						<td><?= $garden->width ?> (<?= $garden->unit_of_dimensions?>)</td>
						<td><?= $garden->length ?> (<?= $garden->unit_of_dimensions?>)</td>
						<td><?= $garden->depth ?> (<?= $garden->unit_of_depth?>)</td>
						<td><?= $garden->number_of_bags ?></td>
						<td><?= $garden->cost ?></td>
					</tr>
				<?php endforeach; ?>
				<tr>
					<td>Total Cost: </td>
					<td></td>
					<td></td>
					<td></td>
					<td><?= array_sum(array_map(fn($garden) => $garden->cost, $gardens)) ?></td>
				</tr>
			<?php endif; ?>
			</tbody>
		</table>
	</div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
