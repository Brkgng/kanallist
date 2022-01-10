// input's value of max cannot be less than value of min
function forceMin(e) {
    const min = e.target.getAttribute("min");
    console.log(min);
    if (Number(e.target.value) < Number(min))
    e.target.value = min;
}

function handleMinChange(e) {
    const min = e.target.value;

    // get value from changed input
    if (e.target.id.localeCompare("subsMin") == 0)
        var max = document.querySelector('#subsMax');
    else if (e.target.id.localeCompare("totalVideoMin") == 0)
        var max = document.querySelector('#totalVideoMax');
    else if (e.target.id.localeCompare("videoCountMin") == 0)
        var max = document.querySelector('#videoCountMax');

    // if max is less than min than max's value changed with min's value
    if (Number(max.value) < Number(min))
    max.value = min;
    max.setAttribute("min", min);
}
