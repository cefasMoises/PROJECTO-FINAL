
export function backPage() {

    window.history.back()

}


export function test() {


    alert("ola mundo")
}

export function goPageTime(route, delay_time) {

    setTimeout(ir => location.pathname = route, delay_time)

}