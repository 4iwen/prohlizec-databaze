<?php
include("db_connect.php");
include("errors.php");

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if ($id === false) {
    throw404();
} else if ($id === null) {
    throw400();
}
$employee = getEmployee($id);
if ($employee === null) {
    throw404();
}
$full_name = $employee->surname . " " . $employee->first_name;
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
    echo "<title>Karta osoby {$full_name}</title>"
    ?>
</head>
<body class="container">
<?php
echo "<h1>Karta osoby: <em>{$full_name}</em></h1>";
?>
<dl class="dl-horizontal">
    <?php
    $html = "<dt>Jméno</dt>";
    $html .= "<dd>$employee->first_name</dd>";
    $html .= "<dt>Příjmení</dt>";
    $html .= "<dd>$employee->surname</dd>";
    $html .= "<dt>Pozice</dt>";
    $html .= "<dd>$employee->job</dd>";
    $html .= "<dt>Mzda</dt>";
    $html .= "<dd>{$employee->wage} Kč</dd>";
    $html .= "<dt>Místnost</dt>";
    $html .= "<dd><a href='room.php?id={$employee->room_id}'>{$employee->room_name}</a></dd>";
    $html .= "<dt>Klíče</dt>";
    foreach ($employee->rooms as $room) {
        $html .= "<dd><a href='room.php?id={$room->room_id}'>{$room->name}</a></dd>";
    }
    echo $html;
    ?>

</dl>
<a href="employees.php"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Zpět na seznam
    zaměstnanců</a>

</body>