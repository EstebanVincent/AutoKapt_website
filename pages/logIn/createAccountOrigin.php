<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Registration | AutoKapt</title>
        <link rel="stylesheet" href="../style.css">
    </head>
<body>
    <div id = "backgroundLogIn">
        <div id = "logo"><a href="../home.html"><img src="../images/logo.png" alt="logo"></a></div>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repudiandae, blanditiis.</p>
    </div>
    <div class="right">
        <h4>Registration</h4>
        <div class="back"><a href="logIn.html">Already have an account?</a></div>
        <form method="POST">
            <div class="element">
                <input type="text" required>
                <span></span>
                <label>Username</label>
            </div>
            <div class="element">
                <input type="email" required>
                <span></span>
                <label>Email</label>
            </div>
            <div class="element">
                <input type="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <div class="element">
                <input type="password" required>
                <span></span>
                <label>Password again</label>
            </div>
            <div class="element">
                <input list="gender" required>
                <span></span>
                <label>Gender</label>
                <datalist id="gender">
                    <option value="Male">
                    <option value="Female">
                    <option value="Other">
                </datalist>
            </div>
            <div class="element">
                <input type="number" required>
                <span></span>
                <label>Age</label>
            </div>
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>