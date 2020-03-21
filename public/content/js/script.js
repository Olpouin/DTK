function getCookie(cname) {
	var name = cname + "=";
	var decodedCookie = decodeURIComponent(document.cookie);
	var ca = decodedCookie.split(';');
	for(var i = 0; i <ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}

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

function select(id) {
	document.getElementById(id).classList.add("selected")
}
function setTheme(theme) {
	document.cookie = "theme="+theme+"; expires=Thu, 18 Dec 9999 12:00:00 UTC;";
	location.reload();
}
