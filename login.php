
<!DOCTYPE html>
<html>
<head>
<style>
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


<script src="SecurityManager.js" type="text/javascript" ></script>
<script type="text/javascript">

function Main(){

var btn_login=document.getElementById('btn1');
 btn_login.onclick=function(){
	var login = document.getElementById('user').value;
	var pswd = document.getElementById('psw').value;
	var result=SecurityManager.ValidateAdmin(login,pswd);
//debugger;	
if(result==true)
	{	
		window.location.href="admin.php";
	}
	else
	{
		alert("Username or Password is Wrong");
	}
return false;
};
	
 var btn2_login = document.getElementById('btn2');
 btn2_login.onclick = function () {
     var login1 = document.getElementById('user1').value;
     var pswd1 = document.getElementById("psw2").value;
     var user_arr = SecurityManager.GetAllUsers();
     var flag=true;
     for (var i = 0; i < user_arr.length; i++)
     {
         if(user_arr[i].login==login1 && user_arr[i].pswd==pswd1)
         {
             if (typeof (Storage) !== "undefined") {
                 // Store
                 localStorage.setItem("username", user_arr[i].login);
             }
             alert(localStorage.getItem("username"));
             //var u = {};
             //u.username = user_arr[i].login;
             //window.sessionStorage.setItem('username', JSON.stringify(u));
             window.location.href = "user.php";
             flag=false;
             break;
         }
     }
     if(flag) {
         alert("Username or Password is Wrong");
     }
     return false;
 };

}

</script>
</head>
<body onload='Main();'>

<h1>Security Management</h1>


<div class="grid-container">
  <div class="item1"><h1>Login Admin</h1>
Username:<br>
<input type='text' id="user" required><br><br>
Password:<br>
<input type='password' id="psw" required><br>
<br>
<input type='submit' id="btn1" value="Login"></div>



  <div class="item2"><h1>Login User</h1>
Username:<br>
<input type='text' id="user1" required><br><br>
Password:<br>
<input type='password' id="psw2" required><br>
<br>
<input type='submit' id="btn2" value="Login"></div>
  
</div>

</body>
</html>
