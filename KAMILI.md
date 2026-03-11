# 📚 Kamili School — Laravel School Management System

A full-featured **school management system** built with **Laravel 10**, designed to manage every aspect of a school: students, staff, academics, exams, fees, attendance, HR, inventory, and more. Built as a multi-school (SaaS-capable) platform with modular architecture.

---

## 🗂️ Project Directory Structure

```
laravel-demo/
│
├── app/                        # Core application logic (models, controllers, helpers, etc.)
│   ├── Http/
│   │   ├── Controllers/        # All request handlers (admin, student, parent, teacher, API)
│   │   ├── Middleware/         # Request guards (auth, roles, maintenance mode, etc.)
│   │   ├── Requests/           # Form validation request classes
│   │   └── Resources/          # API resource transformers
│   │
│   ├── Models/                 # Secondary Eloquent models
│   ├── Helpers/                # Global helper functions (email, SMS, fees, dates)
│   ├── Mail/                   # Mailable classes for emails
│   ├── Jobs/                   # Queued background jobs (email dispatch, etc.)
│   ├── Events/                 # Application events
│   ├── Listeners/              # Event listeners
│   ├── Notifications/          # Laravel notification classes
│   ├── Repositories/           # Data abstraction layer
│   ├── Exports/                # Excel export classes (Maatwebsite)
│   ├── Imports/                # Excel import classes
│   ├── PaymentGateway/         # Payment gateway integrations
│   ├── Providers/              # Service providers
│   ├── Rules/                  # Custom validation rules
│   ├── Scopes/                 # Eloquent global query scopes
│   ├── Traits/                 # Reusable model traits
│   ├── Validators/             # Custom validators
│   ├── View/                   # View composers / share data
│   ├── Console/                # Artisan commands & scheduled tasks
│   ├── Optionbuilder/          # UI option builder helpers
│   │
│   ├── Sm*.php                 # Core Eloquent models (SmStudent, SmStaff, SmExam, ...)
│   ├── User.php                # Auth user model
│   ├── GlobalVariable.php      # System-wide constants and role IDs
│   ├── CustomResultSetting.php # Exam result customization logic
│   ├── NumberToWords.php       # Converts numbers to word format (for reports)
│   └── SmsTemplate.php        # SMS and email template engine
│
├── Modules/                    # Optional feature modules (nwidart/laravel-modules)
│   ├── BehaviourRecords/       # Student behaviour tracking
│   ├── BulkPrint/              # Bulk document printing
│   ├── Chat/                   # Internal messaging/chat
│   ├── DownloadCenter/         # File download center for users
│   ├── ExamPlan/               # Exam planning and scheduling
│   ├── Fees/                   # Advanced fees management
│   ├── Lesson/                 # Lesson plan management
│   ├── MenuManage/             # Dynamic menu / navigation manager
│   ├── RolePermission/         # Role-based access control
│   ├── StudentAbsentNotification/ # Absent student SMS/email alerts
│   ├── TemplateSettings/       # UI template configuration
│   ├── TwoFactorAuth/          # 2FA authentication
│   ├── VideoWatch/             # Video lesson viewer
│   └── Wallet/                 # Student/parent digital wallet
│
├── config/                     # App configuration files
│   ├── app.php                 # Core app settings (timezone, locale, providers)
│   ├── auth.php                # Authentication guards and providers
│   ├── database.php            # Database connection settings
│   ├── mail.php                # Mail driver settings
│   ├── queue.php               # Queue driver settings
│   ├── cache.php               # Cache driver settings
│   ├── filesystems.php         # Storage disk configuration
│   ├── modules.php             # Laravel Modules package config
│   ├── dompdf.php              # PDF generation settings
│   ├── excel.php               # Excel export/import settings
│   ├── paymentGateway.php      # Payment gateway configuration
│   ├── paypal.php              # PayPal settings
│   ├── paystack.php            # Paystack settings
│   ├── stripe/stripe-php       # Stripe (via composer)
│   ├── twilio.php              # Twilio SMS settings
│   ├── msg91.php               # MSG91 SMS settings
│   ├── himalayasms.php         # Himalaya SMS settings
│   ├── textlocal.php           # TextLocal SMS settings
│   ├── zoom.php                # Zoom integration settings
│   ├── bigbluebutton.php       # BigBlueButton video class settings
│   ├── vimeo.php               # Vimeo video settings
│   ├── laravelpwa.php          # Progressive Web App settings
│   └── ...                     # Other third-party config files
│
├── database/
│   ├── migrations/             # Database schema migrations (table definitions)
│   ├── seeders/                # Database seeders (initial/demo data)
│   └── factories/              # Model factories for testing
│
├── packages/
│   ├── larabuild/optionbuilder/ # Custom option/settings builder package
│   └── larabuild/pagebuilder/   # Custom page builder package
│
├── public/                     # Publicly accessible files (CSS, JS, images, index.php)
├── resources/                  # Views (Blade), raw assets (SCSS, JS before compile)
├── routes/                     # Route definitions (web.php, api.php)
├── storage/                    # Uploaded files, logs, compiled views, cache
├── bootstrap/                  # App bootstrapping and cached configs
├── vendor/                     # Composer dependencies (auto-managed)
├── node_modules/               # NPM dependencies (auto-managed)
│
├── .env                        # 🔒 Environment variables (DB, mail, keys) — NOT committed
├── .env.example                # Template for .env — copy and fill in your values
├── artisan                     # Laravel CLI entry point
├── composer.json               # PHP dependencies
├── package.json                # Node.js/NPM dependencies
├── webpack.mix.js              # Laravel Mix asset compilation config
├── modules_statuses.json       # Which Modules are enabled/disabled
├── general_settings.json       # Cached general settings
├── phpunit.xml                 # PHPUnit test configuration
└── serviceworker.js            # PWA service worker
```

---

## 🏗️ Key Components

### Roles / Users
| Role ID | Role Name     | Description                                      |
|---------|---------------|--------------------------------------------------|
| 1       | Admin         | Full system access, school admin                 |
| 2       | Student       | Student dashboard, exam, fees, homework          |
| 3       | Parent        | View child's progress, fees, attendance          |
| 4       | Teacher       | Manage classes, marks, homework, attendance      |
| Alumni  | (dynamic)     | Access alumni dashboard after graduation         |
| SaaS    | Super Admin   | Manage multiple schools in SaaS mode             |

### Core Models (app/Sm*.php)
| Model | Purpose |
|-------|---------|
| `SmStudent` | Central student record (29KB - the most complex model) |
| `SmStaff` | Teacher and staff records |
| `SmClass` / `SmSection` | Class and section management |
| `SmExam` / `SmExamSchedule` | Exam creation and scheduling |
| `SmFeesAssign` / `SmFeesPayment` | Fee assignment and payment tracking |
| `SmStudentAttendance` | Daily student attendance |
| `SmHomework` | Homework assignment and submission |
| `SmNoticeBoard` | School notice board |
| `SmGeneralSettings` | School-wide configuration settings |
| `SmAcademicYear` | Academic session/year management |
| `SmMarkStore` / `SmMarksRegister` | Marks entry and result storage |
| `SmLeaveRequest` | Staff leave management |
| `SmBook` / `SmBookIssue` | Library book management |
| `SmItem` / `SmItemReceive` | Inventory management |
| `SmVehicle` / `SmRoute` | Transport route management |
| `SmDormitoryList` / `SmRoomList` | Hostel/dormitory management |

### Key Controllers
| Controller | Responsibility |
|-----------|---------------|
| `HomeController` | Dashboard routing per role, to-do list, notices |
| `SmStudentAdmissionController` | Student admission and profile management |
| `SmTeacherController` | Teacher management (HR, payroll, leave) |
| `SmFeesController` | Fee collection, invoices, payment gateways |
| `SmExamRoutineController` | Exam schedule and marks entry |
| `SmStudentAttendanceController` | Mark and view student attendance |
| `SmAcademicCalendarController` | Events, holidays, academic calendar |
| `SmApiController` | REST API endpoints for mobile/external apps |
| `SmFrontendController` | Public-facing school website pages |
| `SmAuthController` | Login, logout, auth flows |

### Helper Files (app/Helpers/)
| File | Purpose |
|------|---------|
| `Helper.php` | Core helper functions (SMS, Email, Date conversion, Permissions) |
| `saas.php` | SaaS mode helpers (multi-school, subscription checks) |
| `FeesHelper.php` | Fee-related calculation helpers |
| `ExamHelper.php` | Exam marks and grade helpers |
| `Basic.php` | Miscellaneous utility helpers |

### Active Modules (Modules/)
Modules are optional feature packs that can be enabled or disabled via `modules_statuses.json`.

---

## 🚀 Getting Started / Installation

### Requirements
- PHP ^7.3 or ^8.1
- Composer
- Node.js + NPM
- MySQL / MariaDB (or other supported DB)
- A web server (Apache / Nginx / Laragon)

### Steps

```bash
# 1. Clone the repository
git clone <repo-url> laravel-demo
cd laravel-demo

# 2. Install PHP dependencies
composer install

# 3. Install Node.js dependencies
npm install

# 4. Copy and configure environment
cp .env.example .env

# 5. Update .env with your database, mail, and other settings
#    Edit .env: APP_URL, DB_DATABASE, DB_USERNAME, DB_PASSWORD, MAIL_*, etc.

# 6. Generate application key
php artisan key:generate

# 7. Run database migrations
php artisan migrate

# 8. Seed the database with initial data
php artisan db:seed

# 9. Compile frontend assets
npm run dev  # development
npm run prod # production

# 10. Create symlink for storage
php artisan storage:link

# 11. Start the development server (or use Laragon)
php artisan serve
```

### Default Credentials (after seeding)
```
Admin:   admin@example.com   / password
Student: student@example.com / password
Parent:  parent@example.com  / password
Teacher: teacher@example.com / password
```
> ⚠️ Change all default passwords in production!

---

## ⚙️ Configuration

### Environment Variables (.env)

| Variable | Purpose |
|----------|---------|
| `APP_URL` | Your application's base URL |
| `DB_*` | Database connection settings |
| `MAIL_*` | Email/SMTP settings |
| `PUSHER_*` | Real-time notifications via Pusher |
| `STRIPE_KEY` | Stripe payment public key |
| `PAYPAL_*` | PayPal credentials |
| `TWILIO_*` | Twilio SMS credentials |

### Modules
Enable or disable modules in `modules_statuses.json`, or via the admin panel under **System Settings > Modules**.

---

## 💳 Payment Gateways Supported
- PayPal
- Stripe
- Paystack
- ToyyibPay
- Xendit
- MercadoPago
- Bank Transfer / Manual

---

## 📱 SMS Gateways Supported
- Twilio
- MSG91
- Clickatell
- TextLocal
- Himalaya SMS
- Africa's Talking

---

## 📧 Email
- SMTP (via `config/mail.php` and `sm_email_settings` DB table)
- sendmail
- PHPMailer

---

## 🔒 Security Notes
- Role-based access control enforced on every route
- `.env` is excluded from version control (see `.gitignore`)
- Laravel Passport & Sanctum installed for API authentication
- Optional Two-Factor Authentication (TwoFactorAuth module)
- Fees due login prevention for students/parents with outstanding fees

---

## 🧪 Testing

```bash
# Run PHPUnit tests
php artisan test

# Run browser (Dusk) tests
php artisan dusk
```

---

## 🗃️ Database

Migrations are located in `database/migrations/`. Each `Sm*` table corresponds to an `Sm*` model. Key tables include:

| Table | Purpose |
|-------|---------|
| `sm_students` | All student records |
| `sm_staffs` | Teacher/staff records |
| `sm_classes` | Class definitions |
| `sm_sections` | Class sections |
| `sm_exams` | Exam records |
| `sm_exam_schedules` | Per-subject exam schedule |
| `sm_marks_registers` | Marks entry per student/subject |
| `sm_fees_assigns` | Fee assignment per student |
| `sm_fees_payments` | Payment records |
| `sm_student_attendances` | Daily attendance records |
| `sm_notice_boards` | Notice board entries |
| `sm_general_settings` | System configuration per school |
| `sm_academic_years` | Academic sessions |

---

## 🤝 Contributing

1. Fork the repository
2. Create a new feature branch: `git checkout -b feature/your-feature`
3. Commit your changes: `git commit -m "Add your feature"`
4. Push to the branch: `git push origin feature/your-feature`
5. Open a Pull Request

---

## 📄 License

MIT — see `composer.json` for details.

---

## 📞 Support

For questions or issues, contact the development team or open a GitHub issue.
