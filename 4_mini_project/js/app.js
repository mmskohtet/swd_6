let rate = exchange.rates;
let calcHistory = [];

function showCurrencyList(selector) {
    for(let x in rate){
        document.getElementById(selector).innerHTML += `<option value="${x}">${x}</option>`;
    }
}

function checkInput(x){
    let input = Number(x);
    if(!input){
        alert("Please Input Something");
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

function del(x){
    if(confirm("Are Your Sure to Delete Row"+x+" ?")){
        calcHistory.splice(x,1);
        showHistory();
    }
}

showCurrencyList("from");
showCurrencyList("to");

function showHistory(){
    let output = document.getElementById("output");
    if(calcHistory.length >= 1){
        output.innerHTML = "";
        for(let x in calcHistory){
            output.innerHTML += `<tr>
                    <td class="text-center">${Number(x)+1}</td>
                    <td class="text-right">${calcHistory[x].input}</td>
                    <td class="text-right">${calcHistory[x].from}</td>
                    <td class="text-right">${calcHistory[x].to}</td>
                    <td class="text-right">${calcHistory[x].result}</td>
                    <td class="text-center"><i class="fa fa-trash fa-2x" onclick="del(${x})"></i></td>
                    <td class="text-right">${calcHistory[x].time}</td>                    
                </tr>`;
        }
        // let start = 1;
        // for(let x of calcHistory){
        //     output.innerHTML += `<tr>
        //             <td class="text-center">${start++}</td>
        //             <td class="text-center">${x.input}</td>
        //
        //
        //         </tr>`;
        // }
    }else{
        output.innerHTML = `<tr><td colspan="7">There is no History</td></tr>`;
    }
}


function calc(){

    // get
    let input = checkInput(document.getElementById("input").value);
    let from = document.getElementById("from").value;
    let to = document.getElementById("to").value;

    if(input && from && to){

        //process
        console.log(`${input} ${from} ${to}`);
        // toMmk(input,from);from
        let mmk = toMmk(input,from);
        let calculated = mmk / trueValue(to);
        let result = `${calculated.toFixed(2)} ${to}`;

        //set
        document.querySelector(".result").innerHTML = `Your Result : ${result}`;

        let date = new Date();
        let showTime = date.getHours()+" : "+date.getMinutes();
        console.log(showTime);

        let currentHistory = {
            input: input,
            from:from,
            to:to,
            result:result,
            time: showTime
        };

        calcHistory.push(currentHistory);

        console.log(calcHistory);
        showHistory();

    }


}
