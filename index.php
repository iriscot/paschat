<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <title>PasChat online</title>
    <meta name="description" content="PasChat online">
    <meta name="author" content="Iriscot">
    <style>
        body {
            font: normal 13px arial, sans-serif;
            width: 80%;
            margin: 3% auto;
            padding: 0;
            background: #fff;
            color: #777;
            line-height: 1.9;
        }

        .message {
            margin: 6px 3px;
        }

        .name {
            font-weight: bold;
            margin-left: 6px;
        }

        .name {
            color: #0043ff;
        }

        .text {
            color: #000;
        }
        
        .quick_links{
            padding: 14px;
            border-bottom: 1px solid rgba(234, 92, 119, 0.38);
        }
        
        .quick_links a{
            margin: 5px;
        }
    </style>
</head>

<body>
    <h2>PasChat by <a href="https://iriscot.org/">Iriscot</a></h2>
    
    <div class="quick_links">
        <a href="/dl/paschat_latest.exe">Скачать чатик (.exe)</a>
        <a href="/dl/paschat_source.pas">Скачать исходники (.pas)</a>
    </div>
    
    <h3>Недавние сообщения</h3>
    <div class="last_messages">
        <?
        require_once 'db.php';
            $chat_raw = sql("SELECT * FROM (SELECT * FROM `$database['table']` ORDER BY `id` DESC LIMIT 10) AS `tmp` ORDER BY `id` ASC");
            if(mysqli_num_rows($chat_raw) > 0){
                while($chat_msg = mysqli_fetch_assoc($chat_raw))
                    echo "<div class=\"message\"><span class=\"date\">{$chat_msg['date']}</span> <span class=\"name\">{$chat_msg['user']}</span>: <span class=\"text\">{$chat_msg['text']}</span></div>";
            }else
                echo 'На этом сервере пока нет сообщений :(';
        ?>
    </div>
</body>

</html>
