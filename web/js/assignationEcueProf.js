function assignerEcue(){

  var ecueSelect = document.getElementById('ecue') ;
  var elt = document.getElementById('listing') ;
  var ecueId = ecueSelect.options[ecueSelect.selectedIndex].value ;
  var ecueText = ecueSelect.options[ecueSelect.selectedIndex].text ;

  ligne = document.createElement('li') ;
  ligne.className = 'list-group-item d-flex justify-content-between lh-condensed' ;
  ligne.innerHTML = '<div><h6 class="my-0">'+ecueText+'</h6><small class="text-muted" hidden>'+ecueId+'</small></div>'+
                    '<span class="text-muted"><button class="btn-xs btn-primary mb-2" type="button" onclick="poubelle(this.parentElement)"><i class="fas fa-trash"></i></button></span>' ;
  elt.appendChild(ligne) ;
}
