<?php
session_start();

if (empty($_SESSION['resume'])) {
    header('Location: index.php');
    exit;
}

$r = $_SESSION['resume'];
$template = $r['template'] ?? 'classic';
$success  = $_SESSION['success'] ?? '';
unset($_SESSION['success']);

// Helper: split comma-separated skills into array
function skillList($str) {
    return array_filter(array_map('trim', explode(',', $str)));
}

// Helper: nl2br with XSS protection
function safeNl2br($text) {
    return nl2br(htmlspecialchars($text));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ResumeForge – Preview</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500&family=Merriweather:wght@400;700&family=Source+Sans+3:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/resume.css">
</head>
<body class="preview-page">

  <!-- Top Bar -->
  <div class="preview-topbar no-print">
    <a href="index.php" class="btn-secondary">← Edit Resume</a>
    <?php if ($success): ?>
    <div class="alert-success">✅ <?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    <div class="preview-actions">
      <button onclick="window.print()" class="btn-primary">🖨 Print / Save PDF</button>
      <a href="download.php" class="btn-download">⬇ Download PDF</a>
    </div>
  </div>

  <!-- Resume Preview Paper -->
  <div class="resume-wrapper">
    <div class="resume-paper resume-<?= htmlspecialchars($template) ?>">

      <?php if ($template === 'modern'): ?>
      <!-- ============ MODERN TEMPLATE (Sidebar) ============ -->
      <div class="mod-sidebar">
        <div class="mod-name"><?= htmlspecialchars($r['full_name'] ?? 'Your Name') ?></div>
        <div class="mod-title"><?= htmlspecialchars($r['job_title'] ?? '') ?></div>
        <div class="mod-contact">
          <?php if (!empty($r['email'])): ?>
          <div>📧 <?= htmlspecialchars($r['email']) ?></div>
          <?php endif; ?>
          <?php if (!empty($r['phone'])): ?>
          <div>📞 <?= htmlspecialchars($r['phone']) ?></div>
          <?php endif; ?>
          <?php if (!empty($r['location'])): ?>
          <div>📍 <?= htmlspecialchars($r['location']) ?></div>
          <?php endif; ?>
          <?php if (!empty($r['linkedin'])): ?>
          <div>🔗 <?= htmlspecialchars($r['linkedin']) ?></div>
          <?php endif; ?>
        </div>

        <?php if (!empty($r['technical_skills'])): ?>
        <div class="mod-sec-title">Technical Skills</div>
        <div class="skill-tags">
          <?php foreach (skillList($r['technical_skills']) as $skill): ?>
          <span><?= htmlspecialchars($skill) ?></span>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($r['soft_skills'])): ?>
        <div class="mod-sec-title">Soft Skills</div>
        <div class="skill-tags soft">
          <?php foreach (skillList($r['soft_skills']) as $skill): ?>
          <span><?= htmlspecialchars($skill) ?></span>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($r['languages'])): ?>
        <div class="mod-sec-title">Languages</div>
        <p><?= htmlspecialchars($r['languages']) ?></p>
        <?php endif; ?>

        <?php if (!empty($r['hobbies'])): ?>
        <div class="mod-sec-title">Interests</div>
        <p><?= htmlspecialchars($r['hobbies']) ?></p>
        <?php endif; ?>
      </div>

      <div class="mod-main">
        <?php if (!empty($r['summary'])): ?>
        <div class="res-section">
          <h3 class="res-section-title">Profile</h3>
          <p class="res-summary"><?= htmlspecialchars($r['summary']) ?></p>
        </div>
        <?php endif; ?>

        <?php if (!empty($r['experience'])): ?>
        <div class="res-section">
          <h3 class="res-section-title">Experience</h3>
          <?php foreach ($r['experience'] as $exp): ?>
          <div class="entry">
            <div class="entry-header">
              <strong><?= htmlspecialchars($exp['role'] ?? '') ?></strong>
              <span class="entry-date"><?= htmlspecialchars($exp['start'] ?? '') ?> – <?= htmlspecialchars($exp['end'] ?? '') ?></span>
            </div>
            <div class="entry-sub"><?= htmlspecialchars($exp['company'] ?? '') ?></div>
            <?php if (!empty($exp['description'])): ?>
            <div class="entry-desc"><?= safeNl2br($exp['description']) ?></div>
            <?php endif; ?>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($r['education'])): ?>
        <div class="res-section">
          <h3 class="res-section-title">Education</h3>
          <?php foreach ($r['education'] as $edu): ?>
          <div class="entry">
            <div class="entry-header">
              <strong><?= htmlspecialchars($edu['degree'] ?? '') ?></strong>
              <span class="entry-date"><?= htmlspecialchars($edu['year_start'] ?? '') ?> – <?= htmlspecialchars($edu['year_end'] ?? '') ?></span>
            </div>
            <div class="entry-sub"><?= htmlspecialchars($edu['institution'] ?? '') ?>
              <?php if (!empty($edu['grade'])): ?> &nbsp;|&nbsp; <?= htmlspecialchars($edu['grade']) ?><?php endif; ?>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($r['projects'])): ?>
        <div class="res-section">
          <h3 class="res-section-title">Projects</h3>
          <?php foreach ($r['projects'] as $proj): ?>
          <div class="entry">
            <div class="entry-header">
              <strong><?= htmlspecialchars($proj['title'] ?? '') ?></strong>
              <?php if (!empty($proj['tech'])): ?>
              <span class="tech-badge"><?= htmlspecialchars($proj['tech']) ?></span>
              <?php endif; ?>
            </div>
            <?php if (!empty($proj['description'])): ?>
            <div class="entry-desc"><?= safeNl2br($proj['description']) ?></div>
            <?php endif; ?>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($r['certifications'])): ?>
        <div class="res-section">
          <h3 class="res-section-title">Certifications & Achievements</h3>
          <div class="entry-desc"><?= safeNl2br($r['certifications']) ?></div>
        </div>
        <?php endif; ?>
      </div>

      <?php elseif ($template === 'minimal'): ?>
      <!-- ============ MINIMAL TEMPLATE ============ -->
      <div class="min-header">
        <div class="min-name"><?= htmlspecialchars($r['full_name'] ?? 'Your Name') ?></div>
        <div class="min-title"><?= htmlspecialchars($r['job_title'] ?? '') ?></div>
        <div class="min-contact">
          <?php if (!empty($r['email'])): ?><span><?= htmlspecialchars($r['email']) ?></span><?php endif; ?>
          <?php if (!empty($r['phone'])): ?><span><?= htmlspecialchars($r['phone']) ?></span><?php endif; ?>
          <?php if (!empty($r['location'])): ?><span><?= htmlspecialchars($r['location']) ?></span><?php endif; ?>
          <?php if (!empty($r['linkedin'])): ?><span><?= htmlspecialchars($r['linkedin']) ?></span><?php endif; ?>
        </div>
      </div>

      <div class="min-body">
        <?php include 'templates/sections.php'; ?>
      </div>

      <?php else: ?>
      <!-- ============ CLASSIC TEMPLATE (Default) ============ -->
      <div class="cls-header">
        <h1 class="cls-name"><?= htmlspecialchars($r['full_name'] ?? 'Your Name') ?></h1>
        <div class="cls-title"><?= htmlspecialchars($r['job_title'] ?? '') ?></div>
        <div class="cls-contact">
          <?php if (!empty($r['email'])): ?><span>✉ <?= htmlspecialchars($r['email']) ?></span><?php endif; ?>
          <?php if (!empty($r['phone'])): ?><span>☎ <?= htmlspecialchars($r['phone']) ?></span><?php endif; ?>
          <?php if (!empty($r['location'])): ?><span>⌖ <?= htmlspecialchars($r['location']) ?></span><?php endif; ?>
          <?php if (!empty($r['linkedin'])): ?><span>🔗 <?= htmlspecialchars($r['linkedin']) ?></span><?php endif; ?>
        </div>
      </div>

      <div class="cls-body">
        <?php include 'templates/sections.php'; ?>
      </div>
      <?php endif; ?>

    </div>
  </div>

</body>
</html>
