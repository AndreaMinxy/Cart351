function getRadioVal(form, name) {
    let val;
    // get list of radio buttons with specified name
    let radios = form.elements[name];

    // loop through list of radio buttons
    for (let i=0, len=radios.length; i<len; i++) {
        if ( radios[i].checked ) { // radio checked?
            val = radios[i].value; // if so, hold its value in val
            break; // and break out of for loop
        }
    }
    return val; // return value of checked radio or undefined if none checked
}
