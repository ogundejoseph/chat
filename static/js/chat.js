const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e)=>{
    e.preventDefault(); //preventing form from submitting
}

sendBtn.onclick = ()=>{
   //let's start Ajax
   let xhr = new XMLHttpRequest(); //creating XML object
   xhr.open("POST", "php/insert-chat.php", true);
   xhr.onload = ()=>{
       if(xhr.readyState === XMLHttpRequest.DONE){
           if(xhr.status === 200){
              inputField.value = ""; //once message is inserted into database input field is left blank
              scrollToBottom();
           }
       }
   }
   // we have to send the form data through ajax to php
   let formData = new FormData(form); //creating new form data object
   xhr.send(formData); //sending the form to php       
}

chatBox.classList.add("active");

setInterval(()=>{
    //let's start Ajax
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains("active")){ //if active class not contains in chatbox the scroll to bottom
                    scrollToBottom();
                }
            }
        }
    }
    
    // we have to send the form data through ajax to php
    let formData = new FormData(form); //creating new form data object
    xhr.send(formData); //sending the form to php
},  1000); //this function will run frequently after 1000ms

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}

sendBtn.disabled = true;
inputField.onkeyup = () => {
    if(inputField.value.length > 0) {
        sendBtn.disabled = false;
        console.log(inputField.value.length);
    } else {
        sendBtn.disabled = true;
    }
}


