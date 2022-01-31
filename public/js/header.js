let isHeaderHidden = 1;
function headerButtonHandler() {
    if (isHeaderHidden === 1) {
        document.querySelector('#mobile-header-btn').innerHTML = 'X';
        isHeaderHidden = 0;
    }
    else {
        document.querySelector('#mobile-header-btn').innerHTML = '☰';
        isHeaderHidden = 1;
    }
    switchAllElementsDisplayType('header-item-btn')
}

let resizing = debounce(function () {
    if((document.body.clientWidth > 650) && isHeaderHidden === 1) {
        isHeaderHidden = 0;
        document.querySelector('#mobile-header-btn').innerHTML = 'X';
        Array.from(headerItems).forEach(switchElementDisplayType);
    }
}, 100);

let headerItems = document.getElementsByClassName("header-item-btn");


window.addEventListener("resize", resizing);
