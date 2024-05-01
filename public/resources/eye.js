
function eyeClick() {
    const password = document.getElementById("password1")
    const eye = document.getElementById("eye1")
    // document.getElementById("eye").className = "fas fa-eye-slash"
    const type = password.getAttribute("type") === "password" ? "text" : "password"

    if (password.getAttribute("type") === "password") {

        document.getElementById("eye1").className = "fas fa-eye-slash"

    } else {

        document.getElementById("eye1").className = "fas fa-eye"

    }
    
    password.setAttribute("type", type)
}





function testEye() {
    const password = document.getElementById("password2")
    const eye = document.getElementById("eye2")
    // document.getElementById("eye").className = "fas fa-eye-slash"
    const type = password.getAttribute("type") === "password" ? "text" : "password"

    if (password.getAttribute("type") === "password") {

        document.getElementById("eye2").className = "fas fa-eye-slash"
    } else {

        document.getElementById("eye2").className = "fas fa-eye"
    }
    password.setAttribute("type", type)
}



