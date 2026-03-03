document.addEventListener('DOMContentLoaded', function () {
  const playButton = document.getElementById('playButton');
  const iframe = document.getElementById('impactVideo');

  if (!iframe || !playButton) return;

  playButton.addEventListener('click', function () {
    // Switch to second video with sound
    console.log();

    iframe.src = "https://www.youtube-nocookie.com/embed/Dn1zS16jhbg";
    playButton.style.display = 'none';
  });
});
