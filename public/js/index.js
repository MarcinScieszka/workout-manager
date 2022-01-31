function debounce(func, timeout = 300){
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => { func.apply(this, args); }, timeout);
    };
}

function switchElementDisplayType(element) {
    if (element.style.display === "block") {
        element.style.display = "none";
    } else {
        element.style.display = "block";
    }
}

function switchAllElementsDisplayType(chosenElements) {
    let elements =  document.querySelectorAll('.' + chosenElements);
    Array.from(elements).forEach(switchElementDisplayType);
}

function showElement(chosenElement) {
    let element =  document.querySelector('.' + chosenElement);
    switchElementDisplayType(element);
}
