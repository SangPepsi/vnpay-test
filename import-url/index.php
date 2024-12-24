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

		<form class="needs-validation" method="post" novalidate>
			<div class="form-row">
			
				<div class="col-md-12 mb-3">
					<label for="validationCustom">Full URL:</label>
					<input type="text" name="url" class="form-control" id="validationCustom" placeholder="Data" required>
				</div>
				
				<div class="col-md-12 mb-3">
					<label for="validationCustom">Secret key:</label>
					<input type="text" name="key" class="form-control" id="validationCustom" placeholder="Key" required>
				</div>

				<div class="d-grid gap-3 d-md-flex justify-content-md-end">
					<button type="submit" class="btn btn-primary" value="Submit" disabled>Submit form</button>
					<button type="submit" name="redirect" id="redirect" class="btn btn-primary">Redirect</button>
				</div>
				
			</div>
		</form>

<script>
	// Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
</script>

	<hr>

<?php
error_reporting(E_ALL & E_NOTICE & E_DEPRECATED);
$redirect = "http://localhost/vnpay-demo/import-url/handling.php";
$urlPos = $_POST["url"];
$pos = strpos($urlPos, "?");

if ($pos == false) {
    $url = "ApiUndefined?" . $urlPos;
}
else if ($pos == TRUE) {
    $url = $urlPos;
}

$data = explode("?", $url);
$decode = urldecode($data[1]);
$parameters = str_replace("&", "<br>", $decode);

$vnp_Url = $redirect . "?" . $data[1] . "&vnp_UrlRequest=" . $data[0] . "&vnp_SecretKey=" . $_POST["key"];
if (isset($_POST['redirect'])) {
    header('Location: ' . $vnp_Url);
    die();
}

if (empty($parameters)) {
} else {
echo "
<label for='secureHash'>Parameters</label>
<div class='highlight'>
<pre>
<code class='language-html' data-lang='html'>$data[0]
$parameters
</code>
</pre>";
}
?>
	</div>
</body>
</html>