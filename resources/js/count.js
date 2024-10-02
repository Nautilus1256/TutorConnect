// const questionTitleText = document.querySelector('#question-title-text');
// const questionTitleCount = document.querySelector('#question-title-count');

// questionTitleText.addEventListener('keyup', () => {
//   questionTitleCount.textContent = questionTitleText.value.length;
//   if (questionTitleText.value.length > 50) {
//       questionTitleCount.classList.add('text-red-500');
//   } else {
//       questionTitleCount.classList.remove('text-red-500');
//   }
// });

const characterCount = (inputElement) => {
    const maxLength = inputElement.dataset.maxlength;
    const countTarget = inputElement.nextElementSibling.querySelector('.count-display');
    
    inputElement.addEventListener('keyup', () => {
        const length = inputElement.value.length;
        countTarget.textContent = length;
        
        if (length > maxLength) {
            countTarget.classList.add('text-red-500');
        } else {
            countTarget.classList.remove('text-red-500');
        }
    });
}

document.querySelectorAll('.count-text').forEach(inputElement => {
    characterCount(inputElement);
});