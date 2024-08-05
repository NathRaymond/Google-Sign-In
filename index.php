<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .box {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
            text-align: center;
            width: 100%;
        }

        .box h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }

        .box p {
            font-size: 18px;
            color: #555;
            margin: 10px 0;
        }

        .box p span {
            font-weight: bold;
            color: #333;
        }

        .login-box {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .login-box h3 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .google-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            background: #4285f4;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        .google-btn:hover {
            background: #357ae8;
        }

        .google-btn img {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }
    </style>
    </style>
</head>

<body>
    <?php
    require_once 'vendor/autoload.php';

    // init configuration
    $clientID = '51496944430-j4bdnga6ma5ok96i9d1jre5etppsdpat.apps.googleusercontent.com';
    $clientSecret = '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';
    $redirectUri = 'http://localhost/google-login/';

    // create Client Request to access Google API
    $client = new Google_Client();
    $client->setClientId($clientID);
    $client->setClientSecret($clientSecret);
    $client->setRedirectUri($redirectUri);
    $client->addScope("email");
    $client->addScope("profile");

    $guzzleClient = new GuzzleHttp\Client([
        'verify' => 'C:\wamp64\www\google-login\certs\cacert.pem'
    ]);

    $client->setHttpClient($guzzleClient);

    // authenticate code from Google OAuth Flow
    if (isset($_GET['code'])) {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);

        // get profile info
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $email = $google_account_info->email;
        $name = $google_account_info->name;
    ?>
        <div class="container">
            <div class="box">
                <h1>Welcome</h1>
                <p>Email:
                    <?php echo htmlspecialchars($email); ?>
                </p>
                <p>Name:
                    <?php echo htmlspecialchars($name); ?>
                </p>
            </div>
        </div>
    <?php } else { ?>
        <div class="container">
            <div class="login-box">
                <h3>Login using Google</h3>
                <a href="<?php echo htmlspecialchars($client->createAuthUrl()); ?>" class="google-btn">
                    <img src="google.png" alt="Google Logo">
                    Sign In with Google
                </a>
            </div>
        </div>
    <?php } ?>
</body>

</html>