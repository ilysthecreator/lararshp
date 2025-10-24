<?php
try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=rshplara;charset=utf8mb4", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Update the admin user's role
    $stmt = $pdo->prepare("UPDATE users SET role = 'admin' WHERE email = 'admin@mail.com'");
    $stmt->execute();
    $count = $stmt->rowCount();
    
    if ($count > 0) {
        echo "Successfully updated admin role for admin@mail.com\n";
    } else {
        echo "No user found with email admin@mail.com\n";
    }
} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage() . PHP_EOL;
}