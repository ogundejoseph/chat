lastActive = document.querySelector("#status");

setInterval(()=>{
    let xhr = new XMLHttpRequest(); //creating XML object
    xhr.open("POST", "php/status.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                lastActive.innerHTML = data;
            }
        }
    }
    
    xhr.send();
},  1000);

let userId = document.querySelector('#incoming_id').value;
document.cookie = "userId =" + userId;