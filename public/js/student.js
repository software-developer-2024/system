let gback = document.getElementById('gback');

gback.onclick = () => {
    sessionStorage.removeItem('action');
}

let subjectsPageBtn = document.getElementById('subjectsPageBtn');
let advisingPageBtn = document.getElementById('advisingPageBtn');

let content = document.getElementById('content');
let subjectsPage = document.getElementById('subjectsPage');
let advisingPage = document.getElementById('advisingPage');

let studentId = document.getElementById('studentId').innerText;
let batch = document.getElementById('batch').innerText;

let studentInfo = {
    "studentId": studentId
}

let action = sessionStorage.getItem('action') ?? "view";
sessionStorage.setItem("action", action);

// fetch("/request/studentSubjects", {
//     "method": "POST",
//     "headers": {
//         "Content-Type": "application/json; charset=utf-8"
//     },
//     "body": JSON.stringify(studentInfo)
// }).then(function (response) {
//     return response.json();
// }).then(function (data) {

//     function displaySubjectsForSpecificSemester(year, semester, subjects) {

//         function subjectsForThisSemester(year, semester, subjects) {
//             let subjectArray = [];
//             subjects.forEach(subject => {
//                 if ((subject['year'] == year) && (subject['semester'] == semester)) {
//                     subjectArray.push(subject);
//                 }
//             });

//             return subjectArray;
//         }

//         function createFormElement() {
//             let form = document.createElement('form');
//             form.setAttribute("method", "POST");
//             form.setAttribute("class", "max-h-full");
//             form.setAttribute("action", "/students/" + studentId + "/update/subjects");

//             return form;
//         }

//         function addHiddenInputInsideTheForm(form, year, semester) {

//             function addHiddenInput(instances) {
//                 var inputReturn = "";
//                 Object.entries(instances).forEach(([key, value]) => {
//                     let input = document.createElement('input');
//                     input.setAttribute("type", "text");
//                     input.setAttribute("name", key);
//                     input.setAttribute("value", value);
//                     input.setAttribute("hidden", "");

//                     inputReturn = input;
//                 });
//                 return inputReturn;
//             }

//             let yearInstance = { "year": year };
//             let yearInput = addHiddenInput(yearInstance);

//             let semesterInstance = { "semester": semester };
//             let semesterInput = addHiddenInput(semesterInstance);

//             let studentIdInstance = { "studentId": studentId };
//             let studentIdInput = addHiddenInput(studentIdInstance);

//             form.append(yearInput, semesterInput, studentIdInput);
//         }

//         function addButtonForClickableDiv(form, year, semester) {

//             function createHeaderColumn(width, value) {
//                 let th = document.createElement('th');
//                 th.setAttribute("class", "text-xs font-semibold text-center py-1 border border-black")
//                 th.setAttribute("width", width);
//                 th.innerText = value;

//                 return th;
//             }

//             let buttonDiv = document.createElement('button');
//             buttonDiv.setAttribute("type", "submit");
//             buttonDiv.setAttribute("class", "flex flex-col min-h-full px-3 py-6 shadow bg-gray-100/10 hover:bg-gray-400/40 cursor-default pointer-events-none");

//             let batchYear = batch.split("-");
//             var currentYear = batchYear[0];
//             var nextYear = batchYear[1];

//             var yearDisplay = "";
//             switch (year) {
//                 case 1:
//                     yearDisplay = year + "ST YEAR";
//                     currentYear = parseInt(batchYear[0]);
//                     nextYear = parseInt(batchYear[1]);
//                     break;

//                 case 2:
//                     yearDisplay = year + "ND YEAR";
//                     currentYear = parseInt(batchYear[0]) + 1;
//                     nextYear = parseInt(batchYear[1]) + 1;
//                     break;

//                 case 3:
//                     yearDisplay = year + "RD YEAR";
//                     currentYear = parseInt(batchYear[0]) + 2;
//                     nextYear = parseInt(batchYear[1]) + 2;
//                     break;

//                 default:
//                     yearDisplay = year + "TH YEAR";
//                     currentYear = parseInt(batchYear[0]) + (year - 1);
//                     nextYear = parseInt(batchYear[1]) + (year - 1);
//                     break;
//             }

//             var semDisplay = "";
//             switch (semester) {
//                 case "0":
//                     semDisplay = "1ST SEMESTER"
//                     break;

//                 case "1":
//                     semDisplay = "2ND SEMESTER"
//                     break;

//                 case "2":
//                     semDisplay = "SUMMER"
//                     break;
//             }

            

//             let buttonHeader = document.createElement('div');
//             buttonHeader.setAttribute("class", "text-sm flex flex-row-reverse w-full justify-between text-center px-3 pb-2 pt-0");

//             let termDiv = document.createElement('div');
//             termDiv.setAttribute("class", "font-semibold");
//             termDiv.appendChild(document.createTextNode(semDisplay + " - " + yearDisplay));

//             let batchDiv = document.createElement('div');
//             batchDiv.setAttribute("class", "font-semibold");
//             batchDiv.appendChild(document.createTextNode("A.Y. " + currentYear + "-" + nextYear));

//             buttonHeader.append(termDiv, batchDiv);

//             let buttonTable = document.createElement('table');
//             buttonTable.setAttribute("width", "600")
//             buttonTable.setAttribute("class", "w-full");

//             let tableHeader = document.createElement('tr');
//             tableHeader.setAttribute("class", "bg-gray-800/20");

//             let code = createHeaderColumn(100, "Code");
//             let desc = createHeaderColumn(300, "Description");
//             let units = createHeaderColumn(100, "Units");
//             let grade = createHeaderColumn(100, "Grades");

//             tableHeader.append(code, desc, units, grade);

//             buttonTable.appendChild(tableHeader);

//             buttonDiv.append(buttonHeader, buttonTable);

//             form.appendChild(buttonDiv);

//             return buttonTable;

//         }

//         function addSubjectsToTableButton(table, subjects) {

//             function createColumn(value) {
//                 let td = document.createElement('td');
//                 td.setAttribute("class", "text-xs text-center p-1 border border-black")
//                 td.innerHTML = value;

//                 if (value == "5.0" || value == "INC" || value == "UW" || value == "AW") {
//                     td.classList.add("text-red-600");
//                 }

//                 return td;

//             }
//             subjects.forEach(subject => {
//                 let tr = document.createElement('tr');
//                 tr.setAttribute("class", "bg-yellow-100/10");

//                 let code = createColumn(subject['code']);
//                 let desc = createColumn(subject['description']);
//                 let units = createColumn(subject['units']);
//                 let grade = createColumn(subject['grade']);

//                 tr.append(code, desc, units, grade);

//                 table.appendChild(tr);
//             });
//         }

//         //<--  starts here  -->

//         let subjectReturn = subjectsForThisSemester(year, semester, subjects);

//         if (subjectReturn.length <= 0) {
//             return;
//         }

//         let form = createFormElement();

//         addHiddenInputInsideTheForm(form, year, semester);

//         let tableInButton = addButtonForClickableDiv(form, year, semester);

//         addSubjectsToTableButton(tableInButton, subjectReturn);

//         advisingPage.appendChild(form);
//     }

//     data['numberOfYears'].forEach(years => {
//         data['numberOfSemesters'].forEach(semesters => {
//             displaySubjectsForSpecificSemester(years['year'], semesters['semester'], data['studentTable']);
//         });
//     });


// })

if (sessionStorage.getItem('action') == "advise") {
    advisingPage.classList.replace("hidden", "grid");

    subjectsPageBtn.removeAttribute("aria-current");
    subjectsPageBtn.setAttribute("class", "inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300");
    advisingPageBtn.setAttribute("class", "inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active pointer-events-none");
    advisingPageBtn.setAttribute("aria-current", "page");

    content.scrollTo({
        left: 1000,
        behavior: "instant",
    });

    setTimeout(() => {
        subjectsPage.classList.replace("grid", "hidden");
    }, 500);
}

advisingPageBtn.onclick = () => {
    advisingPage.classList.replace("hidden", "grid");

    subjectsPageBtn.removeAttribute("aria-current");
    subjectsPageBtn.setAttribute("class", "inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300");
    advisingPageBtn.setAttribute("class", "inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active pointer-events-none");
    advisingPageBtn.setAttribute("aria-current", "page");

    content.scrollTo({
        left: 1000,
        behavior: "smooth",
    });

    setTimeout(() => {
        subjectsPage.classList.replace("grid", "hidden");
    }, 500);

    sessionStorage.setItem("action", "advise");
}

subjectsPageBtn.onclick = () => {
    subjectsPage.classList.replace("hidden", "grid");
    content.scrollTo({
        left: 1000,
        behavior: "instant",
    });

    advisingPageBtn.removeAttribute("aria-current");
    advisingPageBtn.setAttribute("class", "inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300");
    subjectsPageBtn.setAttribute("class", "inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active pointer-events-none");
    subjectsPageBtn.setAttribute("aria-current", "page");

    content.scrollTo({
        left: 0,
        behavior: "smooth",
    });

    setTimeout(() => {
        advisingPage.classList.replace("grid", "hidden");
    }, 500);

    sessionStorage.setItem("action", "view");
}

document.querySelectorAll(".move-page").forEach(move => {
    move.onclick = () => {
        sessionStorage.removeItem("action");
    }
})