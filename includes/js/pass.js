 var state = false;


    function togle() {
        let pass = document.querySelector("#eye")
        if (state) {
            document.getElementById("pass").setAttribute("type", "password");
            pass.classList.remove("blue")
            state = false;
        } else {
            document.getElementById("pass").setAttribute("type", "text");
            state = true;
           
            pass.classList.add("blue")
            state = true;
        }

    }

    function toggle() {
        let pass = document.querySelector("#eyeq")
        if (state) {
            document.getElementById("passw").setAttribute("type", "password");
            pass.classList.remove("blue")
            state = false;
        } else {
            document.getElementById("passw").setAttribute("type", "text");
         
            pass.classList.add("blue")
            state = true;
        }

    }
    function opener() {

        let openers = document.querySelector(".pop")

        openers.classList.add("show")
        let opened = document.querySelector(".signup")
        opened.classList.add("hide")
        
    }


