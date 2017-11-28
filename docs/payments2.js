
  
  
  //name
  
   
  function AjaxFunction1(FIRSTNAME)
{
var httpxml;
try
  {
  // Firefox, Opera 8.0+, Safari
  httpxml=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
try
 		{
httpxml=new ActiveXObject("Msxml2.XMLHTTP");
		}
catch (e)
	{
try
		{
	httpxml=new ActiveXObject("Microsoft.XMLHTTP");
		 }
		catch (e)
	{
alert("Your browser does not support AJAX!");
return false;
  		}
		}
}
function stateck() 
   {
   if(httpxml.readyState==4)
   {
document.getElementById("namemsg").innerHTML=httpxml.responseText;
     }
   }
var url="name.php";
url=url+"?FIRSTNAME="+FIRSTNAME;

httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
  }

