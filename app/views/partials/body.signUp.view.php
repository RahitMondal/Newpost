<h3 style="width:100%;text-align:center;color:#800;">
    <?= isset($_GET['error']) ? $_GET['error'] : '' ?>
</h3>
<form name="signup_form" action="/signup" method="POST">
    <input type="text" name="full_name" placeholder="Full name" required>
    <input type="text" name="user_name" placeholder="Pick username" required>
    <input type="email" name="email_id" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="confirm" placeholder="Confirm password" required>
    <input type="submit" name="create_btn" value="Create Account">
</form>