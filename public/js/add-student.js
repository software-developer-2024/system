let fname = document.getElementById('fname');
let mname = document.getElementById('mname');
let lname = document.getElementById('lname');

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function capitalizeWords(sentence) {
    return sentence
        .split(" ")
        .map(word => capitalizeFirstLetter(word))
        .join(" ");
}

[fname, mname, lname].forEach(inputBox => {
    inputBox.addEventListener('keyup', function (event) {
        this.value = capitalizeWords(this.value);
    })
});  