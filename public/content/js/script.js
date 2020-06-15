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

function UUID() {
	var S4 = function() {
		return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
	};
	return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
}
function newElement(type,param) {
	var elem = document.createElement(type);
	if ('txt' in param) elem.textContent = param.txt;
	if ('class' in param) elem.classList.add(param.class);
	if ('attr' in param) {
		for (prop in param.attr) {
			elem.setAttribute(prop, param.attr[prop]);
		}
	}
	return elem;
}
function notify(text, param) { //notify('text',{'delTime': '1000','btn':[{'txt':'btn1','onclick':"func()"},{'txt':'btn2','onclick':"func2()"}]})
	var notifID = "notif-"+UUID();
	console.debug("%cDTK Notification","color:#003399;background-color:#FFFFFF;padding:5px;font-weight:bold;","Generating notification with ID "+notifID,{'text':text,'param':param});

	document.getElementById("notifs").appendChild(newElement("div",{'class':'notif','attr':{'id':notifID}}));
	let notif = document.getElementById(notifID);

	let textSpan = notif.appendChild(newElement("span",{'txt':text}));
	if (param) if ('title' in param) notif.insertBefore(newElement("b",{'txt':param.title}), textSpan);
	if (param) if ('btn' in param) {
		param.btn.forEach((item)=>{
			notif.appendChild(newElement("button",{'txt':item.txt,'attr':{'onclick':item.onclick}}));
		})
	}
	notif.innerHTML += '<svg onclick="this.parentNode.remove();" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path class="svg-color" d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>';
	if (param) if ('delTime' in param) notif.appendChild(newElement("div",{'attr':{'style':'animation-duration:'+param.delTime+'ms;'}}));

	if (param) if ('delTime' in param) setTimeout(()=>{try{document.getElementById(notifID).remove()}catch{}}, param.delTime);
	return notif;
}

function share(url) {
	document.getElementById("share-url").innerHTML = window.location.origin+url;
	document.getElementById("share-url").select();
	document.execCommand('copy');
	document.getElementById("share-url").blur();
	notify("Lien copié !",{"delTime":"3000"});
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
