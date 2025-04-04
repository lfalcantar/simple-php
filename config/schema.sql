CREATE TABLE IF NOT EXISTS page_access (
    id SERIAL PRIMARY KEY,
    ip_address VARCHAR(45),
    user_agent TEXT,
    page_url TEXT,
    access_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    referrer TEXT,
    browser_language VARCHAR(50),
    screen_resolution VARCHAR(20)
); 