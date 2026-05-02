<?php
session_start();

if (empty($_SESSION['resume'])) {
    header('Location: index.php');
    exit;
}

$r = $_SESSION['resume'];
$template = $r['template'] ?? 'classic';

function skillList($str) {
    return array_filter(array_map('trim', explode(',', $str)));
}
function safeNl2br($text) {
    return nl2br(htmlspecialchars($text));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($r['full_name'] ?? 'Resume') ?> – Resume</title>
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Source+Sans+3:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/resume.css">
  <style>
    body { margin: 0; background: #fff; }
    .no-print { display: none; }
    @media screen {
      body { background: #f0f0f0; padding: 30px; }
      .no-print { display: flex; }
    }
  </style>
</head>
<body>
  <div class="no-print" style="justify-content:space-between;align-items:center;max-width:850px;margin:0 auto 16px;gap:12px;flex-wrap:wrap">
    <a href="preview.php" style="color:#333;text-decoration:none;font-family:sans-serif;font-size:14px;">← Back to Preview</a>
    <button onclick="window.print()" style="background:#1a1a2e;color:#fff;border:none;padding:10px 24px;border-radius:6px;cursor:pointer;font-size:14px;font-family:sans-serif">
      🖨 Print / Save as PDF
    </button>
  </div>

  <div class="resume-wrapper">
    <div class="resume-paper resume-<?= htmlspecialchars($template) ?>">

      <?php if ($template === 'modern'): ?>
      <div class="mod-sidebar">
        <div class="mod-name"><?= htmlspecialchars($r['full_name'] ?? '') ?></div>
        <div class="mod-title"><?= htmlspecialchars($r['job_title'] ?? '') ?></div>
        <div class="mod-contact">
          <?php if (!empty($r['email'])): ?><div>📧 <?= htmlspecialchars($r['email']) ?></div><?php endif; ?>
          <?php if (!empty($r['phone'])): ?><div>📞 <?= htmlspecialchars($r['phone']) ?></div><?php endif; ?>
          <?php if (!empty($r['location'])): ?><div>📍 <?= htmlspecialchars($r['location']) ?></div><?php endif; ?>
          <?php if (!empty($r['linkedin'])): ?><div>🔗 <?= htmlspecialchars($r['linkedin']) ?></div><?php endif; ?>
        </div>
        <?php if (!empty($r['technical_skills'])): ?>
        <div class="mod-sec-title">Technical Skills</div>
        <div class="skill-tags">
          <?php foreach (skillList($r['technical_skills']) as $s): ?><span><?= htmlspecialchars($s) ?></span><?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php if (!empty($r['soft_skills'])): ?>
        <div class="mod-sec-title">Soft Skills</div>
        <div class="skill-tags soft">
          <?php foreach (skillList($r['soft_skills']) as $s): ?><span><?= htmlspecialchars($s) ?></span><?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php if (!empty($r['languages'])): ?><div class="mod-sec-title">Languages</div><p><?= htmlspecialchars($r['languages']) ?></p><?php endif; ?>
        <?php if (!empty($r['hobbies'])): ?><div class="mod-sec-title">Interests</div><p><?= htmlspecialchars($r['hobbies']) ?></p><?php endif; ?>
      </div>
      <div class="mod-main"><?php include 'templates/sections_nosk.php'; ?></div>

      <?php elseif ($template === 'minimal'): ?>
      <div class="min-header">
        <div class="min-name"><?= htmlspecialchars($r['full_name'] ?? '') ?></div>
        <div class="min-title"><?= htmlspecialchars($r['job_title'] ?? '') ?></div>
        <div class="min-contact">
          <?php if (!empty($r['email'])): ?><span><?= htmlspecialchars($r['email']) ?></span><?php endif; ?>
          <?php if (!empty($r['phone'])): ?><span><?= htmlspecialchars($r['phone']) ?></span><?php endif; ?>
          <?php if (!empty($r['location'])): ?><span><?= htmlspecialchars($r['location']) ?></span><?php endif; ?>
          <?php if (!empty($r['linkedin'])): ?><span><?= htmlspecialchars($r['linkedin']) ?></span><?php endif; ?>
        </div>
      </div>
      <div class="min-body"><?php include 'templates/sections.php'; ?></div>

      <?php else: ?>
      <div class="cls-header">
        <h1 class="cls-name"><?= htmlspecialchars($r['full_name'] ?? '') ?></h1>
        <div class="cls-title"><?= htmlspecialchars($r['job_title'] ?? '') ?></div>
        <div class="cls-contact">
          <?php if (!empty($r['email'])): ?><span>✉ <?= htmlspecialchars($r['email']) ?></span><?php endif; ?>
          <?php if (!empty($r['phone'])): ?><span>☎ <?= htmlspecialchars($r['phone']) ?></span><?php endif; ?>
          <?php if (!empty($r['location'])): ?><span>⌖ <?= htmlspecialchars($r['location']) ?></span><?php endif; ?>
          <?php if (!empty($r['linkedin'])): ?><span>🔗 <?= htmlspecialchars($r['linkedin']) ?></span><?php endif; ?>
        </div>
      </div>
      <div class="cls-body"><?php include 'templates/sections.php'; ?></div>
      <?php endif; ?>

    </div>
  </div>
</body>
</html>
