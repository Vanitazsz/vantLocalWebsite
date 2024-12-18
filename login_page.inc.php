<h2>Login</h2>
<form action="login.php" method="post">
        <p><label class="label" for="email">Email:</label>
        <input type="text" id="email" name="email" size="30" maxlength="40" 
        value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"></p>
        <br>
        <p><label class="label" for="psword">Password:</label>
        <input type="password" id="psword" name="psword" size="30" maxlength="40" 
        value="<?php if (isset($_POST['psword'])) echo $_POST['psword']; ?>"></p>

        <p>&nbsp</p><p><input id="submit" type="submit" name="submit" value="Login"></p>
</form><br>
