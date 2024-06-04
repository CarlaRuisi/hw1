
function show_info(event){
    const info_dropdown=event.currentTarget;
    const content=info_dropdown.querySelector(".dropdown_content");
    console.log(info_dropdown);
    content.classList.add("show");
    content.classList.remove("hide");
    content.classList.remove("hidden");
    info_dropdown.removeEventListener("click",show_info);
    info_dropdown.addEventListener("click",hidden_info)
}

function hidden_info(event){
    const info_dropdown=event.currentTarget;
    const content=info_dropdown.querySelector(".dropdown_content");
    content.classList.remove("show");
    content.classList.add("hide");
    info_dropdown.removeEventListener("click",hidden_info);
    info_dropdown.addEventListener("click",show_info)
}

function show_info_profile(event){
    const info_dropdown=event.currentTarget;
    const content=info_dropdown.querySelector(".dropdown_content");
    console.log(info_dropdown);
    content.classList.add("show_setting");
    content.classList.remove("hide_setting");
    content.classList.remove("hidden");
    info_dropdown.removeEventListener("click",show_info_profile);
    info_dropdown.addEventListener("click",hidden_info_profile)
}

function hidden_info_profile(event){
    const info_dropdown=event.currentTarget;
    const content=info_dropdown.querySelector(".dropdown_content");
    content.classList.remove("show_setting");
    content.classList.add("hide_setting");
    info_dropdown.removeEventListener("click",hidden_info_profile);
    info_dropdown.addEventListener("click",show_info_profile)
}


const info=document.querySelector("#info_dropdown");
const profile=document.querySelector("#Profile");
info.addEventListener("click",show_info);
profile.addEventListener("click",show_info_profile);

function remove_background(event){
    const element = event.currentTarget;
    element.classList.remove("select_background");
    element.removeEventListener("mouseout", remove_background);
    element.addEventListener("mouseover", background);
}

function background(event){
    const element = event.currentTarget;
    element.classList.add("select_background");
    element.removeEventListener("mouseover", background);
    element.addEventListener("mouseout", remove_background);
}

const tr = document.querySelectorAll('tr');
for (let i of tr){
    i.addEventListener("mouseover", background);
}

const content=document.querySelectorAll(".content");
for (let i of content){
    i.addEventListener("mouseover",background);
}

function addhidden(event){
    const element=event.currentTarget;
    const elenco=element.parentNode.querySelector("#elenco");
    elenco.classList.add("hidden");
    element.textContent="Scoprì di più";
    element.addEventListener("click",removehidden);
    element.removeEventListener("click",addhidden);
}

function removehidden(event){
    const element=event.currentTarget;
    const elenco=element.parentNode.querySelector("#elenco");
    elenco.classList.remove("hidden");
    element.textContent="Nascondi";
    element.removeEventListener("click",removehidden);
    element.addEventListener("click",addhidden);
}
const button=document.querySelector("#button_option");
button.addEventListener("click",removehidden);


function dropdownshow(event){
    const element=event.currentTarget;
    const down=element.querySelector("#down");
    const up=element.querySelector("#up")
    const succ=element.nextElementSibling;
    succ.classList.add('hidden');
    down.classList.remove("hidden");
    up.classList.add("hidden");
    element.removeEventListener("click",dropdownshow);
    element.addEventListener("click",dropdownhidden);
}
function dropdownhidden(event){
    const element=event.currentTarget;
    const down=element.querySelector("#down");
    const up=element.querySelector("#up")
    const succ=element.nextElementSibling;
    succ.classList.remove('hidden');
    down.classList.add("hidden");
    up.classList.remove("hidden");
    element.removeEventListener("click",dropdownhidden);
    element.addEventListener("click",dropdownshow);
}

const dropdown=document.querySelectorAll("#section_info");
    for(let i of dropdown){
        i.addEventListener("click",dropdownhidden);
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