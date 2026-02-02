# Security Policy and Implementation Report

## Overview
This document outlines the security measures, policies, and practices implemented in the Vintage Vault V2 application. The application leverages the Laravel 12 framework's robust security features to protect user data, ensure secure authentication, and prevent common web vulnerabilities.

## 1. Authentication & Session Management

### 1.1 Web Authentication
- **Mechanism:** Laravel Jetstream (Fortify) is used for secure user registration, login, and password management.
- **Password Storage:** User passwords are encrypted using `bcrypt` (Blowfish) algorithm before storage. They are never stored in plain text.
- **Session Protection:**
    - `HttpOnly` and `Secure` flags are set on session cookies to prevent access via JavaScript.
    - Session fixation protection is enabled by default (session ID regeneration on login).

### 1.2 API Authentication
- **Mechanism:** Laravel Sanctum is implemented for API token authentication.
- **Token Handling:**
    - Tokens are issued upon successful login via the `/api/login` endpoint.
    - Protected routes utilize the `auth:sanctum` middleware.
    - Tokens are hashed in the database (SHA-256) for additional security; the plain-text token is only shown once upon creation.

## 2. Authorization & Access Control

### 2.1 Role-Based Access Control (RBAC)
- **Middleware:** Custom `CheckRole` middleware is used to restrict access to sensitive routes (e.g., Admin or Seller dashboards) based on the user's `role` column.
- **Resource Protection:**
    - API endpoints for modifying products verify that the authenticated user is the *owner* of the product before allowing Updates or Deletes (Broken Access Control prevention).
    - Example: `if ($product->user_id !== Auth::id()) { abort(403); }`

**Implementation Proof (`app/Http/Middleware/CheckRole.php`):**
```php
public function handle(Request $request, Closure $next, string $role): Response
{
    // Check if user is logged in AND has the correct role
    if (! $request->user() || $request->user()->role !== $role) {
        // If not, redirect them to the dashboard with an error
        abort(403, 'Unauthorized action.');
    }

    return $next($request);
}
```

## 3. Data Protection & Encryption

### 3.1 Data in Transit
- **HTTPS:** The application is designed to run over HTTPS. In production environments, all HTTP traffic should be redirected to HTTPS to prevent Man-in-the-Middle (MitM) attacks.

### 3.2 Data at Rest
- Sensitive environment variables (Database credentials, API keys) are stored in the `.env` file, which is excluded from version control via `.gitignore`.
- User profiles can handle sensitive personal information; access is restricted to the authenticated user and authorized administrators.

## 4. Input Validation & Sanitization

- **Validation:** All incoming HTTP requests (Web and API) are validated using Laravel's validation engine before processing. This ensures data integrity and type correctness.
- **Sanitization:**
    - **XSS Prevention:** Laravel's Blade templating engine automatically escapes output using `{{ $variable }}` syntax, neutralizing potential Cross-Site Scripting (XSS) payloads.
    - **Mass Assignment Protection:** Eloquent models utilize the `$fillable` property to strictly define which attributes can be mass-assigned, preventing users from modifying protected fields (e.g., `role` or `id`) via malicious requests.

**Implementation Proof (`app/Models/User.php`):**
```php
protected $fillable = [
    'name',
    'email',
    'password',
    'phone',
    'address',
    'role', // Role is fillable but protected by Admin-only controllers/logic
];

protected $hidden = [
    'password',
    'remember_token',
    'two_factor_recovery_codes',
    'two_factor_secret',
];
```

## 5. Vulnerability Mitigation Strategies

| Threat | Mitigation Strategy |
| :--- | :--- |
| **SQL Injection (SQLi)** | The application uses Laravel's Eloquent ORM, which utilizes PDO parameter binding by default. This ensures that user input is treated as data, not executable code, effectively preventing SQL injection attacks. |
| **Cross-Site Request Forgery (CSRF)** | All state-changing web forms include a `@csrf` token. The `VerifyCsrfToken` middleware validates this token for every POST, PUT, DELETE request to ensure the request originated from the authenticated user. |
| **Cross-Site Scripting (XSS)** | Blade templates automatically encode special characters. Raw output `unencoded` is strictly avoided unless safeguarding HTML content from a trusted source. |
| **Brute Force Attacks** | Laravel's rate limiting is applied to login routes (default 5 attempts per minute) to prevent credential stuffing and brute-force attacks. |

**CSRF Implementation Proof (`resources/views/layouts/app.blade.php`):**
```html
<meta name="csrf-token" content="{{ csrf_token() }}">
```

## 6. Security Testing & Auditing

- **Automated Tests:** Feature tests cover authentication flows (Registration, Login) and critical data operations to ensure security constraints hold true during development.
- **Review Process:** Code reviews include a specific check for authorization gates and validation rules on new endpoints.

---
*This document is a living artifact and will be updated as new security features or audits are introduced.*
