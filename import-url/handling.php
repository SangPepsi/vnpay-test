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
<link href="/vnpay-demo/assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="/vnpay-demo/assets/css/bootstrap.css" rel="stylesheet">
<link href="/vnpay-demo/assets/css/docs.min.css" rel="stylesheet">
<link href="/vnpay-demo/assets/css/opensource.css" rel="stylesheet">
<link href="/vnpay-demo/assets/css/styles.css" rel="stylesheet" />

<!-- Custom styles for this template -->
<link href="/vnpay-demo/assets/jumbotron-narrow.css" rel="stylesheet">
<script src="/vnpay-demo/assets/jquery-1.11.3.min.js"></script>

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
						href="/vnpay-demo/import-value/">Nhập giá trị <span
							class="sr-only">(current)</span>
					</a></li>
					<li class="nav-item active"><a class="nav-link"
						href="/vnpay-demo/import-data/">Nhập chuỗi<span class="sr-only">(1)</span></a>
					</li>
					<li class="nav-item active"><a class="nav-link"
						href="/vnpay-demo/import-url/">Nhập URL<span class="sr-only">(2)</span></a>
					</li>
					<li class="nav-item active"><a class="nav-link"
						href="/vnpay-demo/encode/">Encode <span class="sr-only">(3)</span></a>
					</li>
					<li class="nav-item active"><a class="nav-link"
						href="/vnpay-demo/decode/">Decode <span class="sr-only">(4)</span></a>
					</li>
				</ul>
			</div>
		</nav>

		<br>
		
		<label for="validationCustom">Kết quả xử lý:</label>

<?php
error_reporting(E_ALL & E_NOTICE & E_DEPRECATED);
$vnp_SecretKey = $_GET['vnp_SecretKey'];
$vnp_UrlRequest = $_GET['vnp_UrlRequest'];
$vnp_SecureHash = $_GET['vnp_SecureHash'];
$vnp_Version = $_GET['vnp_Version'];

$inputData = array();
foreach ($_GET as $key => $value) {
    if (substr($key, 0, 4) == "vnp_") {
        $inputData[$key] = $value;
    }
}

unset($inputData['vnp_SecretKey']);
unset($inputData['vnp_UrlRequest']);
unset($inputData['vnp_SecureHash']);
unset($inputData['vnp_SecureHashType']);
unset($inputData['vnp_secure_hash_type']);
unset($inputData['vnp_secure_hash']);
ksort($inputData);
$i = 0;
$hashData = "";

//-------------------------------------------------------------
if ($vnp_Version == "2.1.0") {
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashData .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }
    $secureHash = hash_hmac('sha512', $hashData, $vnp_SecretKey);
}
//-------------------------------------------------------------
else if ($vnp_Version == "2.0.0") {
    
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashData .= '&' . ($key) . "=" . ($value);
        } else {
            $hashData .= ($key) . "=" . ($value);
            $i = 1;
        }
        $query .= ($key) . "=" . ($value) . '&';
    }
    $secureHash = hash('sha256',$vnp_SecretKey . $hashData);
}
//----------------------------------------------------------------------------
$vnp_Url = $vnp_UrlRequest . "?" . $query;
$vnp_UrlPay = $vnp_Url . 'vnp_SecureHash=' . $secureHash;

$dataDecode = urldecode($hashData);
$parameters = str_replace("&", "<br>", $dataDecode);
//----------------------------------------------------------------------------
if (empty($parameters)) {
}
else {
echo "
<div class='highlight'>
<pre>
<code class='language-html' data-lang='html'>Parameters Decode:
$vnp_UrlRequest
$parameters
vnp_SecureHash=$vnp_SecureHash
</code>
</pre>
</div>";
}
//----------------------------------------------------------------------------
if ($vnp_SecureHash == $secureHash) {
echo "
<div class='highlight'>
<pre>
<code class='language-html' data-lang='html'>kết quả kiểm tra so sánh checksum:
trùng khớp
vnp_SecureHash=$secureHash
</code>
</pre>
</div>";
}
else {
echo "
<div class='highlight'>
<pre>
<code class='language-html' data-lang='html'>kết quả kiểm tra so sánh checksum:
không khớp
vnp_SecureHash=$secureHash
</code>
</pre>
</div>";
}
//-----------------------------------------------------------------------------
if (empty($parameters)) {
}
else {
    echo "
<div class='highlight'>
<pre>
<code class='language-html' data-lang='html'>Hash Data:
$hashData
</code>
</pre>
</div>";
}
//-----------------------------------------------------------------------------
if (empty($parameters)) {
}
else {
    echo "
<div class='highlight'>
<pre>
<code class='language-html' data-lang='html'>Full URL:
$vnp_UrlPay
</code>
</pre>
</div>";
}
?>
		
<a class="btn btn-outline-secondary" href="/vnpay-demo/import-url/" role="button">Quay lại</a>
	
		<div class="container"><p class="m-0 text-center">Copyright &copy; Tungtd Website 2022</p></div>
	</div>
</body>
</html>