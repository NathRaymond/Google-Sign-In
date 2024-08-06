# Google Sign-In with OTP

## Introduction

This PHP application allows users to sign in using their Google account and retrieve a one-time password (OTP) after successful authentication.

## Requirements

- PHP
- Composer
- Google Cloud Project with OAuth 2.0 credentials

## Setup

1. Clone the repository.
2. Run `composer install` to install dependencies.
3. Configure your Google OAuth credentials in `config.php`.
4. Run the application using a local server.

## How It Works

1. User clicks "Sign In with Google".
2. User is redirected to Google's authentication page.
3. Upon successful authentication, the user's email is retrieved and an OTP is generated.
4. The OTP is displayed on the screen for 30 seconds.

## Error Handling

- Proper error handling for Google authentication and OTP generation is implemented.

## Demo

Include a video demonstration and a link to the repository.
