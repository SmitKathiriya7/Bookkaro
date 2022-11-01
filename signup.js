function clearErrors() {
    errors = document.getElementsByClassName('formerror');
    colorerror = document.getElementsByClassName('input-box');
    for (let item of errors) {
        item.innerHTML = "";
    }
    for (let color of colorerror) {
        color.style.border = " 1px solid rgb(76, 76, 240)";
    }
}

function seterror(id, error) {
    element = document.getElementById(id);
    element.getElementsByClassName('formerror')[0].innerHTML = error;
    element.getElementsByClassName('input-box')[0].style.border = "1px solid red";
}

function validateForm() {
    clearErrors();
    let phone = document.myForm.fphone;
    let name = document.myForm.fname;
    let password = document.myForm.fpass;
    let minlength = 7;
    let maxlength = 12;
    let cpassword = document.myForm.fcpass;
    let dobirth = document.myForm.fdate;

    let a = name_validation(name, 1);
    let b = pass_validation(password, minlength, maxlength);
    let c = cpass_validation(password, cpassword, minlength, maxlength);
    let d = phone_validation(phone);
    let e = dob_validation(dobirth, 18);
    let f = CheckValidCaptcha();

    if (a && b && c && d && e && f) { 
        let a =   document.getElementById("submitform");
        a.reset();
        window.location.href = "./homePage.html";
        alert("your account created successfully");
        return true;
    }
    else {
        return false;
    }
}

function phone_validation(phone) {
    let number = /^\d{10}$/;
    if (phone.value.length == 0) {
        seterror("input_phone", "phone can not be empty !");
        return false;
    }
    else if (phone.value.length != 10) {
        seterror("input_phone", "phone should be of 10 digit");
        return false;
    }
    else if (!phone.value.match(number)) {
        seterror("input_phone", "phone number contains only number");
        return false;
    }
    else if (!phone.value.match(/[6-9]{1}[0-9]{9}/)) {
        seterror("input_phone", "please enter valid phone number");
        return false;
    }
    return true;
}

function name_validation(name, minlength) {
    let name1 = name.value;
    let letter = /^[A-Za-z]+$/;
    if (name1.length == 0) {
        seterror("input_name", "name can not be empty !");
        return false;
    }
    else if (!name1.match(letter)) {
        seterror("input_name", "name contain only letter");
        return false;
    }
    else if (name1.length < minlength) {
        seterror("input_name", "minimum length is 7 ");
        return false;
    }
    return true;
}

function pass_validation(password, minlength, maxlength) {
    let passw_length = password.value.length;
    let passmatch = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{7,12}$/;
    if (passw_length == 0) {
        seterror("input_pass", "password is compalsary !");
        return false;
    }
    if (passw_length < minlength || passw_length > maxlength) {
        seterror("input_pass", "password  length be between " + minlength + " to " + maxlength);
        return false;
    }
    if(!password.value.match(passmatch)){
        seterror("input_pass", "contain lowercase, uppercase, numeric and special character ");
        return false;
    }
    return true;
}

function cpass_validation(password, cpassword, minlength, maxlength) {
    let pass_value = password.value;
    let cpass_value = cpassword.value;
    if (pass_value.length >= minlength && pass_value.length <= maxlength && cpass_value.length == 0) {
        seterror("input_cpass", " plese conform your password !");
        console.log('hello');
        return false;
    }
    else if (cpass_value.length != 0 && pass_value != cpass_value) {
        seterror("input_cpass", " password not match ");
        return false;
    }
    return true;
}

function dob_validation(dobirth, age) {
    let birth = dobirth.value;
    let dob = new Date(birth);
    let curr_date = new Date();
    var age1 = new Date(curr_date.getFullYear() - age, curr_date.getMonth(), curr_date.getDate());
    var age2 = new Date(dob.getFullYear(), dob.getMonth(), dob.getDate());
    if (birth.length == 0) {
        seterror("input_dob", "please enter age");
        return false;
    }
    else if (age1 < age2) {
        seterror("input_dob", " your age should be "+age + " or above");
        return false;
    }
    return true;
}

function generateCaptcha() {
    var alpha = new Array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
    var i;
    for (i = 0; i < 6; i++) {
        var a = alpha[Math.floor(Math.random() * alpha.length)];
        var b = alpha[Math.floor(Math.random() * alpha.length)];
        var c = alpha[Math.floor(Math.random() * alpha.length)];
        var d = alpha[Math.floor(Math.random() * alpha.length)];
        var e = alpha[Math.floor(Math.random() * alpha.length)];
        var f = alpha[Math.floor(Math.random() * alpha.length)];
        var g = alpha[Math.floor(Math.random() * alpha.length)];
    }
    var code = a + ' ' + b + ' ' + ' ' + c + ' ' + d + ' ' + e + ' ' + f + ' ' + g;
    document.getElementById("mainCaptcha").innerHTML = code
    document.getElementById("mainCaptcha").value = code
}

function CheckValidCaptcha() {
    var string1 = removeSpaces(document.getElementById('mainCaptcha').value);
    var string2 = removeSpaces(document.getElementById('txtInput').value);
    if (string1 != string2) {
        generateCaptcha();
        seterror("input_capcha", "please enter valid capcha");
        return false;
    } 
        return true;
}

function removeSpaces(string) {
    return string.split(' ').join('');
}