var pointer = document.getElementById('pointer');
var path = document.querySelector('path');
var state = document.getElementById('state');

let bmi = parseFloat(document.getElementById('bmi').innerHTML)
let finalPoint = (450/27)*(bmi-15);
if (finalPoint > 450) {
    finalPoint = 440;
}
let underweightLimit = 450/5;
let normalLimit = underweightLimit*2;
let overweightLimit = underweightLimit*3;
let obeseLimit = underweightLimit*4;
let extremelyobeseLimit = underweightLimit*5;
/**
 * il primo intervallo è dai 18,5 in giù
 * 2° 18,5-25 6,5
 * 3° 25-30 5
 * 4° 30-35 5
 * 5° >35 
 * per far funzionare la cosa dobbiamo dare un itervallo di 5 a tutti i stati
 * quindi ci sono 5 stati quindi sono 25 parti in totale
 * per fare questo il minimo bmi visualizzabile è 13
 * il bmi maggiore sarà 40
 * quindi 13 sta a 0 px come 40 sta alla lunghezza totale quindi 450px
 */

document.addEventListener('DOMContentLoaded', script());

function script() {
    var currentPoint = 0;
    let timer = setInterval(() => {
        if (currentPoint >= finalPoint)
        {
            let cstate = currentState(currentPoint);
            if (cstate.status == 'Sottopeso' && bmi > 18.5)
                cstate = {color: '#73C7A2', status: 'Normopeso'};
            state.innerHTML += "<span style = \"color:"+ cstate.color + "\">" + cstate.status + "</span>";
            state.style.animationName = 'fadein';
            state.style.opacity = 1;
            clearInterval(timer);
        }
        else 
        {
            currentPoint++;
            pointer.style.left = currentPoint + 'px';
            path.style.fill = currentState(currentPoint).color;
        }
      }, 10);
}

function currentState(currentPoint)
{
    if (currentPoint <= underweightLimit)
        return {color: '#88B7D8', status: 'Sottopeso'};
    else if (currentPoint <= normalLimit)
        return {color: '#73C7A2', status: 'Normopeso'};
    else if (currentPoint <= overweightLimit)
        return {color: '#FDD10B', status: 'Sovrappeso'};
    else if (currentPoint <= obeseLimit)
        return {color: '#F89F51', status: 'Obeso'};
    else if (currentPoint <= extremelyobeseLimit)
        return {color: '#EF464C', status: 'Gravemente Obeso'};
}