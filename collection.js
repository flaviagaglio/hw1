const back = document.querySelector("button");

back.addEventListener("click", backtoHome);

function backtoHome() { 
    window.location.href = "home.php";
}

const result = document.querySelector("#contenitore");

function onJson(json) { 
	for(it of json) {
        const elemento = document.createElement("div");
		elemento.id = "elemento";
		result.appendChild(elemento);
		const image = document.createElement("img");
        image.src = it.img_url;
		const title = document.createElement("p");
		title.innerHTML = it.titolo;
		elemento.appendChild(image);
		elemento.appendChild(title);    
		
		const nomealbum = document.createElement("p");
        nomealbum.innerHTML = "Album: " + it.nome_album;
        nomealbum.classList.add("hidden");
        const artisti = document.createElement("p");
        artisti.innerHTML = "Artisti:" + it.artisti;
        artisti.classList.add("hidden");
		
		const idspotify2 = document.createElement("p");
        idspotify2.innerHTML = it.id_risorsa_spotify;
        idspotify2.classList.add("hidden");
		
		const idspotify = document.createElement("p");
        idspotify.innerHTML = it.id_risorsa_spotify;
        idspotify.classList.add("hidden");
        const bottone = document.createElement("button");
        bottone.innerHTML = "Elimina";
		bottone.appendChild(idspotify2);  
		
		elemento.appendChild(idspotify);	
        elemento.appendChild(nomealbum);
        elemento.appendChild(artisti);
		bottone.addEventListener("click", elimina); 
        elemento.appendChild(bottone);
    }
	
	const cliccato = document.querySelectorAll("#elemento");
    for(c of cliccato) {
        console.log(c);
        c.addEventListener("click", modalonClick); 
    }
}

function onJsonResponse(response) {
    return response.json();
}

const id_container = document.querySelector("#idraccolta").innerHTML;
fetch("http://localhost/richiesta_contenuti.php?id_raccolta=" + id_container).then(onJsonResponse).then(onJson); //mando l'id della raccolta a richiesta_contenuti.php

function elimina(event) { 
	event.stopPropagation();
	const bottone = event.currentTarget;
	console.log(bottone.childNodes[1].innerHTML);
	console.log(id_container);
	
	let formdata = new FormData();
	formdata.append("id_risorsa", bottone.childNodes[1].innerHTML);
	formdata.append("id_raccolta", id_container);
	fetch("http://localhost/elimina_contenuto.php",{method: "POST", body: formdata}).then(function(){document.location.reload(true);}); //ricarica la pagina solo dopo la fetch
}
	
const modal_view = document.querySelector("#modalview");
modal_view.addEventListener("click", removeModal); 

function modalonClick(event) {
    const clicked = event.currentTarget;
    
    const image = document.createElement("img");
    const text = document.createElement("span");
    
    const title = document.createElement("p");
    title.id = "title";
    const id_spotify = document.createElement("p");
    id_spotify.id = "prova";
	const nomealbum = document.createElement("p");
    nomealbum.id = "prova";
    const artisti = document.createElement("p");
    artisti.id = "prova";
    image.src = clicked.childNodes[0].src;
    title.innerHTML = clicked.childNodes[1].innerHTML;
    id_spotify.innerHTML = clicked.childNodes[2].innerHTML;
	nomealbum.innerHTML = clicked.childNodes[3].innerHTML;
    artisti.innerHTML = clicked.childNodes[4].innerHTML;
    modal_view.appendChild(image);
    text.appendChild(title);
    text.appendChild(id_spotify);
	text.appendChild(nomealbum);
    text.appendChild(artisti);
    modal_view.appendChild(text);
    modal_view.classList.remove("hidden");
	
	
    console.log(image);
    console.log(title);
    console.log(id_spotify);
}

function removeModal() {
    modal_view.innerHTML = "";
    modal_view.classList.add("hidden");
}

