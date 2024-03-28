<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>PHP Exercises</title>
</head>

<body>
    <div class="container">

        <div class="row">
            <div class="col-md-6 my-5 mx-auto border rounded px-3 py-3">
                <h4 class="text-center">Tính toán cơ bản</h4>
                <form method="get">
                    <div class="form-group">
                        <label for="num1">Số hạng 1</label>
                        <input type="text" class="form-control" name="num1">
                    </div>
                    <div class="form-group">
                        <label for="num2">Số hạng 2</label>
                        <input type="text" class="form-control" name="num2">
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input id="add" type="radio" class="custom-control-input" name="operation" value="add">
                            <label for="add" type="radio" class="custom-control-label">Cộng</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input id="subtract" type="radio" class="custom-control-input" name="operation" value="sub">
                            <label for="subtract" type="radio" class="custom-control-label">Trừ</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input id="multiply" type="radio" class="custom-control-input" name="operation" value="mul">
                            <label for="multiply" type="radio" class="custom-control-label">Nhân</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input id="divide" type="radio" class="custom-control-input" name="operation" value="div">
                            <label for="divide" type="radio" class="custom-control-label">Chia</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Xem kết quả</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mx-auto px-3 py-3 text-center">
                <div class="alert alert-success">
                    <?php

                    if (isset($_REQUEST["num1"]) && isset($_REQUEST["num2"]) && isset($_REQUEST["operation"])) {

                        $num1 = $_REQUEST["num1"];
                        $num2 = $_REQUEST["num2"];
                        $opreation = $_REQUEST["operation"];
                        $result = "";
                        switch ($opreation) {
                            case 'add':
                                $result = $num1 . " + " . $num2 . " = " . ($num1 + $num2);
                                break;
                            case 'sub':
                                $result = $num1 . " - " . $num2 . " = " . ($num1 - $num2);
                                break;
                            case 'mul':
                                $result = $num1 . " * " . $num2 . " = " . ($num1 * $num2);
                                break;
                            case 'div':
                                $result = $num1 . " / " . $num2 . " = " . ($num1 / $num2);
                                break;
                        }
                        echo $result;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>