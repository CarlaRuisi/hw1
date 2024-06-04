function Delete(json){
    console.log(json.exists);
    const container=document.querySelector(".navbar_option");
    const form=container.querySelector("form");
    console.log(form);
    if(json.exists){
        form.classList.remove('hidden');
    }
    else{
        form.classList.add('hidden');
        favourite.textContent="Impossibile cancellare la tua preferenza"
    }

}
function dislikeartist(event){
    console.log(event.currentTarget);
    const like=event.currentTarget;
    let id=like.getAttribute("id");
    console.log(id);
    fetch("DeleteArtist.php?q="+encodeURIComponent(id)).then(ResponseJson).then(Delete);
}
function dislikealbum(event){
    console.log(event.currentTarget);
    const like=event.currentTarget;
    let id=like.getAttribute("id");
    console.log(id);
    fetch("DeleteAlbum.php?q="+encodeURIComponent(id)).then(ResponseJson).then(Delete);
}
function dislikeaudio(event){
    console.log(event.currentTarget);
    const like=event.currentTarget;
    let id=like.getAttribute("id");
    console.log(id);
    fetch("DeleteAudio.php?q="+encodeURIComponent(id)).then(ResponseJson).then(Delete);
}
function disliketracks(event){
    console.log(event.currentTarget);
    const like=event.currentTarget;
    let id=like.getAttribute("id");
    console.log(id);
    fetch("DeleteTracks.php?q="+encodeURIComponent(id)).then(ResponseJson).then(Delete);
}

function Album(json){
    console.log(json);
    const container=document.querySelector("#favourite");
    container.classList.remove("animation");
    container.innerHTML="";
    if(json.length==0){
        container.textContent="Non hai Album Preferiti";
        container.classList.add("error");
    }else{
        container.classList.add("animation");
        const header=document.createElement("div");
        const images_text=document.createElement("h2");
        const name_text=document.createElement("h2");
        const artist_text=document.createElement("h2");
        const total_text=document.createElement("h2");
        const remove_text=document.createElement("h2");
        images_text.textContent="Immagine";
        name_text.textContent="Album";
        artist_text.textContent="Artista";
        total_text.textContent="total tracks";
        remove_text.textContent="Remove"
        header.appendChild(images_text);
        header.appendChild(name_text);
        header.appendChild(artist_text);
        header.appendChild(total_text);
        header.appendChild(remove_text);
        header.classList.add("flex_around_favourite");
        container.appendChild(header);
        json.forEach(album=>{
        const artist_container=document.createElement("div");
        artist_container.classList.add("flex_around_favourite");
        const image=document.createElement("img");
        image.src=album.image;
        const name=document.createElement("h2");
        name.textContent=album.album;
        let lunghezza=name.textContent.length;
        console.log(lunghezza);
        if(lunghezza>10){
            name.classList.add("text_overflow");
        }
        const total_tracks=document.createElement("h3");
        total_tracks.textContent=album.total_tracks;
        const artist=document.createElement("h3");
        artist.textContent=album.artist;
        const dislike=document.createElement("img");
        dislike.src="img/dislike.png";
        dislike.classList.add('like');
        dislike.setAttribute("id",album.id_album);
        dislike.addEventListener("click",dislikealbum);
        artist_container.appendChild(image);
        artist_container.appendChild(name);
        artist_container.appendChild(artist);
        artist_container.appendChild(total_tracks);
        artist_container.appendChild(dislike);
        container.appendChild(artist_container);

        });
    }
}
function Audiosearch(json){
    console.log(json);
    const container=document.querySelector("#favourite");
    container.classList.remove("animation");
    container.innerHTML="";
    if(json.length==0){
        container.textContent="Non hai AudioBook nei Preferiti";
        container.classList.add("error");
    }else{
        container.classList.add("animation");
        const header=document.createElement("div");
        const images_text=document.createElement("h2");
        const title_text=document.createElement("h2");
        const author_text=document.createElement("h2");
        const publisher_text=document.createElement("h2");
        const remove_text=document.createElement("h2");
        images_text.textContent="Immagine";
        title_text.textContent="Title";
        author_text.textContent="Author";
        publisher_text.textContent="Publisher";
        remove_text.textContent="Remove"
        header.appendChild(images_text);
        header.appendChild(title_text);
        header.appendChild(author_text);
        header.appendChild(publisher_text);
        header.appendChild(remove_text);
        header.classList.add("flex_around_favourite");
        container.appendChild(header);
        json.forEach(audio=>{
            const audio_container=document.createElement("div");
            audio_container.classList.add("flex_around_favourite");
            const image=document.createElement("img");
            image.src=audio.image;
            const title=document.createElement("h2");
            title.textContent=audio.audio;
            let lunghezza=title.textContent.length;
            console.log(lunghezza);
            if(lunghezza>10){
                title.classList.add("text_overflow");
            }
            const name=document.createElement("h2");
            name.textContent=audio.authors;
            const publisher=document.createElement("h3");
            publisher.textContent=audio.publisher;
            const dislike=document.createElement("img");
            dislike.src="img/dislike.png";
            dislike.classList.add('like');
            dislike.setAttribute("id",audio.id_audio);
            dislike.addEventListener("click",dislikeaudio);
            audio_container.appendChild(image);
            audio_container.appendChild(title);
            audio_container.appendChild(name);
            audio_container.appendChild(publisher);
            audio_container.appendChild(dislike);
            container.appendChild(audio_container);
            });
    }
}
function Brani(json){
    console.log(json);
    const container=document.querySelector("#favourite");
    container.classList.remove("animation");
    container.innerHTML="";
    if(json.length==0){
        container.textContent="Non hai Brani nei Preferiti";
        container.classList.add("error");
    }else{
        container.classList.add("animation");
        const header=document.createElement("div");
        const images_text=document.createElement("h2");
        const title_text=document.createElement("h2");
        const artist_text=document.createElement("h2");
        const album_text=document.createElement("h2");
        const remove_text=document.createElement("h2");
        images_text.textContent="Immagine";
        title_text.textContent="Title";
        artist_text.textContent="Artist";
        album_text.textContent="Album";
        remove_text.textContent="Remove"
        header.appendChild(images_text);
        header.appendChild(title_text);
        header.appendChild(artist_text);
        header.appendChild(album_text);
        header.appendChild(remove_text);
        header.classList.add("flex_around_favourite");
        container.appendChild(header);
        json.forEach(track=>{
            const track_container=document.createElement("div");
            track_container.classList.add("flex_around_favourite");
            const image=document.createElement("img");
            image.src=track.image;
            const name=document.createElement("h2");
            name.textContent=track.title;
            const artist=document.createElement("h3");
            artist.textContent=track.artist;
            const album=document.createElement("h3");
            album.textContent=track.album;
            let lunghezza=album.textContent.length;
            console.log(lunghezza);
            if(lunghezza>10){
                album.classList.add("text_overflow");
            }
            const dislike=document.createElement("img");
            dislike.src="img/dislike.png";
            dislike.classList.add('like');
            dislike.setAttribute("id",track.id_tracks);
            dislike.addEventListener("click",disliketracks);
            track_container.appendChild(image);
            track_container.appendChild(name);
            track_container.appendChild(artist);
            track_container.appendChild(album);
            track_container.appendChild(dislike);
            container.appendChild(track_container);
         });
     }
}

function Artist(json){
    console.log(json);
    const container=document.querySelector("#favourite");
    container.classList.remove("animation");
    container.innerHTML="";
    if(json.length==0){
        container.textContent="Non hai Artisti Preferiti";
        container.classList.add("error");
    }else{
        container.classList.add("animation");
        const header=document.createElement("div");
        const images_text=document.createElement("h2");
        const title_text=document.createElement("h2");
        const artist_text=document.createElement("h2");
        const remove_text=document.createElement("h2");
        images_text.textContent="Immagine";
        title_text.textContent="Artist";
        artist_text.textContent="Follower";
        remove_text.textContent="Remove"
        header.appendChild(images_text);
        header.appendChild(title_text);
        header.appendChild(artist_text);
        header.appendChild(remove_text);
        header.classList.add("flex_around_favourite");
        container.appendChild(header);
         json.forEach(artist=>{
        const artist_container=document.createElement("div");
        artist_container.classList.add("flex_around_favourite");
        const image=document.createElement("img");
        image.src=artist.image;
        const name=document.createElement("h2");
        name.textContent=artist.artist;
        const follower=document.createElement("h3");
        const dislike=document.createElement("img");
        dislike.src="img/dislike.png";
        dislike.classList.add('like');
        dislike.setAttribute("id",artist.id_artist);
        dislike.addEventListener("click",dislikeartist);
        follower.textContent=artist.follower;
        artist_container.appendChild(image);
        artist_container.appendChild(name);
        artist_container.appendChild(follower);
        artist_container.appendChild(dislike);
        container.appendChild(artist_container);
        });
    }
}

function ResponseJson(response){
    if (!response.ok) return null;
    return response.json();
}

function showartist(event){
    const artist=event.currentTarget;
    const container=document.querySelector("#favourite");
    container.classList.remove("hidden");
    fetch("searchartist.php").then(ResponseJson).then(Artist);
}
function showbrani(event){
    console.log("ciao");
    const brani=event.currentTarget;
    const container=document.querySelector("#favourite");
    container.classList.remove("hidden");
    fetch("searchbrani.php").then(ResponseJson).then(Brani);
 
}
function showaudio(event){
    console.log("ciao");
    const container=document.querySelector("#favourite");
    container.classList.remove("hidden");
    fetch("searchaudio.php").then(ResponseJson).then(Audiosearch);
 
}
function showalbum(event){
    console.log("ciao");
    const container=document.querySelector("#favourite");
    container.classList.remove("hidden");
    fetch("searchalbum.php").then(ResponseJson).then(Album);
 
}
const artist=document.querySelector("#artist");
console.log(artist);
artist.addEventListener("click",showartist);
const brani=document.querySelector("#brani");
console.log(brani);
brani.addEventListener("click",showbrani);
const audio=document.querySelector("#audio");
audio.addEventListener("click",showaudio);
const album=document.querySelector("#album");
album.addEventListener("click",showalbum);


const observerLeftToRight = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("show_transition_DOWNTOP");
      }
    });
  });
const hiddenLeftRigth = document.querySelectorAll(".hidden_transition_DOWNTOP");
hiddenLeftRigth.forEach((hidden) => observerLeftToRight.observe(hidden));