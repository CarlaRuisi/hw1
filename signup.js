function JsonUsername(json){
    console.log(json.exists)
    if (!json.exists) {
        const element=document.querySelector('.username');
        const span=element.nextElementSibling;
        span.classList.remove("hidden");
        span.querySelector('span').textContent="Userame già in uso";

    } else {
        const element=document.querySelector('.username');
        const span=element.nextElementSibling;
        span.classList.add("hidden");
    }
}

function JsonEmail(json){
    console.log(json.exists);
    if (!json.exists) {
        const element=document.querySelector('.email');
        const span=element.nextElementSibling;
        span.classList.remove("hidden")
        span.querySelector('span').textContent="email già in uso";

    } else {
        const element=document.querySelector('.email');
        const span=element.nextElementSibling;
        span.classList.add("hidden")
    }
}


function fetchResponse(response){
    if (!response.ok) return null;
    return response.json();
}
function checknome(event){
const input=event.currentTarget;
const container=input.parentNode;
if(input.value==0){
    const error=container.nextElementSibling;
    error.classList.remove("hidden");
}
else{
    const error=container.nextElementSibling;
    error.classList.add("hidden");
}
}
function checksurname(event){
    const input=event.currentTarget;
    const container=input.parentNode;
    if(input.value==0){
        const error=container.nextElementSibling;
        error.classList.remove("hidden");
    }
    else{
        const error=container.nextElementSibling;
        error.classList.add("hidden");
    }
}

function checkusername(event){
    const input=event.currentTarget;
    const container=input.parentNode;
    if(!/^[a-zA-Z0-9_]{4,15}$/.test(input.value)){
        const error=container.nextElementSibling;
        error.classList.remove("hidden");
        error.querySelector('span').textContent="Sono ammesse lettere, numeri e underscore. Max. 15";
    }
    else{
        const error=container.nextElementSibling;
        error.classList.add("hidden");
        fetch("check_username.php?q="+encodeURIComponent(input.value)).then(fetchResponse).then(JsonUsername);
    }
}

function checkemail(event){
    const input=event.currentTarget;
    const container=input.parentNode;
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(input.value).toLowerCase())){
        const error=container.nextElementSibling;
        error.classList.remove("hidden");
        error.querySelector('span').textContent="Email non valida";
    }
    else{
        const error=container.nextElementSibling;
        error.classList.add("hidden");
        fetch("check_email.php?q="+encodeURIComponent(String(input.value).toLowerCase())).then(fetchResponse).then(JsonEmail);
    }
}

function equalsemail(event){
    const input=event.currentTarget;
    const container=input.parentNode;
    const email=document.querySelector(".email input");
    if(input.value!=email.value){
        const error=container.nextElementSibling;
        error.classList.remove("hidden");
    }
    else{
        const error=container.nextElementSibling;
        error.classList.add("hidden");
    }
}

function checkpassword(event){
    const input=event.currentTarget;
    const container=input.parentNode;
    if(input.value<5){
        const error=container.nextElementSibling;
        error.classList.remove("hidden");
    }
    else{
        const error=container.nextElementSibling;
        error.classList.add("hidden");
    }
}

function equlaspassword(event){
    const input=event.currentTarget;
    const container=input.parentNode;
    const password=document.querySelector(".password input");
    if(input.value!=password.value){
        const error=container.nextElementSibling;
        error.classList.remove("hidden");
    }
    else{
        const error=container.nextElementSibling;
        error.classList.add("hidden");
    }
}
function checkall(event) {
    if (Object.keys(formStatus).length !== 9 || Object.values(formStatus).includes(false)) {
        event.preventDefault();
    }
}





const formStatus = {'upload': true};
const nome=document.querySelector(".name input");
const surname=document.querySelector(".surname input");
const username=document.querySelector(".username input");
const email=document.querySelector(".email input");
const check_email=document.querySelector(".check_email input");
const password=document.querySelector(".password input");
const check_password=document.querySelector(".check_password input");
const allow=document.querySelector(".allow input");
nome.addEventListener("blur",checknome);
allow.addEventListener("submit",checkall);
check_password.addEventListener("blur",equlaspassword);
password.addEventListener("blur",checkpassword);
check_email.addEventListener("blur",equalsemail);
email.addEventListener("blur",checkemail);
username.addEventListener("blur",checkusername);
surname.addEventListener("blur",checksurname);