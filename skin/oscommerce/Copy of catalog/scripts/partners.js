var startPartnerDiv = "";
var endPartnerDiv = "";

function StartPartnerSlideshow()
{
    if(endPartnerDiv == "Partner2")
    {
        startPartnerDiv = "Partner2";
        endPartnerDiv = "Partner3";
        setTimeout("GetNextPartner('" + startPartnerDiv + "', '" + endPartnerDiv + "', 10, 0)",4000);
    }
    else if(endPartnerDiv == "Partner3")
    {
        startPartnerDiv = "Partner3";
        endPartnerDiv = "Partner4";
        setTimeout("GetNextPartner('" + startPartnerDiv + "', '" + endPartnerDiv + "', 10, 0)",4000);
    }
    else if(endPartnerDiv == "Partner4")
    {
        startPartnerDiv = "Partner4";
        endPartnerDiv = "Partner5";
        setTimeout("GetNextPartner('" + startPartnerDiv + "', '" + endPartnerDiv + "', 10, 0)",4000);
    }
    else if(endPartnerDiv == "Partner5")
    {
        startPartnerDiv = "Partner5";
        endPartnerDiv = "Partner6";
        setTimeout("GetNextPartner('" + startPartnerDiv + "', '" + endPartnerDiv + "', 10, 0)",4000);
    }
    else if(endPartnerDiv == "Partner6")
    {
        startPartnerDiv = "Partner6";
        endPartnerDiv = "Partner7";
        setTimeout("GetNextPartner('" + startPartnerDiv + "', '" + endPartnerDiv + "', 10, 0)",4000);
    }
    else if (endPartnerDiv == "Partner7") 
    {
        startPartnerDiv = "Partner7";
        endPartnerDiv = "Partner8";
        setTimeout("GetNextPartner('" + startPartnerDiv + "', '" + endPartnerDiv + "', 10, 0)", 4000);
    }
    else if (endPartnerDiv == "Partner8") 
    {
        startPartnerDiv = "Partner8";
        endPartnerDiv = "Partner1";
        setTimeout("GetNextPartner('" + startPartnerDiv + "', '" + endPartnerDiv + "', 10, 0)", 4000);
    }
    else
    {
        startPartnerDiv = "Partner1";
        endPartnerDiv = "Partner2";
        setTimeout("GetNextPartner('" + startPartnerDiv + "', '" + endPartnerDiv + "', 10, 0)",4000);
    }
}

function GetNextPartner(fadefrom, fadeto, start, end)
{
    var fromStart = 0;
    var toStart = 0;
    
    if(start != 0)
    {
        document.getElementById(fadefrom).style.display = "";
        document.getElementById(fadeto).style.display = "none";
        
        fromStart = start - 1;
    
        document.getElementById(fadefrom).style.filter = "alpha(opacity=" + fromStart + "0)";
        document.getElementById(fadefrom).style.opacity = "0." + fromStart;
        document.getElementById(fadefrom).style.MozOpacity = "0." + fromStart;
        
        setTimeout("GetNextPartner('" + fadefrom + "', '" + fadeto + "', " + fromStart + ", " + toStart + ")",40);
    }
    else if(end != 10)
    {   
        document.getElementById(fadefrom).style.display = "none";
        document.getElementById(fadeto).style.display = "";
        
        toStart = end + 1;
        
        if(toStart < 10)
        {
            document.getElementById(fadeto).style.filter = "alpha(opacity=" + toStart + "0)";
            document.getElementById(fadeto).style.opacity = "0." + toStart;
            document.getElementById(fadeto).style.MozOpacity = "0." + toStart;   
        }
        else
        {
            document.getElementById(fadeto).style.filter = "alpha(opacity=100)";
            document.getElementById(fadeto).style.opacity = "1.0";
            document.getElementById(fadeto).style.MozOpacity = "1.0";
        }
        
        setTimeout("GetNextPartner('" + fadefrom + "', '" + fadeto + "', 0, " + toStart + ")",40);
    }   
    else
    { 
    
        document.getElementById(fadefrom).style.display = "none";
        document.getElementById(fadeto).style.display = ""; 
        StartPartnerSlideshow(); 
    }
}