# ResumeForge – PHP Resume Builder
## Web Technology Mini Project

A complete resume builder web application built with PHP, HTML5, CSS3, and JavaScript.

---

## 📁 Project Structure

```
resume_builder/
├── index.php            ← Main form (input all resume details)
├── save.php             ← Processes form, saves to PHP session
├── preview.php          ← Shows formatted resume preview
├── download.php         ← Print/save as PDF page
├── clear.php            ← Clears session data
│
├── css/
│   ├── style.css        ← Form/UI styles
│   └── resume.css       ← Resume paper styles (all 3 templates)
│
├── js/
│   └── form.js          ← Dynamic add/remove entries
│
└── templates/
    ├── sections.php     ← Shared resume sections (Classic + Minimal)
    └── sections_nosk.php← Sections for Modern (skills in sidebar)
```

---

## ⚙️ Setup & Run

### Requirements
- PHP 7.4 or higher
- A local server: XAMPP / WAMP / MAMP / Laragon / `php -S`

### Steps

**Option A – XAMPP/WAMP**
1. Copy `resume_builder/` folder to `htdocs/` (XAMPP) or `www/` (WAMP)
2. Start Apache
3. Open: `http://localhost/resume_builder/`

**Option B – PHP Built-in Server**
```bash
cd resume_builder
php -S localhost:8000
# Open http://localhost:8000
```

---

## ✨ Features

| Feature | Details |
|---|---|
| **3 Resume Templates** | Classic, Modern (sidebar), Minimal |
| **Dynamic Sections** | Add/remove Education, Experience, Projects |
| **Session Storage** | Data persists between pages using PHP sessions |
| **Live Preview** | See exactly how your resume looks |
| **Print to PDF** | Browser print → Save as PDF (no library needed) |
| **Input Validation** | Required fields enforced |
| **XSS Protection** | `htmlspecialchars()` on all outputs |
| **Responsive Design** | Works on mobile and desktop |

---

## 📄 Pages Explained

| File | Purpose |
|---|---|
| `index.php` | Main form with all sections |
| `save.php` | POST handler – sanitizes & saves to `$_SESSION['resume']` |
| `preview.php` | Renders resume using selected template |
| `download.php` | Clean print page – use browser's "Save as PDF" |
| `clear.php` | Destroys session, resets form |

---

## 🛠 Technologies Used

- **PHP 8+** – Server-side logic, session management, template rendering
- **HTML5** – Semantic markup
- **CSS3** – Custom properties, Grid, Flexbox, animations
- **JavaScript (Vanilla)** – Dynamic DOM manipulation
- **Google Fonts** – Playfair Display, DM Sans, Merriweather

---

## 👨‍💻 Developed For
Web Technology – Mini Project  
Department of Computer Engineering
