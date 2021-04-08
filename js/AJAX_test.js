function loadDoc(url, cFunction) {
  var xhttp;
  xhttp=new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      cFunction(this);
    }
  };
  xhttp.open("GET", url, true);
  xhttp.send();
}

function myFunction(xhttp) {
  document.getElementById("demo").innerHTML = xhttp.responseText;
}

function loadXML(xml) {
  var xmlDoc, txt, x, i;
  xmlDoc = xml.responseXML;
  txt = "";
  x = xmlDoc.getElementsByTagName("ARTIST");
  for (i = 0; i < x.length; i++) {
    txt = txt + x[i].childNodes[0].nodeValue + "<br>";
  }
  document.getElementById("demo2").innerHTML = txt;
}

// ###############################################
$(document).ready(function(){
  $("#btnjQuery").click(function(){
    $("#div1").load("cd_catalog.xml");
  });
});

function showData(str){
  var xhttp;
  if (str == ""){
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
    if (this.readyState == 4 && this.status =="200"){
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getdata.php?q="+str, true);
  xhttp.send();
}
