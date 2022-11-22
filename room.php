<?php
include("db_connect.php");
include("errors.php");
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if ($id === false) {
    throw404();
} else if ($id === null) {
    throw400();
}
$room = getRoom($id);
if ($room === null) {
    throw404();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- BOOTSTRAP -->
    <?php
    echo "<title>Karta místnosti č. $room->no</title>"
    ?>
</head>
<body class="container">
<?php
echo "<h1>Místnost č. <em>$room->no</em></h1>";
?>
<dl class="dl-horizontal">
    <?php
    $html = "<dt>Číslo</dt>";
    $html .= "<dd>$room->no</dd>";
    $html .= "<dt>Název</dt>";
    $html .= "<dd>$room->name</dd>";
    $html .= "<dt>Telefon</dt>";
    if ($room->phone) {
        $html .= "<dd>$room->phone</dd>";
    } else {
        $html .= "<dd>Neuvedeno</dd>";
    }
    $html .= "<dt>Lidé</dt>";
    if (count($room->employees) > 0) {
        foreach ($room->employees as $employee) {
            $html .= "<dd><a href='employee.php?id={$employee->employee_id}'>{$employee->surname} {$employee->first_name}</a></dd>";
        }
    } else {
        $html .= "<dd>Žádní zaměstnanci</dd>";
    }
    $html .= "<dt>Průměrná mzda</dt>";
    if ($room->wage) {
        $html .= "<dd>$room->wage Kč</dd>";
    } else {
        $html .= "<dd>Neuvedeno</dd>";
    }
    $html .= "<dt>Klíče</dt>";
    if (count($room->keys) > 0) {
        foreach ($room->keys as $key) {
            $html .= "<dd><a href='employee.php?id={$key->employee_id}'>{$key->name}</a></dd>";
        }
    } else {
        $html .= "<dd>Žádné klíče</dd>";
    }
    echo $html;
    ?>

</dl>
<a href="rooms.php"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Zpět na seznam
    místností</a>

</body>