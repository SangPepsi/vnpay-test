<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active"><a class="nav-link"
                            href="/vnpay-test/import-value/">Nhập giá trị <span class="sr-only">(current)</span>
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

                <div class="col-md-6 mb-3">
                    <label for="validationCustom">Amount:</label>
                    <input type="text" name="amount" class="form-control" id="validationCustom" placeholder="Số tiền"
                        required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="validationCustom">BankCode:</label>
                    <select name="bank" id="validationCustom" class="form-control">
                        <option value="" selected></option>
                        <option value="NCB">NCB</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="validationCustom">Command:</label>
                    <select name="command" id="inputState" class="form-control">
                        <option value="pay" selected>pay</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="validationCustom">CreateDate:</label>
                    <input type="text" name="createDate" class="form-control" id="validationCustom"
                        placeholder="Thời gian khởi tạo giao dịch" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="validationCustom">CurrCode:</label>
                    <select name="curr" id="inputState" class="form-control">
                        <option value="VND" selected>VND</option>
                        <option value="USD" selected>USD</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="validationCustom">ExpriDate:</label>
                    <input type="text" name="createDate" class="form-control" id="validationCustom"
                        placeholder="Thời gian hết hạn giao dịch" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="validationCustom">IpAddr:</label>
                    <input type="text" name="ip" class="form-control" id="validationCustom" placeholder="Địa chỉ IP"
                        required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="validationCustom">Locale:</label>
                    <select name="locale" id="inputState" class="form-control">
                        <option value="vn" selected>vn</option>
                        <option value="en">en</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="validationCustom">OrderInfo:</label>
                    <input type="text" name="info" class="form-control" id="validationCustom"
                        placeholder="Nội dung thanh toán" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="validationCustom">OrderType:</label>
                    <input type="text" name="type" class="form-control" id="validationCustom"
                        placeholder="Mã danh mục hàng hoá" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="validationCustom">ReturnUrl:</label>
                    <input type="text" name="return" class="form-control" id="validationCustom"
                        placeholder="URL thông báo kết quả" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="validationCustom">TmnCode:</label>
                    <input type="text" name="tmn" class="form-control" id="validationCustom" placeholder="Mã website"
                        required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="validationCustom">TxnRef:</label>
                    <input type="text" name="txn" class="form-control" id="validationCustom"
                        placeholder="Mã tham chiếu giao dịch" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="validationCustom">Version:</label>
                    <select name="version" id="inputState" class="form-control">
                        <option value="2.1.0" selected>2.1.0</option>
                        <option value="2.0.0">2.0.0</option>
                    </select>
                </div>

            </div>
            <button class="btn btn-primary" type="submit">Submit form</button>
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
require_once ("./controls.php");
if (empty($hashdata)) {
} else {
echo"
<label for='hashdata'>Hash data</label>
<div class='highlight'>
<pre>
<code class='language-html' data-lang='html'>$hashdata</code>
</pre>
</div>";
}
?>
    </div>
</body>
</html>
