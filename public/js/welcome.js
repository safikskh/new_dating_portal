// ************************
// scrollifysection script
// ************************
$(function () {
    $.scrollify({
        section: ".scrollifysection",
    });
});

// ************************
// signup validation script
// ************************
var currentTab = 0; // Current tab is set to be the first tab (0)
var status = true; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab

function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n > 1) {
        // document.getElementById("prevBtn").style.display = "none";
        document.getElementById("nextBtn").style.float = "right";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Tilmeld";
    } else {
        document.getElementById("nextBtn").innerHTML = "næste";
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
}

function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= x.length) {
        // ... the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
}

function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, array, valid = true;
    var error = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // e = $("input[name='email']").val();
    array = {};
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
        // If a field is empty...
        array[y[i]['name']] = y[i]['value'];
        // array[i] = '{'+y[i].name + ':' + y[i].value+ '}';
        if (y[i].value == "") {

            if (y[i].className != "abc" ) {
                if (y[i].name != "matchWords" ) {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
                // emailValidate(e);
                }
            }
        }
    }
    console.log("full object : ", array);
    if (valid){
    $.ajax({
        type: "POST",
        async: false,
        data: {
            tab: currentTab,
            object: array,
        },
        url: "/validate",
        datatype: "JSON",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        success: function (data) {
            console.log("tab: (", currentTab ,") server response: ", data);
            if (data == 0) {
                valid = false;
            }else if(data == 3){
                document.getElementById("doberror").className = "text-danger";
                valid = false;
            }else if(data == 4){
                document.getElementById("usernameerror").innerHTML = "username already exists";
                valid = false;
            }
        },
        fail: function (e) {
            console.log(e);
        }
    });
}
    console.log("error outer: ", valid);

    z = x[currentTab].getElementsByTagName("select");

    for (i = 0; i < z.length; i++) {
        // If a field is empty...
        if (z[i].value == "") {
            // add an "invalid" class to the field:
            z[i].className += " invalid";
            // and set the current valid status to false
            valid = false;
        }
    }

    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
}

function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
}
