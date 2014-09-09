var count = 0;
			
function AddItem()
{
    index = count;
    var collection = document.getElementById('collection');

    collection.innerHTML += "<div id='contnr" + index + "'>";
    collection.innerHTML += "</div>";

    var container = document.getElementById('contnr' + index);

    container.innerHTML += "<label id='lbl" + index + "'>Answer: </label>";
    container.innerHTML += "<textarea id='input" + index + "' type='text' class='qa' name='input" + index + "'></textarea>";
    container.innerHTML += "<input id='btn" + index +"' type='button' value='Remove Answer' onclick='RemoveItem(" + index + ");' />";
    container.innerHTML += "<br />";
    container.innerHTML += "<div class='divider'></div>";

    count++;
}

function RemoveItem(index)
{
    var collection = document.getElementById('collection');
    var container = document.getElementById('contnr' + index);
    var text = document.getElementById('input' + index);
    var btn = document.getElementById('btn' + index);
    var lbl = document.getElementById('lbl' + index);

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
        lbl = document.getElementById('lbl' + j);

        container.id = "contnr" + i;
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