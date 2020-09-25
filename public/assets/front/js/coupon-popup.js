(function(){
  const popupWrapper = document.querySelector('.app-coupon-popup__wrapper')
  const couponButton = document.querySelector('.app-coupon-popup__code-wrapper')
  const couponInfo = document.querySelector('.app-coupon-popup__code-info')
  const citySelectButton = document.querySelector('.app-coupon-popup__city-button')

  function couponToClipboard() {
    const text = document.querySelector('.app-coupon-popup__code-input')

    text.select()
    text.setSelectionRange(0, 99999)

    document.execCommand("copy")

    couponInfo.classList.add('active')
  } 

  if (!localStorage.getItem('couponClosed')) {
    popupWrapper.classList.add('active')
  }
  
  couponButton.addEventListener('click', function(e){
    e.preventDefault()
    couponToClipboard()
  }, false)

  citySelectButton.addEventListener('click', function (e) {
    e.preventDefault()
    popupWrapper.classList.remove('active')
    chooseCity()
    localStorage.setItem('couponClosed', true)
  }, false)
})()