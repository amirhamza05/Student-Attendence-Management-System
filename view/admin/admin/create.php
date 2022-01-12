<div class="row">
    <div class="col-md-6">
        <?php lib()->formResponse(); ?>
        <form action="api/admin.php" method="post">
            <div class="form-group">
                <label>Admin Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Admin Name">
            </div>

            <div class="form-group">
                <label>Admin Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Admin Email">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" id="password_field" class="form-control" placeholder="Enter Password">
                <button type="button" onclick="genRandomPassword()" class="btn btn-sm btn-dark" style="margin-top: 5px;">Make Random Password</button>
            </div>

            <button type="submit" name="create" class="btn btn-primary">Create Admin</button>
        </form>

    </div>
</div>

<script type="text/javascript">
    function genRandomPassword(){
        let length = prompt("Please enter length of password", "6");
        if(length == null)return;

        if(length < 6 || length > 20){
            alert("Password length must be 6 to 20");
            return;
        }

        var result           = '';
        var characters       = '0123456789abcdefghijklmnopqrstuvwxyz';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        document.getElementById("password_field").value = result;

    }
</script>