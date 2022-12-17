const rangeInput = document.querySelectorAll(".range-input input"),
    priceInput = document.querySelectorAll(".price-input input"),
    progress = document.querySelector(".slider .progress");

let priceGap = 100;

rangeInput.forEach(input  => {
    input.addEventListener("input", e => {
        // getting two range values and parsing then into number
        let minVal = parseInt(rangeInput[0].value),
            maxVal = parseInt(rangeInput[1].value);

        if (maxVal - minVal < priceGap) {
            if (e.target.className === "range-min") {
                rangeInput[0].value = maxVal - priceGap;
            } else {
                rangeInput[1].value = minVal + priceGap;
            }
        } else {
            priceInput[0].value = minVal;
            priceInput[1].value = maxVal;
            progress.style.right = (minVal / rangeInput[0].max) * 100 + '%';
            progress.style.left = 100 - (maxVal / rangeInput[1].max) * 100 + '%';
        }
    });
});
// End Price Range
