const image=[
    "img/logo.png",
    "img/violet.png",
    "img/visa.png",
    "img/mastercard.png",
    "img/paypal.png",
    "img/american.png",
    "img/logo_intero.png"
];

let count=0;
const immagini=document.querySelectorAll(".container_image");
for(let i of immagini){
    const insertimg=document.createElement("img");
    insertimg.src=image[count];
    count++;
    i.appendChild(insertimg);
}