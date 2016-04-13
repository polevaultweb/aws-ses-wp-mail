## AWS SES WP Mail
AWS SES is a very simple UI-less plugin for sending `wp_mail()`s email via AWS SES.

### Getting Set Up

You can install this plugin in your WordPress project as a plugin via composer using this setup:

```
  "require-dev":
    {
        "mnsami/composer-custom-directory-installer": "1.1.*",
        "polevaultweb/aws-ses-wp-mail": "dev-master"
    },
    "extra": {
        "installer-paths": {
          "htdocs/content/plugins/{$name}": [
            "polevaultweb/aws-ses-wp-mail"
          ]
        }
    }
```
    
and then use composer update to fetch the package.

The package is intended to be used on a Composer run WordPress site. This means the dependencies for the plugin (AWS SDK) will be installed in the `vendor` dir. You can specify its location:

```PHP
define( 'WP_VENDOR_PATH', 'path/to/vendor' );
```

The path is set up by default to be next to the root WP installation directory.

Then setup the plugin as follows:

```PHP
define( 'AWS_SES_WP_MAIL_REGION', 'us-east-1' );
define( 'AWS_SES_WP_MAIL_KEY', '' );
define( 'AWS_SES_WP_MAIL_SECRET', '' );
```

If you plan to use IAM instance profiles to protect your AWS credentials on disk you'll need the following configuration instead:

```PHP
define('AWS_SES_WP_MAIL_REGION', 'us-east-1');
define('AWS_SES_WP_MAIL_USE_INSTANCE_PROFILE', true);
```


The next thing that you should do is to verify your sending domain for SES:

```
wp aws-ses verify-sending-domain
```

Once you have verified your sending domain, you are all good to go!

### Other Commands

`wp aws-ses send-email <to> <subject> <message> [---from-email=<email>]`

Send a test email via the command line. Good for testing!

### Credits

This is a fork of https://github.com/humanmade/aws-ses-wp-mail to be more composer friendly