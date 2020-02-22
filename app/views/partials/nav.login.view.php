    <nav>
        <logo>Newpost</logo>
        <?php
            $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
            session_unset();
        ?>
        <form name="login_form" action="/login" method="post">
            <input type="text" name="user_email" placeholder="username/email">
            <input type="password" name="password" placeholder="password">
            <input type="submit" value="Login"><br/>
            <span style="display:block;width:100%;color:#fff;text-align:center;"><?= $msg ?></span>
        </form>
    </nav>