<?php
// Script to create `users` table from legacy `user` table, copy data, and mark the create_users migration as run.
// Run: php scripts\migrate_user_table.php

try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=rshplara;charset=utf8mb4", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if legacy 'user' table exists
    $tbl = 'user';
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = :db AND table_name = :tbl");
    $stmt->execute([':db' => 'rshplara', ':tbl' => $tbl]);
    if (!$stmt->fetchColumn()) {
        echo "Legacy table 'user' not found. Aborting.\n";
        exit(1);
    }

    // If 'users' already exists, abort
    $stmt->execute([':db' => 'rshplara', ':tbl' => 'users']);
    if ($stmt->fetchColumn()) {
        echo "Table 'users' already exists. Nothing to do.\n";
        exit(0);
    }

    echo "Creating 'users' table...\n";
    $pdo->exec(<<<'SQL'
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `email_verified_at` timestamp NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) NULL,
  `created_at` timestamp NULL,
  `updated_at` timestamp NULL
) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`;
SQL
    );

    echo "Copying data from 'user' -> 'users' (mapping iduser->id, nama->name)...\n";
    // Copy data, map fields. If email duplicates or other constraints exist, this may fail.
    $pdo->exec("INSERT INTO users (id, name, email, password, created_at, updated_at) SELECT iduser, nama, email, password, NOW(), NOW() FROM `user`");

    // Reset AUTO_INCREMENT
    $max = $pdo->query("SELECT COALESCE(MAX(id),0) FROM users")->fetchColumn();
    $next = $max + 1;
    $pdo->exec("ALTER TABLE users AUTO_INCREMENT = $next");

    echo "Marking migration '0001_01_01_000000_create_users_table' as run in migrations table...\n";
    // Ensure migrations table exists
    $pdo->exec("CREATE TABLE IF NOT EXISTS migrations (id INT AUTO_INCREMENT PRIMARY KEY, migration VARCHAR(255), batch INT)");
    $batch = $pdo->query("SELECT COALESCE(MAX(batch), 0) FROM migrations")->fetchColumn();
    $batch = $batch + 1;
    $migrationName = '0001_01_01_000000_create_users_table';
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM migrations WHERE migration = :m");
    $stmt->execute([':m' => $migrationName]);
    if ($stmt->fetchColumn() == 0) {
        $ins = $pdo->prepare("INSERT INTO migrations (migration, batch) VALUES (:m, :b)");
        $ins->execute([':m' => $migrationName, ':b' => $batch]);
        echo "Migration marked as run (batch $batch).\n";
    } else {
        echo "Migration already recorded in migrations table.\n";
    }

    echo "Done. You can now run 'php artisan migrate --force' to apply remaining migrations.\n";

} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage() . PHP_EOL;
    exit(1);
}
