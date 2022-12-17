const rangeInput2 = document.querySelectorAll(".range-input-mobile input"),
    priceInput2 = document.querySelectorAll(".price-input-mobile input"),
    progress2 = document.querySelector(".slider-mobile .progress-mobile");

let priceGap2 = 100;

rangeInput2.forEach(input  => {
    input.addEventListener("input", e => {
        // getting two range values and parsing then into number
        let minVal = parseInt(rangeInput2[0].value),
            maxVal = parseInt(rangeInput2[1].value);

        if (maxVal - minVal < priceGap2) {
            if (e.target.className === "range-min-mobile") {
                rangeInput2[0].value = maxVal - priceGap2;
            } else {
                rangeInput2[1].value = minVal + priceGap2;
            }
        } else {
            priceInput2[0].value = minVal;
            priceInput2[1].value = maxVal;
            progress2.style.left = (minVal / rangeInput2[0].max) * 100 + '%';
            progress2.style.right = 100 - (maxVal / rangeInput2[1].max) * 100 + '%';
        }
    });
});
// End Price Range
