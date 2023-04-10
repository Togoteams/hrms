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
            document.getElementById(target_id).innerHTML = this.responseText;
            stopPreloader('', target_id);
        }
    };
    if (table_id != '') {
        url_name = url_name + "?id=" + table_id
    }
    xhttp.open(method, url_name, true);
    xhttp.send();
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
              formElements_button.disabled=true
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


function formValidate(el, form_id) {
    var flag = true;
    for (f = 0; f < el.length; f++) {

        if (el[f].required && el[f].value == '') {
            setError(el[f], " is Required filed please Input", form_id)
            flag = false;
        }

        if ('max' in el && el[f].value <= el[f].max) {
            setError(el[f], " is Required filed please Input", form_id)
            flag = false;
        }

    }
    return flag;
}

function backEndValidate(responseData, target_id) {
    var obj = JSON.parse(responseData);
    if ("success" in obj) {
        setSuccess(obj['success'], target_id)

    }
    else if ("delete" in obj) {
        setDelete(obj['delete'], target_id)
    }
    else {
        for (let key in obj) {
            let value;
            // get the value
            value = obj[key];
            var return_element = document.getElementsByName(key)
            var element = return_element[return_element.length - 1];
            setError(element, value, target_id)
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

function setError(el, errr_message, form_id) {
    createdd_element = createMenuItem("p", {
        name: el.name + " - " + el.name + "  " + errr_message,
        class: "text-danger",
        id: "lol",
        size: "13px",
    });
    el.style.borderColor = "#dc3545"
    form_id.appendChild(createdd_element);
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
