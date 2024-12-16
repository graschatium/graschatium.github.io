
<?php
// Static site generator starter
$pages = [
    'index' => 'Home',
    'about' => 'About',
    'contact' => 'Contact'
];

foreach ($pages as $slug => $title) {
    $content = "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>{$title}</title>
    <link rel='stylesheet' href='assets/styles.css'>
</head>
<body>
    <header>
        <h1>{$title}</h1>
        <nav>
            <ul>
                <li><a href='index.html'>Home</a></li>
                <li><a href='about.html'>About</a></li>
                <li><a href='contact.html'>Contact</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <p>Welcome to the {$title} page.</p>
    </main>
    <footer>
        <p>&copy; 2024 My Static CMS</p>
    </footer>
</body>
</html>";

    file_put_contents("{$slug}.html", $content);
}
?>
