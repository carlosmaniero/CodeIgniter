var container = "objects";//element that contains the items.
var mode = 0;//keeps the current mode being displayed.
var exhibitionMode = ["gallery","list"];//classes for the different exhibition modes.
var find = "search";//element where the user writes the search.
var item = "item";//element that represents an item.
var tag = "input";//tag of the element where the text is.


function copyToClipboard(text) {//function to show a message with a text to be copied to the clipboard.
    window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
}

function change(){//function to change the exhibition mode of the items.
  	var o = document.getElementById(container);
  	o.className = exhibitionMode[(++mode)%exhibitionMode.length];
}

function search(text){//function to find the items that contains a text.
		var items = document.getElementsByClassName(item);//gets an array with all items.
		for(var i=0;i<items.length;i++){//searches the array looking for the items that contains the text.
			if(items[i].getElementsByTagName(tag)[0].value.toLowerCase().toString().indexOf(text) == -1){
				items[i].setAttribute("style","display:none;");//hides the item if it doesn't contains the text.
			}else{
				items[i].removeAttribute("style");//shows the item if it contains the text.
			}
		}
}

function edit(object){
	object.removeAttribute("readOnly");//edit the textarea is enabled.
}

function cancelEnter(event, object){//function to change the behavior of the enter button.
	if(event.keyCode === 13){
		event.preventDefault();
	}
}

function done(keycode, object){//edit the textarea is disabled.
	if(keycode === 13){
		object.setAttribute("readOnly", "readonly");
	}
}