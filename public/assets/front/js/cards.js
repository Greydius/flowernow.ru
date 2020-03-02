const cards = document.querySelectorAll(".product-item");
const modal = document.querySelector('.app-sms-modal');

cards.forEach((element) => {
  const openButton = element.querySelector('.product-image__qr');
  const closeButton = element.querySelector('.qr-item__close');
  const qr = element.querySelectorAll('.qr-item__image, .qr-item__link');
  openButton.addEventListener('click', () => {
    element.classList.add('opened');
  })
  closeButton.addEventListener('click', (e) => {
    e.preventDefault();
    element.classList.remove('opened');
  })
  qr.forEach((element) => {
    element.addEventListener('click', (e) => {
      e.preventDefault();
      modal.classList.add('active');
    })
  })
});

const modalCloseButton = modal.querySelector('.app-sms-modal__close');
modalCloseButton.addEventListener('click', (e) => {
  e.preventDefault();
  modal.classList.remove('active');
})

const modalForm = modal.querySelector('.app-sms-modal__input-form');
modalForm.addEventListener('submit', (e) => {
  e.preventDefault();
  const phone = modalForm.querySelector('.app-sms-modal__input').value;
  const xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const response = JSON.parse(this.responseText);
      modal.classList.remove('active');
      toastr.success('Сообщение отправлено!');
    } else if (this.readyState == 4) {
      const response = JSON.parse(this.responseText);
      toastr.error('Неверный номер телефона!');
      console.log(response.message);
    }
  };
  xhttp.open("POST", "/api/sendSMSUrl", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(`phone=${phone}`);
})
