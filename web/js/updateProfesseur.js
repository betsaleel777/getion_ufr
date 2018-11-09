function updateProf() {
  var formulaire = document.getElementById('formulaire') ;
  var ecueSelect = document.getElementById('ecue');
  var id = document.getElementById('id').value ;
  var ecue = ecueSelect.options[ecueSelect.selectedIndex].value;

  var listElement = document.getElementById('listing');
  var ecueSelected = listElement.getElementsByTagName('small');
  var ecueTab = [];
  for (var i = 0; i < ecueSelected.length; i++) {
    ecueTab[i] = ecueSelected[i].textContent;
  }

  var json = JSON.stringify(ecueTab);

  xhr = new XMLHttpRequest();
  var url = '/met_les_gazs/web/professeursUpdate-'+id+'.html';
  xhr.open("POST", url, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
      if (xhr.responseText === 'success') {
        location.href = '/met_les_gazs/web/professeurs.html';
      } else {
        alert(xhr.responseText) ;
        location.reload();
      }
    }
  };
  form = new FormData(formulaire) ;
  form.append('json',json) ;
  xhr.send(form);
}
