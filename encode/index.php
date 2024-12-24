<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<title>VNPAY</title>

<!-- Bootstrap core CSS -->
<link href="/vnpay-test/assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="/vnpay-test/assets/css/bootstrap.css" rel="stylesheet">
<link href="/vnpay-test/assets/css/docs.min.css" rel="stylesheet">
<link href="/vnpay-test/assets/css/opensource.css" rel="stylesheet">
<link href="/vnpay-test/assets/css/styles.css" rel="stylesheet" />

<!-- Custom styles for this template -->
<link href="/vnpay-test/assets/jumbotron-narrow.css" rel="stylesheet">
<script src="/vnpay-test/assets/jquery-1.11.3.min.js"></script>

</head>

<body>

	<div class="container">

		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand">VNPAY TEST</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse"
				data-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active"><a class="nav-link"
						href="/vnpay-test/import-value/">Nhập giá trị <span
							class="sr-only">(current)</span>
					</a></li>
					<li class="nav-item active"><a class="nav-link"
						href="/vnpay-test/import-data/">Nhập chuỗi<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item active"><a class="nav-link"
						href="/vnpay-test/import-url/">Nhập URL<span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item active"><a class="nav-link"
						href="/vnpay-test/encode/">Encode <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item active"><a class="nav-link"
						href="/vnpay-test/decode/">Decode <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item active"><a class="nav-link"
						href="/vnpay-test/ipn-test/">IPN Payment <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item active"><a class="nav-link"
						href="/vnpay-test/password-generator/">Random Password <span class="sr-only">(current)</span></a>
					</li>
				</ul>
			</div>
		</nav>

		<br>

		<div>
			<label for="inputAddress">Data encode</label>
		</div>

		<form id="frmDecode" method="post">
			<div class="form-group">
				<input type="text" name="data" class="form-control" id="validationDefault" placeholder="Data" aria-describedby="inputGroupPrepend2" required>
			</div>
			<input type="submit" class="btn btn-primary" value="Submit" />
		</form>

		<hr>

<?php
error_reporting(E_ALL & E_NOTICE & E_DEPRECATED);
$data = $_POST["data"];
$encode = urlencode($data);

if (empty($data)) {
} else {
echo"
<div class='highlight'>
<pre>
<code class='language-html' data-lang='html'>$encode</code>
</pre>
</div>";
}
?>
	</div>
</body>
</html>