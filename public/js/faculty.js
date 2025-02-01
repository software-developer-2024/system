
function createModalEditAction(action = null, index = 0) {
    let modalHeader = document.querySelector('#modal-header');
    let modalBody = document.querySelector('#modal-body');
    modalHeader.innerHTML = action;
    modalBody.innerHTML = "";


    var role = faculty.cell(index, 6).data();
    var advisee = faculty.cell(index, 7).data();
    var curriculum = faculty.cell(index, 8).data();
    var id = faculty.cell(index, 9).data();
    var emailaddress = faculty.cell(index, 10).data();
    var contactnumber = faculty.cell(index, 11).data();
    contactnumber = contactnumber.replace(/ /g, '');
    id = id.trim();
    var firstname = faculty.cell(index, 1).data();
    var middlename = faculty.cell(index, 2).data();
    var middleInitial = "";
    var lastname = faculty.cell(index, 3).data();

    const modalBodyHeader = document.createElement('h4');
    modalBodyHeader.classList.add("text-contrast", "font-semibold");
    if (middlename != "") {
        middleInitial = middlename[0] + ". ";
    }
    const name = document.createTextNode(firstname + " " + middleInitial + lastname);
    const fullname = firstname + " " + middleInitial + lastname;



    switch (action) {
        case "Assign":

            const formAssign = document.createElement('form');
            formAssign.setAttribute("method", "POST");
            formAssign.setAttribute("action", "/action/edit?id=" + id);;
            modalBody.append(formAssign);

            formAssign.append(modalBodyHeader);
            modalBodyHeader.appendChild(name);

            const roleLabel = document.createElement('label');
            roleLabel.setAttribute("for", "role");
            roleLabel.classList.add("block", "mb-2", "ms-4", "mt-3", "font-medium", "text-gray-900");
            formAssign.appendChild(roleLabel);
            roleLabel.appendChild(document.createTextNode("Role:"));

            const roleSelect = document.createElement('select');
            roleSelect.setAttribute("id", "role");
            roleSelect.setAttribute("name", "role");
            roleSelect.classList.add("bg-gray-50", "border", "border-gray-300", "text-gray-900", "text-sm", "rounded-lg", "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "p-2.5");
            formAssign.appendChild(roleSelect);

            const roleOption1 = document.createElement('option');
            roleOption1.setAttribute("value", "None");
            roleOption1.appendChild(document.createTextNode("None"));

            const roleOption2 = document.createElement('option');
            roleOption2.setAttribute("value", "Adviser");
            roleOption2.appendChild(document.createTextNode("Adviser"));

            if ("advisee0" in sessionStorage) {
                const roleOption3 = document.createElement('option');
                roleOption3.setAttribute("value", "Sub-adviser");
                roleOption3.appendChild(document.createTextNode("Sub-adviser"));
                roleSelect.append(roleOption1, roleOption2, roleOption3);
            } else {
                roleSelect.append(roleOption1, roleOption2);
            }

            roleSelect.value = role;

            const submitDiv = document.createElement('div');
            submitDiv.setAttribute("class", "w-full flex flex-row-reverse gap-4 mt-9");

            const submitBtn = document.createElement('input');
            submitBtn.setAttribute("type", "submit");
            submitBtn.setAttribute("name", "submit");
            submitBtn.setAttribute("value", "Assign");
            submitBtn.classList.add("text-white", "bg-blue-700", "hover:bg-blue-800", "focus:ring-4", "focus:outline-none", "focus:ring-blue-300", "font-medium", "rounded-lg", "text-sm", "px-5", "mt-5", "py-2.5", "text-center")
            submitDiv.appendChild(submitBtn);

            const closeBtn = document.createElement('button');
            closeBtn.setAttribute("type", "button");
            closeBtn.setAttribute("data-modal-hide", "default-modal");
            closeBtn.classList.add("text-blue-800", "bg-transparent", "focus:ring-4", "focus:outline-none", "focus:ring-blue-300", "font-medium", "rounded-lg", "text-sm", "px-5", "mt-5", "py-2.5", "text-center")
            closeBtn.appendChild(document.createTextNode("Close"));
            closeBtn.onclick = () => {
                document.getElementById("modal-close").click();
            }
            submitDiv.appendChild(closeBtn);

            formAssign.append(submitDiv);

            if (role == "Adviser") {
                submitDiv.remove();
                assignAdviser(formAssign, advisee, curriculum);
                formAssign.appendChild(submitDiv);
            }

            if (role == "Sub-adviser") {
                submitDiv.remove();
                assignSub(formAssign, advisee);
                formAssign.appendChild(submitDiv);
            }

            roleSelect.onchange = () => {
                for (let i = formAssign.childElementCount - 1; i > 2; i--) {
                    formAssign.childNodes.item(i).remove();
                }

                if (roleSelect.value == "Adviser") {
                    assignAdviser(formAssign);
                }

                if (roleSelect.value == "Sub-adviser") {
                    assignSub(formAssign);
                }

                formAssign.appendChild(submitDiv);

            }

            break;

        case "Edit Profile":

            const formEdit = document.createElement('form');
            formEdit.setAttribute("action", "/action/edit?id=" + id);
            formEdit.setAttribute("method", "POST");
            modalBody.append(formEdit);

            const firstnameLabel = document.createElement('label');
            firstnameLabel.setAttribute("for", "fname");
            firstnameLabel.classList.add("block", "mb-0", "ms-4", "mt-3", "font-medium", "text-sm", "text-gray-900");
            formEdit.appendChild(firstnameLabel);
            firstnameLabel.appendChild(document.createTextNode("First Name:"));

            const firstnameInput = document.createElement('input');
            firstnameInput.setAttribute("id", "fname");
            firstnameInput.setAttribute("name", "fname");
            firstnameInput.setAttribute("name", "fname");
            firstnameInput.setAttribute("placeholder", "Enter Firstname");
            firstnameInput.classList.add("bg-gray-50", "border", "border-gray-300", "text-gray-900", "text-sm", "rounded-lg", "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "p-2.5");
            formEdit.appendChild(firstnameInput);
            firstnameInput.value = firstname;
            firstnameInput.required = true;

            const middlenameLabel = document.createElement('label');
            middlenameLabel.setAttribute("for", "mname");
            middlenameLabel.classList.add("block", "mb-0", "ms-4", "mt-3", "font-medium", "text-sm", "text-gray-900");
            formEdit.appendChild(middlenameLabel);
            middlenameLabel.appendChild(document.createTextNode("Middle Name:"));

            const middlenameInput = document.createElement('input');
            middlenameInput.setAttribute("id", "mname");
            middlenameInput.setAttribute("name", "mname");
            middlenameInput.setAttribute("placeholder", "Enter Middle Name (Optional)");
            middlenameInput.classList.add("bg-gray-50", "border", "border-gray-300", "text-gray-900", "text-sm", "rounded-lg", "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "p-2.5");
            formEdit.appendChild(middlenameInput);
            middlenameInput.value = middlename;

            const lastnameLabel = document.createElement('label');
            lastnameLabel.setAttribute("for", "lname");
            lastnameLabel.classList.add("block", "mb-0", "ms-4", "mt-3", "font-medium", "text-sm", "text-gray-900");
            formEdit.appendChild(lastnameLabel);
            lastnameLabel.appendChild(document.createTextNode("Last Name:"));

            const lastnameInput = document.createElement('input');
            lastnameInput.setAttribute("id", "lname");
            lastnameInput.setAttribute("name", "lname");
            lastnameInput.setAttribute("placeholder", "Enter Firstname");
            lastnameInput.classList.add("bg-gray-50", "border", "border-gray-300", "text-gray-900", "text-sm", "rounded-lg", "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "p-2.5");
            formEdit.appendChild(lastnameInput);
            lastnameInput.value = lastname;
            lastnameInput.required = true;

            const contactLabel = document.createElement('label');
            contactLabel.setAttribute("for", "contact");
            contactLabel.classList.add("block", "mb-0", "ms-4", "mt-9", "font-medium", "text-sm", "text-gray-900");
            formEdit.appendChild(contactLabel);
            contactLabel.appendChild(document.createTextNode("Contact Number:"));

            const contactInput = document.createElement('input');
            contactInput.setAttribute("type", "tel");
            contactInput.setAttribute("id", "contact");
            contactInput.setAttribute("name", "contact");
            contactInput.setAttribute("placeholder", "09XXXXXXXXX");
            contactInput.setAttribute("pattern", "09[0-9]{9}");
            contactInput.classList.add("bg-gray-50", "border", "border-gray-300", "text-gray-900", "text-sm", "rounded-lg", "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "p-2.5");
            formEdit.appendChild(contactInput);
            contactInput.value = contactnumber;
            contactInput.required = true;

            const emailLabel = document.createElement('label');
            emailLabel.setAttribute("for", "email");
            emailLabel.classList.add("block", "mb-0", "ms-4", "mt-3", "font-medium", "text-sm", "text-gray-900");
            formEdit.appendChild(emailLabel);
            emailLabel.appendChild(document.createTextNode("Email Address:"));

            const emailInput = document.createElement('input');
            emailInput.setAttribute("type", "email");
            emailInput.setAttribute("id", "email");
            emailInput.setAttribute("name", "email");
            emailInput.setAttribute("placeholder", "Enter Email Address");
            emailInput.classList.add("bg-gray-50", "border", "border-gray-300", "text-gray-900", "text-sm", "rounded-lg", "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "p-2.5");
            formEdit.appendChild(emailInput);
            emailInput.value = emailaddress;

            const submitDiv1 = document.createElement('div');
            submitDiv1.setAttribute("class", "w-full flex flex-row-reverse gap-4 mt-9");

            const editBtn = document.createElement('input');
            editBtn.setAttribute("type", "submit");
            editBtn.setAttribute("name", "submit");
            editBtn.setAttribute("value", "Save Changes");
            editBtn.classList.add("text-white", "bg-green-700", "hover:bg-green-800", "focus:ring-4", "focus:outline-none", "focus:ring-green-300", "font-medium", "rounded-lg", "text-sm", "px-5", "mt-5", "py-2.5", "text-center")
            submitDiv1.appendChild(editBtn);

            const closeBtn1 = document.createElement('button');
            closeBtn1.setAttribute("type", "button");
            closeBtn1.setAttribute("data-modal-hide", "default-modal");
            closeBtn1.classList.add("text-green-800", "bg-transparent", "focus:ring-4", "focus:outline-none", "focus:ring-blue-300", "font-medium", "rounded-lg", "text-sm", "px-5", "mt-5", "py-2.5", "text-center")
            closeBtn1.appendChild(document.createTextNode("Close"));
            closeBtn1.onclick = () => {
                document.getElementById("modal-close").click();
            }
            submitDiv1.appendChild(closeBtn1);

            formEdit.appendChild(submitDiv1);

            break;

        case "Reset Password":

            const formReset = document.createElement('form');
            formReset.setAttribute("action", "/action/edit?id=" + id);
            formReset.setAttribute("method", "POST");
            modalBody.append(formReset);

            const reset = document.createElement('p');
            reset.setAttribute("id", "resetID");
            formReset.appendChild(reset);
            const resetId = document.querySelector('#resetID');
            resetId.innerHTML = "Do you want to reset <span class='font-semibold'>" + fullname + "</span>'s password to default?"

            const submitDiv2 = document.createElement('div');
            submitDiv2.setAttribute("class", "w-full flex flex-row-reverse gap-4 mt-9");

            const resetBtn = document.createElement('input');
            resetBtn.setAttribute("type", "submit");
            resetBtn.setAttribute("name", "submit");
            resetBtn.setAttribute("value", "Reset Password");
            resetBtn.classList.add("text-white", "bg-purple-700", "hover:bg-purple-800", "focus:ring-4", "focus:outline-none", "focus:ring-purple-300", "font-medium", "rounded-lg", "text-sm", "px-5", "mt-5", "py-2.5", "text-center");
            submitDiv2.appendChild(resetBtn);

            const closeBtn2 = document.createElement('button');
            closeBtn2.setAttribute("type", "button");
            closeBtn2.setAttribute("data-modal-hide", "default-modal");
            closeBtn2.classList.add("text-purple-700", "bg-transparent", "focus:ring-4", "focus:outline-none", "focus:ring-blue-300", "font-medium", "rounded-lg", "text-sm", "px-5", "mt-5", "py-2.5", "text-center")
            closeBtn2.appendChild(document.createTextNode("Close"));
            closeBtn2.onclick = () => {
                document.getElementById("modal-close").click();
            }
            submitDiv2.appendChild(closeBtn2);

            formReset.appendChild(submitDiv2);

            break;

        case "Remove":

            const formRemove = document.createElement('form');
            formRemove.setAttribute("action", "/action/edit?id=" + id);
            formRemove.setAttribute("method", "POST");
            modalBody.append(formRemove);

            const query = document.createElement('p');
            query.setAttribute("id", "pID");
            formRemove.appendChild(query);
            const queryId = document.querySelector('#pID');
            queryId.innerHTML = "Do you want to remove <span class='font-semibold'>" + fullname + "</span> from the list?"

            const submitDiv3 = document.createElement('div');
            submitDiv3.setAttribute("class", "w-full flex flex-row-reverse gap-4 mt-9");

            const removeBtn = document.createElement('input');
            removeBtn.setAttribute("type", "submit");
            removeBtn.setAttribute("name", "submit");
            removeBtn.setAttribute("value", "Remove");
            removeBtn.classList.add("text-white", "bg-red-700", "hover:bg-red-800", "focus:ring-4", "focus:outline-none", "focus:ring-red-300", "font-medium", "rounded-lg", "text-sm", "px-5", "mt-5", "py-2.5", "text-center")
            submitDiv3.appendChild(removeBtn);

            const closeBtn3 = document.createElement('button');
            closeBtn3.setAttribute("type", "button");
            closeBtn3.setAttribute("data-modal-hide", "default-modal");
            closeBtn3.classList.add("text-red-700", "bg-transparent", "focus:ring-4", "focus:outline-none", "focus:ring-blue-300", "font-medium", "rounded-lg", "text-sm", "px-5", "mt-5", "py-2.5", "text-center")
            closeBtn3.appendChild(document.createTextNode("Close"));
            closeBtn3.onclick = () => {
                document.getElementById("modal-close").click();
            }
            submitDiv3.appendChild(closeBtn3);

            formRemove.appendChild(submitDiv3);

            break;

        default:
            modalBody.innerHTML = "";

            const p = document.createElement('p');
            p.classList.add("text-base", "leading-relaxed", "text-gray-500");

            const msg = document.createTextNode("Looks like we caught someone using inspect element. Anyway, have fun understanding our html structure.");
            modalBody.append(p);
            p.appendChild(msg);
            break;
    }
}

function assignAdviser(form, adv = "", ccm = "") {

    const adviseeLabel = document.createElement('label');
    adviseeLabel.setAttribute("for", "advisee");
    adviseeLabel.classList.add("block", "mb-2", "ms-4", "mt-3", "font-medium", "text-gray-900");
    form.appendChild(adviseeLabel);
    adviseeLabel.appendChild(document.createTextNode("Advisee:"));

    const adviseeInput = document.createElement('input');
    adviseeInput.setAttribute("id", "advisee");
    adviseeInput.setAttribute("name", "advisee");
    adviseeInput.setAttribute("placeholder", "A.Y Batch to handle (20XX - 20YY)");
    adviseeInput.classList.add("bg-gray-50", "border", "border-gray-300", "text-gray-900", "text-sm", "rounded-lg", "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "p-2.5");
    form.appendChild(adviseeInput);
    adviseeInput.value = adv;
    adviseeInput.required = true;

    const curriculumLabel = document.createElement('label');
    curriculumLabel.setAttribute("for", "curriculum");
    curriculumLabel.classList.add("block", "mb-2", "ms-4", "mt-3", "font-medium", "text-gray-900");
    form.appendChild(curriculumLabel);
    curriculumLabel.appendChild(document.createTextNode("Curriculum:"));

    const curriculumSelect = document.createElement('select');
    curriculumSelect.setAttribute("id", "curriculum");
    curriculumSelect.setAttribute("name", "curriculum");
    curriculumSelect.classList.add("bg-gray-50", "border", "border-gray-300", "text-gray-900", "text-sm", "rounded-lg", "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "p-2.5");
    form.appendChild(curriculumSelect);

    fetch ("request/curriculums")
    .then (function (response) {
        return response.json();
    })
    .then (function (data) {
        data.forEach(curriculum => {
            const curriculumOption = document.createElement('option');
            curriculumOption.setAttribute("value", curriculum['name'])
            curriculumSelect.appendChild(curriculumOption)
            curriculumOption.appendChild(document.createTextNode(curriculumOption.value));
        });
        
    })

    if (ccm == "") {
        curriculumSelect.selectedIndex = 0;
    } else {
        curriculumSelect.value = ccm;
    }

}

function assignSub(form, adv = "") {

    const adviseeLabel = document.createElement('label');
    adviseeLabel.setAttribute("for", "advisee");
    adviseeLabel.classList.add("block", "mb-2", "ms-4", "mt-3", "font-medium", "text-gray-900");
    form.appendChild(adviseeLabel);
    adviseeLabel.appendChild(document.createTextNode("Advisee:"));

    const adviseeSelect = document.createElement('select');
    adviseeSelect.setAttribute("id", "advisee");
    adviseeSelect.setAttribute("name", "advisee");
    adviseeSelect.classList.add("bg-gray-50", "border", "border-gray-300", "text-gray-900", "text-sm", "rounded-lg", "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "p-2.5");
    form.appendChild(adviseeSelect);

    fetch ("request/advisees")
    .then (function (response) {
        return response.json();
    })
    .then (function (data) {
        data.forEach(adviser => {
            const adviseeOption = document.createElement('option');
            adviseeOption.setAttribute("value", adviser['advisee']);
            adviseeSelect.appendChild(adviseeOption);
            adviseeOption.appendChild(document.createTextNode(adviser['advisee'] + " — " + adviser['lastname'] + ", " + adviser['firstname'][0] + "."));
        });
        
    })

    if (adv == "") {
        adviseeSelect.selectedIndex = 0;
    } else {
        adviseeSelect.value = adv;
    }

}

let faculty = $('#facultyTable').DataTable({
    info: false,
    ordering: false,
    paging: false,
    searching: false,
    responsive: true,

    columnDefs: [
        {
            target: 1,
            visible: false,
            searchable: false
        },
        {
            target: 2,
            visible: false,
            searchable: false
        },
        {
            target: 3,
            visible: false,
            searchable: false
        },
        {
            target: 5,
            visible: false,
            searchable: false
        },
        {
            target: 8,
            visible: false,
            searchable: false
        },
        {
            target: 9,
            visible: false,
        }
    ]

});

let count = faculty.rows().count();

for (let i = 0; i < count; i++) {
    let $triggerEl = document.getElementById('tooltipButton' + i);
    let $targetEl = document.getElementById('tooltipContent' + i);

    const options = {
        placement: 'left',
        triggerType: 'none',
    };

    const tooltip = new Tooltip($targetEl, $triggerEl, options);

    $triggerEl.onclick = () => {

        let assign = $targetEl.querySelector('#assign');
        let edit = $targetEl.querySelector('#edit');
        let reset = $targetEl.querySelector('#reset');
        let dlt = $targetEl.querySelector('#delete');

        tooltip.toggle();


        assign.onclick = () => {
            tooltip.toggle();
            createModalEditAction("Assign", i);
        }

        edit.onclick = () => {
            tooltip.toggle();
            createModalEditAction("Edit Profile", i);
        }

        reset.onclick = () => {
            tooltip.toggle();
            createModalEditAction("Reset Password", i);
        }

        dlt.onclick = () => {
            tooltip.toggle();
            createModalEditAction("Remove", i);
        }

    }

    let modalClose = document.querySelector('#modal-close');

    modalClose.onclick = () => {
        createModalEditAction("Oops!!")
    }
}


