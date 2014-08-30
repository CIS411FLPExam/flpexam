function InitPage( )
{
	/// <summary>
	/// Initializes the page so that it has the default header and footer navigation elements.
	/// </summary>
	LoadDefaultHeader( );
	LoadDefaultFooter( );
}

function LoadDefaultHeader( )
{
	/// <summary>
	/// Loads the default header.
	/// </summary>
      
	$( '#mainHeader' ).load( 'header.html' );
}

function LoadDefaultFooter( )
{
	/// <summary>
	/// Loads the default footer.
	/// </summary>
	
	$( '#mainFooter' ).load( 'footer.html' );
}

function GetRandomImages()
{
	/// <summary>
	/// Gets a collection of images from the sample images.
	/// </summary>
	
	var images = new Array('', '', '', '', '');
	
	for(var i = 0; i < images.length; i++)
	{
		var randomIndex = Math.floor(Math.random() * 12) + 1;
		images[i] = '<img src="../images/sample-designs/sample' + randomIndex + '.jpg" alt="sample' + randomIndex + '." />';
		
		for(var j = 0; j < i; j++)
		{
			if(images[i] === images[j])
			{
				images[i] = '';
				i--;
			}
		}
	}
	
	return images;
}

function SetListElements(id, elements)
{
	/// <summary>
	/// Takes a collection of HTML elements and places them in the specified list.
	/// </summary>
	
	var innerHTML = "";
	
	for(var i = 0; i < elements.length; i++)
	{			
		var element = elements[i];
		innerHTML += + "<li>" + element + "</li>";
	}
	
	document.getElementById( id ).innerHTML = innerHTML; 
}
