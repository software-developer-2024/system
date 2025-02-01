let username = document.getElementById('username');
let password = document.getElementById('password');
let form = document.getElementById('form');

form.addEventListener("submit", () => {
    if(username.value == ''){
        return alert('Please enter username');
    }

    if(password.value == ''){
        return alert('Please enter password');
    }
})
