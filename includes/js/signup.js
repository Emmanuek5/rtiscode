const form = document.querySelector(".form"),
    URL = form.querySelector("input"),
    Btn = form.querySelector(".btn"),
    user = form.querySelector(".username")
    emails = form.querySelector(".email")
    infoBox = form.querySelector(".pop")
    let error = form.querySelector(".error-text")
form.onsubmit = (e) => {
    e.preventDefault();
}

Btn.onclick = () => {
    
    let xhr2 = new XMLHttpRequest();
  let  bbs=  xhr2.open("POST", "/rtis/php/signup", true);
    xhr2.onload = () => {
        if (xhr2.readyState == 4 && xhr2.status == 200) {
            let data = xhr2.response;
            if (data == "success") {
  
                error.innerHTML(data)
        
            
            } else {
              
             
            }
        }
    }
    let username = user.value;
    let email = emails.value;
    xhr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   bb =  xhr2.send("username=" +username + "&hidden_url=" +email);
   alert(xhr2.OPENED)
   
                }