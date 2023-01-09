<?php

namespace App\Http\Controllers;

use App\Models\GlobalConfig;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\UpdateApplicationSettingRequest;
use App\Http\Requests\UpdateBasicSettingRequest;
use App\Http\Requests\UpdateMeetingSettingRequest;
use App\Http\Requests\UpdateNetworkingSettingRequest;
use App\Http\Requests\UpdateSettingPaymentGatewaysRequest;

class GlobalConfigController extends Controller
{
    /**
     * Manage site settings.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.global-config.basic', [
            'page' => __('Global Configuration - Basic'),
            'route' => 'basic',
        ]);
    }

    //update global configuration
    public function updateBasic(UpdateBasicSettingRequest $request)
    {
        if (isDemoMode()) return back()->with('error', __('This feature is not available in demo mode'));

        $rows = [
            'APPLICATION_NAME', 'PRIMARY_COLOR', 'PRIMARY_LOGO', 'SECONDARY_LOGO', 'FAVICON'
        ];

        foreach ($rows as $row) {
            if ($row == 'PRIMARY_LOGO' || $row == 'SECONDARY_LOGO' || $row == 'FAVICON') {
                $file = $request->input($row);
                if ($file && $file->isValid()) {
                    $value = $row . '.png';
                    $file->storeAs('public/images', $row . '.png');

                    GlobalConfig::where('key', $row)->update(['value' => $value]);
                }
            } else {
                GlobalConfig::where('key', $row)->update(['value' => $request->input($row)]);
            }
        }
        Cache::forget('settings');
        return back()->with('success', __('Settings saved.'));
    }

    //show application form
    public function application()
    {
        return view('admin.global-config.application', [
            'page' => __('Global Configuration - Application'),
            'route' => 'application',
        ]);
    }

    //update application data
    public function updateApplication(UpdateApplicationSettingRequest $request)
    {
        if (isDemoMode()) return back()->with('error', __('This feature is not available in demo mode'));

        $rows = [
            'AUTH_MODE', 'COOKIE_CONSENT', 'LANDING_PAGE', 'GOOGLE_ANALYTICS_ID', 'SOCIAL_INVITATION', 'PAYMENT_MODE'
        ];

        foreach ($rows as $row) {
            GlobalConfig::where('key', $row)->update(['value' => $request->input($row)]);
        }
        Cache::forget('settings');
        return back()->with('success', __('Settings saved.'));
    }

    //show networking form
    public function networking()
    {
        return view('admin.global-config.networking', [
            'page' => __('Global Configuration - Networking'),
            'route' => 'networking',
        ]);
    }

    //update networking data
    public function updateNetworking(UpdateNetworkingSettingRequest $request)
    {
        if (isDemoMode()) return back()->with('error', __('This feature is not available in demo mode'));

        $rows = [
            'SIGNALING_URL', 'STUN_URL', 'TURN_URL', 'TURN_USERNAME', 'TURN_PASSWORD'
        ];

        foreach ($rows as $row) {
            GlobalConfig::where('key', $row)->update(['value' => $request->input($row)]);
        }
        Cache::forget('settings');
        return back()->with('success', __('Settings saved.'));
    }

    //show meeting form
    public function meeting()
    {
        return view('admin.global-config.meeting', [
            'page' => __('Global Configuration - Meeting'),
            'route' => 'meeting',
        ]);
    }

    //update meeting data
    public function updateMeeting(UpdateMeetingSettingRequest $request)
    {
        if (isDemoMode()) return back()->with('error', __('This feature is not available in demo mode'));
        
        $rows = [
            'MODERATOR_RIGHTS', 'DEFAULT_USERNAME'
        ];

        foreach ($rows as $row) {
            GlobalConfig::where('key', $row)->update(['value' => $request->input($row)]);
        }
        Cache::forget('settings');
        return back()->with('success', __('Settings saved.'));
    }

    /**
     * Show the Payment gateway settings form.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function paymentGateways()
    {
        return view('admin.payment-gateways', ['page' => __('Payment Gateways')]);
    }

    /**
     * Update the Payment gateway settings.
     *
     * @param UpdateSettingPaymentGatewaysRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePaymentGateways(UpdateSettingPaymentGatewaysRequest $request)
    {
        if (isDemoMode()) return back()->with('error', __('This feature is not available in demo mode'));
        
        $rows = [
            'STRIPE', 'STRIPE_KEY', 'STRIPE_SECRET', 'STRIPE_WH_SECRET',
            'PAYPAL', 'PAYPAL_MODE', 'PAYPAL_CLIENT_ID', 'PAYPAL_SECRET', 'PAYPAL_WEBHOOK_ID',
        ];
        foreach ($rows as $row) {
            GlobalConfig::where('key', $row)->update(['value' => $request->input($row)]);
        }
        Cache::forget('settings');
        return back()->with('success', __('Settings saved.'));
    }
}
