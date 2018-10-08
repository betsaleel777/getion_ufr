function loadSemestre(arg){
  var xhr = new XMLHttpRequest();
  var elements = document.getElementById('semestres') ;
  var semestres = '' ;
  var url = "/met_les_gazs/web/loadSemestre.html";
  xhr.open("POST", url, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
      semestres = JSON.parse(xhr.responseText) ;
      elements.options.length=0 ;
      var option = document.createElement('option') ;
      option.text = 'choix ....' ;
      option.value = 'choix' ;
      elements.add(option, elements[0]) ;
      for (var i = 0; i < semestres.length; i++) {
        option = document.createElement('option') ;
        option.text = semestres[i].nom ;
        option.value = semestres[i].id ;
        elements.add(option, elements[i+1]) ;
      }
    }
  };
  xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xhr.send("idParcour="+arg);

}
