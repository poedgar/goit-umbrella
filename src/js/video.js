document.addEventListener('DOMContentLoaded', function () {
  const playButton = document.getElementById('playButton');
  const iframe = document.getElementById('impactVideo');

  if (!iframe || !playButton) return;

  playButton.addEventListener('click', function () {
    // Switch to second video with sound
    console.log();

    iframe.src = "https://www.youtube-nocookie.com/embed/Dn1zS16jhbg?si=h_PYub1HsQaqDb0P&autoplay=1&mute=1&rel=0";
    playButton.style.display = 'none';
  });
});
