<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GlobalConfig;

class GlobalConfigSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    GlobalConfig::create([
      'key' => 'APPLICATION_NAME',
      'value' => 'JupiterMeet',
      'description' => 'Application Name will be visible in the entire application.',
    ]);

    GlobalConfig::create([
      'key' => 'PRIMARY_COLOR',
      'value' => '#EC6367',
      'description' => 'Set the primary color for the front-end.',
    ]);

    GlobalConfig::create([
      'key' => 'PRIMARY_LOGO',
      'value' => 'PRIMARY_LOGO.png',
      'description' => 'This will be the main logo. Only PNG is supported. The maximum allowed size is 2 MB.',
    ]);

    GlobalConfig::create([
      'key' => 'SECONDARY_LOGO',
      'value' => 'SECONDARY_LOGO.png',
      'description' => 'This will visible during the video meeting and in the admin panel. Only PNG is supported. The maximum allowed size is 2 MB.',
    ]);

    GlobalConfig::create([
      'key' => 'FAVICON',
      'value' => 'FAVICON.png',
      'description' => 'This will be the favicon. Only PNG is supported. The maximum allowed size is 2 MB.',
    ]);

    GlobalConfig::create([
      'key' => 'SIGNALING_URL',
      'value' => 'https://yourdomain.in:9006',
      'description' => 'Signaling server (NodeJS) URL.',
    ]);

    GlobalConfig::create([
      'key' => 'STUN_URL',
      'value' => 'stun:stun.l.google.com:19302',
      'description' => 'STUN URL for WebRTC. No need to update.',
    ]);

    GlobalConfig::create([
      'key' => 'TURN_URL',
      'value' => 'turn:yourdomain.in',
      'description' => 'TURN URL for WebRTC. Add your server\'s TURN URL once you finish installing it.',
    ]);

    GlobalConfig::create([
      'key' => 'TURN_USERNAME',
      'value' => 'username',
      'description' => 'Enter TURN username (NOT server\'s username).',
    ]);

    GlobalConfig::create([
      'key' => 'TURN_PASSWORD',
      'value' => 'password',
      'description' => 'Enter TURN password (NOT server\'s passsword)',
    ]);

    GlobalConfig::create([
      'key' => 'DEFAULT_USERNAME',
      'value' => 'Stranger',
      'description' => 'This will be the default username when the guest user joins the meeting without entering his name.',
    ]);

    GlobalConfig::create([
      'key' => 'COOKIE_CONSENT',
      'value' => 'enabled',
      'description' => 'If enabled, the system will display a cookie consent popup to the visitors.',
    ]);

    GlobalConfig::create([
      'key' => 'LANDING_PAGE',
      'value' => 'enabled',
      'description' => 'Set landing page enabled or disabled.',
    ]);

    GlobalConfig::create([
      'key' => 'GOOGLE_ANALYTICS_ID',
      'value' => 'null',
      'description' => 'Google Analytics tracking ID. Set null to disable. It uses the format G-XXXXXXX.',
    ]);

    GlobalConfig::create([
      'key' => 'SOCIAL_INVITATION',
      'value' => 'Hey, check out this amazing website, where you can host video meetings!',
      'description' => 'Social invitation link message.',
    ]);

    GlobalConfig::create([
      'key' => 'MODERATOR_RIGHTS',
      'value' => 'enabled',
      'description' => 'If enabled, the moderator will be able to accept/reject requests to join the room and can kick the users out of the room.',
    ]);

    GlobalConfig::create([
      'key' => 'AUTH_MODE',
      'value' => 'enabled',
      'description' => 'This mode will enable register, dashboard, profile, etc modules. If this mode is disabled use \'login\' URL manually to login.',
    ]);

    GlobalConfig::create([
      'key' => 'PAYMENT_MODE',
      'value' => 'disabled',
      'description' => 'This mode will enable the payment module. An extended license is required.',
    ]);

    GlobalConfig::create([
      'key' => 'STRIPE_KEY',
      'value' => 'pk_test_example',
      'description' => 'Stripe payment gateway key. You can get it from your Stripe dashboard.',
    ]);

    GlobalConfig::create([
      'key' => 'STRIPE_SECRET',
      'value' => 'sk_test_example',
      'description' => 'Stripe payment gateway secret. You can get it from your Stripe dashboard.',
    ]);

    GlobalConfig::create([
      'key' => 'STRIPE',
      'value' => '0',
      'description' => 'Stripe PG',
    ]);

    GlobalConfig::create([
      'key' => 'STRIPE_WH_SECRET',
      'value' => '',
      'description' => '',
    ]);

    GlobalConfig::create([
      'key' => 'PAYPAL',
      'value' => '0',
      'description' => '',
    ]);

    GlobalConfig::create([
      'key' => 'PAYPAL_MODE',
      'value' => 'sandbox',
      'description' => '',
    ]);

    GlobalConfig::create([
      'key' => 'PAYPAL_CLIENT_ID',
      'value' => '',
      'description' => '',
    ]);

    GlobalConfig::create([
      'key' => 'PAYPAL_SECRET',
      'value' => '',
      'description' => '',
    ]);

    GlobalConfig::create([
      'key' => 'PAYPAL_WEBHOOK_ID',
      'value' => '',
      'description' => '',
    ]);

    GlobalConfig::create([
      'key' => 'VERSION',
      'value' => '2.6.0',
      'description' => 'Current version.',
    ]);
  }
}
