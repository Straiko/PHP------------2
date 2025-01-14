<?php
function process($text, $key, $action): string {
    $chars = str_split(string: 'abcdefghijklmnopqrstuvwxyz0123456789 !,.:;?-_"\'');

    $key_bin = bindec(binary_string: implode(separator: '', array: array_map(callback: function($c): string { return decbin(num: ord(character: $c)); }, array: str_split(string: $key))));

    if ($action === 'encrypt') {
        $output = '';
        foreach (str_split(string: $text) as $c) {
            $pos = array_search(needle: $c, haystack: $chars);
            if ($pos !== false) $output .= ($pos * $key_bin) . ';';
        }
    } else {
        $output = '';
        foreach (explode(separator: ';', string: $text) as $num) {
            if ($num !== '') $output .= $chars[intval(value: $num) / $key_bin] ?? '';
        }
    }
    return $output;
}

$result = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = process(text: $_POST['text'], key: $_POST['key'], action: $_POST['action']);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Шифрование и дешифрование</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background:rgb(82, 81, 79);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #fff;
            padding: 33px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            background-image: url("image.png");
        }

        textarea, input, select, button {
            width: 70%;
            padding: 20px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        button {
            background: #272727d6;
            color: white;
            cursor: pointer;
            margin-top: 20px;
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        button:hover {
            background: #272727d6;
        }

        h1,h2,h3 {
            margin-top: 20px;
            color:rgb(0, 0, 0);
        }


    </style>
</head>
<body>
    <div class="container">
        <h1>Шифрование и дешифрование</h1>
        <form method="POST">
            <textarea name="text" placeholder="Текст"></textarea>
            <input type="text" name="key" placeholder="Ключ">
            <select name="action">
                <option value="encrypt">Шифровать</option>
                <option value="decrypt">Дешифровать</option>
            </select>
            <button type="submit">Выполнить</button>
        </form>
        <h2>Результат:</h2>
        <h3><?php echo htmlspecialchars(string: $result); ?></h3>
    </div>
</body>
</html>