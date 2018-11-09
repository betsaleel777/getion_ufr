function automatiser(){

    var tp = [] ;
    var td = [] ;
    var projet = [] ;
    var tpe = [] ;
    var cm = [] ;
    var totalHeure = [] ;
    var credits = [] ;

    for (var i = 1; i <3 ; i++) {
      var code ;
      if(document.getElementById('code'+String(i))){
        code = document.getElementById('code'+String(i)).value ;
      }

      if(code){
        projet.push(parseInt(document.getElementById('inputProjet'+String(i)).value)) ;
        tp.push(parseInt(document.getElementById('inputTp'+String(i)).value)) ;
        td.push(parseInt(document.getElementById('inputTd'+String(i)).value)) ;
        cm.push(parseInt(document.getElementById('inputCm'+String(i)).value)) ;
      }
    }

     for (var j = 0 ,c = tp.length ; j < c ; j++) {
       som = projet[j]+tp[j]+td[j]+cm[j] ;
       totalHeure.push(som) ;
     }

     for (var k = 0,longueur = totalHeure.length ; k < longueur ; k++) {
      credit[k] = totalHeure[k]/12 ;
      if(document.getElementById('inputCredit'+k)){
        document.getElementById('inputCredit'+k).setAttribute('value',String(credit[k])) ;
      }
     }
}
