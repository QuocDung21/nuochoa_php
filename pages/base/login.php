<style>
    /* Add this CSS to change the placeholder text color to white */
    .inputbox input::placeholder {
        color: white;
    }
</style>

<div id="toast_message"></div>
<section class="login pd-section">
    <div class="form-box">
        <div class="form-value">
            <form action="pages/handle/login.php" autocomplete="on" method="POST">
                <h2 class="login-title">Đăng nhập</h2>
                <div class="inputbox">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input placeholder="Email" type="email" name="account_email" required>
                </div>
                <div class="inputbox">
                    <ion-icon style="cursor: pointer" id="password-toggle" name="eye-outline"></ion-icon>
                    <input placeholder="Password" id="account_password" type="password" name="account_password"
                           required>
                </div>

                <div class="forget">
                    <label for=""><input type="checkbox">Remember Me <a href="#">Forget Password</a></label>
                </div>
                <button type="submit" name="login">Đăng nhập</button>
                <div class="register">
                    <p>Chưa có tài khoản <a href="index.php?page=register">Đăng ký</a></p>
                </div>
            </form>
        </div>
    </div>
</section>


<script>
    function showSuccessMessage() {
        toast({
            title: "Success",
            message: "Đăng ký thành công",
            type: "success",
            duration: 3000,
        });
    }

    function showErrorMessage() {
        toast({
            title: "Error",
            message: "Tài khoản hoặc mật khẩu không đúng vui lòng thử lại !",
            type: "error",
            duration: 3000,
        });
    }

    function showBlockMessage() {
        toast({
            title: "Error",
            message: "Tài khoản đã bị khóa vui lòng liên hệ admin để mở lại",
            type: "error",
            duration: 3000,
        });
    }
</script>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('account_password');
        const password2Input = document.getElementById('account_password2');
        const passwordToggle = document.getElementById('password-toggle');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            password2Input.type = 'text';
            passwordToggle.textContent = 'Ẩn Mật Khẩu';
        } else {
            passwordInput.type = 'password';
            password2Input.type = 'password';
            passwordToggle.textContent = 'Hiện Mật Khẩu';
        }
    }

    document.getElementById('password-toggle').addEventListener('click', togglePasswordVisibility);
</script>


<?php
if (isset($_GET['message']) && $_GET['message'] === 'blocked') {
    echo '<script>';
    echo 'showBlockMessage();';
    echo '</script>';
}
if (isset($_GET['message']) && $_GET['message'] === 'error') {
    echo '<script>';
    echo 'showErrorMessage();';
    echo '</script>';
}


if (isset($_GET['message']) && $_GET['message'] == 'success') {
    echo '<script>';
    echo 'showSuccessMessage();';
    echo 'window.history.pushState(null, "", "index.php?page=product_detail&product_id=' . $product_id . '");';
    echo '</script>';
} elseif (isset($_GET['message']) && $_GET['message'] == 'error') {
    echo '<script>';
    echo 'showErrorMessage();';
    echo 'window.history.pushState(null, "", "index.php?page=product_detail&product_id=' . $product_id . '");';
    echo '</script>';
}
?>