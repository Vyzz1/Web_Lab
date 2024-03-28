<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            font-family: Arial, sans-serif;

            margin: 25px auto;
            border-collapse: collapse;
            border: 1px solid #eee;
        }

        table th,
        table td {
            color: #999;
            border: 1px solid #999;
            padding: 12px 30px;
            border-collapse: collapse;
        }

        table th {
            background-color: #00cccc;
            color: #fff;
            text-transform: uppercase;
            font-size: 12px;
        }

        table th.last {
            border-right: none;
        }

        table tr:hover {
            background-color: #f4f4f4;
        }

        table tr:hover td {
            color: #555;
        }

        /* Optional box-shadow equivalent (using multiple inset shadows) */
        table {
            box-shadow: inset 0px 0px 20px rgba(0, 0, 0, 0.1),
                inset 0px 10px 20px rgba(0, 0, 0, 0.05),
                inset 0px 20px 20px rgba(0, 0, 0, 0.05),
                inset 0px 30px 20px rgba(0, 0, 0, 0.05);

            border-radius: 8px;
        }

        .title {
            text-align: center;
        }
    </style>
</head>

<body>
    <table>
        <thead>

            <tr class="title">
                <td colspan="10">BẢNG CỬU CHƯƠNG</td>
            </tr>

        </thead>
        <tbody>
            <?php
            for ($i = 1; $i <= 10; $i++) {
                echo "<tr>";
                for ($j = 1; $j <= 10; $j++) {
                    echo "<td> " . $j . " x " . $i . " = " . ($i * $j) . "</td>";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>
<?php
