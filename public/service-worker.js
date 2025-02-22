self.addEventListener('install', (event) => {
    console.log('Service Worker installing.');
    // You can cache assets here
  });

  self.addEventListener('fetch', (event) => {
    console.log('Service Worker fetching.');
    // You can respond with cached assets here
  });
