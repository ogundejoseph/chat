const form = document.querySelector(".setting form"),
submitBtn = form.querySelector("#submit"),
errorText = form.querySelector(".setting .error-text");

form.onsubmit = (e)=>{
    e.preventDefault(); //preventing form from submitting
}

submitBtn.onclick = ()=>{
    //let's start Ajax
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "php/setting.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "Successfull. "){
                    errorText.style.background = "lightgreen";
                    errorText.style.color = "green";
                    errorText.style.display = "block";
                    errorText.textContent = data;
                    setTimeout(()=>{
                        location.href = "setting.php";
                    }, 2000);
                }else{
                    errorText.style.display = "block";
                    errorText.textContent = data;
                }
            }
        }
    }
    // we have to send the form data through ajax to php
    let formData = new FormData(form); //creating new form object
    xhr.send(formData); //sending the form data to php
}
