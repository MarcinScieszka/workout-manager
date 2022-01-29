function switchDisplayType(element) {
    if (element.style.display === "block") {
        element.style.display = "none";
    } else {
        element.style.display = "block";
    }
}

function showElement(chosenElement) {
    let element =  document.querySelector('.' + chosenElement);
    switchDisplayType(element);
}

function showAllElements(chosenElements) {
    let elements =  document.querySelectorAll('.' + chosenElements);
    Array.from(elements).forEach(switchDisplayType);
}
