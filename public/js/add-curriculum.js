// Global Variable <-- STARTS HERE -->
let SUBJECTS = [];
let SEMESTERS = ["1st Semester", "2nd Semester", "Summer"];
let YEARS = ["1st Year"];
let SEMESTERFLAG = [];

let SEMESTER = 0;
let YEAR = -1;
let YEARDELAY = 3;
let FLAG = 0;
let FLAGGING = 0;
let CURRENTSEMESTER = null;
let CURRENTTABLE = null;

function elementFromHtml(html) {
  const template = document.createElement("template");

  template.innerHTML = html.trim();

  return template.content.firstElementChild;
}

function check_if_table_empty(table) {
  const currentTable = document.getElementById(table);

  if (currentTable.querySelector("tbody").childElementCount != 0) {
    if (document.querySelector(`#${table} tfoot`) != null) {
      document.querySelector(`#${table} tfoot`).remove();
    }
    return;
  }

  let tfoot = elementFromHtml(
    `<tfoot><tr><td colspan="7">Leave EMPTY if no subject for this Semester</td></tr></tfoot>`
  );
  currentTable.appendChild(tfoot);
}

// Global Variable <-- ENDS HERE -->

// Functions to Add New Semester <-- STARTS HERE -->

function addSemesterToNewCurriculum() {
  let selectSemester = document.getElementById("selectSemester");
  let tableContent = document.getElementById("tableContent");

  function pushingSemester() {
    function namingSemester() {
      SEMESTER = SEMESTER % 3;

      if (SEMESTER == 0) {
        let year = "";

        let THISYEAR = (YEAR + YEARDELAY).toString();
        switch (Number(THISYEAR[THISYEAR.length - 1])) {
          case 1:
            year = Number(THISYEAR) + "st Year";
            break;

          case 2:
            year = Number(THISYEAR) + "nd Year";
            break;

          case 3:
            year = Number(THISYEAR) + "rd Year";
            break;

          default:
            year = Number(THISYEAR) + "th Year";
            break;
        }

        YEARS.push(year);
        YEAR++;
      }

      SEMESTERFLAG.push(`${YEARS[YEAR]} - ${SEMESTERS[SEMESTER]}`);
      SEMESTER++;

      FLAG = SEMESTERFLAG.length;
      FLAGGING = FLAG - 1;
    }

    namingSemester();

    let optionSemester = elementFromHtml(`
        <option value="${FLAGGING}">${SEMESTERFLAG[FLAGGING]}</option>
        `);

    selectSemester.appendChild(optionSemester);

    let displayTable = elementFromHtml(`
      <table id="table${FLAGGING}">
          <thead>
              <tr>
                  <th rowspan="2" width="10%">Code</th>
                  <th rowspan="2" width="50%">Description</th>
                  <th colspan="3" width="10%">Units</th>
                  <th rowspan="2" width="20%">Pre-requisite</th>
                  <th rowspan="2" width="10%"></th>
              </tr>
              <tr>
                  <th>Lec</th>
                  <th>Lab</th>
                  <th>Total</th>
              </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
      `);
    tableContent.appendChild(displayTable);

    moveSemester();
  }

  function moveSemester(index = FLAGGING) {
    function pagingSemester(index) {
      document.querySelectorAll("#selectSemester option").forEach((option) => {
        option.removeAttribute("selected");
      });

      let header = document.getElementById("header");
      header.innerText = SEMESTERFLAG[index];
      selectSemester.children[index].setAttribute("selected", "");
    }

    FLAGGING = index;

    index == 0
      ? prev.setAttribute("disabled", "")
      : prev.removeAttribute("disabled");

    index == SEMESTERFLAG.length - 1
      ? next.setAttribute("disabled", "")
      : next.removeAttribute("disabled");

    pagingSemester(FLAGGING);

    document.querySelectorAll("#displayContent table").forEach((table) => {
      table.setAttribute("hidden", "");
      if (table.getAttribute("id") == `table${FLAGGING}`) {
        table.removeAttribute("hidden");
        CURRENTSEMESTER = SEMESTERFLAG[FLAGGING];
        CURRENTTABLE = table.getAttribute("id");
      }
    });
  }

  selectSemester.onchange = () => {
    moveSemester(Number(selectSemester.value));
  };

  let next = document.getElementById("nextSemester");
  let prev = document.getElementById("prevSemester");

  next.onclick = () => {
    moveSemester(FLAGGING + 1);
  };
  prev.onclick = () => {
    moveSemester(FLAGGING - 1);
  };
  pushingSemester();
  check_if_table_empty(CURRENTTABLE);
}

addSemesterToNewCurriculum();

document.getElementById("addSemester").onclick = () => {
  addSemesterToNewCurriculum();
};

// Functions to Add New Semester <-- ENDS HERE -->

// Functions to Add Subject <-- STARTS HERE -->

function openAddSubjectModal(
  currentTable = "",
  currentSemester = "",
  code = "",
  desc = "",
  lec = "",
  lab = "",
  preq = "",
  elec = "",
  subjectIndex = "",
  tableIndex = ""
) {
  function insertToSubjectJSON(
    year = "",
    semester = "",
    code = "",
    desc = "",
    lec = "",
    lab = "",
    preq = "None",
    elec = "",
    subjectIndex = ""
  ) {
    let unit = Number(lec) + Number(lab);
    preq = preq == "" ? "None" : preq;
    elec = elec == "" ? null : elec;
    subjectIndex = subjectIndex == "" ? null : subjectIndex;
    tableIndex = tableIndex == "" ? null : tableIndex;
    let subjectJSON = {
      subjectYear: year,
      subjectSemester: semester,
      subjectCode: code,
      subjectDesc: desc,
      subjectLec: Number(lec),
      subjectLab: Number(lab),
      subjectUnit: unit,
      subjectPreq: preq,
      subjectElec: elec,
    };

    if (subjectIndex != null) {
      SUBJECTS[subjectIndex] = subjectJSON;
    } else {
      SUBJECTS.push(subjectJSON);
    }
  }

  function insertToDisplayTable(
    table = "",
    code = "",
    desc = "",
    lec = "",
    lab = "",
    preq = "None",
    elec = "",
    subjectIndex = null,
    tableIndex = null
  ) {
    let unit = Number(lec) + Number(lab);
    preq = preq == "" ? "None" : preq;
    elec = elec == "" ? null : elec;
    subjectIndex = subjectIndex == "" ? null : subjectIndex;
    tableIndex = tableIndex == "" ? null : tableIndex;

    let newSubject = elementFromHtml(`
      <tr>
        <td>${code}</td>
        <td class="text-left">${desc}</td>
        <td>${Number(lec)}</td>
        <td>${Number(lab)}</td>
        <td>${Number(unit)}</td>
        <td>${preq}</td>
        <td>
            <div id="action">
                <button type="button" id="editSubject">Edit</button>
                <button type="button" id="removeSubject">X</button>
                <input type="number" id="index" value="${
                  subjectIndex == null ? SUBJECTS.length : subjectIndex
                }" hidden>
            </div>
        </td>
      </tr>
    `);

    const currentTable = document.getElementById(table);

    if (tableIndex == null) {
      currentTable.querySelector("tbody").appendChild(newSubject);
    } else {
      currentTable
        .querySelector("tbody")
        .children[tableIndex].insertAdjacentElement("afterend", newSubject);
      currentTable.querySelector("tbody").children[tableIndex].remove();
    }

    if (document.querySelector(`#${table} tfoot`) != null) {
      document.querySelector(`#${table} tfoot`).remove();
    }

    let action = newSubject.children[6].children["action"];
    action.children["removeSubject"].onclick = () => {
      const index = action.children["index"].value;
      SUBJECTS[index] = "REMOVED";
      newSubject.remove();

      check_if_table_empty(table);
    };

    action.children["editSubject"].onclick = (event) => {
      const subjectIndex = action.children["index"].value;
      const tableIndex = event.target.parentNode.parentNode.parentNode.rowIndex;

      let newCode = SUBJECTS[subjectIndex]["subjectCode"];
      let newDesc = SUBJECTS[subjectIndex]["subjectDesc"];
      let newLec = SUBJECTS[subjectIndex]["subjectLec"];
      let newLab = SUBJECTS[subjectIndex]["subjectLab"];
      let newPreq = SUBJECTS[subjectIndex]["subjectPreq"];
      let newElec = SUBJECTS[subjectIndex]["subjectElec"];

      openAddSubjectModal(
        CURRENTTABLE,
        CURRENTSEMESTER,
        newCode,
        newDesc,
        newLec,
        newLab,
        newPreq,
        newElec,
        subjectIndex,
        tableIndex - 2
      );
    };
  }

  // Setting up the modal <-- STARTS HERE -->
  const modal = document.getElementById("modal");
  const add_subject_modal = document.getElementById("add-subject-modal");
  const close_modal = document.getElementById("close-add-subject-modal");

  modal.classList.replace("hidden", "flex");
  add_subject_modal.removeAttribute("hidden");

  close_modal.onclick = () => {
    modal.classList.replace("flex", "hidden");
    add_subject_modal.setAttribute("hidden", "");
  };

  // Setting up the modal <-- ENDS HERE -->

  // Inserting the subject into the modal <-- STARTS HERE -->

  document.getElementById("subjectCode").value = code;
  document.getElementById("subjectDesc").value = desc;
  document.getElementById("subjectLec").value = lec;
  document.getElementById("subjectLab").value = lab;
  document.getElementById("subjectPreq").value = preq;
  document.getElementById("subjectElec").value = elec;
  document.getElementById("subjectIndex").value = tableIndex;

  const semesterSeparator = currentSemester.split(" - ");

  // Inserting the subject into the modal <-- ENDS HERE -->

  // Adding the subject to the new curriculum display <-- STARTS HERE -->

  document.getElementById("saveSubject").onclick = () => {
    close_modal.click();

    insertToDisplayTable(
      currentTable,
      document.getElementById("subjectCode").value.trim(),
      document.getElementById("subjectDesc").value.trim(),
      document.getElementById("subjectLec").value.trim(),
      document.getElementById("subjectLab").value.trim(),
      document.getElementById("subjectPreq").value.trim(),
      document.getElementById("subjectElec").value.trim(),
      subjectIndex,
      document.getElementById("subjectIndex").value.trim()
    );

    insertToSubjectJSON(
      semesterSeparator[0],
      semesterSeparator[1],
      document.getElementById("subjectCode").value.trim(),
      document.getElementById("subjectDesc").value.trim(),
      document.getElementById("subjectLec").value.trim(),
      document.getElementById("subjectLab").value.trim(),
      document.getElementById("subjectPreq").value.trim(),
      document.getElementById("subjectElec").value.trim(),
      subjectIndex
    );
  };

  // Adding the subject to the new curriculum display <-- ENDS HERE -->
}

const createSubject = document.getElementById("createSubject");

createSubject.onclick = () => {
  openAddSubjectModal(CURRENTTABLE, CURRENTSEMESTER);
};

// Functions to Add Subject <-- ENDS HERE -->

// Functions to Save Curriculum <-- STARTS HERE -->

const saveCurriculum = document.getElementById("saveCurriculum");

saveCurriculum.onclick = () => {
  const modal = document.getElementById("curriculum-modal");
  const add_subject_modal = document.getElementById("save-curriculum-modal");
  const close_modal = document.getElementById("close-save-curriculum-modal");

  // const contentDivisor = document.getElementById("contentDivisor");

  let yearsArray = [];

  SUBJECTS.forEach(function callback(subject, index) {
    if (!yearsArray.includes(subject.subjectYear)) {
      yearsArray.push(subject.subjectYear);
    }
  });

  let electivesArray = [];

  SUBJECTS.forEach(function callback(subject, index) {
    if (!electivesArray.includes(subject.subjectElec)) {
      electivesArray.push(subject.subjectElec);
    }
  });

  let semesterArray = ["1st Semester", "2nd Semester", "Summer"];

  let yearDivisor = document.getElementById("yearDivisor");
  yearDivisor.innerHTML = "";

  yearsArray.forEach((year) => {
    if (!(year == "" || year == null)) {
      let headerDivisor = elementFromHtml(`
      <div id="headerDivisor">${year}</div>
      `);
      yearDivisor.appendChild(headerDivisor);

      let contentDivisor = elementFromHtml(`
        <div id="contentDivisor"></div>
      `);
      yearDivisor.appendChild(contentDivisor);

      semesterArray.forEach((semester) => {
        let subjectCount = 0;
        let table = elementFromHtml(`
        <table>
          <caption>
            ${year} - ${semester}
          </caption>
          <tr>
            <th width="10%">Code</th>
            <th width="50%">Description</th>
            <th width="5%">Lec</th>
            <th width="5%">Lab</th>
            <th width="5%">Total</th>
            <th width="25%">Pre-requisite</th>
          </tr>
        </table>
        `);

        SUBJECTS.forEach((subject) => {
          if (
            subject.subjectYear == year &&
            subject.subjectSemester == semester
          ) {
            subjectCount++;
            let tr = elementFromHtml(`
              <tr>
                <td>${subject.subjectCode}</td>
                <td>${subject.subjectDesc}</td>
                <td>${subject.subjectLec}</td>
                <td>${subject.subjectLab}</td>
                <td>${subject.subjectUnit}</td>
                <td>${subject.subjectPreq}</td>
              </tr>
            `);

            table.appendChild(tr);
          }
        });

        if (subjectCount > 0) {
          contentDivisor.append(table);
        }
      });
    }
  });

  if (electivesArray.length > 1) {
    let headerDivisor = elementFromHtml(`
      <div id="headerDivisor">ELECTIVES</div>
      `);
    yearDivisor.appendChild(headerDivisor);

    let contentDivisor = elementFromHtml(`
        <div id="contentDivisor"></div>
      `);
    yearDivisor.appendChild(contentDivisor);

    electivesArray.forEach((elective) => {
      if (elective == "" || elective == "null") {
        let subjectCount = 0;
        let table = elementFromHtml(`
        <table>
          <caption>
            ${elective}
          </caption>
          <tr>
            <th width="10%">Code</th>
            <th width="50%">Description</th>
            <th width="5%">Lec</th>
            <th width="5%">Lab</th>
            <th width="5%">Total</th>
            <th width="25%">Pre-requisite</th>
          </tr>
        </table>
        `);

        SUBJECTS.forEach((subject) => {
          if (subject.subjectElec == elective) {
            subjectCount++;
            let tr = elementFromHtml(`
              <tr>
                <td>${subject.subjectCode}</td>
                <td>${subject.subjectDesc}</td>
                <td>${subject.subjectLec}</td>
                <td>${subject.subjectLab}</td>
                <td>${subject.subjectUnit}</td>
                <td>${subject.subjectPreq}</td>
              </tr>
            `);

            table.appendChild(tr);
          }
        });

        if (subjectCount > 0) {
          contentDivisor.append(table);
        }
      }
    });
  }

  const name = document.getElementById("cname").value;
  const year = document.getElementById("cyear").value;
  const coll = document.getElementById("ccoll").value;
  const dept = document.getElementById("cdept").value;

  document.getElementById("curriculumName").value = name;
  document.getElementById("curriculumYear").value = year;
  document.getElementById("curriculumCollege").value = coll;
  document.getElementById("curriculumDept").value = dept;

  modal.classList.replace("hidden", "flex");
  add_subject_modal.removeAttribute("hidden");

  let saveButton = document.getElementById("save-button");
  let subjectsJSON = document.getElementById("subjectsJSON");
  let saveSubmit = document.getElementById("save-submit");

  saveButton.onclick = () => {
    function filterRemove(subject) {
      return subject != "REMOVED";
    }
    let UPDATEDSUBJECTS = SUBJECTS.filter(filterRemove);
    UPDATEDSUBJECTS = JSON.stringify(UPDATEDSUBJECTS);
    subjectsJSON.innerText = UPDATEDSUBJECTS;

    saveSubmit.click();
  };

  close_modal.onclick = () => {
    modal.classList.replace("flex", "hidden");
    add_subject_modal.setAttribute("hidden", "");
  };
};

// Functions to Save Curriculum <-- ENDS HERE -->

// Functions to List Old Subjects <-- STARTS HERE -->
function listOldSubjects(query = "") {
  let searchQuery = {
    query: query.trim(),
  };

  fetch("/request/getPreviousSubjects", {
    method: "POST",
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
    body: JSON.stringify(searchQuery),
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      let listContainer = document.querySelector("#listContainer ul");
      listContainer.innerHTML = "";

      data.forEach((subject) => {
        let anOldSubject = elementFromHtml(`
          <li>
            <button type="button" class="addSubject" id="addSubject">
              ${subject["subjectCode"]} - ${subject["subjectDesc"]}
            </button>
          </li>
          `);

        anOldSubject.onclick = () => {
          openAddSubjectModal(
            CURRENTTABLE,
            CURRENTSEMESTER,
            subject["subjectCode"],
            subject["subjectDesc"],
            subject["subjectLec"],
            subject["subjectLab"],
            subject["subjectPreq"],
            subject["subjectElec"]
          );
        };

        listContainer.appendChild(anOldSubject);
      });
    });
}

listOldSubjects();
// Event listeners for search input
let searchSubject = document.getElementById("searchSubject");
searchSubject.addEventListener("input", () => {
  listOldSubjects(searchSubject.value);
});

// Functions to List Old Subjects <-- STARTS HERE -->
