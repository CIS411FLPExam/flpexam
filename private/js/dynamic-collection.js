function GetCount()
{
    var count = 0;
    
    while(document.getElementById('contnr' + count))
    {
        count++;
    }
    
    return count;
}

function AddItem()
{
    var textAreas = document.getElementsByTagName('textarea');
    
    var index = GetCount();
    var collection = document.getElementById('collection');
    
    var contnr = document.createElement('div');
    var lbl = document.createElement('b');
    var txt = document.createElement('textarea');
    var btn = document.createElement('input');
    var newLine = document.createElement('br');
    var newLine1 = document.createElement('br');
    var divider = document.createElement('div');
    
    contnr.id = 'contnr' + index;
    
    lbl.innerHTML = 'Answer: ';
    
    txt.id = 'input' + index;
    txt.name = txt.id;
    txt.setAttribute('class', 'qa');
    txt.required = true;
    
    btn.setAttribute('type', 'button');
    btn.id = 'btn' + index;
    btn.setAttribute('onclick','RemoveItem(' + index + ')');
    btn.value = 'Remove Answer';
    
    divider.setAttribute('class', 'divider');
    
    contnr.appendChild(lbl);
    contnr.appendChild(txt);
    contnr.appendChild(btn);
    contnr.appendChild(newLine);
    contnr.appendChild(newLine1);
    contnr.appendChild(divider);
    
    collection.appendChild(contnr);
}

function RemoveItem(index)
{
    var count = GetCount();
    
    if (count < 2)
    {
        alert('There must be at least one answer.');
        return; 
    }
    
    var collection = document.getElementById('collection');
    var container = document.getElementById('contnr' + index);
    var text = document.getElementById('input' + index);
    var btn = document.getElementById('btn' + index);

    collection.removeChild(container);

    var i = 0;
    var j = 0;

    while(i < count - 1)
    {
        if (i === index)
        {
            j++;
        }

        container = document.getElementById('contnr' + j);
        text = document.getElementById('input' + j);
        btn = document.getElementById('btn' + j);

        container.id = "contnr" + i;
        text.id = 'input' + i;
        text.name = text.id;
        btn.id = 'btn' + i;
        btn.setAttribute('onclick','RemoveItem(' + i + ')');

        j++;
        i++;
    }
}