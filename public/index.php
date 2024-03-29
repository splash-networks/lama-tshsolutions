<?php

require 'header.php';
include 'config.php';

$_SESSION["mac"] = $_POST['mac'];
$_SESSION["ip"] = $_POST['ip'];
$_SESSION["link-login"] = $_POST['link-login'];
$_SESSION["link-login-only"] = $_POST['link-login-only'];
if (isset($_POST['sitename'])) {
    $_SESSION["sitename"] = $_POST['sitename'];
} else {
    $_SESSION["sitename"] = 'default';
}

$_SESSION["user_type"] = "new";

# Checking DB to see if user exists or not

mysqli_report(MYSQLI_REPORT_OFF);
$result = mysqli_query($con, "SELECT * FROM `$table_name` WHERE mac='$_SESSION[mac]'");

if ($result->num_rows >= 1) {
    $row = mysqli_fetch_array($result);

    mysqli_close($con);

    $_SESSION["user_type"] = "repeat";
    header("Location: welcome.php");
} else {
    mysqli_close($con);
}

?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>
        <?php echo htmlspecialchars($business_name); ?> WiFi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="assets/styles/bulma.min.css" />
    <link rel="stylesheet" href="vendor/fortawesome/font-awesome/css/all.css" />
    <link rel="icon" type="image/png" href="assets/images/favicomatic/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="assets/images/favicomatic/favicon-16x16.png" sizes="16x16" />
    <link rel="stylesheet" href="assets/styles/style.css" />
    <link rel="stylesheet" href="assets/build/css/intlTelInput.css" />
</head>

<body>
    <div class="page">

        <div class="head">
            <br>
            <figure id="logo">
                <img src="assets/images/logo.png">
            </figure>
        </div>

        <div class="main">
            <section class="section">
                <div class="container">
                    <div id="contact_form" class="content has-text-centered">
                        Please provide the following details to connect to the LAMA Retail free WIFI!
                    </div>
                    <br>
                    <form method="post" action="connect.php">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" type="text" id="form_font" name="name" placeholder="Name" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input class="input" type="tel" id="phone" name="phone[full]" onkeydown="return onlyNumberKey(event)" placeholder="Phone" pattern="^03\d{9}$" title="03xxxxxxxxx" maxlength="11" required>
                            </div>
                        </div>
                        <div class=" field">
                            <div class="control has-icons-left">
                                <input class="input" type="email" id="form_font" name="email" placeholder="Email" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" title="name@domain.xxx" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="columns is-centered is-mobile">
                            <div class="control">
                                <label class="checkbox">
                                    <input type="checkbox" required>
                                    I agree to the <a href="policy.php">Terms & Conditions</a>
                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="buttons is-centered">
                            <button class="button is-link">Connect</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
    <script src="assets/build/js/intlTelInput.js"></script>
    <script>
        const input = document.querySelector("#phone");
        const iti = window.intlTelInput(input, {
            initialCountry: "pk",
            hiddenInput: "full",
            utilsScript: "assets/build/js/utils.js?1706723638591"
        });
    </script>
    <script>
        function onlyNumberKey(evt) {
            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                return false;
            return true;
        }
    </script>
</body>

</html>