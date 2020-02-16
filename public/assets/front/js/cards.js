const cards = document.querySelectorAll(".product-item");

cards.forEach((element) => {
  const openButton = element.querySelector('.product-image__qr');
  const closeButton = element.querySelector('.qr-item__close');
  openButton.addEventListener('click', () => {
    element.classList.add('opened');
  })
  closeButton.addEventListener('click', (e) => {
    e.preventDefault();
    element.classList.remove('opened');
  })
})
