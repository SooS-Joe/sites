//elemment script
let leftText = document.querySelector('#io1');
let rightText = document.querySelector('#io2');
let leftEncode = document.querySelector('#encode1');
let rightEncode = document.querySelector('#encode2');
let leftKeyValue = document.querySelector('#key1');
let rightKeyValue = document.querySelector('#key2');
let switchButton = document.querySelector('#reverse-btn');
let clearMessage = "";
let alfabeto = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
let ps = [
    ['a', 'b', 'c', 'd', 'e'],
    ['f', 'g', 'h', 'i', 'k'],
    ['l', 'm', 'n', 'o', 'p'],
    ['q', 'r', 's', 't', 'u'],
    ['v', 'w', 'x', 'y', 'z']
];

function clearText (message, key)
{
    delete key;
    return message;
}

function caesarChipher(message, key)
{
    //normalizzazione della chiave
    key = (key >= 0 ? key%26 : 26-Math.abs(key%26));
    let output = "";
    for (let i = 0; i < message.length; i++) 
    {
        if (alfabeto[alfabeto.indexOf(message[i])] === undefined) 
        {
            if(alfabeto[alfabeto.indexOf(message[i].toLowerCase())] === undefined)
                output += message[i];
            else
                output += (alfabeto[(alfabeto.indexOf(message[i].toLowerCase())+key)%26]).toUpperCase();                
        }
        else
            output += alfabeto[(alfabeto.indexOf(message[i])+key)%26];
    }
    return output;
}

function atbash(message, key)
{
    delete key;
    let output = "";
    for (let i = 0; i < message.length; i++) 
    {
        if (alfabeto[alfabeto.indexOf(message[i])] === undefined) 
        {
            if(alfabeto[alfabeto.indexOf(message[i].toLowerCase())] === undefined)
                output += message[i];
            else
                output += (alfabeto[(25 - alfabeto.indexOf(message[i].toLowerCase()))]).toUpperCase();                
        }
        else
            output += alfabeto[(25 - alfabeto.indexOf(message[i]))];
    }
    return output;
}

function polybiusSquare(message, key)
{
    delete key;
    console.log("eseguendo scacchiera di polibio");
    output = "";
    let find = false;
    message = message.toLowerCase().replace('j','i');
    for (let i = 0; i < message.length; i++) 
    {
        find = false;
        for (let j = 0; j < ps.length && !find; j++)
        {
            for (let k = 0; k < ps[j].length && !find; k++)
            {
                if(message[i] == ps[j][k])
                {
                    output += "" + (j+1) + (k+1) + " ";
                    find = true;
                }
                console.log("cambio lettera");
            }
        }
        find = false;
    }
    output.slice(0, output.length-1);
    return output;
}

function checkSyntax(message)
{
    let output = [];
    for (let i = 2; i < message.length; i+=3) 
    {
        if (/^[1-5]$/.test(message[i-2]) && /^[1-5]$/.test(message[i-1]) && (message[i] == " " || i == message.length))
        {
            output.push([message[i-2], message[i-1]]);
        }    
        else
            return false;
    }
    return output;
}

function dPolybiusSquare(message, key)
{
    delete key;
    console.log("eseguendo scacchiera di polibio");
    output = "";
    if(!(message = checkSyntax(message)))
    {
        return output;
    }
    for (let i = 0; i < message.length; i++)
    {
        output += ps[message[i][0]-1][message[i][1]-1];
        console.log(output);
    }
    console.log(output);
    return output;
}

function vigenereChipher(message, key, crypt)
{
    output = "";
    if(key != "")
    {
        let chipher = function(i, j){};
        if(crypt == "encrypt")
        chipher = function(i, j) {return (alfabeto.indexOf(message[i]) + alfabeto.indexOf(key[j % key.length]))%26;};
        else if(crypt == "decrypt")
        chipher = function(i, j) 
        {
            let index = (alfabeto.indexOf(message[i]) - alfabeto.indexOf(key[j % key.length]))%26;
            return index >= 0 ? index : 26+index;
        };
        message = message.toLowerCase();
        key = key.toLowerCase();
        for (let i = 0, j = 0; i < message.length; i++)
        {
            if(/^[a-z]$/.test(message[i]))
            {
                let index = chipher(i, j);
                output += alfabeto[index];
                j++;
            }
            else
                output += message[i];
        }
    }
    return output;
}

function sortKey(key)
{
    key = key.split('');
    let indices = [];
    for (let i = 0; i < key.length; i++) {
      indices.push(i);
    }
    indices.sort(function(a, b) {
      if (key[a] === key[b]) {
        return a - b;
      } else {
        return key[a].localeCompare(key[b]);
      }
    });
    return indices;
}

function transpositionChipher(message, key)
{
    output = "";
    if(key.length > 0 && !key.includes(' '))
    {
        let sKey = sortKey(key);
        let max = Math.ceil(message.length/key.length) //massimo numero di caratteri per colonna
        
        //divisione del messaggio (uso questo metodo perché si applica meglio al concetto di matrice in informatica)
        for (let i = 0; i < key.length; i++)
        {
            let offset = sKey[i];
            for (let j = 0; j < max; j++)
            {
                output += (message[(j*key.length)+offset] == undefined ? "*" : message[(j*key.length)+offset]);
            }
            
        }
    }
    return output;
}

function dTranspositionChipher(message, key)
{
    console.log("decriptando il cifrario di cesare");
    let output = "";
    if(key.length > 0 && !key.includes(' '))
    {
        let sKey = sortKey(key);
        let max = Math.ceil(message.length/key.length) //massimo numero di caratteri per colonna
        for (let i = 0; i < max; i++)   
        {
            for (let j = 0; j < key.length; j++)
            {
                index = (max*sKey[j]+i);
                console.log(message[index]);
                output += (message[index] == undefined ? "*" : (message[index]));
            }
        }
    }
    return output;
}

function toBinary(input) {
    let output = [];
    output.value = "";
    for (var i = 0; i < input.length; i++) {
        output.push(input[i].charCodeAt(0));
    }
  }

function xor(message, key)
{
    let output = "";

    return output;
}

//dichiarazione delle funzioni variabili di criptaggio e decriptaggio del messaggio formaggio foraggio andaggio
let leftEncryptionMethod = clearText;
let rightEncryptionMethod = clearText;
let leftDecryptionMethod = clearText;
let rightDecryptionMethod = clearText;

//funzioni gestionali per eventi e cambiamenti di testo o di codifica
function triggerEvent(eventName, element)
{
    var event; // The custom event that will be created
    if(document.createEvent)
    {
        event = document.createEvent("HTMLEvents");
        event.initEvent(eventName, true, true);
        event.eventName = eventName;
        element.dispatchEvent(event);
    } 
    else 
    {
        event = document.createEventObject();
        event.eventName = eventName;
        event.eventType = eventName;
        element.fireEvent(event.eventType, event);
    }
}

function handleChanges()
{
    console.log("modalita cambiate");
    console.log(leftEncode.value);
    console.log(rightEncode.value);
    switch (leftEncode.value)
    {
        case "0": // testo chiaro
            leftEncryptionMethod = clearText;
            leftDecryptionMethod = clearText;
            leftKeyValue.style.visibility = 'hidden';
            break;
        case "1": //cifrario di cesare
            leftEncryptionMethod = caesarChipher;
            leftDecryptionMethod = function (message, key) {return caesarChipher(message, -key)}
            leftKeyValue.value = "";
            leftKeyValue.type = "number";
            leftKeyValue.value = "1";
            leftKeyValue.min = "0";
            leftKeyValue.style.visibility = 'visible';
            break;
        case "2": // atbash
            leftEncryptionMethod = atbash;
            leftDecryptionMethod = atbash;
            leftKeyValue.style.visibility = 'hidden';
            break;
        case "3": // scacchiera di polibio
            leftEncryptionMethod = polybiusSquare;
            leftDecryptionMethod = dPolybiusSquare;
            leftKeyValue.style.visibility = 'hidden';
            break;
        case "4": // cifrario di vigenère
            leftEncryptionMethod = function(message, key) {return vigenereChipher(message, key, "encrypt")};
            leftDecryptionMethod = function(message, key) {return vigenereChipher(message, key, "decrypt")};
            leftKeyValue.value = "";
            leftKeyValue.type = 'text';
            leftKeyValue.pattern = '[A-Za-z]';
            leftKeyValue.style.visibility = 'visible';
            break;
        case "5":
            leftEncryptionMethod = transpositionChipher;
            leftDecryptionMethod = dTranspositionChipher;
            leftKeyValue.value = "";
            leftKeyValue.type = 'text';
            leftKeyValue.pattern = '[A-Za-z]';
            leftKeyValue.style.visibility = 'visible';
        case "6":
            leftEncryptionMethod = xor;
            leftDecryptionMethod = xor;
            leftKeyValue.value = "";
            leftKeyValue.type = 'text';
            leftKeyValue.pattern = '';
            leftKeyValue.style.visibility = 'visible';
    }
    switch (rightEncode.value)
    {
        case "0":
            rightEncryptionMethod = clearText;
            rightDecryptionMethod = clearText;
            rightKeyValue.style.visibility = 'hidden';
            break;
        case "1":
            rightEncryptionMethod = caesarChipher;
            rightDecryptionMethod = function (message, key) {return caesarChipher(message, -key);}
            rightKeyValue.value = "";
            rightKeyValue.type = "number";
            rightKeyValue.value = "1";
            leftKeyValue.min = "0";
            rightKeyValue.style.visibility = 'visible';
            break;
        case "2":
            rightEncryptionMethod = atbash;
            rightDecryptionMethod = atbash;
            rightKeyValue.style.visibility = 'hidden';
            break;
        case "3":
            rightEncryptionMethod = polybiusSquare;
            rightDecryptionMethod = dPolybiusSquare;
            rightKeyValue.style.visibility = 'hidden';
            break;
        case "4":
            rightEncryptionMethod = function(message, key) {return vigenereChipher(message, key, "encrypt")};
            rightDecryptionMethod = function(message, key) {return vigenereChipher(message, key, "decrypt")};
            rightKeyValue.value = "";
            rightKeyValue.type = 'text';
            rightKeyValue.pattern = '[A-Za-z]';
            rightKeyValue.style.visibility = 'visible';
            break;
        case "5":
            rightEncryptionMethod = transpositionChipher;
            rightDecryptionMethod = dTranspositionChipher;
            rightKeyValue.value = "";
            rightKeyValue.type = 'text';
            rightKeyValue.pattern = '[A-Za-z]';
            rightKeyValue.style.visibility = 'visible';
            break;
        case "6":
            rightEncryptionMethod = xor;
            rightDecryptionMethod = xor;
            rightKeyValue.value = "";
            rightKeyValue.type = 'text';
            rightKeyValue.pattern = '';
            rightKeyValue.style.visibility = 'visible';
    }
    triggerEvent("input", leftText);
}

function sizeHandler() 
{
    rightText.style.height = leftText.style.height = 'auto';
    rightText.style.height = leftText.style.height = leftText.scrollHeight+'px';
}

//event script
/**
 * ogni volta che viene scritto qualcosa nel campo sinistro:
 * 1. si prende quello che è scritto nel campo
 * 2. lo si decripta in testo chiaro con il metodo sinistro selezionato
 * 3. si mette nel campo destro il messaggio in chiaro criptato con il metodo destro selezionato
 * viceversa per il campo destro
 */

leftEncode.addEventListener('change', handleChanges);
rightEncode.addEventListener('change', handleChanges);


leftText.addEventListener("input", function() 
{
    clearMessage = leftDecryptionMethod(leftText.value, leftKeyValue.value);
    rightText.value = rightEncryptionMethod(clearMessage, rightKeyValue.value);
});

rightText.addEventListener("input", function() 
{
    clearMessage = rightDecryptionMethod(rightText.value, rightKeyValue.value);
    leftText.value = leftEncryptionMethod(clearMessage, leftKeyValue.value); 
});

switchButton.addEventListener("click", function() {
    let tEncode = leftEncode.value;
    let tLKey = leftKeyValue.value;
    let tRKey = rightKeyValue.value;
    leftEncode.value = rightEncode.value;
    rightEncode.value = tEncode;
    triggerEvent('change', leftEncode);
    leftKeyValue.value = tRKey;
    rightKeyValue.value = tLKey;
})



// clearText.addEventListener("input", sizeHandler);
// cipherText.addEventListener("input", sizeHandler);

leftKeyValue.addEventListener("input", function() {
    triggerEvent('input', leftText);
    sizeHandler();
});
rightKeyValue.addEventListener("input", function() {
    triggerEvent('input', leftText);
    sizeHandler();
});