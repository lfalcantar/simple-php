<?php
require_once 'config/database.php';

// Debug: Check database connection
try {
    // Test the connection
    $pdo->query("SELECT 1");
    error_log("Database connection successful");
} catch (PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    die("Database connection failed");
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
            browser_language VARCHAR(50),
            screen_resolution VARCHAR(20)
        )
    ");
    error_log("Table created or already exists");
} catch (PDOException $e) {
    error_log("Error creating table: " . $e->getMessage());
    die("Error creating table");
}

// Log access details
try {
    $stmt = $pdo->prepare("
        INSERT INTO page_access 
        (ip_address, user_agent, page_url, referrer, browser_language, screen_resolution) 
        VALUES (?, ?, ?, ?, ?, ?)
    ");

    $ip = $_SERVER['REMOTE_ADDR'];
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
    $pageUrl = $_SERVER['REQUEST_URI'];
    $referrer = $_SERVER['HTTP_REFERER'] ?? 'Direct';
    $language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'Unknown', 0, 50);
    $resolution = isset($_GET['resolution']) ? $_GET['resolution'] : 'Unknown';

    error_log("Logging access: IP=$ip, URL=$pageUrl, Resolution=$resolution, Language=$language");

    $stmt->execute([
        $ip,
        $userAgent,
        $pageUrl,
        $referrer,
        $language,
        $resolution
    ]);

    error_log("Access logged successfully");
} catch (PDOException $e) {
    error_log("Error logging access: " . $e->getMessage());
}

// If this is a resolution update request, just exit
if (isset($_GET['resolution']) && !isset($_GET['full_page'])) {
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Coding Assistant Guide</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        // Function to log access
        function logAccess() {
            const resolution = window.screen.width + 'x' + window.screen.height;
            const url = new URL(window.location.href);
            url.searchParams.set('resolution', resolution);
            url.searchParams.set('full_page', 'true');
            
            // Make a direct request to log the access
            const xhr = new XMLHttpRequest();
            xhr.open('GET', url.toString(), true);
            xhr.send();
            
            console.log('Access logged:', resolution);
        }

        // Log on page load
        document.addEventListener('DOMContentLoaded', logAccess);

        // Log on visibility change
        document.addEventListener('visibilitychange', function() {
            if (document.visibilityState === 'visible') {
                logAccess();
            }
        });
    </script>
</head>
<body>
    <div class="container">
        <header>
            <h1><i class="fas fa-robot"></i> AI Coding Assistant Guide</h1>
            <p class="subtitle">Enhancing Your Development Workflow with AI</p>
        </header>

        <main>
            <section class="card">
                <h2><i class="fas fa-lightbulb"></i> What is AI Coding?</h2>
                <p>AI coding assistants are powerful tools that help developers write, review, and optimize code. They can:</p>
                <ul>
                    <li>Generate code snippets based on natural language descriptions</li>
                    <li>Help debug and fix errors</li>
                    <li>Suggest improvements and optimizations</li>
                    <li>Provide documentation and explanations</li>
                </ul>
            </section>

            <section class="card">
                <h2><i class="fas fa-code"></i> How to Use AI for Coding</h2>
                <div class="steps">
                    <div class="step">
                        <h3>1. Start with Clear Instructions</h3>
                        <p>Be specific about what you want to achieve. Describe the problem or feature in detail.</p>
                    </div>
                    <div class="step">
                        <h3>2. Review Generated Code</h3>
                        <p>Always review the AI's suggestions and ensure they match your requirements.</p>
                    </div>
                    <div class="step">
                        <h3>3. Iterate and Refine</h3>
                        <p>Use feedback loops to improve the results and get better suggestions.</p>
                    </div>
                </div>
            </section>

            <section class="card">
                <h2><i class="fas fa-tools"></i> Best Practices</h2>
                <ul>
                    <li>Use AI as a complement to your skills, not a replacement</li>
                    <li>Maintain security and privacy standards</li>
                    <li>Keep learning and improving your own coding skills</li>
                    <li>Test all AI-generated code thoroughly</li>
                </ul>
            </section>
        </main>

        <footer>
            <p>Created with <i class="fas fa-heart"></i> for developers</p>
        </footer>
    </div>
</body>
</html> 