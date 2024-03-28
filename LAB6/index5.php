<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #color-palette {
            width: 1000px;
            height: 1000px;
            border: 1px solid salmon;
            background: #ffffff;
        }

        .color-cell {
            float: left;
            width: 100px;
            height: 100px;
            cursor: pointer;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        }
    </style>

</head>

<body>
    <div id="color-palette">
        <?php
        function generateColor()
        {
            $letters = '0123456789ABCDEF';
            $color = '#';
            for ($i = 0; $i < 6; $i++) {
                $color .= $letters[rand(0, 15)];
            }
            return $color;
        }

        for ($i = 0; $i < 100; $i++) {
            echo "<div class='color-cell' style='background-color:" . generateColor() . "'></div>";
        }



        ?>
    </div>
</body>

</html>