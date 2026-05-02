<?php
// Sections for Modern template (skills shown in sidebar, not here)
?>
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
      <?php if (!empty($edu['grade'])): ?> | <?= htmlspecialchars($edu['grade']) ?><?php endif; ?>
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
      <?php if (!empty($proj['tech'])): ?><span class="tech-badge"><?= htmlspecialchars($proj['tech']) ?></span><?php endif; ?>
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
