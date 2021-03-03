
let couponButtonWrapper = document.querySelector('#vertical-button-content');
let couponButton = couponButtonWrapper.querySelector('#btn-coupon');
let couponDescriptionBox = document.querySelector('#vertical-button-description');


couponButton.addEventListener( 'click', boxHandler );

function boxHandler(e) {
    couponDescriptionBox.classList.toggle('active');
}

