<?php
/**
 * Common Configuration
 * EPM CONGRESS 2025
 */

// Set encoding and locale
ini_set('default_charset', 'utf-8');
mb_internal_encoding('UTF-8');
mb_http_output('UTF-8');
mb_regex_encoding('UTF-8');
setlocale(LC_CTYPE, 'ko_KR.UTF-8', 'korean', 'kor');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set timezone
date_default_timezone_set(getenv('APP_TIMEZONE') ?: 'Asia/Seoul');

// Include database configuration
require_once __DIR__ . '/database.php';

// Application configuration
define('APP_NAME', getenv('SITE_NAME') ?: 'EPM CONGRESS 2025');
define('APP_VERSION', '1.0.0');
define('APP_ENV', getenv('APP_ENV') ?: 'production');
define('APP_DEBUG', getenv('APP_DEBUG') === 'true');
define('APP_URL', getenv('APP_URL') ?: 'http://localhost:8080');

// Security configuration
define('CSRF_TOKEN_NAME', getenv('CSRF_TOKEN_NAME') ?: 'csrf_token');
define('SESSION_LIFETIME', (int)(getenv('SESSION_LIFETIME') ?: 7200));
define('JWT_SECRET', getenv('JWT_SECRET') ?: 'your-secret-key-here');

// File upload configuration
define('MAX_FILE_SIZE', (int)(getenv('MAX_FILE_SIZE') ?: 10485760)); // 10MB
define('ALLOWED_FILE_TYPES', explode(',', getenv('ALLOWED_FILE_TYPES') ?: 'jpg,jpeg,png,gif,pdf,doc,docx,ppt,pptx'));

// Email configuration
define('MAIL_HOST', getenv('MAIL_HOST') ?: 'smtp.gmail.com');
define('MAIL_PORT', (int)(getenv('MAIL_PORT') ?: 587));
define('MAIL_USERNAME', getenv('MAIL_USERNAME') ?: '');
define('MAIL_PASSWORD', getenv('MAIL_PASSWORD') ?: '');
define('MAIL_ENCRYPTION', getenv('MAIL_ENCRYPTION') ?: 'tls');
define('MAIL_FROM_ADDRESS', getenv('MAIL_FROM_ADDRESS') ?: 'noreply@epmcongress.com');
define('MAIL_FROM_NAME', getenv('MAIL_FROM_NAME') ?: 'EPM CONGRESS 2025');

// API Keys
define('GOOGLE_MAPS_API_KEY', getenv('GOOGLE_MAPS_API_KEY') ?: '');
define('GOOGLE_ANALYTICS_ID', getenv('GOOGLE_ANALYTICS_ID') ?: '');

// Directory paths
define('ROOT_PATH', dirname(__DIR__));
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('ASSETS_PATH', PUBLIC_PATH . '/assets');
define('UPLOADS_PATH', PUBLIC_PATH . '/uploads');
define('INCLUDES_PATH', ROOT_PATH . '/includes');
define('CONFIG_PATH', ROOT_PATH . '/config');

// URL paths
define('BASE_URL', rtrim(APP_URL, '/'));
define('ASSETS_URL', BASE_URL . '/assets');
define('UPLOADS_URL', BASE_URL . '/uploads');

// Error reporting
if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
} else {
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', ROOT_PATH . '/logs/error.log');
}

// Utility functions
function env($key, $default = null) {
    return getenv($key) ?: $default;
}

function config($key, $default = null) {
    $keys = explode('.', $key);
    $value = $GLOBALS['config'] ?? [];
    
    foreach ($keys as $k) {
        if (isset($value[$k])) {
            $value = $value[$k];
        } else {
            return $default;
        }
    }
    
    return $value;
}

function asset($path) {
    return ASSETS_URL . '/' . ltrim($path, '/');
}

function url($path = '') {
    return BASE_URL . '/' . ltrim($path, '/');
}

function redirect($url, $code = 302) {
    header("Location: $url", true, $code);
    exit;
}

function generateCSRFToken() {
    if (!isset($_SESSION[CSRF_TOKEN_NAME])) {
        $_SESSION[CSRF_TOKEN_NAME] = bin2hex(random_bytes(32));
    }
    return $_SESSION[CSRF_TOKEN_NAME];
}

function verifyCSRFToken($token) {
    return isset($_SESSION[CSRF_TOKEN_NAME]) && hash_equals($_SESSION[CSRF_TOKEN_NAME], $token);
}

function sanitizeInput($input) {
    if (is_array($input)) {
        return array_map('sanitizeInput', $input);
    }
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

function safeOutput($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function ensureUTF8($text) {
    if (!mb_check_encoding($text, 'UTF-8')) {
        $text = mb_convert_encoding($text, 'UTF-8', 'auto');
    }
    return $text;
}

function formatDate($date, $format = 'Y-m-d H:i:s') {
    if (is_string($date)) {
        $date = new DateTime($date);
    }
    return $date->format($format);
}

function formatKoreanDate($date) {
    $dateObj = is_string($date) ? new DateTime($date) : $date;
    return $dateObj->format('Y년 n월 j일');
}

function formatKoreanDateTime($date) {
    $dateObj = is_string($date) ? new DateTime($date) : $date;
    return $dateObj->format('Y년 n월 j일 H시 i분');
}

function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function isValidPhone($phone) {
    return preg_match('/^[0-9\-\+\(\)\s]+$/', $phone);
}

function logError($message, $context = []) {
    $logMessage = date('Y-m-d H:i:s') . ' - ' . $message;
    if (!empty($context)) {
        $logMessage .= ' - Context: ' . json_encode($context);
    }
    error_log($logMessage . PHP_EOL, 3, ROOT_PATH . '/logs/error.log');
}

function logInfo($message, $context = []) {
    if (APP_DEBUG) {
        $logMessage = date('Y-m-d H:i:s') . ' - INFO: ' . $message;
        if (!empty($context)) {
            $logMessage .= ' - Context: ' . json_encode($context);
        }
        error_log($logMessage . PHP_EOL, 3, ROOT_PATH . '/logs/info.log');
    }
}

// Create necessary directories
$dirs = [
    ROOT_PATH . '/logs',
    PUBLIC_PATH . '/uploads',
    PUBLIC_PATH . '/uploads/temp'
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Global error handler
function globalErrorHandler($errno, $errstr, $errfile, $errline) {
    if (!(error_reporting() & $errno)) {
        return false;
    }
    
    $message = "Error [$errno]: $errstr in $errfile on line $errline";
    logError($message);
    
    if (APP_DEBUG) {
        echo "<pre>$message</pre>";
    }
    
    return true;
}

set_error_handler('globalErrorHandler');

// Global exception handler
function globalExceptionHandler($exception) {
    $message = "Uncaught exception: " . $exception->getMessage() . " in " . $exception->getFile() . " on line " . $exception->getLine();
    logError($message);
    
    if (APP_DEBUG) {
        echo "<pre>$message</pre>";
        echo "<pre>" . $exception->getTraceAsString() . "</pre>";
    } else {
        echo "시스템 오류가 발생했습니다. 잠시 후 다시 시도해주세요.";
    }
}

set_exception_handler('globalExceptionHandler');
?>
