if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('/service-worker.js')
    .then(() => console.log('PWA aktif'))
    .catch(err => console.log(err));
}

window.addEventListener('beforeinstallprompt', () => {
  console.log('PWA bisa diinstall');
});
