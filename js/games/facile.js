window.addEventListener("load", function() {
    let input = document.querySelector('.solutionInput') ;
    let form = document.getElementById("mainSubmitForm") ;

    if (!window.matchMedia("(min-width: 800px)").matches) {
        form.innerHTML = "<div class='noForm'>Le formulaire pour indiquer la réponse n'est pas disponible sur mobile pour cette étape.</div>" ;
    }

    input.addEventListener('keydown', function (e) {onKey(e) ;}) ;
    input.addEventListener('keyup', function (e) {onKey(e) ;}) ;

    function onKey(e){
        let letters = input.value ;
        console.log(e.keyCode) ;

        if (e.keyCode === 13) {
            e.preventDefault();
            return false;
        } else if (e.keyCode === 8){

        } else {
            input.value = shuffleWord(letters) ;
        }
    }
    let button = document.querySelector('button.gameSubmit') ;

    button.addEventListener('mouseenter',function (cursor){
        let p = event.clientX ;
       p += 10 ;
        button.style.position = "fixed" ;
        button.style.left =  p +'px';
    }) ;

})

function shuffleWord(word){
    let shuffledWord = '';
    word = word.split('');
    while (word.length > 0) {
        shuffledWord +=  word.splice(word.length * Math.random() << 0, 1);
    }
    return shuffledWord;
}