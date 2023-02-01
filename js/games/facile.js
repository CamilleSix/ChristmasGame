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
        let x = cursor.clientX ;
        let y = cursor.clientY ;
        let randX = Math.random() < 0.5 ;
        let randY = Math.random() < 0.5 ;
        x += 100 ;  y += 50 ;
        if (randX === true){
            x -= 200 ;
        }
        if (randY === true){
            y -= 100 ;
        }


        button.style.position = "fixed" ;
        button.style.left =  x +'px';
        button.style.top =  y +'px';
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