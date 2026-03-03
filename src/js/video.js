document.addEventListener('DOMContentLoaded', function () {
  const playButton = document.getElementById('playButton');
  const iframe = document.getElementById('impactVideo');

  if (!iframe || !playButton) return;

  playButton.addEventListener('click', function () {
    // Switch to second video with sound
    iframe.src = "https://www.youtube.com/embed/GBYrd07HAfQ?autoplay=1&mute=0&rel=0";
    playButton.style.display = 'none';
  });
});
