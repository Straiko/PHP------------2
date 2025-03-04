
# Проект: Шифрование и дешифрование текста

Этот проект представляет собой веб-приложение для шифрования и дешифрования текста с использованием PHP. Пользователь может ввести текст, указать ключ и выбрать действие (шифрование или дешифрование), после чего получить результат.

---

## 📌 Оглавление
- [Как это работает](#как-это-работает)
- [Использование](#использование)
- [Интерфейс](#интерфейс)
- [Пример использования](#пример-использования)
- [Технологии](#технологии)
- [Лицензия](#лицензия)
- [Автор](#автор)

---

## 🛠 Как это работает

Проект использует простой алгоритм шифрования, основанный на преобразовании символов текста в числовые значения и их умножении на числовое представление ключа. Для дешифрования выполняется обратная операция.

### Основные функции:
- **Шифрование**: Текст преобразуется в последовательность чисел, разделенных точкой с запятой. Каждое число представляет собой позицию символа в алфавите, умноженную на числовое значение ключа.
- **Дешифрование**: Последовательность чисел преобразуется обратно в текст, используя тот же ключ.

---

## 🚀 Использование

1. Склонируйте репозиторий на свой компьютер:
   ```bash
   git clone https://github.com/ваш-username/название-репозитория.git
   ```
2. Перейдите в директорию проекта:
   ```bash
   cd название-репозитория
   ```
3. Запустите локальный сервер PHP (если у вас установлен PHP):
   ```bash
   php -S localhost:8000
   ```
4. Откройте браузер и перейдите по адресу `http://localhost:8000`.

---

## 🖥 Интерфейс

- **Текстовое поле**: Введите текст, который хотите зашифровать или расшифровать.
- **Поле ключа**: Введите ключ, который будет использоваться для шифрования или дешифрования.
- **Выбор действия**: Выберите "Шифровать" или "Дешифровать".
- **Кнопка "Выполнить"**: Нажмите для получения результата.

---

## 📋 Пример использования

1. Введите текст: `Hello, World!`
2. Введите ключ: `secret`
3. Выберите действие: `Шифровать`
4. Нажмите "Выполнить".
5. Результат будет отображен ниже.

---

## 🛠 Технологии

- **PHP**: Для обработки текста и выполнения шифрования/дешифрования.
- **HTML/CSS**: Для создания интерфейса веб-страницы.

---

## 📜 Лицензия

Этот проект распространяется под лицензией MIT.

---

## 👤 Автор

[Стариков Даниил]  
- GitHub: [Straiko](https://github.com/Straiko)  
