
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
            background-color: rgb(60, 60, 60);
        }
    </style>
    <script src="SecurityManager.js"></script>
    <script>

        function Main() {
            var tableRef = document.getElementById("table");
            tableRef.style.width = '100px';
            tableRef.style.border = '0px solid black';

            var newRow = tableRef.insertRow(0);
            for (var j = 0; j < 5; j++) {
                var newCell = newRow.insertCell(j);
                var newText = "";
                if (j == 0) {
                    newText = document.createTextNode("ID");
                    newCell.style.border = '1px solid black';
                }
                if (j == 1) {
                    newText = document.createTextNode("User");
                    newCell.style.border = '1px solid black';
                }
                if (j == 2) {
                    newText = document.createTextNode("Role");
                    newCell.style.border = '1px solid black';
                }
                if (j == 3) {

                    newText = document.createTextNode("Edit");
                    newCell.style.border = '1px solid black';
                }
                if (j == 4) {

                    newText = document.createTextNode("Delete");

                    newCell.style.border = '1px solid black';
                }
                newCell.appendChild(newText);
            }
            var ur_arr = SecurityManager.GetAllUserRoles();

            for (var i = 0; i < ur_arr.length; i++) {
                var newRow = tableRef.insertRow(-1);

                for (var j = 0; j < 5; j++) {
                    var newCell = newRow.insertCell(j);
                    var newText = "";
                    if (j == 0) {

                        newText = document.createTextNode(ur_arr[i].ID);
                        newCell.style.border = '1px solid black';
                    }
                    if (j == 1) {

                        newText = document.createTextNode(ur_arr[i].user);
                        newCell.style.border = '1px solid black';
                    }
                    if (j == 2) {
                        newText = document.createTextNode(ur_arr[i].role);
                        newCell.style.border = '1px solid black';
                    }

                    if (j == 3) {
                        var newText = document.createElement('a');


                        newText.id = ur_arr[i].ID;

                        newText.href = "#";
                        newText.innerHTML = "edit";
                        newText.onclick = function () {
                            var edit_useRole = SecurityManager.GetUserRoleById(this.id);

                            var role_arr = SecurityManager.GetAllRoles();
                            var r = document.getElementById("cmbRole");
                            r.innerHTML = '';

                            for (var i = 0; i < role_arr.length; i++) {
                                if (role_arr[i].role_name == edit_useRole.role) {
                                    var opt = document.createElement("option");
                                    opt.setAttribute("value", role_arr[i].ID);
                                    opt.innerText = role_arr[i].role_name;
                                    r.appendChild(opt);
                                    break;
                                }
                            }

                            for (var i = 0; i < role_arr.length; i++) {

                                if (role_arr[i].role_name != edit_useRole.role) {

                                    var opt = document.createElement("option");
                                    opt.setAttribute("value", role_arr[i].ID);
                                    opt.innerText = role_arr[i].role_name;
                                    r.appendChild(opt);

                                }
                            }

                            var user_arr = SecurityManager.GetAllUsers();
                            var u = document.getElementById("cmbUser");
                            u.innerHTML = '';

                            for (var i = 0; i < user_arr.length; i++) {
                                if (user_arr[i].login == edit_useRole.user) {
                                    var opt = document.createElement("option");
                                    opt.setAttribute("value", user_arr[i].ID);
                                    opt.innerText = user_arr[i].login;
                                    u.appendChild(opt);
                                    break;
                                }
                            }

                            for (var i = 0; i < user_arr.length; i++) {
                                if (user_arr[i].login != edit_useRole.user) {
                                    var opt = document.createElement("option");
                                    opt.setAttribute("value", user_arr[i].ID);
                                    opt.innerText = user_arr[i].login;
                                    u.appendChild(opt);

                                }
                            }

                            var save_btn = document.getElementById("save");
                            save_btn.onclick = function () {
                                var role = document.getElementById("cmbRole");
                                var user = document.getElementById("cmbUser");


                                edit_useRole.role = role[role.selectedIndex].text;
                                edit_useRole.user = user[user.selectedIndex].text;

                                SecurityManager.SaveUserRole(edit_useRole, function () { alert("user_role has been edited") }, function () { alert("user_role has not been edited") });
                                location.reload(true);

                            };

                        };
                        newCell.style.border = '1px solid black';
                    }
                    if (j == 4) {
                        var newText = document.createElement('a');
                        newText.id = ur_arr[i].ID;
                        newText.href = "#";
                        newText.innerHTML = "delete";
                        newText.onclick = function () {
                            var agree = confirm("do you want to delete role");
                            if (agree) {
                                SecurityManager.DeleteUserRole(this.id, function () { "user_role deleted successfully" }, function () { "user_role is not deleted successfully" });
                            }
                            location.reload(true);
                        };
                        newCell.style.border = '1px solid black';
                    }
                    newCell.appendChild(newText);
                }
            }
            var roles = SecurityManager.GetAllRoles();
            var cmb = document.getElementById('cmbRole')
            for (var i = 0; i < roles.length; i++) {
                var opt = document.createElement("option");
                opt.setAttribute("value", roles[i].ID);
                opt.innerText = roles[i].role_name;

                cmb.appendChild(opt);
            }


            var user = SecurityManager.GetAllUsers();
            var cmbU = document.getElementById('cmbUser')
            for (var i = 0; i < user.length; i++) {
                var opt = document.createElement("option");
                opt.setAttribute("value", user[i].ID);
                opt.innerText = user[i].login;

                cmbU.appendChild(opt);
            }


            var save_btn = document.getElementById("save");
            save_btn.onclick = function () {
                var role = document.getElementById("cmbRole");
                var user = document.getElementById("cmbUser");
                var ur_Obj = {};
                ur_Obj.role = role[role.selectedIndex].text;
                ur_Obj.user = user[user.selectedIndex].text;
                var flag = true;
                if (!ur_Obj.role || !ur_Obj.user) {
                    alert("fill all the fields");
                }
                else {
                    var ur_arr = SecurityManager.GetAllUserRoles();
                    for (var i = 0; i < ur_arr.length; i++) {
                        if (ur_arr[i].role == ur_Obj.role && ur_arr[i].user == ur_Obj.user) {
                            alert("user-role already exists,enter another user-role");
                            flag = false;
                            break;
                        }
                    }
                    if (flag) {
                        SecurityManager.SaveUserRole(ur_Obj, function () { alert("role_permission has been created") }, function () { alert("role_permission has not been created") });
                        location.reload(true);
                    }
                }
            };
            //end ofMain
        }
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
                <h1> User-Role Management</h1>
                <form>

                    Role<br>
                    <select name="" id="cmbRole"></select><br>

                    user:<br>
                    <select name="" id="cmbUser" required></select><br>

                    <input type=submit id="save" value="save">

                </form>
            </div>
        </div>
        <div class="item2">
            <table id="table"></table>

        </div>


</body>
</html>
