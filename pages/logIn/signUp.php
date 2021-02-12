<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Registration | AutoKapt</title>
        <link rel="stylesheet" href="/AutoKapt/style.css">
    </head> 
<body>
    <div id = "backgroundLogIn">
        <div id = "logo"><a href="/AutoKapt/home.php"><img src="/AutoKapt/images/logo.png" alt="logo"></a></div>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repudiandae, blanditiis.</p>
    </div>
    <div class="right">
        <h4>Registration</h4>
        <div class="back"><a href="/AutoKapt/pages/logIn/logIn.php">Already have an account?</a></div>
        <form action="/AutoKapt/includes/signUp.inc.php" method="POST">
            <div class="element">
                <input type="text" name="username" required>
                <span></span>
                <label>Username</label>
            </div>
            <div class="element">
                <input type="email" name="email" required>
                <span></span>
                <label>Email</label>
            </div>
            <div class="element">
                <input type="password" name="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <div class="element">
                <input type="password" name="pwdRepeat" required>
                <span></span>
                <label>Confirm Pwd</label> 
            </div>
            <div class="element">
                <input list="gender" name="gender" required>
                <span></span>
                <label>Gender</label>
                <datalist id="gender">
                    <option value="Male">
                    <option value="Female">
                    <option value="Other">
                </datalist>
            </div>
            <div class="element">
                <input type="number" name="age"required>
                <span></span>
                <label>Age</label>
            </div>
            <input type="submit" name="submit" value="Register">
        </form>
    </div>
</body>
</html>