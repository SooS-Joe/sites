function validateForm() 
{
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
    if (form["mass"].value > 0) 
    {
        alert("Devi inserire un peso valido!");
        return false;
    }
}