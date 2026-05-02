<?php
session_start();
$resume = isset($_SESSION['resume']) ? $_SESSION['resume'] : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ResumeForge – Build Your Resume</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <!-- Header -->
  <header class="site-header">
    <div class="logo">Resume<span>Forge</span></div>
    <nav>
      <a href="index.php" class="nav-link active">Build</a>
      <a href="preview.php" class="nav-link">Preview</a>
      <a href="download.php" class="nav-link btn-download-nav">Download PDF</a>
    </nav>
  </header>

  <!-- Hero -->
  <section class="hero">
    <div class="hero-text">
      <h1>Craft Your<br><em>Perfect Resume</em></h1>
      <p>Fill in the sections below. Preview and download your resume as a print-ready PDF.</p>
    </div>
    <div class="steps">
      <div class="step active"><span>1</span> Personal Info</div>
      <div class="step"><span>2</span> Education</div>
      <div class="step"><span>3</span> Experience</div>
      <div class="step"><span>4</span> Skills</div>
    </div>
  </section>

  <!-- Main Form -->
  <main class="form-container">
    <form action="save.php" method="POST" id="resumeForm">

      <!-- Personal Info -->
      <section class="form-section" id="sec-personal">
        <div class="section-header">
          <div class="section-icon">👤</div>
          <h2>Personal Information</h2>
        </div>
        <div class="grid-2">
          <div class="field">
            <label>Full Name *</label>
            <input type="text" name="full_name" placeholder="John Doe"
              value="<?= htmlspecialchars($resume['full_name'] ?? '') ?>" required>
          </div>
          <div class="field">
            <label>Job Title / Role *</label>
            <input type="text" name="job_title" placeholder="Software Engineer"
              value="<?= htmlspecialchars($resume['job_title'] ?? '') ?>" required>
          </div>
          <div class="field">
            <label>Email Address *</label>
            <input type="email" name="email" placeholder="john@example.com"
              value="<?= htmlspecialchars($resume['email'] ?? '') ?>" required>
          </div>
          <div class="field">
            <label>Phone Number</label>
            <input type="tel" name="phone" placeholder="+91 98765 43210"
              value="<?= htmlspecialchars($resume['phone'] ?? '') ?>">
          </div>
          <div class="field">
            <label>Location</label>
            <input type="text" name="location" placeholder="Pune, Maharashtra"
              value="<?= htmlspecialchars($resume['location'] ?? '') ?>">
          </div>
          <div class="field">
            <label>LinkedIn / Website</label>
            <input type="text" name="linkedin" placeholder="linkedin.com/in/johndoe"
              value="<?= htmlspecialchars($resume['linkedin'] ?? '') ?>">
          </div>
          <div class="field full-width">
            <label>Professional Summary</label>
            <textarea name="summary" rows="4" placeholder="A brief summary about your professional background and goals..."><?= htmlspecialchars($resume['summary'] ?? '') ?></textarea>
          </div>
        </div>
      </section>

      <!-- Education -->
      <section class="form-section" id="sec-education">
        <div class="section-header">
          <div class="section-icon">🎓</div>
          <h2>Education</h2>
        </div>
        <div id="education-list">
          <?php
          $educations = $resume['education'] ?? [['degree'=>'','institution'=>'','year_start'=>'','year_end'=>'','grade'=>'']];
          foreach ($educations as $i => $edu): ?>
          <div class="entry-block" id="edu-<?= $i ?>">
            <div class="entry-num"><?= $i + 1 ?></div>
            <div class="grid-2">
              <div class="field">
                <label>Degree / Qualification</label>
                <input type="text" name="education[<?= $i ?>][degree]" placeholder="B.E. Computer Engineering"
                  value="<?= htmlspecialchars($edu['degree'] ?? '') ?>">
              </div>
              <div class="field">
                <label>Institution / University</label>
                <input type="text" name="education[<?= $i ?>][institution]" placeholder="Pune University"
                  value="<?= htmlspecialchars($edu['institution'] ?? '') ?>">
              </div>
              <div class="field">
                <label>Start Year</label>
                <input type="number" name="education[<?= $i ?>][year_start]" placeholder="2019" min="1980" max="2030"
                  value="<?= htmlspecialchars($edu['year_start'] ?? '') ?>">
              </div>
              <div class="field">
                <label>End Year (or Expected)</label>
                <input type="text" name="education[<?= $i ?>][year_end]" placeholder="2023 / Present"
                  value="<?= htmlspecialchars($edu['year_end'] ?? '') ?>">
              </div>
              <div class="field">
                <label>Grade / CGPA / Percentage</label>
                <input type="text" name="education[<?= $i ?>][grade]" placeholder="8.5 CGPA / 85%"
                  value="<?= htmlspecialchars($edu['grade'] ?? '') ?>">
              </div>
            </div>
            <?php if ($i > 0): ?>
            <button type="button" class="btn-remove" onclick="removeBlock('edu-<?= $i ?>')">✕ Remove</button>
            <?php endif; ?>
          </div>
          <?php endforeach; ?>
        </div>
        <button type="button" class="btn-add" onclick="addEducation()">+ Add Education</button>
      </section>

      <!-- Experience -->
      <section class="form-section" id="sec-experience">
        <div class="section-header">
          <div class="section-icon">💼</div>
          <h2>Work Experience</h2>
        </div>
        <div id="experience-list">
          <?php
          $experiences = $resume['experience'] ?? [['role'=>'','company'=>'','start'=>'','end'=>'','description'=>'']];
          foreach ($experiences as $i => $exp): ?>
          <div class="entry-block" id="exp-<?= $i ?>">
            <div class="entry-num"><?= $i + 1 ?></div>
            <div class="grid-2">
              <div class="field">
                <label>Job Title / Role</label>
                <input type="text" name="experience[<?= $i ?>][role]" placeholder="Frontend Developer"
                  value="<?= htmlspecialchars($exp['role'] ?? '') ?>">
              </div>
              <div class="field">
                <label>Company / Organization</label>
                <input type="text" name="experience[<?= $i ?>][company]" placeholder="Tech Corp Pvt. Ltd."
                  value="<?= htmlspecialchars($exp['company'] ?? '') ?>">
              </div>
              <div class="field">
                <label>Start Date</label>
                <input type="text" name="experience[<?= $i ?>][start]" placeholder="June 2022"
                  value="<?= htmlspecialchars($exp['start'] ?? '') ?>">
              </div>
              <div class="field">
                <label>End Date</label>
                <input type="text" name="experience[<?= $i ?>][end]" placeholder="Present"
                  value="<?= htmlspecialchars($exp['end'] ?? '') ?>">
              </div>
              <div class="field full-width">
                <label>Key Responsibilities / Achievements</label>
                <textarea name="experience[<?= $i ?>][description]" rows="3"
                  placeholder="• Developed REST APIs using Laravel&#10;• Improved page load speed by 40%"><?= htmlspecialchars($exp['description'] ?? '') ?></textarea>
              </div>
            </div>
            <?php if ($i > 0): ?>
            <button type="button" class="btn-remove" onclick="removeBlock('exp-<?= $i ?>')">✕ Remove</button>
            <?php endif; ?>
          </div>
          <?php endforeach; ?>
        </div>
        <button type="button" class="btn-add" onclick="addExperience()">+ Add Experience</button>
      </section>

      <!-- Projects -->
      <section class="form-section" id="sec-projects">
        <div class="section-header">
          <div class="section-icon">🚀</div>
          <h2>Projects</h2>
        </div>
        <div id="project-list">
          <?php
          $projects = $resume['projects'] ?? [['title'=>'','tech'=>'','description'=>'']];
          foreach ($projects as $i => $proj): ?>
          <div class="entry-block" id="proj-<?= $i ?>">
            <div class="entry-num"><?= $i + 1 ?></div>
            <div class="grid-2">
              <div class="field">
                <label>Project Title</label>
                <input type="text" name="projects[<?= $i ?>][title]" placeholder="Resume Builder Website"
                  value="<?= htmlspecialchars($proj['title'] ?? '') ?>">
              </div>
              <div class="field">
                <label>Technologies Used</label>
                <input type="text" name="projects[<?= $i ?>][tech]" placeholder="PHP, MySQL, HTML, CSS"
                  value="<?= htmlspecialchars($proj['tech'] ?? '') ?>">
              </div>
              <div class="field full-width">
                <label>Description</label>
                <textarea name="projects[<?= $i ?>][description]" rows="3"
                  placeholder="A web-based application that allows users to create and download resumes..."><?= htmlspecialchars($proj['description'] ?? '') ?></textarea>
              </div>
            </div>
            <?php if ($i > 0): ?>
            <button type="button" class="btn-remove" onclick="removeBlock('proj-<?= $i ?>')">✕ Remove</button>
            <?php endif; ?>
          </div>
          <?php endforeach; ?>
        </div>
        <button type="button" class="btn-add" onclick="addProject()">+ Add Project</button>
      </section>

      <!-- Skills -->
      <section class="form-section" id="sec-skills">
        <div class="section-header">
          <div class="section-icon">⚡</div>
          <h2>Skills & Others</h2>
        </div>
        <div class="grid-2">
          <div class="field full-width">
            <label>Technical Skills</label>
            <input type="text" name="technical_skills"
              placeholder="PHP, MySQL, HTML, CSS, JavaScript, Bootstrap, Git"
              value="<?= htmlspecialchars($resume['technical_skills'] ?? '') ?>">
            <small>Comma separated</small>
          </div>
          <div class="field full-width">
            <label>Soft Skills</label>
            <input type="text" name="soft_skills"
              placeholder="Leadership, Communication, Problem Solving, Teamwork"
              value="<?= htmlspecialchars($resume['soft_skills'] ?? '') ?>">
          </div>
          <div class="field">
            <label>Languages Known</label>
            <input type="text" name="languages"
              placeholder="English, Hindi, Marathi"
              value="<?= htmlspecialchars($resume['languages'] ?? '') ?>">
          </div>
          <div class="field">
            <label>Hobbies / Interests</label>
            <input type="text" name="hobbies"
              placeholder="Open Source Contribution, Chess, Photography"
              value="<?= htmlspecialchars($resume['hobbies'] ?? '') ?>">
          </div>
          <div class="field full-width">
            <label>Certifications / Achievements</label>
            <textarea name="certifications" rows="3"
              placeholder="• AWS Certified Developer – 2024&#10;• Winner, State-Level Hackathon 2023"><?= htmlspecialchars($resume['certifications'] ?? '') ?></textarea>
          </div>
        </div>
      </section>

      <!-- Template Choice -->
      <section class="form-section">
        <div class="section-header">
          <div class="section-icon">🎨</div>
          <h2>Choose Template</h2>
        </div>
        <div class="template-grid">
          <label class="template-card <?= ($resume['template'] ?? 'classic') == 'classic' ? 'selected' : '' ?>">
            <input type="radio" name="template" value="classic" <?= ($resume['template'] ?? 'classic') == 'classic' ? 'checked' : '' ?>>
            <div class="tmpl-preview tmpl-classic">
              <div class="t-header"></div>
              <div class="t-lines"><span></span><span></span><span></span></div>
            </div>
            <span>Classic</span>
          </label>
          <label class="template-card <?= ($resume['template'] ?? '') == 'modern' ? 'selected' : '' ?>">
            <input type="radio" name="template" value="modern" <?= ($resume['template'] ?? '') == 'modern' ? 'checked' : '' ?>>
            <div class="tmpl-preview tmpl-modern">
              <div class="t-sidebar"></div>
              <div class="t-lines"><span></span><span></span><span></span></div>
            </div>
            <span>Modern</span>
          </label>
          <label class="template-card <?= ($resume['template'] ?? '') == 'minimal' ? 'selected' : '' ?>">
            <input type="radio" name="template" value="minimal" <?= ($resume['template'] ?? '') == 'minimal' ? 'checked' : '' ?>>
            <div class="tmpl-preview tmpl-minimal">
              <div class="t-topbar"></div>
              <div class="t-lines"><span></span><span></span><span></span></div>
            </div>
            <span>Minimal</span>
          </label>
        </div>
      </section>

      <div class="form-actions">
        <button type="submit" class="btn-primary">💾 Save & Preview Resume</button>
        <a href="clear.php" class="btn-secondary" onclick="return confirm('Clear all data?')">🗑 Clear All</a>
      </div>

    </form>
  </main>

  <footer class="site-footer">
    <p>ResumeForge &copy; <?= date('Y') ?> — PHP Mini Project | Web Technology</p>
  </footer>

  <script src="js/form.js"></script>
</body>
</html>
