<?php
// Shared sections used by Classic and Minimal templates
// $r is available from parent (preview.php)
?>

<?php if (!empty($r['summary'])): ?>
<div class="res-section">
  <h3 class="res-section-title">Professional Summary</h3>
  <p class="res-summary"><?= htmlspecialchars($r['summary']) ?></p>
</div>
<?php endif; ?>

<?php if (!empty($r['experience'])): ?>
<div class="res-section">
  <h3 class="res-section-title">Work Experience</h3>
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

<?php if (!empty($r['technical_skills']) || !empty($r['soft_skills'])): ?>
<div class="res-section">
  <h3 class="res-section-title">Skills</h3>
  <?php if (!empty($r['technical_skills'])): ?>
  <div class="skills-row">
    <span class="skill-label">Technical:</span>
    <div class="skill-tags">
      <?php foreach (skillList($r['technical_skills']) as $skill): ?>
      <span><?= htmlspecialchars($skill) ?></span>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endif; ?>
  <?php if (!empty($r['soft_skills'])): ?>
  <div class="skills-row">
    <span class="skill-label">Soft Skills:</span>
    <div class="skill-tags soft">
      <?php foreach (skillList($r['soft_skills']) as $skill): ?>
      <span><?= htmlspecialchars($skill) ?></span>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endif; ?>
</div>
<?php endif; ?>

<?php if (!empty($r['certifications'])): ?>
<div class="res-section">
  <h3 class="res-section-title">Certifications & Achievements</h3>
  <div class="entry-desc"><?= safeNl2br($r['certifications']) ?></div>
</div>
<?php endif; ?>

<?php if (!empty($r['languages']) || !empty($r['hobbies'])): ?>
<div class="res-section">
  <h3 class="res-section-title">Additional Information</h3>
  <div class="info-grid">
    <?php if (!empty($r['languages'])): ?>
    <div><strong>Languages:</strong> <?= htmlspecialchars($r['languages']) ?></div>
    <?php endif; ?>
    <?php if (!empty($r['hobbies'])): ?>
    <div><strong>Hobbies:</strong> <?= htmlspecialchars($r['hobbies']) ?></div>
    <?php endif; ?>
  </div>
</div>
<?php endif; ?>
