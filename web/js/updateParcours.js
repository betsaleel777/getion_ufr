function updateParcours() {
  var selectGrade = document.getElementById('id_grade');
  var parcours = document.getElementById('id_parcours').value ;
  grade = selectGrade.value;
  var selectSpecialite = document.getElementById('id_specialite');
  specialite = selectSpecialite.value;
  nom = selectGrade.options[selectGrade.selectedIndex].text + '-' + selectSpecialite.options[selectSpecialite.selectedIndex].text;

  xhr = new XMLHttpRequest();
  url = '/met_les_gazs/web/modifier-'+parcours+'.html';

  xhr.open('post', url, true);
  xhr.onreadystatechange = function() {
    if (xhr.status == 200 && xhr.readyState == 4) {
      if (xhr.responseText === 'fail' || xhr.responseText === 'warning') {
        location.href = '/met_les_gazs/web/parcoursUpdate-'+parcours+'.html';
      } else {
        
        document.getElementById('success-insertion').innerHTML = 'le parcours a été modifié avec succès,';
        document.getElementById('parcour').innerHTML = xhr.responseText;
        document.getElementById('sempar-form').removeAttribute('hidden');
        loadSemestre();
      }
    }
  };
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.send('grade=' + grade + '&specialite=' + specialite + '&nom=' + nom);
}
