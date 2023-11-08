<?php
//session_start();
//include('../../admin/config/config.php');
//if (isset($_POST['login'])) {
//    $account_email = $_POST['account_email'];
//    $account_password = md5($_POST['account_password']);
//    $sql_account = "SELECT * FROM account WHERE account_email='" . $account_email . "' AND account_password='" . $account_password . "' AND account_status=0";
//    $query_account = mysqli_query($mysqli, $sql_account);
//    $row = mysqli_fetch_array($query_account);
//    $count = mysqli_num_rows($query_account);
//    if ($count > 0) {
//        $_SESSION['account_id'] = $row['account_id'];
//        $_SESSION['account_email'] = $row['account_email'];
//        header('Location:../../index.php?page=my_account&tab=account_info&message=success');
//    } else {
//        header('Location:../../index.php?page=login&message=success');
//
//    }
//}


session_start();
include('../../admin/config/config.php');

if (isset($_POST['login'])) {
    $account_email = $_POST['account_email'];
    $account_password = md5($_POST['account_password']);

    // Retrieve the user's account information
    $sql_account = "SELECT * FROM account WHERE account_email='" . $account_email . "'";
    $query_account = mysqli_query($mysqli, $sql_account);
    $row = mysqli_fetch_array($query_account);

    $sql_check = "SELECT * FROM account WHERE account_email='" . $account_email . "' AND account_password='" . $account_password . "' AND account_status=0";

    $query_account_check = mysqli_query($mysqli, $sql_check);

    $count = mysqli_num_rows($query_account_check);

    if ($row > 0) {
        if ($row['account_status'] == -1) {
            header('Location:../../index.php?page=login&message=blocked');
        } else {
            if ($count > 0) {
                $login_attempts = 0;

                $_SESSION['account_id'] = $row['account_id'];
                $_SESSION['account_email'] = $row['account_email'];

                $sql_update_attempts = "UPDATE account SET login_attempts = " . $login_attempts . " WHERE account_email = '" . $account_email . "'";
                mysqli_query($mysqli, $sql_update_attempts);

                header('Location:../../index.php?page=my_account&tab=account_info&message=success');
            } else {
                $login_attempts = $row['login_attempts'] + 1;
                if ($login_attempts >= 6) {
                    $sql_lock_account = "UPDATE account SET account_status = -1 WHERE account_email = '" . $account_email . "'";
                    mysqli_query($mysqli, $sql_lock_account);
                    header('Location:../../index.php?page=login&message=blocked');
                } else {
                    $sql_update_attempts = "UPDATE account SET login_attempts = " . $login_attempts . " WHERE account_email = '" . $account_email . "'";
                    mysqli_query($mysqli, $sql_update_attempts);
                    header('Location:../../index.php?page=login&tab=account_info&message=error');
                }
            }
        }
    } else {
        header('Location:../../index.php?page=login&tab=account_info&message=error');
    }
}
