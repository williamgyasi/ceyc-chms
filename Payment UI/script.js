// FIELDS ON THE CARD
const cardNumber = document.querySelector('.card__number span');
const cardHolder = document.querySelector('.card__holder span');
const cardExpiresMonth = document.querySelector('.expires__month');
const cardExpiresYear = document.querySelector('.expires__year');
const cardCVV = document.querySelector('.card__cvv span');

// INPUT FIELDS IN THE FORM
const numberInput = document.querySelector('.number__input');
const holderInput = document.querySelector('.holder__input');
const monthSelect = document.querySelector('.form__monthSelect');
const yearSelect = document.querySelector('.form__yearSelect');
const cvvInput = document.querySelector('.cvv__input');

const formButton = document.querySelector('.form__button');

// GENERATES A 10 YEAR SPAM 
window.onload = function() {
  const yearSelect = document.querySelector('.form__yearSelect');
  let currentYear = new Date().getUTCFullYear();

  for (i = 0; i <= 10; i++) {
    let option = document.createElement('option');
    option.innerHTML = currentYear;
    
    yearSelect.appendChild(option);
    currentYear += 1;
  }
}

// PRINTS INFO ON THE CARD IN REAL TIME
numberInput.addEventListener('input', writeCardNumber);
holderInput.addEventListener('input', writeCardHolder);
monthSelect.addEventListener('input', writeExpirationDate);
yearSelect.addEventListener('input', writeExpirationDate);

cvvInput.addEventListener('input', writeCVV);
cvvInput.addEventListener('focus', rotateCard);
cvvInput.addEventListener('focusout', rotateCard);

function numberValidator() {
  if(numberInput.value.length === 16) {
    numberInput.classList.remove('invalidField');
    return true
  } else {
    numberInput.classList.add('invalidField');
    return false
  }
}

function writeCardNumber() {
  cardNumber.innerHTML = numberInput.value;
  numberValidator();
}

function writeCardHolder() {
  cardHolder.innerHTML = holderInput.value;
}

function writeExpirationDate() {
  cardExpiresMonth.innerHTML = monthSelect.value;
  cardExpiresYear.innerHTML = yearSelect.value.slice(2);
}

function writeCVV() {
  cardCVV.innerHTML = cvvInput.value;
}

function rotateCard() {
  document.querySelector('.card__container').classList.toggle('card__container--rotation');
}