# Otzivnik

Мини-отзовик на Laravel: организации + анонимные отзывы (без авторизации).

---

## Быстрый старт (Windows + Git Bash + VS Code)

### 0 Клонирование репозитория

````bash
git clone https://github.com/creator137/otzivnik.git
cd otzivnik
git checkout dev

### 1 Клонирование репозитория
```bash
composer install
cp .env.example .env
php artisan key:generate

### 2 SQLite (локально)
Создать файл базы:
```bash
mkdir -p database
touch database/database.sqlite

Указать абсолютный путь к базе в .env:

Узнать путь до проекта:
```bash
pwd -W


Открыть .env и выставить (пример):

DB_CONNECTION=sqlite
DB_DATABASE=D:/projects/otzivnik/database/database.sqlite

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync


Важно: DB_DATABASE должен быть абсолютным Windows-путём (лучше в формате D:/...).

### 3 Миграции и запуск
```bash
php artisan migrate
php artisan serve

Открыть в браузере: http://127.0.0.1:8000


### 4 Работа в команде (Git)

Ветки

main — стабильная ветка (релизы)

dev — разработка

feature/* — ветки задач

Типовой флоу
```bash

git checkout dev
git pull
git checkout -b feature/some-task

# ... работа ...

git add .
git commit -m "feat: some task"
git push -u origin feature/some-task
````
