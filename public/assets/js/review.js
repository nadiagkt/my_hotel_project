document.addEventListener("DOMContentLoaded", () => {

    const $stars = document.getElementsByClassName("star-items");

    for(let i=0; i<$stars.length; i++){
        $stars[i].addEventListener("mouseover", (e) => { 
            for(let j=0; j<$stars.length; j++){
                $stars[j].classList.add("active");
                $stars[j].classList.remove("active");
            }
            for(let j=0; j<=i; j++){
                $stars[j].classList.remove("active");
                $stars[j].classList.add("active");
            }
        })
    }
})