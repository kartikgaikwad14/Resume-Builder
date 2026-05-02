<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and store all form data in session
    $resume = [];

    // Personal Info
    $resume['full_name']       = trim($_POST['full_name'] ?? '');
    $resume['job_title']       = trim($_POST['job_title'] ?? '');
    $resume['email']           = trim($_POST['email'] ?? '');
    $resume['phone']           = trim($_POST['phone'] ?? '');
    $resume['location']        = trim($_POST['location'] ?? '');
    $resume['linkedin']        = trim($_POST['linkedin'] ?? '');
    $resume['summary']         = trim($_POST['summary'] ?? '');

    // Education (array)
    $resume['education'] = [];
    if (!empty($_POST['education']) && is_array($_POST['education'])) {
        foreach ($_POST['education'] as $edu) {
            if (!empty(array_filter($edu))) {
                $resume['education'][] = array_map('trim', $edu);
            }
        }
    }

    // Experience (array)
    $resume['experience'] = [];
    if (!empty($_POST['experience']) && is_array($_POST['experience'])) {
        foreach ($_POST['experience'] as $exp) {
            if (!empty(array_filter($exp))) {
                $resume['experience'][] = array_map('trim', $exp);
            }
        }
    }

    // Projects (array)
    $resume['projects'] = [];
    if (!empty($_POST['projects']) && is_array($_POST['projects'])) {
        foreach ($_POST['projects'] as $proj) {
            if (!empty(array_filter($proj))) {
                $resume['projects'][] = array_map('trim', $proj);
            }
        }
    }

    // Skills & Others
    $resume['technical_skills'] = trim($_POST['technical_skills'] ?? '');
    $resume['soft_skills']      = trim($_POST['soft_skills'] ?? '');
    $resume['languages']        = trim($_POST['languages'] ?? '');
    $resume['hobbies']          = trim($_POST['hobbies'] ?? '');
    $resume['certifications']   = trim($_POST['certifications'] ?? '');

    // Template
    $allowed_templates = ['classic', 'modern', 'minimal'];
    $resume['template'] = in_array($_POST['template'] ?? '', $allowed_templates)
        ? $_POST['template']
        : 'classic';

    $_SESSION['resume'] = $resume;
    $_SESSION['success'] = 'Resume saved successfully!';

    header('Location: preview.php');
    exit;
}

header('Location: index.php');
exit;
