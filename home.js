function creazione(event) { 
	const box = document.createElement("p");
    box.classList.add("box");
	const titolo = document.querySelector("#titolo").value;
	box.innerText = titolo;
	
	if (titolo === "") {
		alert("Nome vuoto");
	} else {
		const img = document.createElement("img");
		img.src = "spotify.jpg";
		box.appendChild(img);
		const div = document.querySelector("#add");
		div.appendChild(box);
		const e = document.querySelector("#contenitore");
		e.appendChild(box);
	}
	
	let formdata = new FormData();
	formdata.append("titolo", titolo);
	
    fetch("http://localhost/home.php",{method: "POST", body: formdata}); 
}

const bottone = document.querySelector("#bottone");
bottone.addEventListener("click", creazione);

function onJson(json) { 
    const e = document.querySelector("#contenitore");

    for(row of json){
		const box = document.createElement("p");
		box.classList.add("box");

		box.innerText = row.titolo;

		const img = document.createElement("img");
		box.appendChild(img);
		img.src = row.img_url;
		
		const id_raccolta = document.createElement("div");
		box.appendChild(id_raccolta);
		id_raccolta.innerText = row.id_raccolta;
		id_raccolta.classList.add("hidden");

		e.appendChild(box);
    }
	
	const coll = document.querySelectorAll("p");
	for (t of coll) {
		t.addEventListener("click", vaiaCollection);
	}
}

function onJsonResponse(response) {
    return response.json();
}

fetch("http://localhost/raccolte.php").then(onJsonResponse).then(onJson); 

function vaiaCollection(event) { 
    let title = event.currentTarget;
    const id_raccolta = title.querySelector(".hidden").innerText;
    window.location.assign("collection.php?idraccolta=" + id_raccolta);
}
