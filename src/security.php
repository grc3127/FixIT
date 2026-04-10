<?php
/**
 * Security utilities: CSRF protection, session auth, HTTP headers, input sanitization.
 */

class Security
{
    /**
     * Generate a CSRF token and store it in the session.
     */
    public static function generateCsrfToken(): string
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Validate a CSRF token from a request.
     */
    public static function validateCsrfToken(?string $token): bool
    {
        if (empty($token) || empty($_SESSION['csrf_token'])) {
            return false;
        }
        return hash_equals($_SESSION['csrf_token'], $token);
    }

    /**
     * Validate CSRF for POST requests. Sends 403 JSON and exits on failure.
     */
    public static function requireCsrf(): void
    {
        $token = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;
        if (!self::validateCsrfToken($token)) {
            http_response_code(403);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid or expired security token. Please refresh the page.']);
            exit;
        }
    }

    /**
     * Require an authenticated session. Redirects or sends JSON 401.
     */
    public static function requireAuth(bool $jsonResponse = true): void
    {
        if (empty($_SESSION['logged_in'])) {
            if ($jsonResponse) {
                http_response_code(401);
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Session expired. Please log in again.']);
                exit;
            }
            header('Location: login.php');
            exit;
        }
    }

    /**
     * Require specific role(s). Sends 403 JSON on failure.
     */
    public static function requireRole(array $allowedRoles): void
    {
        $role = $_SESSION['role_id'] ?? 0;
        if (!in_array((int)$role, $allowedRoles, true)) {
            http_response_code(403);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Access denied.']);
            exit;
        }
    }

    /**
     * Require POST method. Sends 405 JSON on failure.
     */
    public static function requirePost(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
            exit;
        }
    }

    /**
     * Send security-related HTTP headers.
     */
    public static function sendSecurityHeaders(): void
    {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        header("Content-Security-Policy: default-src 'self';"
        ." script-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com;"
        ." style-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com;"
        ." img-src 'self' data:;"
        ." font-src 'self';");
    }

    /**
     * Configure secure session settings before session_start().
     */
    public static function configureSession(array $config = []): void
    {
        $lifetime = $config['lifetime'] ?? 1800;
        $name = $config['name'] ?? 'ISERVE_SID';

        ini_set('session.use_strict_mode', '1');
        ini_set('session.use_only_cookies', '1');
        ini_set('session.cookie_httponly', '1');
        ini_set('session.cookie_samesite', 'Strict');
        ini_set('session.gc_maxlifetime', (string)$lifetime);

        $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
        ini_set('session.cookie_secure', $isHttps ? '1' : '0');

        session_name($name);
    }

    /**
     * Validate and sanitize a file upload. Returns validated temp path or false.
     */
    public static function validateUpload(array $file, array $config): string|false
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        $maxSize = $config['max_size'] ?? 2 * 1024 * 1024;
        if ($file['size'] > $maxSize) {
            return false;
        }

        $allowedTypes = $config['allowed_types'] ?? ['image/jpeg', 'image/png', 'image/gif'];
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file['tmp_name']);
        if (!in_array($mimeType, $allowedTypes, true)) {
            return false;
        }

        return $file['tmp_name'];
    }

    /**
     * Simple login rate limiting using session.
     * Returns true if the request should be blocked.
     */
    public static function isLoginRateLimited(int $maxAttempts = 5, int $windowSeconds = 300): bool
    {
        $now = time();
        if (!isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts'] = [];
        }

        // Clean old attempts outside the window
        $_SESSION['login_attempts'] = array_filter(
            $_SESSION['login_attempts'],
            fn($t) => ($now - $t) < $windowSeconds
        );

        return count($_SESSION['login_attempts']) >= $maxAttempts;
    }

    /**
     * Record a login attempt for rate limiting.
     */
    public static function recordLoginAttempt(): void
    {
        $_SESSION['login_attempts'][] = time();
    }

    /**
     * Clear login attempts after successful login.
     */
    public static function clearLoginAttempts(): void
    {
        unset($_SESSION['login_attempts']);
    }

    /**
     * Output a hidden CSRF input field for forms.
     */
    public static function csrfField(): string
    {
        $token = self::generateCsrfToken();
        return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
    }

    /**
     * Get CSRF token value for use in JavaScript fetch headers.
     */
    public static function csrfToken(): string
    {
        return self::generateCsrfToken();
    }

    /**
     * Safe JSON error response (never exposes internal details).
     */
    public static function jsonError(string $userMessage, ?string $logMessage = null): void
    {
        if ($logMessage) {
            error_log($logMessage);
        }
        echo json_encode(['success' => false, 'message' => $userMessage]);
        exit;
    }
}
