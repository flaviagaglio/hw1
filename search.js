function onJson(json) { 
	if(form.ricerca.value.length === 0) {
		alert("Non hai scritto niente");
		event.preventDefault();
	}
	
	result.innerHTML = "";
	for(it of json.tracks.items) {
		const elemento = document.createElement("div");
		result.appendChild(elemento);
		const image = document.createElement("img");
		image.src = it.album.images["0"].url;
		const title = document.createElement("p");
		title.innerHTML = it.name;
		elemento.appendChild(image);
		elemento.appendChild(title);

		const form1 = document.createElement("form");
		form1.name = "select";
		form1.method = "post";
		elemento.appendChild(form1);
		const scelta = document.createElement("select");
		scelta.name = "scelta";
		const opzione = document.createElement("option");
		form1.appendChild(scelta);
		
		const nomealbum = document.createElement("p");
        nomealbum.innerHTML = it.album.name;
        nomealbum.classList.add("hidden");
        console.log(it.album.name);
        const artists = it.artists;
        const artis = document.createElement("p");
        for(t of artists) {    
            const artisti = t.name;
            artis.innerHTML = artis.innerHTML + " " + artisti;
		}
        artis.classList.add("hidden");
		
		
		
		scelta.addEventListener("click", stop); 
		
		const idspotify = document.createElement("h1");
		idspotify.innerHTML = it.id;
		elemento.appendChild(idspotify);
		
		const bottone = document.createElement("button");
        form1.appendChild(bottone);
        bottone.innerHTML = "Aggiungi";
		bottone.appendChild(image);
		bottone.appendChild(title);
		bottone.appendChild(idspotify);	
		bottone.appendChild(scelta);
        bottone.appendChild(nomealbum);
        bottone.appendChild(artis);
	
        bottone.addEventListener("click", aggiungi); 
	}
		
	function onJson1(json1) { 
		for(h of scelto) {
			for(g of json1) {
				let option = document.createElement("option");
				option.value = g.id_raccolta;
				option.innerHTML = g.titolo;
				h.appendChild(option);
			}	
		}
	}
		
	function onJsonResponse1(response1) {
		return response1.json();
    }
		
	fetch("http://localhost/scelta_raccolta.php").then(onJsonResponse1).then(onJson1); 
	const scelto = document.querySelectorAll("select");	
}

function onJsonResponse(response) {
	return response.json();
}

function ricerca(event) { 
	let formData = new FormData();
    formData.append("textToSearch", form.ricerca.value);
    event.preventDefault();
	fetch("http://localhost/do_search.php",{method: "POST", body: formData}).then(onJsonResponse).then(onJson);
}

const searchform = document.forms["form"];
searchform.addEventListener("submit", ricerca);

const result = document.querySelector("#content");

function aggiungi(event) {
	event.preventDefault();
	const bottone = event.currentTarget;

	
	let formdata = new FormData();
	formdata.append("immagine", bottone.childNodes[1].src);
	formdata.append("titolo", bottone.childNodes[2].innerHTML);
	formdata.append("idspotify", bottone.childNodes[3].innerHTML);
	formdata.append("idraccolta", bottone.childNodes[4].value);
	formdata.append("album", bottone.childNodes[5].innerHTML);
	formdata.append("artista", bottone.childNodes[6].innerHTML);
	fetch("http://localhost/search.php",{method: "POST", body: formdata}); 
}

function stop(event) {
	event.preventDefault();
	event.stopPropagation();
}



