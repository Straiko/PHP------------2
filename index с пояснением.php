<?php
// Функция для шифрования или дешифрования текста
function process($text, $key, $action): string {
    // Массив символов, которые можно шифровать/дешифровать
    $chars = str_split(string: 'abcdefghijklmnopqrstuvwxyz0123456789 !,.:;?-_"\''); // Разбиваем строку на массив символов

    // Преобразуем ключ в двоичное число
    $key_bin = bindec(binary_string: implode(separator: '', array: array_map(callback: function($c): string {
        return decbin(num: ord(character: $c)); // Переводим каждый символ ключа в двоичный код
    }, array: str_split(string: $key))));

    // Если выбран режим шифрования
    if ($action === 'encrypt') {
        $output = ''; // Переменная для хранения результата шифрования
        foreach (str_split(string: $text) as $c) { // Разбиваем текст на символы и проходим по каждому
            $pos = array_search(needle: $c, haystack: $chars); // Ищем позицию символа в массиве $chars
            if ($pos !== false) $output .= ($pos * $key_bin) . ';'; // Умножаем позицию на ключ и добавляем к результату
        }
    } else { // Если выбран режим дешифрования
        $output = ''; // Переменная для хранения результата дешифрования
        foreach (explode(separator: ';', string: $text) as $num) { // Разбиваем зашифрованный текст по разделителю ";"
            if ($num !== '') $output .= $chars[intval(value: $num) / $key_bin] ?? ''; // Делим на ключ и находим символ
        }
    }
    return $output; // Возвращаем результат
}

// Обработка данных формы
$result = ''; // Переменная для хранения результата
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Проверяем, была ли отправлена форма
    $result = process($_POST['text'], $_POST['key'], $_POST['action']); // Вызываем функцию process с данными из формы
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"> <!-- Указываем кодировку страницы -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Настройка адаптивного дизайна -->
    <title>Шифрование и дешифрование</title> <!-- Заголовок страницы -->
    <style>
        body {
            font-family: Arial, sans-serif; /* Устанавливаем шрифт для страницы */
            background:rgb(82, 81, 79); /* Цвет фона страницы */
            display: flex; /* Используем flexbox для центрирования */
            justify-content: center; /* Центрируем по горизонтали */
            align-items: center; /* Центрируем по вертикали */
            height: 100vh; /* Высота страницы равна высоте видимой области */
            margin: 0; /* Убираем отступы по умолчанию */
        }

        .container {
            background: #fff; /* Цвет фона контейнера */
            padding: 33px; /* Внутренние отступы контейнера */
            border-radius: 8px; /* Закругление углов контейнера */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Тень контейнера */
            width: 300px; /* Ширина контейнера */
            text-align: center; /* Выравнивание текста по центру */
            background-image: url("image.png");
        }

        textarea, input, select, button {
            width: 70%; /* Ширина элементов формы */
            padding: 20px; /* Внутренние отступы элементов формы */
            margin: 10px 0; /* Внешние отступы элементов формы */
            border-radius: 4px; /* Закругление углов элементов формы */
            border: 1px solid #ccc; /* Граница элементов формы */
        }

        button {
            background: #272727d6; /* Цвет фона кнопки */
            color: white; /* Цвет текста кнопки */
            cursor: pointer; /* Указатель при наведении на кнопку */
            margin-top: 20px; /* Смещение кнопки ниже */
            width: 100%; /* Ширина кнопки */
            padding: 10px; /* Внутренние отступы кнопки */
            border-radius: 4px; /* Закругление углов кнопки */
            border: 1px solid #ccc; /* Граница кнопки */
        }

        button:hover {
            background: #272727d6; /* Цвет фона кнопки при наведении */
        }

        h1,h2,h3 {
            margin-top: 20px;
            color:rgb(0, 0, 0);
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Шифрование и дешифрование</h1> <!-- Заголовок страницы -->
        <form method="POST"> <!-- Форма с методом POST -->
            <textarea name="text" placeholder="Текст"></textarea> <!-- Поле для ввода текста -->
            <input type="text" name="key" placeholder="Ключ"> <!-- Поле для ввода ключа -->
            <select name="action"> <!-- Выбор действия (шифровать/дешифровать) -->
                <option value="encrypt">Шифровать</option> <!-- Опция шифрования -->
                <option value="decrypt">Дешифровать</option> <!-- Опция дешифрования -->
            </select>
            <button type="submit">Выполнить</button> <!-- Кнопка отправки формы -->
        </form>
        <h2>Результат:</h2> <!-- Заголовок для результата -->
        <p><?php echo htmlspecialchars(string: $result); ?></p> <!-- Вывод результата с экранированием спецсимволов -->
    </div>
</body>
</html>