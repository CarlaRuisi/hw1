

function JsonCheckUserName(json){
    const form=document.querySelector("input[name=username]").parentNode;
    const span=form.querySelector("span");
    if(!json.exists){
        span.classList.remove("hidden");
        span.textContent="Username già esistente";
    }else if(json.exists==='impossible'){
        span.classList.remove("hidden");
        span.textContent="Impossibile inserire nuovo username";
    }else if(json.exists){
        span.classList.add("hidden");
        const submit=form.querySelector("input[type=submit]");
        submit.classList.remove("hidden");
    }

}
function JsonCheckEmail(json){
    const form=document.querySelector("input[name=email]").parentNode;
    const span=form.querySelector("span");
    if(!json.exists){
        span.classList.remove("hidden");
        span.textContent="Email già esistente";
    }else if(json.exists==='impossible'){
        span.classList.remove("hidden");
        span.textContent="Impossibile inserire la nuova email";
    }else if(json.exists){
        span.classList.add("hidden");
        const submit=form.querySelector("input[type=submit]");
        submit.classList.remove("hidden");
    }

}

function JsonResponse(response){
    if (!response.ok) return null;
    return response.json();
}
function search(event){
    console.log("ciao");
    const input=event.currentTarget;
    const container=input.parentNode;
    const span=input.parentNode.querySelector("span");

    if(input.getAttribute("name")==="name"){
        if(input.value==0){
            span.classList.remove("hidden");
            span.textContent="Inserisci il nome"
        }
        else{
            span.innerHTML="";
            const submit=container.querySelector("input[type=submit]");
            console.log(submit);
            submit.classList.remove("hidden");
        }
    }

    else if(input.getAttribute("name")==="surname"){
            if(input.value==0){
                span.classList.remove("hidden");
                span.textContent="Inserisci il cognome"
            }
            else{
                span.innerHTML="";
                const submit=container.querySelector("input[type=submit]");
                console.log(submit);
                submit.classList.remove("hidden");
            }
    }

    else if(input.getAttribute("name")==="username"){
            if(input.value==0){
                span.classList.remove("hidden");
                span.textContent="Inserisci l'username"
            }
            else{
                fetch("insertusername.php?q="+encodeURIComponent(input.value)).then(JsonResponse).then(JsonCheckUserName);
            }
    }

    else if(input.getAttribute("name")==="email"){
            if(input.value==0){
                span.classList.remove("hidden");
                span.textContent="Inserisci la email"
            }
            else if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(input.value).toLowerCase())){
                span.classList.remove("hidden");
                span.textContent="Email non valida"
            }else{
                fetch("insertemail.php?q="+encodeURIComponent(String(input.value))).then(JsonResponse).then(JsonCheckEmail);
            }
    }
    else if(input.getAttribute("name")==="password"){
            const svg=input.parentNode.parentNode.querySelector("#emoji");
            console.log(svg);
            console.log(input.value);
            svg.classList.add("hidden")
            if(input.value==0){
                span.classList.remove("hidden");
                span.textContent="Inserisci la password";
            }
            else if((input.value).length<5){
                span.classList.remove("hidden");
                span.textContent="Troppo piccola, DEVE ESSERE MAGGIORE DI 5";
            }
            else{
                span.innerHTML="";
                const submit=container.querySelector("input[type=submit]");
                console.log(submit);
                submit.classList.remove("hidden");
            }
    }
}


function Modifica(event){
    const element=event.currentTarget;
    const form=element.nextElementSibling;
    const input=form.querySelector("input");
    element.classList.add("hidden");
    form.classList.remove("hidden");
    element.removeEventListener("click",Modifica);
    if(input.getAttribute('type')=='text'){
    form.querySelector("input[type=text]").addEventListener("blur",search);
    }else{
        console.log('io');
    form.querySelector("input[type=password]").addEventListener("blur",search);
    }

}


const button=document.querySelectorAll("#setting button");
for(let i of button){
    i.addEventListener("click",Modifica);
}

const observerLeftToRight = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("show_transition_DOWNTOP");
      }
    });
  });
const hiddenLeftRigth = document.querySelectorAll(".hidden_transition_DOWNTOP");
hiddenLeftRigth.forEach((hidden) => observerLeftToRight.observe(hidden));