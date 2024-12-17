<?php
// Масив сторінок із відповідними текстовими файлами
$pages = [
    'home' => 'files/home.txt',
    'about' => 'files/about.txt',
    'contact' => 'files/contact.txt'
];

// Отримання сторінки з параметра URL або вибір за замовчуванням
$page = $_GET['page'] ?? 'home';

// Перевірка, чи існує файл для сторінки
if (!array_key_exists($page, $pages) || !file_exists($pages[$page])) {
    die('Сторінку не знайдено.');
}

// Зчитування вмісту файла
$content = file_get_contents($pages[$page]);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?php echo ucfirst($page); ?> Page</title>
</head>
<body class="container">
    <nav>
        <a href="index.php?page=home">Головна</a>
        <a href="index.php?page=about">Про нас</a>
        <a href="index.php?page=contact">Контакти</a>
    </nav>

    <h1><?php echo ucfirst($page); ?></h1>
    <div>
        <p><?php echo nl2br(htmlspecialchars($content)); ?></p>
    </div>

    <!-- Посилання на редагування -->
    <a href="edit.php?page=<?php echo $page; ?>">Редагувати</a>
</body>
</html>
