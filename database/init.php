<?php
// database/init.php

$dbFile = __DIR__ . '/burger_labs.sqlite';
$schemaFile = __DIR__ . '/schema.sql';

if (file_exists($dbFile)) {
    unlink($dbFile);
}

try {
    $db = new PDO("sqlite:" . $dbFile);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $schema = file_get_contents($schemaFile);
    
    // Split schema into statements and execute
    $statements = explode(';', $schema);
    foreach ($statements as $statement) {
        $statement = trim($statement);
        if (!empty($statement)) {
            $db->exec($statement);
        }
    }
    
    echo "[+] SQLite Database initialized successfully at $dbFile\n";
    chmod($dbFile, 0666);
    
} catch (PDOException $e) {
    die("[-] Database Initialization Error: " . $e->getMessage() . "\n");
}
