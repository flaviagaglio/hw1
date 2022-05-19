function validazione(event) { 
	if (form.nome.value.length === 0 || form.cognome.value.length === 0 || form.email.value.length === 0 || form.nomeutente.value.length === 0 ||
		form.password.value.length === 0 || form.confermapassword.value.length === 0) {
			alert("Compilare tutti i campi");
			event.preventDefault();
	}
	
	if (form.password.value !== form.confermapassword.value) {
		alert("Password errata");
		event.preventDefault();
	}
    else{
	if(form.password.value.length < 6){
		alert("La password deve contenere almeno 6 caratteri");
		event.preventDefault();
	 }
    }
	 if (form.password.value.length > 15){
        alert("Password troppo lunga, inserire meno di 15 caratteri");
        event.preventDefault();
      } else{
       
        if ((form.password.value.match(/[A-Z]/)) && (form.password.value.match(/[a-z]/)) && (form.password.value.match(/[0-9]/))) {
          return true;
          }
          else {
            alert("La password deve contenere almeno un carattere maiuscolo, almeno uno minuscolo e almeno una cifra");
            event.preventDefault();

          }}
	const mail = form.email.value;
	if (form.email.value.length !== 0 && mail.indexOf("@") <= -1) {
		alert("Email non valida");
		event.preventDefault();
	}
	
	if (usernameexists) {
		alert("Questo nome utente esiste già, scegline un altro");
		event.preventDefault();
	}
    
	
	
}

let usernameexists = false; 

function onText(text) {
	if (text == true) {
		usernameexists = true;
		form.nomeutente.classList.remove("correct")
        form.nomeutente.classList.add("incorrect");
	} else {
		usernameexists = false;
		form.nomeutente.classList.remove("incorrect");
        form.nomeutente.classList.add("correct");
	}
}

function onResponse(response) {
	return response.text();
}

function controllousername(event) { 
	const username = event.currentTarget;
	let formdata = new FormData();
	formdata.append("controllo_user", username.value);
	fetch("http://localhost/signup.php", {method: "POST", body: formdata}).then(onResponse).then(onText);
}

const signupform = document.forms["form"];
signupform.addEventListener("submit", validazione);

const user = form.querySelector("#user");
user.addEventListener("blur", controllousername); 
