function nav() {
    const nav = document.querySelector("nav")

    if(nav.classList.contains("open")) {
        nav.classList.remove("open")
        nav.classList.add("close")
    } else {
        nav.classList.remove("close")
        nav.classList.add("open")
    }
}