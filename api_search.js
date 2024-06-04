function Save(json){
    console.log(json);
}
function Delete(json){
    console.log(json);
}
function ResponseJson(response){
    if (!response.ok) return null;
    return response.json();
}
function savetracks(event){
    const like_click=event.currentTarget;
    const container=like_click.parentNode;
    const id=like_click.dataset.id;
    fetch("searchtrackbyid.php?q="+encodeURIComponent(id)).then(function ResponseTrack(response){
        return response.json();
    }).then(function SearchTrack(json){
        console.log(json);
        if(json.length>0){
            like_click.classList.remove('like');
            fetch("DeleteTracks.php?q="+encodeURIComponent(id)).then(ResponseJson).then(Delete);
        }else{
            like_click.classList.add('like');
            const form=new FormData();
            form.append("id_track",container.querySelector("#id_track").textContent)
            form.append('title',container.querySelector("#title").textContent);
            form.append("image",container.querySelector("#image_spotify").src);
            form.append("artist",container.querySelector("#artist").textContent);
            form.append("album",container.querySelector("#album").textContent);
            fetch("savetracks.php", {method: 'post', body: form}).then(ResponseJson).then(Save);
            event.stopPropagation();
        }
    });
}
function saveaudio(event){
    const like_click=event.currentTarget;
    const id=like_click.dataset.id;
    const container=like_click.parentNode;
    fetch("searchaudiobyid.php?q="+encodeURIComponent(id)).then(function ResponseAudio(response){
        return response.json();
    }).then(function SearchAudio(json){
        console.log(json);
        if(json.length>0){
            like_click.classList.remove('like');
            fetch("DeleteAudio.php?q="+encodeURIComponent(id)).then(ResponseJson).then(Delete);
        }else{
            like_click.classList.add('like');
            const form=new FormData();
            form.append("id_audio",container.querySelector("#id_audio").textContent);
            form.append('audio',container.querySelector("#nameaudio").textContent);
            form.append("image",container.querySelector("#image_spotify").src);
            form.append("authors",container.querySelector("#authors").textContent);
            form.append("publisher",container.querySelector("#publisher").textContent);
            fetch("saveaudio.php", {method: 'post', body: form}).then(ResponseJson).then(Save);
            event.stopPropagation();
        }
    });

}
function savealbum(event){
    const like_click=event.currentTarget;
    const id=like_click.dataset.id;
    const container=like_click.parentNode;
    const form=new FormData();
    fetch("searchalbumbyid.php?q="+encodeURIComponent(id)).then(function ResponseAlbum(response){
        return response.json();
    }).then(function SearchAlbum(json){
        console.log(json);
        if(json.length>0){
            like_click.classList.remove('like');
            fetch("DeleteAlbum.php?q="+encodeURIComponent(id)).then(ResponseJson).then(Delete);
        }else{
            like_click.classList.add('like');
            const form=new FormData();
            form.append("id_album",container.querySelector("#id_album").textContent)
            form.append('album',container.querySelector("#namealbum").textContent);
            form.append("image",container.querySelector("#image_spotify").src);
            form.append("total_tracks",container.querySelector("#total_tracks").textContent);
            form.append("artist",container.querySelector("#artist").textContent);
            fetch("savealbum.php", {method: 'post', body: form}).then(ResponseJson).then(Save);
            event.stopPropagation();
        }
    });
}
   

function saveartist(event){
    const like_click=event.currentTarget;
    const container=like_click.parentNode;
    const id=like_click.dataset.id;
    fetch("searchartistbyid.php?q="+encodeURIComponent(id)).then(function ResponseArtist(response){
        return response.json();
    }).then(function SearchArtist(json){
        console.log(json);
        if(json.length>0){
            like_click.classList.remove('like');
            fetch("DeleteArtist.php?q="+encodeURIComponent(id)).then(ResponseJson).then(Delete);
        }else{
            like_click.classList.add('like');
            const form=new FormData();
            form.append("id_artist",container.querySelector("#id_artist").textContent)
            form.append('nameartist',container.querySelector("#nameartist").textContent);
            form.append("image",container.querySelector("#image_spotify").src);
            form.append("type",container.querySelector("#type").textContent);
            form.append("follower",container.querySelector("#follower").textContent);
            fetch("saveartist.php", {method: 'post', body: form}).then(ResponseJson).then(Save);
            event.stopPropagation();
        }
    });
}
 





function JsonTokenArtist(json){
    console.log(json.artists);
    const container=document.querySelector("#result_spotify");
    const base_container=document.querySelector("#result");
    base_container.classList.add("scroll");
    container.innerHTML="";
    let artist=json.artists.items;
    let array_length=json.artists.items.length;
    console.log(array_length);
    if(array_length>12){
        array_length=12;
    }
    else if(array_length==0){
        base_container.textContent="Nessun Risultato";
        base_container.classList.add("error");
    }
    for(let i=0;i<array_length;i++){
        const divartist=document.createElement("div");
        divartist.classList.add("card");
        const id_artist=document.createElement("p");
        id_artist.textContent=artist[i].id;
        id_artist.setAttribute("id","id_artist");
        id_artist.classList.add("hidden");
        const name=document.createElement("h1");
        name.setAttribute("id","nameartist");
        name.textContent=artist[i].name;
        let lunghezza=name.textContent.length;
        console.log(lunghezza);
        if(lunghezza>10){
            name.classList.add("text_overflow");
        }
        console.log(name);
        const image=document.createElement('img');
        image.setAttribute("id","image_spotify");
        if(artist[i].images.length==0){
            image.src="img/error.png"
        }else{
            image.src=artist[i].images[0].url;
        }
        const like=document.createElement("img");
        like.setAttribute("id","addlike");
        like.setAttribute("data-value","Artist");
        like.setAttribute("data-id",artist[i].id);
        like.src="img/like.png";
        fetch("searchartistbyid.php?q="+encodeURIComponent(artist[i].id)).then(function ResponseArtist(response){
            console.log(response);
            return response.json();
        }).then(function SearchArtist(json){
            if(json.length>0){
                like.classList.add('like');
            }
        });
        like.addEventListener('click',saveartist);
        console.log(like);
        const type=document.createElement("h3");
        type.setAttribute("id","type");
        type.textContent=artist[i].type;
        const follower=document.createElement("h5");
        follower.setAttribute("id","follower");
        follower.textContent=artist[i].followers.total;
        divartist.appendChild(name);
        divartist.appendChild(image);
        divartist.appendChild(type);
        divartist.appendChild(follower);
        divartist.appendChild(like);
        divartist.appendChild(id_artist)
        container.classList.add("grid");
        container.appendChild(divartist);
    }
 
}
function JsonTokenAlbum(json){
    console.log(json.albums);
    let album=json.albums.items;
    let array_length=album.length;
    console.log(array_length);
    const container=document.querySelector("#result_spotify");
    const base_container=document.querySelector("#result");
    base_container.classList.add("scroll");
    container.innerHTML="";
    if(array_length>12){
        array_length=12;
    }
    for(let i=0;i<array_length;i++){
        const divartist=document.createElement("div");
        divartist.classList.add("card");
        const id_album=document.createElement("p");
        id_album.textContent=album[i].id;
        id_album.setAttribute("id","id_album");
        id_album.classList.add("hidden");
        const name=document.createElement("h1");
        name.textContent=album[i].name;
        name.setAttribute("id","namealbum");
        let lunghezza=name.textContent.length;
        console.log(lunghezza);
        if(lunghezza>10){
            name.classList.add("text_overflow");
        }
        else if(array_length==0){
            base_container.textContent="Nessun Risultato";
            base_container.classList.add("error");
        }
        console.log(name);
        const image=document.createElement('img');
        image.setAttribute("id","image_spotify");
        if(album[i].images.length==0){
            image.src="img/error.png"
        }else{
            image.src=album[i].images[0].url;
        }
        const like=document.createElement("img");
        like.setAttribute("id","addlike");
        like.setAttribute("data","Album");
        like.setAttribute("data-id",album[i].id);
        like.src="img/like.png";
        fetch("searchalbumbyid.php?q="+encodeURIComponent(album[i].id)).then(function ResponseArtist(response){
            console.log(response);
            return response.json();
        }).then(function SearchArtist(json){
            if(json.length>0){
                like.classList.add('like');
            }
        });
        like.addEventListener('click',savealbum);
        const artist=document.createElement("h2");
        artist.textContent=album[i].artists[0].name;
        if(artist.textContent.length>10){
            artist.classList.add("text_overflow");

        }
        artist.setAttribute("id","artist");
        const type=document.createElement("h3");
        type.textContent=album[i].type;
        type.setAttribute("id","type");
        const total_track=document.createElement("h3");
        total_track.textContent=album[i].total_tracks;
        total_track.setAttribute("id","total_tracks");
        divartist.appendChild(id_album);
        divartist.appendChild(name);
        divartist.appendChild(image);
        divartist.appendChild(artist);
        divartist.appendChild(total_track);
        divartist.appendChild(like);
        container.classList.add("grid");
        container.appendChild(divartist);
    }

}

function JsonTokenAudiobook(json){
    console.log(json.audiobooks);
    let audio=json.audiobooks.items;
    let array_length=audio.length;
    console.log(array_length);
    const container=document.querySelector("#result_spotify");
    const base_container=document.querySelector("#result");
    base_container.classList.add("scroll");
    container.innerHTML="";
    if(array_length>12){
        array_length=12;
    }
    for(let i=0;i<array_length;i++){
        const divartist=document.createElement("div");
        divartist.classList.add("card");
        const id_audio=document.createElement("p");
        id_audio.textContent=audio[i].id;
        id_audio.setAttribute("id","id_audio");
        id_audio.classList.add("hidden");
        const name=document.createElement("h1");
        name.textContent=audio[i].name;
        name.setAttribute("id","nameaudio");
        let lunghezza=name.textContent.length;
        console.log(lunghezza);
        if(lunghezza>10){
            name.classList.add("text_overflow");
        }
        else if(array_length==0){
            base_container.textContent="Nessun Risultato";
            base_container.classList.add("error");
        }
        console.log(name);
        const image=document.createElement('img');
        image.setAttribute("id","image_spotify");
        if(audio[i].images.length==0){
            image.src="img/error.png"
        }else{
            image.src=audio[i].images[0].url;
        }
        const like=document.createElement("img");
        like.setAttribute("id","addlike");
        like.src="img/like.png";
        like.setAttribute("data","Audio");
        like.setAttribute("data-id",audio[i].id);
        fetch("searchaudiobyid.php?q="+encodeURIComponent(audio[i].id)).then(function ResponseArtist(response){
            console.log(response);
            return response.json();
        }).then(function SearchArtist(json){
            if(json.length>0){
                like.classList.add('like');
            }
        });
        like.addEventListener("click",saveaudio);
        const authors=document.createElement("h2");
        authors.textContent=audio[i].authors[0].name;
        authors.setAttribute("id","authors");
        if(authors.textContent.length>10){
            authors.classList.add("text_overflow");

        }
        const publisher=document.createElement("h3");
        publisher.textContent=audio[i].publisher;
        if(publisher.textContent.length>10){
            publisher.classList.add("text_overflow");

        }
        publisher.setAttribute("id","publisher");
        divartist.appendChild(id_audio);
        divartist.appendChild(name);
        divartist.appendChild(image);
        divartist.appendChild(authors);
        divartist.appendChild(publisher);
        divartist.appendChild(like);
        container.classList.add("grid");
        container.appendChild(divartist);
    }

}

function JsonTokenTracks(json){
    console.log(json.tracks);
    let tracks=json.tracks.items;
    let array_length=tracks.length;
    console.log(array_length);
    const container=document.querySelector("#result_spotify");
    const base_container=document.querySelector("#result");
    base_container.classList.add("scroll");
    container.innerHTML="";
    if(array_length>12){
        array_length=12;
    }
    else if(array_length==0){
        base_container.textContent="Nessun Risultato";
        base_container.classList.add("error");
    }
    for(let i=0;i<array_length;i++){
        const divartist=document.createElement("div");
        divartist.classList.add("card");
        const id_track=document.createElement("p");
        id_track.textContent=tracks[i].id;
        id_track.setAttribute("id","id_track");
        id_track.classList.add("hidden");
        const name=document.createElement("h1");
        name.textContent=tracks[i].name;
        name.setAttribute("id","title");
        let lunghezza=name.textContent.length;
        console.log(lunghezza);
        if(lunghezza>10){
            name.classList.add("text_overflow");
        }
        console.log(name);
        const image=document.createElement('img');
        image.setAttribute("id","image_spotify");
        if(tracks[i].album.images[0].length==0){
            image.src="img/error.png"
        }else{
            image.src=tracks[i].album.images[0].url;
        }
        const like=document.createElement("img");
        like.setAttribute("id","addlike");
        like.setAttribute("data","Tracks");
        like.setAttribute("data-id",tracks[i].id);
        like.src="img/like.png";
        fetch("searchtrackbyid.php?q="+encodeURIComponent(tracks[i].id)).then(function ResponseTrack(response){
            console.log(response);
            return response.json();
        }).then(function SearchTrack(json){
            if(json.length>0){
                like.classList.add('like');
            }
        });
        like.addEventListener("click",savetracks)
        const artist=document.createElement("h2");
        artist.textContent=tracks[i].artists[0].name;
        artist.setAttribute("id","artist");
        if(artist.textContent.length>10){
            artist.classList.add("text_overflow");

        }
        const album=document.createElement("h3");
        album.textContent=tracks[i].album.name;
        album.setAttribute("id","album");
        if(album.textContent.length>10){
            album.classList.add("text_overflow");

        }
        divartist.appendChild(id_track);
        divartist.appendChild(name);
        divartist.appendChild(image);
        divartist.appendChild(artist);
        divartist.appendChild(album);
        divartist.appendChild(like);
        container.classList.add("grid");
        container.appendChild(divartist);
    }

}


function JsonResponse(response){
    console.log(response);
    return response.json();
}

function token_access(event){
    const text=event.currentTarget;
    const span=text.parentNode.nextElementSibling;
    const selector=text.parentNode.querySelector("#type");
    if(text.value.length>0){
        span.innerHTML="";
        console.log(selector.value);
        console.log(text.value);
        if(selector.value=="Artist"){
            fetch("Artistspotify.php?q="+encodeURIComponent(text.value)).then(JsonResponse).then(JsonTokenArtist);
         }
        if(selector.value=="Album"){
            fetch("Albumspotify.php?q="+encodeURIComponent(text.value)).then(JsonResponse).then(JsonTokenAlbum);
        }
        if(selector.value=="Audiobook"){
            fetch("Audiobookspotify.php?q="+encodeURIComponent(text.value)).then(JsonResponse).then(JsonTokenAudiobook);
        }
        if(selector.value=="Track"){
            fetch("Trackspotify.php?q="+encodeURIComponent(text.value)).then(JsonResponse).then(JsonTokenTracks);
        }

    }
    else{
        span.textContent="Inserisci qualcosa da cercare";
        span.classList.add("error");
    }
}

const input=document.querySelector("#search_content");
input.addEventListener("blur",token_access);
