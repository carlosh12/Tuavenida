/////////////////////////////
// cookie + pop-up idioma ///////////////////////////////
/////////////////////////////    


// Inicializa el selector de idioma
Shadowbox.init( {
    handleOversize: "drag",
    modal: true
});

// Lanza el pop-up selector de idioma
function abrirshadow()
{               
    Shadowbox.open({
        content: 'idiomas.php', 
        player: 'iframe',   //el tipo de elemento** 
        width: "400",
        height: "300",
        title: ""
    });


}

//Retorna la cookie c_name
function getCookie(c_name)
{
    var i,x,y,ARRcookies=document.cookie.split(";");
    for (i=0;i<ARRcookies.length;i++)
    {
        x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
        y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
        x=x.replace(/^\s+|\s+$/g,"");
        if (x==c_name)
        {
            return unescape(y);
        }
    }
}

//Si no existe la cookie lanza el pop-up
function checkCookie()
{
    var username=getCookie("idioma");
    if (username==null)
    {
        abrirshadow();
    }
}
//////////////////////////////////////////////////////////////
