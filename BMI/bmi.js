var pointer = document.getElementById('pointer');
let bmi = parseFloat(document.getElementById('bmi').innerHTML);
let id = null; 
console.log(typeof(bmi));

window.addEventListener('DOMContentLoaded', ()=>{
    let id = setInterval(frame, 5); 
})

function frame() {
    let pos = 0;
    if (pos == 450) 
    clearInterval(id);
    else 
    {
        pos++;
        pointer.style.left = pos + 'px';
    }
}