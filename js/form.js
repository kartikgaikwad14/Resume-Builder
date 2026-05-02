// ResumeForge - Dynamic Form JS

// ---- Education ----
let eduCount = document.querySelectorAll('#education-list .entry-block').length;

function addEducation() {
  const i = eduCount++;
  const div = document.createElement('div');
  div.className = 'entry-block';
  div.id = 'edu-' + i;
  div.innerHTML = `
    <div class="entry-num">${i + 1}</div>
    <div class="grid-2">
      <div class="field">
        <label>Degree / Qualification</label>
        <input type="text" name="education[${i}][degree]" placeholder="B.E. Computer Engineering">
      </div>
      <div class="field">
        <label>Institution / University</label>
        <input type="text" name="education[${i}][institution]" placeholder="Pune University">
      </div>
      <div class="field">
        <label>Start Year</label>
        <input type="number" name="education[${i}][year_start]" placeholder="2019" min="1980" max="2030">
      </div>
      <div class="field">
        <label>End Year (or Expected)</label>
        <input type="text" name="education[${i}][year_end]" placeholder="2023 / Present">
      </div>
      <div class="field">
        <label>Grade / CGPA / Percentage</label>
        <input type="text" name="education[${i}][grade]" placeholder="8.5 CGPA / 85%">
      </div>
    </div>
    <button type="button" class="btn-remove" onclick="removeBlock('edu-${i}')">✕ Remove</button>
  `;
  document.getElementById('education-list').appendChild(div);
  div.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

// ---- Experience ----
let expCount = document.querySelectorAll('#experience-list .entry-block').length;

function addExperience() {
  const i = expCount++;
  const div = document.createElement('div');
  div.className = 'entry-block';
  div.id = 'exp-' + i;
  div.innerHTML = `
    <div class="entry-num">${i + 1}</div>
    <div class="grid-2">
      <div class="field">
        <label>Job Title / Role</label>
        <input type="text" name="experience[${i}][role]" placeholder="Frontend Developer">
      </div>
      <div class="field">
        <label>Company / Organization</label>
        <input type="text" name="experience[${i}][company]" placeholder="Tech Corp Pvt. Ltd.">
      </div>
      <div class="field">
        <label>Start Date</label>
        <input type="text" name="experience[${i}][start]" placeholder="June 2022">
      </div>
      <div class="field">
        <label>End Date</label>
        <input type="text" name="experience[${i}][end]" placeholder="Present">
      </div>
      <div class="field full-width">
        <label>Key Responsibilities / Achievements</label>
        <textarea name="experience[${i}][description]" rows="3" placeholder="• Developed REST APIs using Laravel\n• Improved performance by 40%"></textarea>
      </div>
    </div>
    <button type="button" class="btn-remove" onclick="removeBlock('exp-${i}')">✕ Remove</button>
  `;
  document.getElementById('experience-list').appendChild(div);
  div.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

// ---- Projects ----
let projCount = document.querySelectorAll('#project-list .entry-block').length;

function addProject() {
  const i = projCount++;
  const div = document.createElement('div');
  div.className = 'entry-block';
  div.id = 'proj-' + i;
  div.innerHTML = `
    <div class="entry-num">${i + 1}</div>
    <div class="grid-2">
      <div class="field">
        <label>Project Title</label>
        <input type="text" name="projects[${i}][title]" placeholder="Resume Builder Website">
      </div>
      <div class="field">
        <label>Technologies Used</label>
        <input type="text" name="projects[${i}][tech]" placeholder="PHP, MySQL, HTML, CSS">
      </div>
      <div class="field full-width">
        <label>Description</label>
        <textarea name="projects[${i}][description]" rows="3" placeholder="A web-based application that allows users to create and download resumes..."></textarea>
      </div>
    </div>
    <button type="button" class="btn-remove" onclick="removeBlock('proj-${i}')">✕ Remove</button>
  `;
  document.getElementById('project-list').appendChild(div);
  div.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

// ---- Remove Block ----
function removeBlock(id) {
  const el = document.getElementById(id);
  if (el) {
    el.style.transition = 'opacity .3s, transform .3s';
    el.style.opacity = '0';
    el.style.transform = 'translateX(-10px)';
    setTimeout(() => el.remove(), 300);
  }
}

// ---- Template Cards ----
document.querySelectorAll('.template-card').forEach(card => {
  card.querySelector('input[type="radio"]').addEventListener('change', () => {
    document.querySelectorAll('.template-card').forEach(c => c.classList.remove('selected'));
    card.classList.add('selected');
  });
});

// ---- Nav Step Progress (visual only) ----
const sections = ['sec-personal', 'sec-education', 'sec-experience', 'sec-skills'];
const steps    = document.querySelectorAll('.step');

function updateSteps() {
  let active = 0;
  sections.forEach((id, idx) => {
    const el = document.getElementById(id);
    if (el) {
      const rect = el.getBoundingClientRect();
      if (rect.top < window.innerHeight * 0.6) active = idx;
    }
  });
  steps.forEach((s, i) => s.classList.toggle('active', i === active));
}

window.addEventListener('scroll', updateSteps, { passive: true });
updateSteps();
