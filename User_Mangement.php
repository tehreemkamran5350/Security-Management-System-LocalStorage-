
<!DOCTYPE html>
<html lang="en">
<head>
<title>userManangement</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}


.topnav {
    overflow: hidden;
    background-color: #333;
}

/* Style the topnav links */
.topnav a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

/* Change color on hover */
.topnav a:hover {
    background-color: #ddd;
    color: black;
}

/* Style the content */
.content {
    background-color: #ddd;
    padding: 10px;
    height: 200px; 
}
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    
}

.grid-container {
  display: grid;
  grid-template-columns: auto auto auto auto auto auto auto auto;
  grid-gap: 10px;
  background-color: white;
  padding: 1px;
}
.grid-container > div {
  background-color: gainsboro;
  
  padding: 0px 0;
  
}
.item1 {
  grid-row: 1/4;
  
}
.item2 {
  grid-row: 1/4;
  
}
h1 {
    color: white;
     background-color:rgb(60, 60, 60)
}

</style>
<script src="SecurityManager.js"></script>
        <script>

      function Main(){
		var tableRef = document.getElementById("table");
tableRef.style.width  = '100px';
    tableRef.style.border = '0px solid black';

var newRow = tableRef.insertRow(0);
for(var j=0;j<5;j++){
  var newCell = newRow.insertCell(j);
var newText="";
  if(j==0){
  newText = document.createTextNode("ID");
newCell.style.border = '1px solid black';
}
if(j==1){
	newText = document.createTextNode("Name");
newCell.style.border = '1px solid black';
}
 if(j==2){
  newText = document.createTextNode("Email");
newCell.style.border = '1px solid black';
}
if(j==3){
	
	newText = document.createTextNode("Edit");
newCell.style.border = '1px solid black';
}
if(j==4){
	
	newText = document.createTextNode("Delete");

newCell.style.border = '1px solid black';
}
  newCell.appendChild(newText);
}
  var u_arr= SecurityManager.GetAllUsers();

for(var i=0;i<u_arr.length;i++){
  var newRow = tableRef.insertRow(-1);

  for(var j=0;j<5;j++){
  var newCell = newRow.insertCell(j);
var newText="";
  if(j==0){
  newText = document.createTextNode(u_arr[i].ID);
newCell.style.border = '1px solid black';
}
if(j==1){
	newText = document.createTextNode(u_arr[i].login);
newCell.style.border = '1px solid black';
}
 if(j==2){
  newText = document.createTextNode(u_arr[i].email);
newCell.style.border = '1px solid black';
}
if(j==3){
	var newText = document.createElement('a');
 	
	
	newText.id=u_arr[i].ID;
	
	newText.href="#";
  	newText.innerHTML = "edit";
	newText.onclick=function(){
		var edit_user=SecurityManager.GetUserById(this.id);
		document.getElementById("login").value=edit_user.login;
		document.getElementById("pswd").value=edit_user.pswd;
		document.getElementById("name").value=edit_user.name;
		document.getElementById("email").value = edit_user.email;
		document.getElementById('cmbCountries').value = edit_user.cntry;
		var c = document.getElementById('cmbCities');
		var city_arr = SecurityManager.GetCitiesByCountryId(edit_user.cntry);
		c.innerHTML = '';
		//var u_id = 0;
		//var u_name = "";
		for (var i = 0; i < city_arr.length; i++) {
		    if (city_arr[i].CityID == edit_user.city) {
		        var opt = document.createElement("option");
		        opt.setAttribute("value", city_arr[i].CityID);
		        opt.innerText = city_arr[i].Name;
		        c.appendChild(opt);
		        break;
		    }
		}
		for (var i = 0; i < city_arr.length; i++) {
		    if (city_arr[i].CityID != edit_user.city) {
		        var opt = document.createElement("option");
		        opt.setAttribute("value", city_arr[i].CityID);
		        opt.innerText = city_arr[i].Name;
		        c.appendChild(opt);
		        
		    }
		}
		var sBtn = document.getElementById("save");
		sBtn.onclick = function () {
		    alert("hello");
		    edit_user.login=document.getElementById("login").value;
		    edit_user.pswd=document.getElementById("pswd").value;
		    edit_user.name=document.getElementById("name").value;
		    edit_user.email= document.getElementById("email").value;
		    edit_user.cntry=document.getElementById('cmbCountries').value;
		    edit_user.city = document.getElementById('cmbCities').value;
		    SecurityManager.SaveUser(edit_user, function () { alert("user has been edited") }, function () { alert("user has not been edited") });
		    window.location.href="User_Mangement.html";
            
		};
		var clr = document.getElementById("clear");
		clr.onclick = function () {
		    document.getElementById("login").value = "";
		    document.getElementById("pswd").value = "";
		    document.getElementById("name").value = "";
		    document.getElementById("email").value = "";
		    document.getElementById('cmbCountries').value = "";
		    document.getElementById('cmbCities').value = "";
		};
};
newCell.style.border = '1px solid black';
}
if(j==4){

	var newText = document.createElement('a');
 	
	
	newText.id=u_arr[i].ID;
	
	newText.href="#";
  	newText.innerHTML = "delete";
	newText.onclick=function(){
	var agree=confirm("do you want to delete record");
	
	if(agree){

		SecurityManager.DeleteUser(this.id,function(){"record deleted successfully"},function(){"record is not deleted successfully"});
		
	}
	location.reload(true);
};
	
newCell.style.border = '1px solid black';
}
  newCell.appendChild(newText);
}


}
                var countries = SecurityManager.GetCountries();
                var cmb = document.getElementById('cmbCountries')
                for(var i=0;i<countries.length;i++)
                {
                    var opt = document.createElement("option");
                    opt.setAttribute("value",countries[i].CountryID);
                    opt.innerText = countries[i].Name;

                    cmb.appendChild(opt);
                }


                cmb.onchange = function(){

                    var citycmb = document.getElementById('cmbCities');

                    //Remove all child elements (e.g. options)
                    citycmb.innerHTML = '';
 
                    var cities = SecurityManager.GetCitiesByCountryId(cmb.value);

                    for(var i=0;i<cities.length;i++)
                    {
                        var opt = document.createElement("option");
                        opt.setAttribute("value",cities[i].CityID);
			
                        opt.innerText = cities[i].Name;

                        citycmb.appendChild(opt);
                    }   
		

                //end of onchange
	
};
		var save_btn=document.getElementById("save");
	
		
		save_btn.onclick=function(){
		var log=document.getElementById("login").value;
		var psw=document.getElementById("pswd").value;
		var name=document.getElementById("name").value;
		var mail=document.getElementById("email").value;
		var ctr = document.getElementById('cmbCountries').value;
		var cit = document.getElementById('cmbCities').value;
		
		var userObj={};
		userObj.login=log;
		userObj.name=name;
		userObj.pswd=psw;
		userObj.email=mail;
		userObj.cntry=ctr;
		userObj.city=cit;
		var flag=true;
		if(!userObj.login || !userObj.pswd || !userObj.email || !userObj.cntry || !userObj.city ||!userObj.name){
			alert("fill all the fields");
		}
		else{
			var user_arr= SecurityManager.GetAllUsers();
		        for(var i=0;i<user_arr.length;i++){
			if(user_arr[i].login==log || user_arr[i].email==mail){
				alert("username or email id already exists,enter another login");
				flag=false;
				break;
				
			}
			
			
		}
			
		if(flag){
			SecurityManager.SaveUser(userObj,function(){alert("user has been created")},function(){alert("user has not been created")});
location.reload(true);
		}
		var clr = document.getElementById("clear");
		clr.onclick = function () {
		    document.getElementById("login").value="";
		    document.getElementById("pswd").value="";
		    document.getElementById("name").value="";
		    document.getElementById("email").value="";
		    document.getElementById('cmbCountries').value="";
		    document.getElementById('cmbCities').value="";
		};

		
      
 }
};
}//end ofMain
            

        </script>
</head>
<body onload="Main();">

<div class="topnav">
  <a href="admin.php" >Home</a>
	  <a href="User_Mangement.php" >User Management</a>
	     <a href="Role_Mangement.php" >Role Management</a>
	    <a href="Permission_Mangement.php" >Permissions Management</a>
	   <a href="Role_Permission.php">Role-Permissions Assignment</a>
	<a href="User_Role.php">User-Role Assignment</a>
	   <a href="login.php" >Logout</a>

</div>


  

<div class="grid-container">
  <div class="item1" id="div1">
<div class="sidenav">
<h1> User Management</h1>
<form>

Login:<br>
  <input type=text id="login" required><br>
  Password:<br>
<input type=password id="pswd" required><br>
 Name:<br>
<input type=text id="name" required><br>
 Email:<br>
  <input type=text id="email" required><br>
 Country:<br>
 <select name="" id="cmbCountries">

    </select><br>

	City:<br>
   <select name="" id="cmbCities" required>
       </select><br>
  <input type=submit id="save" value="save">
    <input type=submit id="clear" value="clear">
</form>
</div>
</div>
  <div class="item2" >
<table id="table"></table>
  
</div>


</body>
</html>








