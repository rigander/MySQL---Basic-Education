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
//        $mysql->query("CREATE TABLE `users` (
//            id INT NOT NULL,
//            name VARCHAR(50) NOT NULL,
//            bio TEXT NOT NULL,
//            PRIMARY KEY(id)
//)");
//        //todo Добавление новой записи в таблицу.
//        // Важно помнить что синтаксис кавычек внутри SQL команд очень важен ``, '', "".
//        // Добавление записей в цикле.
//        for($i = 1; $i <= 5; $i++){
//            $name = "Bob #".$i;
//            $mysql->query(
//                "INSERT INTO `users` (`name`, `bio`)
//                       VALUES ('$name', 'From Krypton')");
//        }
        //todo Редактирование данных.
        // Добавление записей
        //$mysql->query("UPDATE `users` SET `bio` = 'New Good Text' WHERE `name` = 'Bob #1'");
        //todo Удаление записей
        //$mysql->query("DELETE FROM `users` WHERE `id` >= 6");

        //todo Команды по выборке данных из БД.
        // Выборка всех полей и записей таблицы users.
        $result = $mysql->query("SELECT * FROM `users`");

        //todo Вывести данные выборки.
        function printResults($result){
            if ($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "Id: ".$row['id'].'. ';
                    echo "Name: ".$row['name'].'. ';
                    echo "Bio: ".$row['bio'].'<br>';
                }
            }
            echo "<hr>";
        }
        printResults($result);

        //todo Выборка конкретных полей
        $result2 = $mysql->query("SELECT `id`, `name` FROM `users`");
        printResults($result2);

        //todo Выборка конкретных полей с условиями.
        $result3 = $mysql->query("SELECT `id`, `name` FROM `users` WHERE `id` > 2");
        printResults($result3);

        //todo Выборка конкретных полей с условиями и сортировкой ASC - по возрастанию.
        $result4 = $mysql->query("SELECT `id`, `name` FROM `users` WHERE `id` > 2 ORDER BY `id` ASC");
        printResults($result4);

        //todo Выборка конкретных полей с условиями и сортировкой DESC - по убыванию.
        $result5 = $mysql->query("SELECT `id`, `name` FROM `users` WHERE `id` > 2 ORDER BY `id` DESC");
        printResults($result5);

        //todo Выборка конкретных полей с условием LIMIT - позволяет вывести указанное число строк из таблицы.
        // В данном случае будут выведены только первые три записи.
        $result6 = $mysql->query("SELECT `id`, `name` FROM `users` LIMIT 3");
        printResults($result6);
    }
//todo Обязательно после исполнения SQL запроса необходимо закрыть соединение с БД иначе
// сервер будет перегружен и сайт может лечь.
    $mysql->close();
?>
</body>
</html>
