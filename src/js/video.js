document.addEventListener('DOMContentLoaded', function () {
  // const playButton = document.getElementById('playButton');
  // const iframe = document.getElementById('impactVideo');

  // if (!iframe || !playButton) return;

  // playButton.addEventListener('click', function () {
  //   // Switch to second video with sound
  //   console.log();

  //   iframe.src = "https://www.youtube-nocookie.com/embed/Dn1zS16jhbg?&autoplay=1&mute=0&rel=0";
  //   playButton.style.display = 'none';
  // });

  const playButton = document.getElementById('playButton');
  const iframe = document.getElementById('impactVideo');

  if (!iframe || !playButton) return;

  playButton.addEventListener('click', function () {

    iframe.src = "https://www.youtube-nocookie.com/embed/Dn1zS16jhbg?autoplay=1&rel=0";

    playButton.style.display = 'none';
  });

});
