function API(APIname,data) {
	document.documentElement.classList.add("wait");
	let url = "../api/"+APIname+".php";
	let xhr = new XMLHttpRequest();
	xhr.responseType = "json";
	xhr.open("POST", url, true);
	xhr.setRequestHeader('Content-Type', 'application/json');
	xhr.onreadystatechange = function() {
		if (xhr.readyState === 4) {
			if (xhr.response === null) {;
				var title = "Erreur client";
				var message = "Nous n'avons pas pu lire la réponse du serveur. La quote a peut être été envoyée, ou pas.";
			} else {
				var title = xhr.response.title;
				var message = xhr.response.message;
			}
			notify(message,{'title':title,'delTime': '10000','btn':[{'txt':'Dernières quotes','onclick':"window.location.href = '../quotes/latest/'"}]})
			document.documentElement.classList.remove("wait");
		}
	}
	xhr.send(JSON.stringify(data));
}

function isChecked(id) {
	if (document.getElementById(id).checked) return "true";
	else return "false";
}

/*function formatQuote(text,date,sourcetype) {
	var text = document.getElementById("add_text").value.replace(/\n/g, "%0D%0A");
	console.log({text});
	var date = document.getElementById("add_date").value;
	var sourcetype = document.getElementById("add_source-type").value;

	var path = window.location.href.match(/(.*)\/add/)[1];
	var url = path + "/api/format_quote.php?text="+text+"&date="+date+"&source-type="+sourcetype;
	fetch(
		url
	).then(function(response) {
		return response.json();
	}).then(function(myJson) {
		console.log(JSON.stringify(myJson));
		document.getElementById("previewBox").innerHTML = myJson.formatted;
	});
}*/
