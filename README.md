# Mailtrap
A simple Mailtrap extension for Magento 2

## What Is Mailtrap?
Mailtrap is a fake SMTP server for development teams to test, view and share emails sent from the development and staging environments without spamming real customers.

## Signup For Mailtrap
Visit https://mailtrap.io/register/signup

## How To Install
Pull in the composer package: `composer require mediotype/mailtrap --dev`
Run the setup: `php bin/magento setup:upgrade`

## Configure
You can find the configuration by going to `Stores > Configuration > Mediotype > Mailtrap`. You'll need to enable the extension by setting `Enabled` to `Yes`. This will then display the fields for `Mailtrap Username` and `Mailtrap Password`. You can find these in your Mailtrap mailbox settings.
