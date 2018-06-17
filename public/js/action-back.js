let historyCount=document.referrer;
let historyLength=history.length;
//var btnBackID = document.getElementById("btnBack");
if(historyCount&&historyLength>1){
    console.log("OK");
}else{
	//btnBackID.className = " is-hidden-data";
    console.log("NO");
}