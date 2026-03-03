document.addEventListener('DOMContentLoaded', function () {
  var player;

  function onYouTubeIframeAPIReady() {
    player = new YT.Player('impactVideo', {
      videoId: 'yO0d6nJPPsE',
      playerVars: {
        autoplay: 1,
        mute: 1,
        rel: 0,
        loop: 1,
        playlist: 'yO0d6nJPPsE',
        controls: 0,
        modestbranding: 1
      }
    });
  }

  const playButton = document.getElementById('playButton');
  const iframe = document.getElementById('impactVideo');

  if (!iframe || !playButton) return;

  playButton.addEventListener('click', function () {
    // Switch to second video with sound
    player.loadVideoById('Dn1zS16jhbg');
    player.unMute();
    player.setLoop(false);

    // iframe.src = "https://www.youtube.com/embed/Dn1zS16jhbg?si=h_PYub1HsQaqDb0P&autoplay=1&mute=1&rel=0";
    playButton.style.display = 'none';
  });
});
