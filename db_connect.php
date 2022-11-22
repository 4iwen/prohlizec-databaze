<?php
$host = '127.0.0.1';
$db = 'ip_3';
$user = 'www-aplikace';
$pass = 'Bezpe4n0Heslo.';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
$pdo = new PDO($dsn, $user, $pass, $options);

function getEmployees($order)
{
    global $pdo;
    $employees = $pdo->query("SELECT employee_id, CONCAT(surname, ' ', employee.name) AS 'name', room.name AS 'room_name', phone, job FROM employee JOIN room ON employee.room = room.room_id ORDER BY $order;")->fetchAll(PDO::FETCH_OBJ);
    if ($employees) {
        return $employees;
    } else {
        return null;
    }
}

function getRooms($order)
{
    global $pdo;
    $rooms = $pdo->query("SELECT name, room.no, phone, room_id FROM room ORDER BY $order")->fetchAll(PDO::FETCH_OBJ);
    if ($rooms) {
        return $rooms;
    } else {
        return null;
    }
}

function getEmployee($id)
{
    global $pdo;
    $stmt = $pdo->query("SELECT employee_id, surname, employee.name AS 'first_name', room_id, room.name AS 'room_name', wage, job FROM employee JOIN room ON employee.room = room.room_id WHERE employee_id = {$id};")->fetch(PDO::FETCH_OBJ);
    if ($stmt === false) {
        return null;
    }
    $employee = $stmt;
    $employee->rooms = $pdo->query("SELECT name, room_id FROM ip_3.key JOIN room ON ip_3.key.room=room.room_id WHERE ip_3.key.employee = {$id}")->fetchAll(PDO::FETCH_OBJ);
    if ($employee->rooms) {
        return $employee;
    } else {
        return null;
    }
}

function getRoom($id)
{
    global $pdo;
    $stmt = $pdo->query("SELECT room_id, no, name, phone FROM room WHERE room_id = {$id};")->fetch(PDO::FETCH_OBJ);
    if ($stmt === false)
        return null;
    $room = $stmt;
    $room->employees = $pdo->query("SELECT employee_id, surname, name as 'first_name' FROM employee WHERE room = {$id}")->fetchAll(PDO::FETCH_OBJ);

    $wage = $pdo->query("SELECT avg(wage) as 'avg_wage' FROM employee WHERE room = {$id}")->fetch(PDO::FETCH_OBJ);
    if ($wage === false) {
        $room->wage = null;
    } else {
        $room->wage = $wage->avg_wage;
    }
    $keys = $pdo->query("SELECT employee_id, concat(surname, ' ', LEFT(employee.name, 1), '.') AS 'name' FROM ip_3.key JOIN employee ON ip_3.key.employee=employee.employee_id WHERE ip_3.key.room={$id}")->fetchAll(PDO::FETCH_OBJ);
    $room->keys = $keys;

    return $room;
}