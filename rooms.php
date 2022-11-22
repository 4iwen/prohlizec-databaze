<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- BOOTSTRAP -->
    <title>Seznam místností</title>
</head>
<body class="container">
<h1>Seznam místností</h1>
<table class="table">
    <tbody>
    <tr>
        <th>Jméno
            <a href="?sortby=name_asc" class="sorted">
                <span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>
            </a>
            <a href="?sortby=name_desc">
                <span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span>
            </a>
        </th>
        <th>Číslo místnosti
            <a href="?sortby=no_asc">
                <span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>
            </a>
            <a href="?sortby=no_desc"><span
                    class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span>
            </a>
        </th>
        <th>Telefon
            <a href="?sortby=phone_asc">
                <span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>
            </a>
            <a href="?sortby=phone_desc">
                <span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span>
            </a>
        </th>
    </tr>
    <?php
    include_once "db_connect.php";

    $sortby = isset($_GET["sortby"]) ? $_GET["sortby"] : "";
    $order = explode("_", $sortby);
    if (count($order) == 2) {
        $order = $order[0] . " " . $order[1];
    } else {
        $order = "name ASC";
    }

    $rooms = getRooms($order);
    foreach ($rooms as $room) {
        $row = "<tr>";
        $row .= "<td><a href='room.php?id={$room->room_id}'>{$room->name}</a></td>";
        $row .= "<td>" . $room->no . "</td>";
        $row .= "<td>" . $room->phone . "</td>";
        $row .= "</tr>";
        echo $row;
    }
    ?>
</table>

<a href="index.php"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Zpět na domovskou stránku</a>

</body>
</html>