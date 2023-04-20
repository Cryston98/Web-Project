<div id="wrapper-login">

<div id="leftside-login"></div>
<div id="rightside-login">
   <div id="log-input">
     <h1>Login Form</h1>
     <hr>
      <form action="function/loginScript.php" method="post" >
        <label for="email-log">E-mail:
            <input required type="text" id="email-log" name="email-log" placeholder="Enter your username"></input>
        </label>
        <br>
        <label for="password-log">Password:
          <input required type="password" id="password-log" name="password-log" placeholder="Enter your password"></input>
        </label>
        <br>
         <input type="submit" name="submit_log" id="submit_log" value="LogIn"></input>
      </form>
      <p>Don't have an account.<span onclick="sigupFunc(1)">Click here to sigup!</span></p>

   </div>


   <div id="register-input">
     <h1>Sigup Form</h1>
     <hr>
      <form action="function/register.php"  method="post">
        <label for="username-reg">Username:
            <input type="text" id="userName-reg" name="userName-reg" placeholder="Enter your username"></input>
        </label>
        <br>

        <label for="FirstName-reg">FirstName:
            <input type="text" id="firstName-reg" name="firstName-reg" placeholder="Enter your firstName"></input>
        </label>
        <br>

        <label for="LastName-reg">LastName:
            <input type="text" id="lastName-reg" name="lastName-reg" placeholder="Enter your lastname"></input>
        </label>
        <br>

        <label for="email-reg">E-mail:
            <input type="email" id="email-reg" name="email=reg" placeholder="Enter your email"></input>
        </label>
        <br>

        <label for="password-reg">Password:
          <input type="password" id="password-reg" name="password-reg" placeholder="Enter your password"></input>
        </label>
        <br>

        <label for="conf-password">Confirma Password:
          <input type="password" id="conf-password-reg" name="conf-password-reg" placeholder="Enter your password"></input>
        </label>
        <br>

         <input type="submit" name="submit_reg" id="submit_reg" value="Sigup"></input>
      </form>
      <p>If you have account.<span onclick="sigupFunc(2)">Click here to login!</span></p>

   </div>

</div>


</div>
