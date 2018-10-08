function formulaire(){
  var contentElement = document.getElementById('ecueContent') ;
  var nom = document.getElementById('nom').value ;
  if(nom != ''){
    nom = 'value="'+nom+'"' ;
  }

  var form = document.createElement('div') ;
  var num = contentElement.childNodes.length+1 ;
  if(num == 3){
    document.getElementById('ecueCreateButton').disabled = true ;
  }else{
    form.innerHTML = '<h3 class="tittle-w3-agileits mb-4">ECUE '+num+'</h3><div class="form-group"><label for="inputName'+num+'">Nom ECUE:</label><input '+nom+' type="text" name="nomEcue'+num+'" class="form-control" id="inputName'+num+'"  required=""></div><div class="form-row"><div class="form-group col-md-4"><label for="inputCm'+num+'">Heures CM</label><input type="text" name="cm'+num+'" class="form-control" id="inputCm'+num+'" required=""></div><div class="form-group col-md-4"><label for="inputtp'+num+'">Heures TP</label><input type="text" name="tp'+num+'" class="form-control" id="inputtp'+num+'"></div><div class="form-group col-md-4"><label for="inputtd'+num+'">Heures TD</label><input type="text" class="form-control" id="inputtd'+num+'" name="td'+num+'"></div></div><div class="form-group"><label for="inputCredit">Credits:</label><input type="text" name="credits'+num+'" class="form-control" id="inputCredit" required=""></div>' ;

    contentElement.appendChild(form) ;
    contentElement.style.display = 'block' ;
  }
}
