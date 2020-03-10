let rate = exchange.rates;

function showCurrencyList(selector) {
    for(let x in rate){
        document.getElementById(selector).innerHTML += `<option value="${x}">${x}</option>`;
    }
}

function checkInput(x){
    let input = Number(x);
    if(!input){
        alert("Please Input Something")
    }else{
        return input;
    }
}

function trueValue(y) {
    let val = rate[y];
    let toNumber = Number(val.replace(",",""));
    return toNumber;
}

function toMmk(x,y){
    let calculated = x * trueValue(y);
    return calculated;
}

showCurrencyList("from");
showCurrencyList("to");


function calc(){

    // get
    let input = checkInput(document.getElementById("input").value);
    let from = document.getElementById("from").value;
    let to = document.getElementById("to").value;

    //process
    console.log(`${input} ${from} ${to}`);
    // toMmk(input,from);from
    let mmk = toMmk(input,from);
    let calculated = mmk / trueValue(to);

    //set
    document.querySelector(".result").innerHTML = `Your Result : ${calculated.toFixed(2)} ${to}`;

}
