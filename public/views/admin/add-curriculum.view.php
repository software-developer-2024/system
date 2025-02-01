<?php

if (!isset($_SESSION['role'])) {
    header('location: /system');
    die();
}

if ($_SESSION['role'] != 'Admin') {
    header('location : /system/auth/logout.php');
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Curriculum</title>

    <link
      rel="icon"
      href="/system/public/img/Western_Mindanao_State_University.png"
      type="image/png"
    />
    <link rel="stylesheet" href="<?= css('style.css') ?>">
    <link rel="stylesheet" href="<?= css('add-curriculum.css') ?>" />
  </head>

  <body>
    <div class="container-addCurriculum">
      <div id="gobackContainer">
        <a
          href="/curriculums"
          id="goback"
          class="non-highlight"
        >
          < Go Back
        </a>
      </div>
      <div id="headerContent">
        <div class="input-group">
          <label for="cname">Curriculum Name:</label>
          <input type="text" id="cname" required />
        </div>
        <div class="input-group">
          <label for="cyear">Year Effective:</label>
          <input type="text" id="cyear" required />
        </div>
        <div class="input-group">
          <label for="ccoll">College:</label>
          <select id="ccoll" class="non-highlight" required>
            <option value="College of Engineering" selected>
              College of Engineering
            </option>
          </select>
        </div>
        <div class="input-group">
          <label for="cdept">Department:</label>
          <select id="cdept" class="non-highlight" required>
            <option value="BS Computer Engineering" selected>
              BS Computer Engineering
            </option>
          </select>
        </div>
      </div>
      <div id="mainContent">
        <div id="displayOldSubjects">
          <div id="searchContainer">
            <div id="searchInput">
              <input type="text" name="searchSubject" id="searchSubject" />
              <button type="button">X</button>
            </div>
            <button type="button" id="createSubject">CREATE</button>
          </div>
          <div id="resultContainer">
            <div id="listContainer">
              <ul>
              </ul>
            </div>
          </div>
          <div id="buttonContainer">
            <button type="button" id="addSemester">Add Semester</button>
            <button type="button" id="saveCurriculum">Save</button>
          </div>
        </div>
        <div id="displayNewSubjects">
          <div id="displayHeader">
            <div id="arrowHead">
              <button type="button" id="prevSemester"><</button>
              <button type="button" id="nextSemester">></button>
            </div>
            <div id="header"></div>
            <div id="selectHeader"><select id="selectSemester"></select></div>
          </div>
          <div id="displayContent">
            <div id="tableContent"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-modal hidden" id="modal">
      <div class="modal-container">
        <div id="add-subject-modal" hidden>
          <div class="modal-header">
            <h3>Create Subject Info</h3>
            <button type="button" id="close-add-subject-modal">X</button>
          </div>
          <div class="modal-content">
            <form>
              <div class="input-group flex-col">
                <label for="subjectCode">Subject Code:</label>
                <input type="text" id="subjectCode" required />
              </div>
              <div class="input-group flex-col">
                <label for="subjectDesc">Subject Description:</label>
                <input type="text" id="subjectDesc" required />
                <!-- <div class="note">Separate by comma (,) if multiple subjects</div> -->
              </div>
              <div class="input-group flex-col">
                <label for="subjectLec">Lec Units:</label>
                <input
                  type="number"
                  id="subjectLec"
                  oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null"
                  Required
                />
              </div>
              <div class="input-group flex-col">
                <label for="subjectLab">Lab Units:</label>
                <input
                  type="number"
                  id="subjectLab"
                  oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null"
                  Required
                />
              </div>
              <div class="input-group flex-col">
                <label for="subjectPreq">Pre-requisite:</label>
                <input
                  type="text"
                  id="subjectPreq"
                  placeholder="Separate by Comma (,)"
                />
                <div class="note">Leave Empty if Value is None</div>
              </div>
              <div class="input-group flex-col">
                <label for="subjectElec">Elective Name:</label>
                <input type="text" id="subjectElec" />
                <div class="note">Leave Empty if Value is None</div>
              </div>
              <input type="text" id="subjectIndex" hidden />

              <div class="modal-footer">
                <button type="button" class="text-nowrap" id="saveSubject">
                  Add Subject
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-modal hidden" id="curriculum-modal">
      <div class="modal-container">
        <div id="save-curriculum-modal" hidden>
          <div class="modal-header">
            <h3>Save Curriculum</h3>
            <button type="button" id="close-save-curriculum-modal">X</button>
          </div>
          <div class="modal-content">
            <form action="/action/add" method="post">
              <div id="curriculum-details">
                <div class="input-group flex-col">
                  <label for="curriculumName">Name:</label>
                  <input
                    type="text"
                    name="curriculumName"
                    id="curriculumName"
                    readonly
                    required
                  />
                  <div class="err"></div>
                </div>
                <div class="input-group flex-col">
                  <label for="curriculumYear">Year Effective:</label>
                  <input
                    type="text"
                    name="curriculumYear"
                    id="curriculumYear"
                    readonly
                    required
                  />
                  <div class="err"></div>
                </div>
                <div class="input-group flex-col">
                  <label for="curriculumCollege">College:</label>
                  <input
                    type="text"
                    name="curriculumCollege"
                    id="curriculumCollege"
                    readonly
                    required
                  />
                  <div class="err"></div>
                </div>
                <div class="input-group flex-col">
                  <label for="curriculumDept">Department:</label>
                  <input
                    type="text"
                    name="curriculumDept"
                    id="curriculumDept"
                    readonly
                    required
                  />
                  <div class="err"></div>
                </div>
              </div>

              <div id="curriculum-subjects">
                <div id="yearDivisor">
                </div>
              </div>

              <textarea name="subjectsJSON" id="subjectsJSON" hidden></textarea>
              <input type="submit" value="Add Curriculum" name="submit" id="save-submit" hidden>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="save-button">Save Curriculum</button>
          </div>
        </div>
      </div>
    </div>

    <script src="<?= js('add-curriculum.js') ?>"></script>

  </body>
</html>
