// crud start
function ajaxCall(form_id, target_id = "", method = "POST") {
    // getting the all from form
    var form = document.getElementById(form_id);
    var url_name = form.action;
    if (target_id == "") {
        target_id = form_id
    }
    // setting all input into the forData object
    var formdata = new FormData(form);
    if (formValidate(form.elements, form)) {
        var formElements_button = Array.from(form.elements).pop();
        // getting the button of the form and passing into the preloader function
        preloader(formElements_button);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // document.getElementById(target_id).innerHTML = this.responseText;
                t_id = document.getElementById(target_id);
                backEndValidate(this.responseText, t_id)
                stopPreloader(formElements_button);
            }
        };
        xhttp.open(method, url_name, true);
        xhttp.send(formdata);
    }
}


function editForm(url_name, target_id, method = "GET", table_id = '') {

    preloader('', target_id);
    // getting the button of the form and passing into the preloader function
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            try {
                document.getElementById(target_id).innerHTML = this.responseText;
                underscore_remover();
                stopPreloader('', target_id);
            } catch (error) {

            }
        }
    };
    if (table_id != '') {
        url_name = url_name + "?id=" + table_id
    }
    xhttp.open(method, url_name, true);
    xhttp.send();
}

function checkInput(url_name, data, method = "GET") {

    preloader('', target_id);
    // getting the button of the form and passing into the preloader function
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(target_id).innerHTML = this.responseText;
            stopPreloader('', target_id);
        }
    };
    if (table_id != '') {
        url_name = url_name + "?data=" + data
    }
    xhttp.open(method, url_name, true);
    xhttp.send();
}

function selectDrop(form_id, url_name, target_id, method = "POST") {
    // getting the all from form
    var form = document.getElementById(form_id);
    // var url_name = form.action;
    if (target_id == "") {
        target_id = form_id
    }
    // setting all input into the forData object
    var formdata = new FormData(form);
    var formElements_button = Array.from(form.elements).pop();
    // getting the button of the form and passing into the preloader function
    preloader(formElements_button);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // document.getElementById(target_id).innerHTML = this.responseText;

            document.getElementById(target_id).value = this.responseText;
            document.getElementById(target_id).innerHTML = this.responseText;

            stopPreloader(formElements_button);
        } method
    };
    xhttp.open(method, url_name, true);
    xhttp.send(formdata);
}


function setData(form_id, url_name = '', method = "POST") {
    // getting the all from form
    var form = document.getElementById(form_id);
    if (url_name == '') {
        var url_name = form.action;
    }

    // setting all input into the forData object
    var formdata = new FormData(form);
    var formElements_button = Array.from(form.elements).pop();
    // getting the button of the form and passing into the preloader function
    preloader(formElements_button);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            for (var key in data.data) {
                try {
                    document.getElementsByName(key)[0].value = data.data[key];
                } catch (err) {
                }
            }

            stopPreloader(formElements_button);
        } method
    };
    xhttp.open(method, url_name, true);
    xhttp.send(formdata);
}




function deleteRow(form_id, target_id = "", method = "POST") {
    if (confirm('Are sure to delete  !!!')) {
        // getting the all from form
        var form = document.getElementById(form_id);
        var url_name = form.action;
        if (target_id == "") {
            target_id = form_id
        }
        // setting all input into the forData object
        var formdata = new FormData(form);
        var formElements_button = Array.from(form.elements).pop();
        // getting the button of the form and passing into the preloader function
        // preloader(formElements_button);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(target_id).innerHTML = this.responseText;
                formElements_button.disabled = true
                refreshPage(500)
            }
        };
        xhttp.open(method, url_name, true);
        xhttp.send(formdata);

    }
}



function deleteForm(url_name, target_id, method = "POST", table_id = '') {
    if (confirm('Are sure to delete !!!')) {
        preloader('', target_id);
        // getting the button of the form and passing into the preloader function
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                t_id = document.getElementById(target_id);
                stopPreloader('', target_id);
            }
        };
        if (table_id != '') {
            url_name = url_name + "?id=" + table_id
        }
        xhttp.open(method, url_name, true);
        xhttp.send();
    }
}

function changeStatus(url_name, target_id, method = "GET", table_id = '') {
    if (confirm('Are sure to Change Status !!!')) {
        preloader('', target_id);
        // getting the button of the form and passing into the preloader function
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                t_id = document.getElementById(target_id);
                document.getElementById(target_id).innerHTML = this.responseText;
                try {
                    stopPreloader('', target_id);
                }
                catch (err) {
                    console.log(err);
                }
                refreshPage(500)

            }
        };
        if (table_id != '') {
            url_name = url_name + "?id=" + table_id
        }
        xhttp.open(method, url_name, true);
        xhttp.send();
    }
}




function fetchApi(form_id, url_name, target_id, method = "POST") {
    const form = document.getElementById(form_id);
    // setting all input into the forData object
    FormData = new FormData(form);
    const formElements_button = Array.from(form.elements).pop();
    // getting the button of the form and passing into the preloader function
    preloader(formElements_button);
    fetch(url_name, {
        method: method,
        body: FormData,
    })
        .then((response) => response.text())
        .then((text) => {
            document.getElementById(target_id).innerHTML = text;
            stopPreloader(formElements_button, "span");
        })
        .catch((error) => console.error("Error:", error));
}


// crud end

// some special fucntion start

// this function is responsival for front end validation
function formValidate(el, form_id) {
    var flag = true;

    for (f = 0; f < el.length; f++) {

        if (el[f].required && el[f].value == '') {
            setError(el[f], " is Required filed please Input", "red")
            flag = false;
        } else {
            setError(el[f], " ", "green")
        }
        if ('max' in el) {
            if (el[f].value <= el[f].max) {
                setError(el[f], " is Required filed please Input", "red")
                flag = false;
            } else {
                setError(el[f], " ", "green")
            }
        }

        // if (flag == true && el[f].type == "text") {
        //     flag = validateText(el[f]);
        // }

        if (flag == true && el[f].type == "email") {
            flag = validateEmail(el[f])
        }
        if (flag == true && el[f].type == "tel") {
            flag = validatePhone(el[f]);
        }
        if (flag == true && el[f].type == "url") {
            flag = validateUrl(el[f]);
        }
        if (el[f].tagName == "SELECT") {
            flag = validateSelect(el[f]);

        }

    }
    return flag;
}

function backEndValidate(responseData, target_id) {
    var obj = JSON.parse(responseData);
    if ("success" in obj) {
        setSuccess(obj['success'], target_id)
        refreshPage(500);

    }

    else if ("error" in obj) {
        setErrorMsg(obj['error'], target_id)
    }

    else if ("delete" in obj) {
        setDelete(obj['delete'], target_id)
        refreshPage(500);
    }
    else {
        for (let key in obj) {
            let value;
            // get the value
            value = obj[key];
            var return_element = document.getElementsByName(key)
            var element = return_element[return_element.length - 1];
            setError(element, value, "red")
        }
    }

}

function setDelete(errr_message, form_id) {
    createdd_element = createMenuItem("span", {
        name: errr_message,
        class: "text-white",
        id: "lol",
        size: "13px",
    });
    form_id.appendChild(createdd_element);
}

function setSuccess(errr_message, form_id) {
    createdd_element = createMenuItem("div", {
        name: errr_message,
        class: "alert alert-success mt-3",
        id: "lol",
        size: "13px",
    });
    form_id.appendChild(createdd_element);
}
function setErrorMsg(errr_message, form_id) {
    createdd_element = createMenuItem("div", {
        name: errr_message,
        class: "alert alert-danger mt-3",
        id: "lol",
        size: "13px",
    });
    form_id.appendChild(createdd_element);
}


function setError(el, errr_message, bcolor) {

    el.style.borderColor = bcolor;
    if (errr_message != ' ') {
        errr_message = el.name.replaceAll("_", " ") + " " + errr_message;
    }
    el.insertAdjacentHTML('afterend', "<span class='text-danger error" + el.name + "'>" + errr_message + "</span>");
    var all_errors = document.getElementsByClassName("error" + el.name);
    for (i = 1; i < all_errors.length; i++) {
        all_errors[i].style.display = "none";
    }
    // form_id.appendChild(createdd_element);
}



function preloader(element_data, id = "") {
    var element = "";
    if (id != "") {
        element = document.getElementById(id);
    } else {
        element = element_data;
    }

    element.disabled = true;
    createdd_element = createMenuItem("span", {
        name: "",
        class: "spinner-border spinner-border-sm",
        id: "lol",
        size: "20px",
    });
    element.appendChild(createdd_element);
}

function stopPreloader(element_data, child, id = "") {
    var element = "";
    if (id != "") {
        element = document.getElementById(id);
    } else {
        element = element_data;
    }
    element.removeChild(element.firstElementChild);
    element.disabled = false;
}

function createMenuItem(element, data) {
    let created_element = document.createElement(element);
    created_element.textContent = data.name;
    created_element.setAttribute("class", data.class);
    created_element.setAttribute("id", data.id);
    created_element.setAttribute("style", "font-size:" + data.size);
    return created_element;
}

function refreshPage(miliSecond) {
    setTimeout(() => {
        document.location.reload();
    }, miliSecond);
}

// some special function end


function image_check(element, uploadImageSize) {
    var imgpath = element;
    console.log(element.files[0]);
    if (!imgpath.value == "") {
        var img = imgpath.files[0].size;
        var imgsize = Math.round(img / 1024);
        if (imgsize > uploadImageSize) {
            alert("Image size is " + imgsize + " KB please Upload  Image smaller than " + uploadImageSize + " KB");
            element.value = "";
        }
    }
}

// multi select js for select multile value at a time
var selected_array = [];

function multiselect(selectBox, input_id) {
    selectBox.style.height = "auto"
    var selectedValue = selectBox.selectedIndex;
    if (selected_array.includes(selectBox.selectedIndex)) {
        selected_array.pop()
        document.getElementById(input_id).options[selectBox.selectedIndex].selected = ""

    } else {
        selected_array.push(selectedValue);
    }
    console.log(selected_array);
    for (i = 0; i < selected_array.length; i++) {
        document.getElementById(input_id).options[selected_array[i]].selected = "true";
        document.getElementById(input_id).options[selected_array[i]].classList.add('fas')
        document.getElementById(input_id).options[selected_array[i]].classList.add('fa-check')
    }
}


// this function is reponsival for validate the email 
function validateText(text_input) {
    var text_value = text_input.value;
    var data = text_value.match(
        /^[0-9a-zA-Z]+$/
    );
    console.log(text_input);
    if (data == null) {
        setError(text_input, "Is Invalid Please Enter valid " + text_input.type + " You can't use " + text_input.value, "red")
        return false
    } else {
        setError(text_input, " ", "green")
        return true;
    }
}


// this function is reponsival for validate the email 
function validateEmail(email_input) {
    var email_value = email_input.value;
    var data = email_value.match(
        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
    if (data == null) {
        setError(email_input, "Is Invalid Please Enter valid Email", "red")
        return false
    } else {
        setError(email_input, " ", "green")
        return true;
    }
}

// this function is reponsival for validate the phone number 
// for correctly use this function please add  input type = 'phone'
function validatePhone(phone_input) {
    var phone_value = phone_input.value;
    var data = phone_value.match(
        /^[1-9]\d{9}$/
    );
    if (data == null) {
        setError(phone_input, "Is Invalid Please Enter valid " + phone_input.name + " number", "red")
        return false
    } else {
        setError(phone_input, " ", "green");
        return true;
    }
}

// this function is reponsival for validate the phone number 
// for correctly use this function please add  input type = 'phone'
function validateUrl(url_input) {
    var url_value = url_input.value;
    var data = url_value.match(
        /(?:https?):\/\/(\w+:?\w*)?(\S+)(:\d+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/
    );
    if (data == null) {
        setError(url_input, "Is Invalid Please Enter valid " + url_input.name + " url", "red")
        return false
    } else {
        setError(url_input, " ", "green")
        return true;
    }
}

function validateSelect(select_input) {
    if (select_input.required && select_input[select_input.selectedIndex].disabled) {
        setError(select_input, " is Required filed please Input", "red")
        return false
    } else {
        setError(select_input, " ", "green")
        return true;
    }
}






// for replacing _ underscore into the empty space
// for workig smothly please use class form-group
underscore_remover();
function underscore_remover() {
    var form_group = document.getElementsByClassName('form-group');
    try {
        for (i = 0; i <= form_group.length; i++) {
            var all_child_nodes = form_group[i].childNodes;
            all_child_nodes[1].innerText = all_child_nodes[1].innerText.replaceAll("_", " ");
            var all_placeholder = all_child_nodes[3].placeholder;
            if (all_placeholder != null) {
                all_child_nodes[3].placeholder = all_child_nodes[3].placeholder.replaceAll("_", " ");

            }
        }
    } catch (err) {

    }
}