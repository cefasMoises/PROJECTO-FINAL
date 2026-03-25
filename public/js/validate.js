const regex_anyText = /^[A-Za-zÀ-ÿ\s]+$/
const regex_email = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/
const regex_tel = /^9\d{8}$/
const regex_bi = /^\d{9}[A-Z]{2}\d{3}$/



function generateValidationElements(id, regex) {
    const elements = document.querySelectorAll(`#${id}`);

    if (elements) {
        elements.forEach((item) => {
            item.addEventListener('input', function () {
                const isValid = regex.test(this.value.trim());

                if (isValid) {
                    this.classList.remove('text-red-500');
                    this.classList.add('text-slate-500');
                } else {
                    this.classList.remove('text-slate-500');
                    this.classList.add('text-red-500');
                }
            });
        });
    }
}

generateValidationElements('any-text', regex_anyText)
generateValidationElements('any-email', regex_email)
generateValidationElements('any-tel', regex_tel)
generateValidationElements('any-bi', regex_bi)
