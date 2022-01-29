function debounce(func, timeout = 300){
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => { func.apply(this, args); }, timeout);
    };
}

let resizing = debounce(function () {
    if((document.body.clientWidth > 650) && status === 0) {
        status = 1;
        Array.from(headerItems).forEach(switchDisplayType);
    }
    if((document.body.clientWidth < 650) && status === 1) {
        status = 0;
    }
}, 100);

let headerItems = document.getElementsByClassName("header-item-btn");

let status = 0;
window.addEventListener("resize", resizing);
