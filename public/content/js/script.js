function share(url) {
	document.getElementById("share-url").innerHTML = window.location.origin+url;
	document.getElementById("share-url").select();
	document.execCommand('copy');
	console.log("Lien à partager copié");
}

function researchBar(action) {
	if (action == "open") {
		document.getElementById("search-button").setAttribute("onclick","researchBar('close')");
		document.getElementById("search-menu").classList.add("open");
		document.getElementById("search-button").classList.add("menu-open");
	}
	if (action == "close") {
		document.getElementById("search-button").setAttribute("onclick","researchBar('open')");
		document.getElementById("search-menu").classList.remove("open");
		document.getElementById("search-button").classList.remove("menu-open");
	}

	console.log("Bouton paramètre de recherche activé avec action="+action);
}
