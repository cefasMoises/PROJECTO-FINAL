function reloadScreen() {

    location.reload()
}
async function changeScreen(url, id_element) {


    const element = document.querySelector(id_element)

    const response = await fetch(url)


    if (response.ok) {


        let status_response = await response.text()

        if (status_response.length != 0) element.innerHTML = status_response




    } else {

        element.innerHTML = "<h1>erro ao carregar</h1>"


    }








}

function asideHide() {

    document.getElementById('asidebar').classList.toggle('hidden')
}

/*colorir os botoens do aside bar caso forem pressinados*/
const aside_buttons = document.querySelectorAll('#asidebar a');
const progressBar = document.querySelector('#progress')
// Pega a primeira pasta da URL atual
const currentPath = window.location.pathname.split('/')[1];

aside_buttons.forEach(function (element) {
    const hrefPath = new URL(element.href).pathname.split('/')[1];


    element.addEventListener('click', function () {


        progressBar.classList.remove('hidden')
    })


});

const all_buttons = document.querySelectorAll('body button')

const select_method_pagamento = document.querySelector('#m_pagamento');
const ref_pagamento = document.querySelector('#referencia_pagamento')
const input_ref_pagamento = document.querySelector('#referencia')




select_method_pagamento.addEventListener('change', function () {

    console.log(this.value)
    if (this.value == 'dinheiro') {

        ref_pagamento.classList.add('hidden')
        input_ref_pagamento.value = Math.floor(Math.random() * 100000)

    }
    else {
        ref_pagamento.classList.remove('hidden')
        input_ref_pagamento.value = ''

    }
})
