function check(element)
{

var str = "s"+element.id;
if(element.value.length!=0) 
{ 
if (element.value.match(/^[a-zA-Z]+((\.|\s)?[a-zA-Z]+)*(\s)*?$/))
		element.className="ok";
   else
	{
      //document.getElementById(str).innerHTML="&nbsp;<font color='red'> *Enter Valid Value</font>";
		element.className="error";
		return false;
	}
}
else
element.className="";
return true;
}

function checkFinal(element)
{

if(element.value.length!=0) 
{ 

if (element.value.match(/^[a-zA-Z]+((\.|\s)?[a-zA-Z]+)*(\s)*?$/))
		element.className="ok";
   else
	{
      //document.getElementById(str).innerHTML="&nbsp;<font color='red'> *Enter Valid Value</font>";
		element.className="error";
		return false;
	}
}
else 
{
	if (element.id.search('strImp') != -1)
	{
		element.className="error";
		return false;
	}
}

return true;
}

function numcheckFinal(element)
{
if(element.value.length!=0) 
{ 
if (element.value.search(/^(\d)*?$/) != -1 && element.value.length == element.size )
       element.className="ok";
   else
   {
		element.className="error";
		return false;
   }

}

return true;
}

function mailcheckFinal(element)
{
if(element.value.length!=0) 
{ 

	if (element.value.match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+(\s)*?$/))
    //        document.getElementById('semail').innerHTML="";
    	element.className="ok"
	else
	//	document.getElementById('semail').innerHTML="&nbsp;<font color='red'> *Enter Valid Email Address</font>";
	{
		element.className="error";
		return false;
	}
}
else
{
element.className="error";
return false;
}
	return true;
}

function validateMyForm(validationFrm)
{
var error = false;
var inputs = document.getElementsByTagName('INPUT'); 
  for (var i=0;i<inputs.length;i++) { 
   if (inputs[i].type.toLowerCase() == 'text') 
   { 
		if (inputs[i].id.search('str') != -1)
		{
			if (!checkFinal(inputs[i]))
			{
				error = true;
			}
		} 
		else if (inputs[i].id.search('num') != -1)
		{
			if (!numcheckFinal(inputs[i]))
			{
				error = true;
			}
		}
		else if (inputs[i].id.search('mail') != -1)
		{
			if (!mailcheckFinal(inputs[i]))
			{
				error = true;
			}
		}
   }   
  }
  if (error)
	return false;
  else
	return true;
} 
function numcheck(element)
{
var str = "s"+element.id;
if(element.value.length!=0) 
{ 
if (element.value.search(/^(\d)*?$/) != -1 && element.value.length == element.size )
       element.className="ok";
   else
   {
		element.className="error";
		return false;
   }
}
else
	element.className="";
return true;
}

function mailcheck(element)
{
if(element.value.length!=0) 
{ 
	if (element.value.match(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+(\s)*?$/))
    //        document.getElementById('semail').innerHTML="";
    	element.className="ok"
	else
	//	document.getElementById('semail').innerHTML="&nbsp;<font color='red'> *Enter Valid Email Address</font>";
	{
		element.className="error";
		return false;
	}
}
else
	element.className="";
return true;
}