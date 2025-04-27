## 🔐 Laravel 10 Authentication with Email Verification & Remember Me
This project demonstrates how to build a simple authentication system in Laravel 10 from scratch, with support for email verification and the "Remember Me" feature. 

🧩 What This Project Contains
- Basic user registration and login
-📧 Email verification after registration
-🔁 "Remember Me" functionality
-🚫 Access restrictions for unverified users
-🔐 Secure authentication middleware
-📋 Blade templates styled with Bootstrap 5

## 🛠️ Tech Stack

| Tool         | Purpose                     |
|--------------|-----------------------------|
| Laravel 10   | PHP framework               |
| Blade        | View templating             |
| Eloquent ORM | Database interaction        |
| Bootstrap 5  | Frontend UI styling         |


🚀 Setup Steps

1️⃣ Install Laravel

```bash
composer create-project laravel/laravel auth-app
```

2️⃣ Setup Authentication
Manually implement routes, controllers, and Blade views for:
- Registration
- Login
- Logout
- Dashboard


3️⃣ Enable Email Verification
- Implement MustVerifyEmail in the User model.
- Use sendEmailVerificationNotification() after registration.
- Add verification routes (/email/verify, /email/verify/{id}/{hash}).
- Protect dashboard and authenticated routes with verified middleware.


4️⃣ Add Remember Me Functionality
- Use Laravel's Auth::attempt() with the remember flag.
- Add checkbox in the login form.

5️⃣ Create Views

- Build Blade views using Bootstrap 5 for:
- Registration page
- Login page
- Dashboard
- Verify email notification page
- Flash messages for errors and success

🔐 Important Middleware

Apply these middlewares to routes:

## 🔐 Important Middleware
Apply these middlewares to routes:

| Middleware | Purpose                                                  |
|------------|----------------------------------------------------------|
| `auth`     | Restrict access to logged-in users only                  |
| `guest`    | Prevent logged-in users from accessing login/register pages |
| `verified` | Allow access only after email is verified                |
| `signed`   | Required for secure email verification links             |


## 💡 Useful Artisan Commands

```bash
php artisan migrate                  # Run migrations
php artisan serve                    # Start dev server
php artisan route:list               # View all defined routes
```

## 📬 Notes on Email Verification
Laravel uses a built-in Mailable for verification.
Email content is auto-generated via Illuminate\Auth\Notifications\VerifyEmail.
You can override this for custom email design.
