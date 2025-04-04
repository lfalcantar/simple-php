<?php
require_once 'config/database.php';

// Debug: Check database connection
try {
    // Test the connection
    $pdo->query("SELECT 1");
    echo "<!-- Database connection successful -->";
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Create table if it doesn't exist
try {
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS page_access (
            id SERIAL PRIMARY KEY,
            ip_address VARCHAR(45),
            user_agent TEXT,
            page_url TEXT,
            access_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            referrer TEXT,
            browser_language VARCHAR(10),
            screen_resolution VARCHAR(20)
        )
    ");
    echo "<!-- Table created or already exists -->";
} catch (PDOException $e) {
    die("Error creating table: " . $e->getMessage());
}

// Get all entries from the database
try {
    $stmt = $pdo->query("SELECT * FROM page_access ORDER BY access_time DESC");
    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<!-- Found " . count($entries) . " entries -->";
} catch (PDOException $e) {
    die("Error fetching entries: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Access Logs</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
            font-size: 0.9rem;
        }
        .admin-table th, .admin-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .admin-table th {
            background-color: #f8fafc;
            font-weight: bold;
            position: sticky;
            top: 0;
        }
        .admin-table tr:hover {
            background-color: #f5f5f5;
        }
        .admin-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }
        .no-entries {
            text-align: center;
            padding: 2rem;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <h1>Access Logs</h1>
        <?php if (empty($entries)): ?>
            <div class="no-entries">
                <p>No access logs found yet. Visit the main page to generate some logs.</p>
                <p><a href="index.php">Go to Main Page</a></p>
            </div>
        <?php else: ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>IP Address</th>
                        <th>User Agent</th>
                        <th>Page URL</th>
                        <th>Access Time</th>
                        <th>Referrer</th>
                        <th>Language</th>
                        <th>Resolution</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($entries as $entry): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($entry['id']); ?></td>
                        <td><?php echo htmlspecialchars($entry['ip_address']); ?></td>
                        <td><?php echo htmlspecialchars($entry['user_agent']); ?></td>
                        <td><?php echo htmlspecialchars($entry['page_url']); ?></td>
                        <td><?php echo htmlspecialchars($entry['access_time']); ?></td>
                        <td><?php echo htmlspecialchars($entry['referrer']); ?></td>
                        <td><?php echo htmlspecialchars($entry['browser_language']); ?></td>
                        <td><?php echo htmlspecialchars($entry['screen_resolution']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html> 