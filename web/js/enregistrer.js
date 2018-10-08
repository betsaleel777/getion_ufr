function enregistrer() {
  var semestreSelect = document.getElementById('semestre');
  var anneeSelect = document.getElementById('annee');
  var semestre = semestreSelect.options[semestreSelect.selectedIndex].value;
  var annee = anneeSelect.options[anneeSelect.selectedIndex].value;

  var listElement = document.getElementById('listing');
  var ueSelected = listElement.getElementsByTagName('small');
  var ueTab = [];
  for (var i = 0; i < ueSelected.length; i++) {
    ueTab[i] = ueSelected[i].textContent;
  }
  
  var json = JSON.stringify(ueTab);

  xhr = new XMLHttpRequest();
  var url = '/met_les_gazs/web/ajaxDispensees.html';
  xhr.open("POST", url, true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
      //  alert(xhr.responseText)
      if (xhr.responseText === 'success') {
        location.href = '/met_les_gazs/web/dispensees.html';
      } else {
        location.reload();
      }
    }
  };
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("semestre=" + semestre + "&annee=" + annee + "&json=" + json);


}
