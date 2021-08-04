<?php
$response = [];
$response['error']['isError'] = 0;
$response['error']['message'] = [];

$db = new SQLite3('mysqlitedb.db');
/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/
$query = "
CREATE TABLE IF NOT EXISTS comments (
  id        INTEGER PRIMARY KEY,
  user_name       TEXT    NOT NULL,
  message         TEXT    NOT NULL,
  datetime        TIMESTAMP 
  DEFAULT CURRENT_TIMESTAMP
);
";

$db->exec($query);

if ($_POST['type'] === 'add') {

    $name = clearXSSAttack($_POST['name']);
    $message = clearXSSAttack($_POST['message']);

    if (!trim($name)) {
        $response['error']['message'][] = 'Не заполнено поле имя';
    }

    if (!trim($message)) {
        $response['error']['message'][] = 'Не заполнено поле комментарий';
    }

    if (checkError()) {
        responseError();
    }

    $query = "
    INSERT INTO comments (user_name, message) VALUES (:name, :text)
    ";

    $smt = $db->prepare($query);
    $smt->bindValue(':name', $name, SQLITE3_TEXT);
    $smt->bindValue(':text', $message, SQLITE3_TEXT);

    if (!$smt->execute()) {
        $response['error']['message'][] = 'Ошибка вставки в базу';

        if (checkError()) {
            responseError();
        }
    }
    echo getComments();
}

if ($_POST['type'] === 'get') {
    echo getComments();
}

if ($_POST['type'] === 'delete') {
    $id = (int)$_POST['id'];

    if (!$id) {
        $response['error']['message'][] = 'Не верный id';
    }

    if (checkError()) {
        responseError();
    }

    $query = "
    DELETE FROM comments WHERE id = :id 
    ";

    $smt = $db->prepare($query);
    $smt->bindValue(':id', $id, SQLITE3_TEXT);

    if (!$smt->execute()) {
        $response['error']['message'][] = 'Ошибка удаления';

        if (checkError()) {
            responseError();
        }
    }
    echo json_encode($response);
}

function getComments() {
    global $response, $db;
    $query = "
    SELECT id, user_name, message, datetime FROM comments
    ";

    $results = $db->query($query);

    while ($row = $results->fetchArray()) {
        $row['passed'] = passedTime($row['datetime']);
        $row['time'] = postTime($row['datetime']);
        $response['result'][] = $row;
    }
    return json_encode($response);
}

function passedTime($datetime) {
    $curr = time();
    $datetime = strtotime($datetime);
    $diff = $curr - $datetime;

    if ($diff / 3600 < 24) {
        return 'Сегодня';
    } else if ($diff / 3600 > 24 && $diff / 3600 < 48) {
        return 'Вчера';
    } else {
        return 'Добавлено';
    }
}

function postTime($datetime) {
    $datetimeExp = explode(' ', $datetime);
    return substr(trim($datetimeExp[1]),0, 5);
}

function responseError() {
    global $response;
    $response['error']['isError'] = 1;
    echo json_encode($response);
    exit;
}

function checkError() {
    global $response;
    return count($response['error']['message']) > 0;
}

function clearXSSAttack($str) {
    $value = strip_tags($str);
    $value = htmlentities($value, ENT_QUOTES, "UTF-8");
    $value = htmlspecialchars($value, ENT_QUOTES);
    return $value;
}