.
<!DOCTYPE html>
<html>
 <head>
  <title>Login Admin</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="style_login.css">
 </head>
 <body>
    <div id="card"> 
        <div id="card-content">
            <div id="card-title">
              <h2>Login Admin</h2>
              <div class="underline-title"></div>
            </div>
            <form method="post" class="form" action="cek_login_admin.php">
            <label>Username</label><br>
                </label>
              <input type="text" name="user"><br>
              <label>Password</label><br>
                </label>
                <input type="password" name="pass"><br>
                <a href="login_pendaftar.php">
              </a>
              <input id="submit-btn" type="submit" name="submit" value="LOGIN" />
              <a href="register_admin.php" id="signup">Don't have account yet?</a>
            </form>
          </div>
        </div>
      </body>
      </html>