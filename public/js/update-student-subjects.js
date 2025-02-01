let removes = document.querySelectorAll('#remove');
let takes = document.querySelectorAll('#take');
let subjectActions = document.querySelectorAll('#subjectAction');


takes.forEach(take => {
    take.disabled = true;
    take.hidden = true;
});

subjectActions.forEach(subjectAction => {
    subjectAction.hidden = true;
    subjectAction.value = "take";
});


removes.forEach(remove => {
    remove.onclick = () => {
        let take = remove.parentElement.querySelector('#take');
        let subjectAction = remove.parentElement.querySelector('#subjectAction');

        subjectAction.value = "remove";

        take.disabled = false;
        take.hidden = false;

        remove.disabled = true;
        remove.hidden = true;

        take.onclick = () => {
            subjectAction.value = "take";

            remove.disabled = false;
            remove.hidden = false;

            take.disabled = true;
            take.hidden = true;
        }
    }
});


// takes.forEach(take => {
//     take.onclick = () => {
//         let remove = remove.parentElement.querySelector('#remove');
//         remove.disabled = false;
//         remove.hidden = false;

//         take.disabled = true;
//         take.hidden = true;
//     }
// });


