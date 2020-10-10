<?php

include 'db.php';

switch($_GET['method']){
    
    case 'ping':
        echo 'OK Server: PasChat by Iriscot on '.gethostbyname(gethostname());
    break;

    case 'send':
        if($_GET['text'] != '')
            sql("INSERT INTO `$database['table']` (`id`, `text`, `user`, `date`) VALUES (NULL, '".mysqli_real_escape_string($sql, $_GET['text'])."', '".mysqli_real_escape_string($sql, $_GET['user'])."', '".date('d.m.y H:i')."')");
        else
            exit('/!\ Сообщение пустое');
    break;

    case 'getAll':
        $chat_raw = sql("SELECT * FROM (SELECT * FROM `$database['table']` ORDER BY `id` DESC LIMIT 20) AS `tmp` ORDER BY `id` ASC");
        if(mysqli_num_rows($chat_raw) > 0){
            while($chat_msg = mysqli_fetch_assoc($chat_raw))
                echo "[{$chat_msg['date']}] {$chat_msg['user']}: {$chat_msg['text']}\n";
        }else
            echo 'empty';
        
    break;

    case 'getLast':
        $chat_raw = sql("SELECT * FROM `$database['table']` ORDER BY `id` DESC LIMIT 1");
        if(mysqli_num_rows($chat_raw) > 0){
            while($chat_msg = mysqli_fetch_assoc($chat_raw))
                echo "[{$chat_msg['date']}] {$chat_msg['user']}: {$chat_msg['text']}";
        }else
            echo 'empty';
    break;
}
