var count = 0;

function AddItem()
{
    index = count;
    var collection = document.getElementById('collection');

    collection.innerHTML += "<label id='lbl" + index + "'>label:</label>";
    collection.innerHTML += "<input id='input" + index + "' type='text' name='input" + index + "' />";
    collection.innerHTML += "<input id='btn" + index +"' type='button' value='Remove' onclick='RemoveItem(" + index + ");' />";

    count++;
}

function RemoveItem(index)
{
    var collection = document.getElementById('collection');
    var text = document.getElementById('input' + index);
    var btn = document.getElementById('btn' + index);
    var lbl = document.getElementById('lbl' + index);

    collection.removeChild(text);
    collection.removeChild(btn);
    collection.removeChild(lbl);

    var i = 0;
    var j = 0;

    while(i < count - 1)
    {
        if (i === index)
        {
            j++;
        }

        text = document.getElementById('input' + j);
        btn = document.getElementById('btn' + j);
        lbl = document.getElementById('lbl' + j);

        if(!btn)
        {
                alert("I'm null.");
        }

        text.id = 'input' + i;
        text.name = text.id;
        btn.id = 'btn' + i;
        btn.setAttribute('onclick','RemoveItem(' + i + ')');
        lbl.id = 'lbl' + i;

        j++;
        i++;
    }

    count--;
}