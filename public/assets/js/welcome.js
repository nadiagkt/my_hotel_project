var textWrapper = document.querySelector(".welcome-message");
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({loop: false})
  .add({
    targets: '.welcome-message .letter',
    translateY: [-100,0],
    easing: "easeOutExpo",
    duration: 1600,
    delay: (el, i) => 30 * i
  }).add({
    targets: '.welcome-message',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 2000
  });