document.addEventListener("DOMContentLoaded", () => {
  
  const photos = ["image_back1", "image_back2", "image_back3"];
  const $gallery = document.querySelector(".gallery");
  const $buttons = document.querySelectorAll(".btn");
  let photoIndex = 0;

  $gallery.style.backgroundImage = `url('assets/images/${photos[photoIndex]}.jpg')`;

  $buttons.forEach(($btn) =>{
    $btn.addEventListener("click", (e) =>{
      if($btn.id === "prev"){
        photoIndex--;
        if(photoIndex < 0){
          photoIndex = photos.length - 1;
        }
        $gallery.style.backgroundImage = `url('assets/images/${photos[photoIndex]}.jpg')`;
      }

      if ($btn.id === "next"){
        photoIndex++;
        if(photoIndex > photos.length - 1){
          photoIndex = 0;
        }
        $gallery.style.backgroundImage = `url('assets/images/${photos[photoIndex]}.jpg')`;
      }
    })
  })
})
