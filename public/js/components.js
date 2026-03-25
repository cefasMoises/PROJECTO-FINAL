

function asideBar() {


    if (document.querySelector('.aside-btn-option')) {

        const btn_options = document.querySelectorAll(".aside-btn-option")
        btn_options.forEach((btn_option, index) => {


            btn_option.addEventListener("click", () => {


                for (n = 0; n <= btn_options.length; n++) {

                    if (btn_options[n].classList.contains("active-btn-option")) {

                        btn_options[n].classList.remove("active-btn-option")
                    }
                    btn_option.classList.add("active-btn-option")
                }

            })



        })

    }
    else {
        console.log("esta pagina nao contem menu lateral esquerdo")
    }
}
function asidebarCollaps() {

    const asidebar = document.querySelector(".x-asidebar-app")
    asidebar.classList.toggle("x-asidebar-app-collaps")




}

asideBar()
