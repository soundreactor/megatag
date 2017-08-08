//MIT license

var server = 'megatag.php';


// only edit below here if you have IQ > 247

var xmlhttp = {};
var taglist = [];


function alerta(a,b){
	console.log(a);
	console.log(b);
}


function AddWrapper(elem){
	var itm = document.getElementById("megatag_template_wrap");
	var cln = itm.cloneNode(true);
	cln.removeAttribute('id');
	var inptelm = cln.getElementsByTagName('input')[0];
	elem.appendChild(cln);
	$(inptelm).typeahead({
	  hint: true,
	  highlight: true,
	  minLength: 1
	},
	{
	  name: 'taglist',
	  source: substringMatcher(taglist)
	});
	var cmnd = {"action":"get_tags","item":elem.getAttribute('data')};
	SendCommand(cmnd,AddTags,elem);
}


function AddTags(obj,elem){
	var ojson = JSON.parse(obj);
	for (var i = 0; i < ojson.length; i++) {
		var mainelem = elem.getElementsByClassName("megatag-main")[0];
		var itm = document.getElementById("megatag_template_tag");
		var cln = itm.cloneNode(true);
		cln.removeAttribute('id');
		cln.childNodes[0].nodeValue = ojson[i]['tag']+" ";
		cln.getElementsByTagName('span')[0].addEventListener("click", function(theVar){return function(){DeleteTag(theVar)};}(cln),false);
		mainelem.insertBefore(cln, mainelem.childNodes[0]);
	}
}

function SendTag(refr){
	var itemname = refr.parentNode.parentNode.parentNode.getAttribute('data');
	var strobj = '[{"tag":"'+refr.value+'"}]';
	AddTags(strobj,refr.parentNode.parentNode.parentNode);
	var objcmd = {"action":"add_tag","tag":refr.value,"item":itemname};
	SendCommand(objcmd,alerta,refr);
	refr.value = "";
}

function DeleteTag(elm){
	var tagnme = elm.childNodes[0].nodeValue;
	tagnme.trim();    
	var itemname = elm.parentNode.parentNode.getAttribute('data');
	var cmdd = {"action":"delete_tag","tag":tagnme,"item":itemname};
	SendCommand(cmdd,alerta,elm);
	elm.remove();
}

function SendCommand(obj,callback,elemnd){
	dbParam = JSON.stringify(obj);
	var tmprndmname = makeid();
	xmlhttp[tmprndmname] = new XMLHttpRequest();
	xmlhttp[tmprndmname].onreadystatechange = function()
    {
        if (xmlhttp[tmprndmname].readyState == 4 && xmlhttp[tmprndmname].status == 200)
        {
            callback(xmlhttp[tmprndmname].responseText,elemnd); // Another callback here
        }
    }; 
	xmlhttp[tmprndmname].open("GET", server+"?x=" + dbParam, true);
	xmlhttp[tmprndmname].send();
}

function GetAllTags(obj,elmt){
	var nutaglistobj = JSON.parse(obj);
	taglist = nutaglistobj['tag'];
	taglist = taglist.filter( function( item, index, inputArray ) {
           return inputArray.indexOf(item) == index;
    });

	aftergetlist();
}

function SearchItems(bangz){
	var cmnd = {"action":"get_items","tag":bangz};
	SendCommand(cmnd,alerta,window);
}

//DO AFTER DOC IS LOADED 
// document.addEventListener("DOMContentLoaded", function(event) { 
function aftergetlist(){
	var classname2 = document.getElementsByClassName("megatag-s");
	for (var i = 0; i < classname2.length; i++) {
		//console.log("wtf");
		AddWrapper(classname2[i]);
	}
	  // ADD TAG FROM INPUT
	var classname = document.getElementsByClassName("megatag-input tt-input");
	for (var i = 0; i < classname.length; i++) {
		classname[i]
			.addEventListener("keyup", function(event) {
			event.preventDefault();
			if (event.keyCode == 13) {
				SendTag(this);
			}
		});
	} 
}
//});




//START
var div = document.createElement("div");

div.innerHTML = '<span id="megatag_template_tag" class="megatag-tag label label-info">TEMP <span class="megatag-remove glyphicon glyphicon-minus"></span></span>'+
'<div id="megatag_template_wrap" onclick="this.getElementsByTagName(\'input\')[1].focus()" class="megatag-main">'+
'<input  class="megatag-input" type="text" ></div>';

document.body.appendChild(div);


var cmnd = {"action":"get_all"};
SendCommand(cmnd,GetAllTags,window);



//OTHER SHEEEIIITEEE

function makeid() {
  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  for (var i = 0; i < 10; i++){text += possible.charAt(Math.floor(Math.random() * possible.length))};
  return text;
}

var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substringRegex;
    matches = [];
    substrRegex = new RegExp(q, 'i');
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        matches.push(str);
      }
    });
    cb(matches);
  };
};

taglist = ['Alabama', 'Alaska'];



 

// function SendCommand(obj, callback, elemnd){

	// dbParam = JSON.stringify(obj);
	// xmlhttp = new XMLHttpRequest();
	// xmlhttp.onreadystatechange = function()
    // {
        // if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        // {
            // callback(xmlhttp.responseText,elemnd); // Another callback here
        // }
    // }; 
	// xmlhttp.open("GET", server+"?x=" + dbParam, true);
	// xmlhttp.send();

// }
//focus input
// $(document).ready(function () {
// var classname = document.getElementsByClassName("megatag-main");

// var focus_input = function() {
    // var inputobj = this.getElementsByTagName('input')[0];
    // console.log(inputobj);
	// inputobj.focus();
// };

// for (var i = 0; i < classname.length; i++) {
    // classname[i].addEventListener('click', focus_input, false);
// }
 // });
/*
obj = {"action":"delete_tag","item":"ffffff","tag":"Beton"};

dbParam = JSON.stringify(obj);
xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("demo").innerHTML = this.responseText;
    }
};
xmlhttp.open("POST", server+"?x=" + dbParam, true);
xmlhttp.send();

*/