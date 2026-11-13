# IS Project 1 - Web Application

A small PHP web app (signup, login, feedback) hosted on **nginx + Debian 13 + PostgreSQL**

## Stack
- **nginx** — web server
- **PHP-FPM 8.4** — runs the `.php` pages
- **PostgreSQL 17** — database , accessed via PDO (`pdo_pgsql`)

## Files
| File | Purpose |
|------|---------|
| `index.php` | Landing page + DB connection test |
| `db.php` | PDO connection to the  database |
| `register.php` | Signup — inserts a user (password hashed) |
| `login.php` | Login — verifies password, starts session |
| `welcome.php` | Post-login dashboard |
| `logout.php` | Ends the session |
| `feedback.php` | Extra form — POST + retrieve from `feedback` table |
| `schema.sql` | Creates the database, app role and tables |
| `.github/workflows/php-ci.yml` | GitHub Actions — lints PHP on every push (serverless) |

## Setup on the server
```bash
# 1. install the stack
sudo apt update
sudo apt install -y nginx postgresql postgresql-contrib php-fpm php-cli php-pgsql git

# 2. create the database + tables
sudo -u postgres psql -f schema.sql

# 3. deploy the code
sudo git clone https://github.com/bhunnid/IS-project1.git /var/www/cat2
sudo chown -R $USER:www-data /var/www/cat2

# 4. point nginx at /var/www/cat2 (see the lab guide for the server block)
sudo nginx -t && sudo systemctl reload nginx
```

Then browse to `http://localhost/`.

> Note: `db.php` holds the DB password in plain text for simplicity.
> In production you would move it to an environment variable.
