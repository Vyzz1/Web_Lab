<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    $name = $_POST['name'] ?? 'Not provided';
    $email = $_POST['email'] ?? 'Not provided';
    $gender = $_POST['gender'] ?? 'Not provided';
    $os = $_POST['os'] ?? 'Not provided';
    $chrome = $_POST['chrome'] ?? null;
    $firefox = $_POST['firefox'] ?? null;
    $edge = $_POST['edge'] ?? null;
    $safari = $_POST['safari'] ?? null;

    $myArray = array();
    if (isset($chrome)) {
        array_push($myArray, "Google Chrome");
    }
    if (isset($firefox)) {
        array_push($myArray, "Firefox");
    }
    if (isset($edge)) {
        array_push($myArray, "Microsoft Edge");
    }
    if (isset($safari)) {
        array_push($myArray, "Safari");
    }

    if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['gender']) || !isset($_POST['os'])) {
        echo "<div> Vui lòng nhập đủ thông tin </div>";
    } else {
        echo "  <div class='container'>
    <div class='row'>
        <div class='col-md-8 col-lg-5 my-5 mx-2 mx-sm-auto border rounded px-3 py-3'>
            <h3 class='text-center text-secondary'> Confirm Information </h3>
            <div class='mb-3 px-3 py-3'>
                <h5> Your name </h5>
                <p class='text-success fw-bold'>" . htmlspecialchars($name) . "</p>
            </div>
            <div class='mb-3 px-3 py-3'>
                <h5> Your email </h5>
                <p class='text-success fw-bold'>" . htmlspecialchars($email) . "</p>
            </div>
            <div class='mb-3 px-3 py-3'>
                <h5> Gender </h5>
                <p class='text-success fw-bold'>" . htmlspecialchars($gender) . "</p>
            </div>
            <div class='mb-3 px-3 py-3'>
                <h5> Favorite web browser </h5>
                <ul class='text-success fw-bold'>";
        foreach ($myArray as $browser) {
            echo "<li>" . htmlspecialchars($browser) . "</li>";
        }
        echo "</ul>
           </div>
            <div class='mb-3 px-3 py-3'>
                <h5> Favorite Operating System </h5>
                <p class='text-success fw-bold'>" . htmlspecialchars($os) . "</p>
            </div>
            <button class='btn btn-success btn-lg'> Save</button>
             <button class='btn btn-outline-success btn-lg'> Back</button>
        </div>
        

        ";
    }
    ?>
</body>

</html>