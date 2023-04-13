<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP + MySQL</title>
</head>
<body>
<h1>PHP + MySQL</h1>
<?php
//todo В данном случае подключаемся к локальному серверу (localhost),
// при подключении к удаленному серверу параметры для конструктора будут
// отличаться.
// query - Выполняет запрос к базе данных.

//todo Подключились к БД.
    $mysql = new mysqli("localhost", "root", "", "php-mysql");
//todo Установили кодировку для всей БД, чтобы все символы корректно отображались.
// query - Выполняет запрос к базе данных, в аргументах метода
// пишем сам SQL запрос (sql код).
    $mysql->query("SET NAMES 'utf-8'");

    if ($mysql->connect_error){
        echo 'Error Number' . $mysql->connect_errno.'<br>';
        echo 'Error: '.$mysql->connect_error;
    }else{
        // echo 'Host info: '.$mysql->host_info;
        //todo DROP TABLE - удалить таблицу и далее в наклонных
        // кавычках название таблицы.
        // $mysql->query("DROP TABLE `example`");

        //todo Создание Таблицы. Таблица может называться как-угодно
        // главное без специальных символов.
        $mysql->query("CREATE TABLE `users` (
            id INT NOT NULL,
            name VARCHAR(50) NOT NULL,
            bio TEXT NOT NULL,
            PRIMARY KEY(id)    
)");
        //todo Добавление новой записи в таблицу.
        // Важно помнить что синтаксис кавычек внутри SQL команд очень важен ``, '', "".
        $mysql->query(
                "INSERT INTO `users` (`name`, `bio`) 
                       VALUES ('Clark', 'From Krypton')");
    }
//todo Обязательно после исполнения SQL запроса необходимо закрыть соединение с БД иначе
// сервер будет перегружен и сайт может лечь.
    $mysql->close();
?>
</body>
</html>
