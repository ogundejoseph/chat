const pswrdField = document.querySelector("#p1"),
toggleBtn = document.querySelector("#i1");
const pswrdField2 = document.querySelector("#p2"),
toggleBtn2 = document.querySelector("#i2");

toggleBtn.onclick = ()=>{
    if(pswrdField.type == "password"){
        pswrdField.type = "text";
        toggleBtn.classList.add("active");
    }else{
        pswrdField.type = "password";
        toggleBtn.classList.remove("active");
    }
}

toggleBtn2.onclick = ()=>{
    if(pswrdField2.type == "password"){
        pswrdField2.type = "text";
        toggleBtn2.classList.add("active");
    }else{
        pswrdField2.type = "password";
        toggleBtn2.classList.remove("active");
    }
}