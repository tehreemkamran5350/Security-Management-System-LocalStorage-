
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
                    newText = document.createTextNode("Name");
                    newCell.style.border = '1px solid black';
                }
                if (j == 2) {
                    newText = document.createTextNode("Description");
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
            var p_arr = SecurityManager.GetAllPermissions();

            for (var i = 0; i < p_arr.length; i++) {
                var newRow = tableRef.insertRow(-1);

                for (var j = 0; j < 5; j++) {
                    var newCell = newRow.insertCell(j);
                    var newText = "";
                    if (j == 0) {
                        newText = document.createTextNode(p_arr[i].ID);
                        newCell.style.border = '1px solid black';
                    }
                    if (j == 1) {
                        newText = document.createTextNode(p_arr[i].permission_name);
                        newCell.style.border = '1px solid black';
                    }
                    if (j == 2) {
                        newText = document.createTextNode(p_arr[i].description);
                        newCell.style.border = '1px solid black';
                    }
                    if (j == 3) {
                        var newText = document.createElement('a');


                        newText.id = p_arr[i].ID;

                        newText.href = "#";
                        newText.innerHTML = "edit";
                        newText.onclick = function () {
                            var edit_per = SecurityManager.GetPermissionById(this.id);
                            document.getElementById("perm").value = edit_per.permission_name;
                            document.getElementById("desc").value = edit_per.description;
                            var sBtn = document.getElementById("save");
                            sBtn.onclick = function () {
                                
                                edit_per.permission_name = document.getElementById("perm").value;
                                edit_per.description = document.getElementById("desc").value;
                                SecurityManager.SavePermission(edit_per, function () { alert("permission has been edited") }, function () { alert("permission has not been edited") });
                                window.location.href = "Permission_Mangement.html";

                            };
                            var clr = document.getElementById("clear");
                            clr.onclick = function () {
                                document.getElementById("perm").value = "";
                                document.getElementById("desc").value = "";
                            };
                        };
                        newCell.style.border = '1px solid black';
                    }
                    if (j == 4) {

                        var newText = document.createElement('a');


                        newText.id = p_arr[i].ID;

                        newText.href = "#";
                        newText.innerHTML = "delete";
                        newText.onclick = function () {
                            var agree = confirm("do you want to delete role");

                            if (agree) {

                                SecurityManager.DeletePermission(this.id, function () { "permission deleted successfully" }, function () { "permission is not deleted successfully" });

                            }
                            location.reload(true);
                        };

                        newCell.style.border = '1px solid black';
                    }
                    newCell.appendChild(newText);
                }


            }

            var save_btn = document.getElementById("save");
            save_btn.onclick = function () {
                var perm = document.getElementById("perm").value;
                var desc = document.getElementById("desc").value;
                var p_Obj = {};
                p_Obj.permission_name = perm;
                p_Obj.description = desc;
                var flag = true;
                if (!p_Obj.permission_name || !p_Obj.description) {
                    alert("fill all the fields");
                }
                else {
                    var p_arr = SecurityManager.GetAllPermissions();
                    for (var i = 0; i < p_arr.length; i++) {
                        if (p_arr[i].permission_name == perm) {
                            alert("permission already exists,enter another role");
                            flag = false;
                            break;
                        }
                    }
                    if (flag) {
                        SecurityManager.SavePermission(p_Obj, function () { alert("permission has been created") }, function () { alert("permission has not been created") });
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
                <h1> Permission Management</h1>
                <form>

                    Permission Name:<br>
                    <input type=text id="perm" required><br>
                    Description:<br>
                    <input type=text id="desc" required><br>
                    <input type=submit id="save" value="save">
                    <input type=submit id="clear" value="clear">
                </form>
            </div>
        </div>
        <div class="item2">
            <table id="table"></table>

        </div>


</body>
</html>
