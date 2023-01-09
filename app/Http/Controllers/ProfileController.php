<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Requests\UpdateUserSecurityRequest;
use App\Models\Payment;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\CancelSubscriptionMail;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('profile.profile', ['user' => $request->user(), 'page' => __('Basic Information')]);
    }

    public function updateProfile(UpdateUserProfileRequest $request)
    {
        if (isDemoMode()) return back()->with('error', __('This feature is not available in demo mode'));

        $request->user()->username = $request->username;
        $request->user()->email = $request->email;
        $request->user()->save();

        return back()->with('success', __('Settings saved.'));
    }

    public function security(Request $request)
    {
        return view('profile.security', ['user' => $request->user(), 'page' => __('Security')]);
    }

    public function updateSecurity(UpdateUserSecurityRequest $request)
    {
        if (isDemoMode()) return back()->with('error', __('This feature is not available in demo mode'));
        
        $request->user()->password = Hash::make($request->input('password'));
        $request->user()->save();

        Auth::logoutOtherDevices($request->input('password'));

        return back()->with('success', __('Settings saved.'));
    }

    public function showInvoice(Request $request, $id)
    {
        $payment = Payment::where([['user_id', '=', $request->user()->id], ['id', '=', $id], ['status', '=', 'completed']])->firstOrFail();

        // Sum the inclusive tax rates
        $inclTaxRatesPercentage = collect($payment->tax_rates)->where('type', '=', 0)->sum('percentage');

        // Sum the exclusive tax rates
        $exclTaxRatesPercentage = collect($payment->tax_rates)->where('type', '=', 1)->sum('percentage');

        return view('profile.content', ['view' => 'payments.invoice', 'payment' => $payment, 'inclTaxRatesPercentage' => $inclTaxRatesPercentage, 'exclTaxRatesPercentage' => $exclTaxRatesPercentage]);
    }

    /**
     * Show the Plan settings form.
     */
    public function myPlan(Request $request)
    {
        return view('profile.plan', ['user' => $request->user(), 'page' => __('Plan')]);
    }

    /**
     * Update the Plan settings.
     */
    public function cancelPlan(Request $request)
    {
        $request->user()->planSubscriptionCancel();

        try {
            Mail::to($request->user()->email)->send(new CancelSubscriptionMail($request->user()));
        } catch (\Exception $e) {
        }
        return back()->with('success', __('Settings saved.'));
    }

    public function payments(Request $request)
    {
        $payments = Payment::where('user_id', '=', $request->user()->id)
            ->orderBy('id', 'DESC')->get();

        $plans = Plan::where([['amount_month', '>', 0], ['amount_year', '>', 0]])->withTrashed()->get();

        return view('profile.payments.index', ['payments' => $payments, 'plans' => $plans, 'page' => __('Payments')]);
    }
}
