window.addEventListener("load", function() {
    let allSelect = document.querySelectorAll('#game select') ;
    let solution = document.querySelector(".solutionInput") ;

    for (let i = 0; i < allSelect.length; i++){
        allSelect[i].addEventListener('change', function (){
            let value  = "" ;
            for (let j = 0; j < allSelect.length; j++) {
                value += allSelect[j].value ;
            }
            solution.value = value ;
        }) ;
    }
})