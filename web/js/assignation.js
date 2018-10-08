function assigner(){

  var ueSelect = document.getElementById('ue') ;
  var elt = document.getElementById('listing') ;
  var ueId = ueSelect.options[ueSelect.selectedIndex].value ;
  var ueText = ueSelect.options[ueSelect.selectedIndex].text ;

  ligne = document.createElement('li') ;
  ligne.className = 'list-group-item d-flex justify-content-between lh-condensed' ;
  ligne.innerHTML = '<div><h6 class="my-0">'+ueText+'</h6><small class="text-muted" hidden>'+ueId+'</small></div><span class="text-muted"><button type="button" onclick="poubelle.js(this.parentNode)">poubelle</button></span>' ;
  elt.appendChild(ligne) ;



}
