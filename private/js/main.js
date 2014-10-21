
///Asks the user for confrimation, and returns to true on confirm.
function ConfirmationPrompt(message)
{
    var result = confirm(message);
    
    if (result === true)
    {
        return true;
    }
    
    return false;
}