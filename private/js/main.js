
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

var allSelected = false;

///Sets the current check state of all checkboxes on the page
/// to the given checkbox's check state.
function CheckAll()
{
    var cbs = document.getElementsByTagName('input');
    allSelected = !allSelected;
    for(var i = 0; i < cbs.length; i++)
    {
        if(cbs[i].type === 'checkbox')
        {
            cbs[i].checked = allSelected;
        }
    }
}