
📰 Laravel News Portal
📘 Project Description

This project is a simple news portal built with the Laravel framework. It includes a user authentication system, news management, role-based access (Admin and Editor), and dynamic news listing with Ajax. All interface elements are styled using Bootstrap only.
✅ Features

    Bootstrap-based UI

    Structured layout with Header and Footer

    12 sample news items (pre-seeded)

    Pagination support – 4 news items per page (Ajax-based)

    News detail page 

    User registration and login system (with hashed passwords)

    Session-based login/logout

    User Dashboard: Profile, Password Update, Add News

    Admin Panel with full CRUD (users, news, admins)

    Role-based access control: admin, editor

    News API: returns latest news first

    Visual design with Bootstrap only – no custom styles

📦 Installation


```bash
git clone https://github.com/bakyyeva/mynews.git
cd mynews
composer install
cp .env.example .env
php artisan migrate --seed
php artisan serve


## 👤 Demo Admin Login

Use the following credentials to log in as an admin:

Username: editor  
Password: editor








