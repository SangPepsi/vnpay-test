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
    <link href="/vnpay-test/assets/jumbotron-narrow.css" rel="stylesheet">
    <script src="/vnpay-test/assets/jquery-1.11.3.min.js"></script>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand">VNPAY TEST</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active"><a class="nav-link" href="/vnpay-test/import-value/">Nhập giá trị <span
                                class="sr-only">(current)</span></a></li>
                    <li class="nav-item active"><a class="nav-link" href="/vnpay-test/import-data/">Nhập chuỗi<span
                                class="sr-only">(current)</span></a></li>
                    <li class="nav-item active"><a class="nav-link" href="/vnpay-test/import-url/">Nhập URL<span
                                class="sr-only">(current)</span></a></li>
                    <li class="nav-item active"><a class="nav-link" href="/vnpay-test/encode/">Encode <span
                                class="sr-only">(current)</span></a></li>
                    <li class="nav-item active"><a class="nav-link" href="/vnpay-test/decode/">Decode <span
                                class="sr-only">(current)</span></a></li>
                    <li class="nav-item active"><a class="nav-link" href="/vnpay-test/ipn-test/">IPN Payment <span
                                class="sr-only">(current)</span></a></li>
                    <li class="nav-item active"><a class="nav-link"
                        href="/vnpay-test/password-generator/">Random Password <span class="sr-only">(current)</span></a>
                    </li>
                </ul>

            </div>
        </nav>
        <br>
        <div>
            <h2>Kiểm tra IPN</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label for="ipn_url">IPN:</label>
                    <input type="text" class="form-control" id="ipn_url" name="ipn_url" required>
                </div>
                <div class="form-group">
                    <label for="vnp_amount">vnp_Amount:</label>
                    <input type="text" class="form-control" id="vnp_amount" name="vnp_amount" required>
                </div>
                <div class="form-group">
                    <label for="vnp_txn_ref">vnp_TxnRef:</label>
                    <input type="text" class="form-control" id="vnp_txn_ref" name="vnp_txn_ref" required>
                </div>
                <div class="form-group">
                    <label for="vnp_tmn_code">vnp_TmnCode:</label>
                    <input type="text" class="form-control" id="vnp_tmn_code" name="vnp_tmn_code" required>
                </div>
                <div class="form-group">
                    <label for="vnp_hash_secret">vnp_HashSecret:</label>
                    <input type="text" class="form-control" id="vnp_hash_secret" name="vnp_hash_secret" required>
                </div>
                <div class="form-group">
                    <label for="vnp_txn_ref_failed">vnp_TxnRef for Failed Case:</label>
                    <input type="text" class="form-control" id="vnp_txn_ref_failed" name="vnp_txn_ref_failed" required>
                </div>
                <button type="submit" name="test" class="btn btn-primary">Thực hiện kiểm tra</button>
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $vnp_HashSecret = $_POST['vnp_hash_secret'];
                $vnp_Amount = $_POST['vnp_amount'];
                $vnp_TxnRef = $_POST['vnp_txn_ref'];
                $vnp_TmnCode = $_POST['vnp_tmn_code'];
                $vnp_TxnRef_Failed = $_POST['vnp_txn_ref_failed'];
                $ipn_url = $_POST['ipn_url'];

                function getCurrentPayDate() {
                    return date('YmdHis'); // Lấy thời gian hiện tại theo định dạng YmdHis
                }

                // Hàm để tạo hash bảo mật
                function createSecureHash($inputData, $hashSecret) {
                    ksort($inputData);
                    $hashData = '';
                    foreach ($inputData as $key => $value) {
                        if (strpos($key, 'vnp_') === 0 && $key != 'vnp_SecureHash' && $key != 'ipn_url') {
                            $hashData .= $key . "=" . $value . "&";
                        }
                    }
                    $hashData = rtrim($hashData, '&');
                    return hash_hmac('sha512', $hashData, $hashSecret);
                }

                // Tạo URL IPN đầy đủ
                function createIpnUrl($inputData) {
                    $ipnUrl = $inputData['ipn_url'];
                    unset($inputData['ipn_url']);

                    // Tạo chuỗi truy vấn mới từ các trường dữ liệu còn lại
                    $query = http_build_query($inputData);

                    return $ipnUrl . "?" . $query;
                }

                // Các trường hợp kiểm tra giả lập
                $testCases = [
                    [
                        'input' => [
                            'vnp_Amount' => $vnp_Amount,
                            'vnp_BankCode' => 'NCB',
                            'vnp_BankTranNo' => 'VNP14226112',
                            'vnp_CardType' => 'ATM',
                            'vnp_OrderInfo' => 'Thanh toan don hang thoi gan: ' . getCurrentPayDate(),
                            'vnp_PayDate' => getCurrentPayDate(),
                            'vnp_ResponseCode' => '00',
                            'vnp_TmnCode' => $vnp_TmnCode,
                            'vnp_TransactionNo' => '14226112',
                            'vnp_TransactionStatus' => '00',
                            'vnp_TxnRef' => $vnp_TxnRef,
                            'vnp_SecureHash' => '',
                            'ipn_url' => $ipn_url
                        ],
                        'expectedRspCode' => '00',
                        'caseTitle' => 'Giao dịch thành công'
                    ],

                    // Thêm các trường hợp kiểm tra khác vào đây

                    // Trường hợp 2
                    [
                        'input' => [
                            'vnp_Amount' => $vnp_Amount,
                            'vnp_BankCode' => 'NCB',
                            'vnp_BankTranNo' => 'VNP14226115',
                            'vnp_CardType' => 'ATM',
                            'vnp_OrderInfo' => 'Thanh toan don hang thoi gian: ' . getCurrentPayDate(),
                            'vnp_PayDate' => getCurrentPayDate(),
                            'vnp_ResponseCode' => '99',
                            'vnp_TmnCode' => $vnp_TmnCode,
                            'vnp_TransactionNo' => '14226115',
                            'vnp_TransactionStatus' => '99', // Trạng thái giao dịch thất bại
                            'vnp_TxnRef' => $vnp_TxnRef_Failed,
                            'vnp_SecureHash' => '',
                            'ipn_url' => $ipn_url
                        ],
                        'expectedRspCode' => '00',
                        'caseTitle' => 'Giao dịch thất bại'
                    ],
                    // Trường hợp 3
                    [
                        'input' => [
                            'vnp_Amount' => $vnp_Amount,
                            'vnp_BankCode' => 'NCB',
                            'vnp_BankTranNo' => 'VNP14226114',
                            'vnp_CardType' => 'ATM',
                            'vnp_OrderInfo' => 'Thanh toan don hang thoi gian: ' . getCurrentPayDate(),
                            'vnp_PayDate' => getCurrentPayDate(),
                            'vnp_ResponseCode' => '00',
                            'vnp_TmnCode' => $vnp_TmnCode,
                            'vnp_TransactionNo' => '14226114',
                            'vnp_TransactionStatus' => '00',
                            'vnp_TxnRef' => 'not_found', // Mã đơn hàng không tồn tại
                            'vnp_SecureHash' => '',
                            'ipn_url' => $ipn_url
                        ],
                        'expectedRspCode' => '01',
                        'caseTitle' => 'Mã đơn hàng không tồn tại'
                    ],
                    // Trường hợp 4
                    [
                        'input' => [
                            'vnp_Amount' => $vnp_Amount,
                            'vnp_BankCode' => 'NCB',
                            'vnp_BankTranNo' => 'VNP14226112',
                            'vnp_CardType' => 'ATM',
                            'vnp_OrderInfo' => 'Thanh toan don hang thoi gian: ' . getCurrentPayDate(),
                            'vnp_PayDate' => getCurrentPayDate(),
                            'vnp_ResponseCode' => '00',
                            'vnp_TmnCode' => $vnp_TmnCode,
                            'vnp_TransactionNo' => '14226112',
                            'vnp_TransactionStatus' => '00',
                            'vnp_TxnRef' => $vnp_TxnRef,
                            'vnp_SecureHash' => '',
                            'ipn_url' => $ipn_url
                        ],
                        'expectedRspCode' => '02',
                        'caseTitle' => 'Giao dịch đã được confirm'
                    ],
                    // Trường hợp 5
                    [
                        'input' => [
                            'vnp_Amount' => 0, // Số tiền không hợp lệ
                            'vnp_BankCode' => 'NCB',
                            'vnp_BankTranNo' => 'VNP14226113',
                            'vnp_CardType' => 'ATM',
                            'vnp_OrderInfo' => 'Thanh toan don hang thoi gian: ' . getCurrentPayDate(),
                            'vnp_PayDate' => getCurrentPayDate(),
                            'vnp_ResponseCode' => '00',
                            'vnp_TmnCode' => $vnp_TmnCode,
                            'vnp_TransactionNo' => '14226113',
                            'vnp_TransactionStatus' => '00',
                            'vnp_TxnRef' => $vnp_TxnRef,
                            'vnp_SecureHash' => '',
                            'ipn_url' => $ipn_url
                        ],
                        'expectedRspCode' => '04',
                        'caseTitle' => 'Số tiền không hợp lệ'
                    ],
                    // Trường hợp 6
                    [
                        'input' => [
                            'vnp_Amount' => $vnp_Amount,
                            'vnp_BankCode' => 'NCB',
                            'vnp_BankTranNo' => 'VNP14226113',
                            'vnp_CardType' => 'ATM',
                            'vnp_OrderInfo' => 'Thanh toan don hang thoi gian: ' . getCurrentPayDate(),
                            'vnp_PayDate' => getCurrentPayDate(),
                            'vnp_ResponseCode' => '00',
                            'vnp_TmnCode' => $vnp_TmnCode,
                            'vnp_TransactionNo' => '14226113',
                            'vnp_TransactionStatus' => '00',
                            'vnp_TxnRef' => $vnp_TxnRef,
                            'vnp_SecureHash' => 'invalid_hash', //Chữ ký không hợp lệ
                            'ipn_url' => $ipn_url
                        ],
                        'expectedRspCode' => '97',
                        'caseTitle' => 'Chữ ký không hợp lệ'
                    ],
                ];
                
                // Thực hiện kiểm tra các trường hợp
                foreach ($testCases as &$testCase) {
                    // Tạo hash bảo mật cho mỗi trường hợp
                    $testCase['input']['vnp_SecureHash'] = createSecureHash($testCase['input'], $vnp_HashSecret);

                    // Tạo URL IPN đầy đủ cho mỗi trường hợp
                    $ipnUrl = createIpnUrl($testCase['input']);

                    // Gửi yêu cầu GET đến URL

                    // Gửi yêu cầu GET đến URL IPN
                    $response = file_get_contents($ipnUrl);

                    // Chuyển đổi phản hồi từ dạng JSON sang mảng assosiative
                    $responseArray = json_decode($response, true);

                    // Hiển thị kết quả kiểm tra                  
                    echo "<h4>Test Case: " . $testCase['caseTitle'] . "</h4>";
                    echo "URL IPN: <a href='" . $ipnUrl . "'>" . $ipnUrl . "</a><br>";
                    echo "Kết quả trả về: " . $response . "<br>";
                    echo "Kết quả mong đợi: " . $testCase['expectedRspCode'] . "<br>";
                    echo ($responseArray['RspCode'] === $testCase['expectedRspCode']) ? "Đạt<br>" : "Không đạt<br>";
                    echo "<hr>";
                }
            }
            ?>
        </div>
    </div>
    <script src="/vnpay-test/assets/js/bootstrap.min.js"></script>
    <script src="/vnpay-test/assets/js/bootstrap.js"></script>
    <script src="/vnpay-test/assets/js/docs.min.js"></script>
</body>

</html>