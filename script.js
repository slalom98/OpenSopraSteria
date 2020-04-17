 var param="";
    var i=1;
        function getSelected(sel) {
             var libelletbillet = sel.options[sel.selectedIndex].value; // recupere le champ value de l'option (l'ID)
            // alert(sel.options[sel.selectedIndex].text); // récupere le texte stocké dans l'option


             if (libelletbillet === 'promo' ){
                 var element= document.getElementById('promo');
                 element.style.display='block';
             }


             if (libelletbillet === 'licencie' ){
                 var element= document.getElementById('licencie');
                 element.style.display='block';
             }



        }
