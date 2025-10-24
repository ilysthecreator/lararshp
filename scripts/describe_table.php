<?php
$table = $argv[1] ?? 'user';
try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=rshplara;charset=utf8mb4", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("DESCRIBE `$table`");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $r) {
        echo $r['Field'] . "\t" . $r['Type'] . "\t" . $r['Null'] . "\t" . $r['Key'] . "\t" . $r['Default'] . "\t" . $r['Extra'] . PHP_EOL;
    }
} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage() . PHP_EOL;
}
