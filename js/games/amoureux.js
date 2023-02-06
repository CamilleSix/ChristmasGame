window.addEventListener("load", function() {
    let allPick = document.querySelectorAll('.pick') ;

    for (let i = 0; i < allPick.length; i++){
        allPick[i].querySelector('.like').addEventListener('click', function (){
            allPick[i].style.backgroundColor = "#d2eccc" ;
            allPick[i].style.color = "#2e6e26" ;
            allPick[i].classList.add('selected') ;
            generateInput() ;
        }) ;
        allPick[i].querySelector('.dislike').addEventListener('click', function (){
            allPick[i].style.backgroundColor = "#efd6d6" ;
            allPick[i].style.color = "#6e2626" ;
            allPick[i].classList.remove('selected') ;
            generateInput() ;
        }) ;
    }
    function generateInput(){
        let solution = document.querySelector(".solutionInput") ;

        let string = '' ;
        for (let i = 0; i < allPick.length; i++){

            if (allPick[i].classList.contains('selected') ){
                string += '1' ;
            } else {
                string += '0' ;
            }
        }
        solution.value = string ;
    }
});