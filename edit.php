<?php
// Масив сторінок із відповідними текстовими файлами
$pages = [
    'home' => 'files/home.txt',
    'about' => 'files/about.txt',
    'contact' => 'files/contact.txt'
];

// Отримання сторінки з параметра URL
$page = $_GET['page'] ?? 'home';

// Перевірка, чи існує файл для сторінки
if (!array_key_exists($page, $pages) || !file_exists($pages[$page])) {
    die('Сторінку не знайдено.');
}

// Шлях до файлу
$filePath = $pages[$page];

// Якщо форму відправлено, зберігаємо новий вміст
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newContent = $_POST['content'] ?? '';
    file_put_contents($filePath, $newContent);
    header("Location: index.php?page=$page"); // Повернення до сторінки
    exit;
}

// Зчитування вмісту файла
$content = file_get_contents($filePath);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Редагувати <?php echo ucfirst($page); ?></title>
</head>
<body class="container">
    <h1>Редагувати <?php echo ucfirst($page); ?></h1>
    <form method="post" class="container">
        <textarea name="content" rows="10" cols="50"><?php echo htmlspecialchars($content); ?></textarea>
        <br>
        <button type="submit">Зберегти</button>
        <a href="index.php?page=<?php echo $page; ?>">Назад</a>
    </form>
</body>
</html>
