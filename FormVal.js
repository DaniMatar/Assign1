function Confirm(){


return confirm("Are you Sure you Want to Delete This Record?");



}


function checkForm()
{


   if(document.forms["MyForm"].FirstName[0].value.match(/^[A-Z]*$/))
    {
        alert(" First Letter Must be UpperCase ");
        return false;
    }

    else if(document.forms["MyForm"].LastName.value.length ==0)
    {
        alert("You must enter a last name");
        return false;
    }


    if(last === last.toLowerCase())
    {
        alert(" First Letter Must be UpperCase ");
        return false;
    }




    else
    {
        alert("Employee Added")
    }

}


function anyText(field,messageText,target)
{
    var targetSpan = document.getElementById(target);
    if(targetSpan != null)
    {
        if(field.value.length ==0)
        {
            targetSpan.innerHTML = messageText;
            return false;
        }
        else
        {
            targetSpan.innerHTML = "Hey, at least you entered something!";
            return true;
        }
    }

}





