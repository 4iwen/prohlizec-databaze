<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- BOOTSTRAP -->
    <title>Seznam zaměstnanců</title>
</head>
<body class="container">
<h1>Seznam zaměstnanců</h1>
<table class="table">
    <tbody>
    <tr>
        <th>Jméno
            <a href="?sortby=surname_asc" class="sorted">
                <span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>
            </a>
            <a href="?sortby=surname_desc">
                <span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span>
            </a>
        </th>
        <th>Místnost
            <a href="?sortby=room_asc">
                <span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>
            </a>
            <a href="?sortby=room_desc"><span
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
        <th>Pozice
            <a href="?sortby=job_asc">
                <span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>
            </a>
            <a href="?sortby=job_desc">
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
        $order = "surname ASC";
    }

    $employees = getEmployees($order);
    foreach ($employees as $employee) {
        $row = "<tr>";
        $row .= "<td><a href='employee.php?id={$employee->employee_id}'>{$employee->name}</a></td>";
        $row .= "<td>{$employee->room_name}</td>";
        $row .= "<td>{$employee->phone}</td>";
        $row .= "<td>{$employee->job}</td>";
        $row .= "</tr>";
        echo $row;
    }
    ?>
</table>

<a href="index.php"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Zpět na domovskou stránku</a>

</body>
</html>