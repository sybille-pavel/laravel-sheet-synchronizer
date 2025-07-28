# 📄 Laravel Google Sheet Sync

> Сервис на Laravel 12 для автоматической синхронизации данных из базы с Google Таблицей.

Поддерживает CRUD-интерфейс, экспорт записей со статусом `Allowed`, загрузку и сохранение комментариев из Google Sheets, а также консольные команды и автоматическую синхронизацию по расписанию.

---


## 📦 Установка

```bash
git clone https://github.com/sybille-pavel/laravel-sheet-synchronizer
cd laravel-google-sheet-sync

composer install

cp .env.example .env
php artisan migrate

npm install
npm run build
```

---

## ⚙️ Настройка

### 1. Получите сервисный аккаунт Google

- Создайте проект в [Google Cloud Console](https://console.cloud.google.com/)
- Включите API Google Sheets
- Создайте **сервисный аккаунт** и скачайте JSON-файл
- Предоставьте доступ на **редактирование таблицы** аккаунту вида `your-service-account@project.iam.gserviceaccount.com`

### 2. Настройте `.env`

```dotenv
GOOGLE_APPLICATION_CREDENTIALS=storage/app/credentials/credentials.json
GOOGLE_SPREADSHEET_ID=your_google_sheet_id
```

📌 `GOOGLE_SPREADSHEET_ID` — это ID из ссылки на Google Таблицу:  
`https://docs.google.com/spreadsheets/d/**your_google_sheet_id**/edit`

---

## 💻 Использование

### 🔁 Синхронизация данных

```bash
php artisan sheet:sync
```

- Загружает все записи со статусом `Allowed` в Google Таблицу
- Сохраняет комментарии из таблицы в базу данных

### 💬 Получение комментариев

```bash
php artisan sheet:fetch {--count=}
```

- Загружает строки из Google Таблицы
- Выводит ID и комментарии в консоль
- `--count` — необязательный параметр, ограничивающий количество строк

### 🌐 Вызов из браузера

```text
GET /fetch
```

- Вызов команды `sheet:fetch` через HTTP

---

## ⏰ Планировщик

Чтобы настроить автоматическую синхронизацию, добавьте cron:

```bash
* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1
```

---

## 📁 Структура проекта

- `app/Models/Record.php` — модель записей
- `app/Services/GoogleSheetService.php` — логика синхронизации
- `app/Console/Commands/` — команды для CLI
- `routes/web.php` — роут для вызова `sheet:fetch` из браузера

---

## 🧷 Требования

- PHP >= 8.2
- Laravel >= 12
- Google Sheets API
- Сервисный аккаунт Google
- node = 22

---

