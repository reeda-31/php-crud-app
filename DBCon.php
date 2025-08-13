
<?php
// Load .env manually
$envPath = __DIR__ . '/.env';

if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        // Split key=value
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);

        // Remove quotes if present
        $value = trim($value, "\"'");

        // Set environment variable
        putenv("$name=$value");
        $_ENV[$name] = $value;
    }
}

// Use env vars for DB connection
$server_name = getenv('DB_SERVER');
$user_name   = getenv('DB_USERNAME');
$user_pass   = getenv('DB_PASSWORD');
$dbName      = getenv('DB_NAME');

$con = mysqli_connect($server_name, $user_name, $user_pass, $dbName);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

