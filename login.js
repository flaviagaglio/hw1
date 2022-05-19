function validazione(event) { 
	if (form.nomeutente.value.length === 0 || form.password.value.length === 0) {
			alert("Devi compilare tutti i campi!");
			event.preventDefault();
	}
}

const loginform = document.forms["form"];
loginform.addEventListener("submit", validazione); 