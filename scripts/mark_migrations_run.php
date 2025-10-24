<?php
$migrations = $argv;
array_shift($migrations); // remove script name
if (count($migrations) == 0) {
    echo "Usage: php scripts\\mark_migrations_run.php migration_name1 [migration_name2 ...]\n";
    exit(1);
}
try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=rshplara;charset=utf8mb4", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $batch = $pdo->query("SELECT COALESCE(MAX(batch), 0) FROM migrations")->fetchColumn();
    $batch++;
    $ins = $pdo->prepare("INSERT INTO migrations (migration, batch) VALUES (:m, :b)");
    foreach ($migrations as $m) {
        $exists = $pdo->prepare("SELECT COUNT(*) FROM migrations WHERE migration = :m");
        $exists->execute([':m' => $m]);
        if ($exists->fetchColumn()) {
            echo "Migration $m already recorded.\n";
            continue;
        }
        $ins->execute([':m' => $m, ':b' => $batch]);
        echo "Marked $m as run (batch $batch).\n";
    }
} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage() . PHP_EOL;
    exit(1);
}
