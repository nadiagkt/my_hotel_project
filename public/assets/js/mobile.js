document.addEventListener("DOMContentLoaded", () => {
    
    const mobileMenu = document.querySelector(".mobile-menu");
    const mobile = document.querySelector("#mobile");

    mobileMenu.addEventListener("click", (e) =>{
        if (mobile.style.display === "flex") {
            mobile.style.display = "none";
        } else {
            mobile.style.display = "flex";
            mobile.style.justifyContent = "center";
        }
    })  
})