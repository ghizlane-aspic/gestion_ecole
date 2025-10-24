<?php

/**
 * Acces_BD/connexion.php
 * Fournit la fonction Connect() pour établir une connexion PDO MySQL.
 */

declare(strict_types=1);

/**
 * Ouvre et retourne une connexion PDO vers MySQL.
 *
 * @throws RuntimeException si le .env est introuvable ou la connexion échoue
 * @throws InvalidArgumentException si des paramètres requis manquent
 */
function Connect(): PDO
{
    static $pdo = null;
    if ($pdo instanceof PDO) {
        return $pdo;
    }

   
    $envPaths = [
        __DIR__ . DIRECTORY_SEPARATOR . '.env',          
    ];


    $config = [
        'Serveur' => 'localhost',
        'Utilisateur' => 'root',
        'Password' => '',
        'db_name' => 'gestion-ecole',
        'Port' => '3306',  
        'Charset' => 'utf8mb4',   
    ];

    $envLoaded = false;
    foreach ($envPaths as $envFile) {
        if (is_readable($envFile)) {
            $envLoaded = true;
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            if ($lines === false) {
                throw new RuntimeException("Impossible de lire le fichier .env: {$envFile}");
            }
            foreach ($lines as $line) {
                $line = trim($line);
                if ($line === '' || $line[0] === '#' || $line[0] === ';') {
                    continue; // commentaire ou ligne vide
                }
                // Split sur le premier '=' ou ':' avec espaces optionnels
                $pair = preg_split('/\s*[=:]\s*/', $line, 2);
                if (is_array($pair) && count($pair) === 2) {
                    $key = trim($pair[0]);
                    $val = trim($pair[1]);
                    if (array_key_exists($key, $config)) {
                        $config[$key] = $val;
                    }
                }
            }
            break;
        }
    }

    if (!$envLoaded) {
        throw new RuntimeException(
            ".env introuvable. Placez un fichier .env à la racine du projet avec: " .
            "Serveur, Utilisateur, Password, db_name, (Port, Charset optionnels)."
        );
    }

    // Validation des paramètres requis
    foreach (['Serveur', 'Utilisateur', 'db_name'] as $required) {
        if (!isset($config[$required]) || $config[$required] === null || $config[$required] === '') {
            throw new InvalidArgumentException("Paramètre manquant dans .env: {$required}");
        }
    }

    $host = $config['Serveur'];
    $dbname = $config['db_name'];
    $user = $config['Utilisateur'];
    $pass = (string)($config['Password'] ?? '');
    $port = $config['Port'] ?: '3306';
    $charset = $config['Charset'] ?: 'utf8mb4';

    $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=%s', $host, $port, $dbname, $charset);

    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    } catch (PDOException $e) {
        throw new RuntimeException('Erreur de connexion à la base de données: ' . $e->getMessage());
    }

    return $pdo;
}

if (php_sapi_name() === 'cli') {
    echo "🧪 Test de connexion à la base de données...\n";

    try {
        $pdo = Connect();
        echo "✅ Connexion réussie à la base de données !\n";
    } catch (Throwable $e) {
        echo "❌ Erreur : " . $e->getMessage() . "\n";
    }
}