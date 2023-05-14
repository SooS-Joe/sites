let clearText = document.querySelector("#testochiaro");
let cipherText = document.querySelector("#testochiaro");
let keyValue = document.querySelector("#key");

let alfabeto = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];

function atbash(message)
{
    let output = "";
    for (let i = 0; i < message.length; i++) {
        output[i] = alfabeto.indexOf(24 - alfabeto.indexOf(message[i]));
    }
    return output;
} 

const atbashHandler = function(input, output)
{
    output.value = atbash(input);
}

clearText.addEventListener("input", atbashHandler(clearText, cipherText));
cipherText.addEventListener("input", atbashHandler(cipherText, clearText));

//per ogni input da ognuno dei textfield si rieseguira l'encriptaggio o il decriptaggio