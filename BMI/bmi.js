function validateForm() 
{
    let form = document.forms["bmi"];
    if (form["name"].value == "")
    {
        alert("Devi inserire un nome!");
        return false;
    }
    if (form["surname"].value == "")
    {
        alert("Devi inserire un cognome!");
        return false;
    }
    if (form["sex"].value == "-")
    {
        alert("Devi inserire un sesso!");
        return false;
    }
    if (form["age"].value <= 0 || form["age"].value > 120)
    {
        alert("Devi inserire un'età valida!");
        return false;
    }
    if (form["height"].value > 0)
    {
        alert("Devi inserire un'altezza valida!");
        return false;
    }
    if (form["weight"].value > 0) 
    {
        alert("Devi inserire un peso valido!");
        return false;
    }
}