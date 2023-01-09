<?php

use App\Models\GlobalConfig;
use App\Models\Content;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use App\Models\Language;
use App\Models\Plan;

//get settings from the global config table
function getSetting($key) {
	$settings = Cache::rememberForever('settings', function () {
		return GlobalConfig::all()->pluck('value', 'key');
	});
	
	if (!$settings[$key]) {
		Cache::forget('settings');
		$settings = GlobalConfig::all()->pluck('value', 'key');
	}

	return $settings[$key];
}

//get features associated with the user ID
function getUserPlanFeatures($id) {
	$user = User::find($id);
    $planId = $user->plan_id;

    if ($user->plan_ends_at == '') {
        $planId = $user->plan_id;
    } else if (date('Y-m-d', strtotime($user->plan_ends_at)) < date('Y-m-d')) {
        $planId = 1;
    }

	return Plan::find($planId)->features;
}

//get content from the content table
function getContent($key) {
	$content = Cache::rememberForever('content', function () {
		return Content::all()->pluck('value', 'key');
	});

	if (!$content[$key]) {
		Cache::forget('content');
		$content = Content::all()->pluck('value', 'key');
	}

	return $content[$key];
} 

//get languages
function getLanguages () {
	$languages = Cache::rememberForever('languages', function () {
		return Language::where(['status' => 'active'])->select('code', 'name', 'default', 'direction')->get();
	});

	return $languages;
}

//get selected language
function getSelectedLanguage () {
	if (session('locale')) {
        $selectedLanguage = getLanguages()->first(function($langauage) {
            return $langauage->code == session('locale');
        });

		if ($selectedLanguage) return $selectedLanguage;
	}

	return getDefaultLanguage();
}

//get default language
function getDefaultLanguage() {
	$languages = Cache::rememberForever('defaultLangauage', function () {
		return Language::where(['default' => 'yes'])->select('code', 'name', 'direction')->first();
	});

	return $languages;
}

//set value
function installed ($value) {
	session(['installed' => $value]);
}

//get value
function isInstalled () {
	return session('installed');
}

// Format money.
function formatMoney($amount, $currency)
{
    if (in_array(strtoupper($currency), config('currencies.zero_decimals'))) {
        return number_format($amount, 0, __('.'), __(','));
    } else {
        return number_format($amount, 2, __('.'), __(','));
    }
}

// Get the enabled payment gateways.
function paymentGateways()
{
    $paymentGateways = config('payment.gateways');
    foreach ($paymentGateways as $key => $value) {
        if (!getSetting($key)) {
            unset($paymentGateways[$key]);
        }
    }

    return $paymentGateways;
}

function calculateInclusiveTax($amount, $discount, $inclusiveTaxRate, $inclusiveTaxRates)
{
    return calculatePostDiscount($amount, $discount) * ($inclusiveTaxRate / 100);
}

/**
 * Calculate the total, including the exclusive taxes.
 * PostDiscount + ExclusiveTax$
 */
function checkoutTotal($amount, $discount, $exclusiveTaxRates, $inclusiveTaxRates)
{	
    return calculatePostDiscount($amount, $discount) + (calculatePostDiscount($amount, $discount) * ($exclusiveTaxRates / 100));
}

/**
 * Returns the amount after discount.
 * Amount - Discount$
 */
function calculatePostDiscount($amount, $discount)
{
    return $amount - calculateDiscount($amount, $discount);
}

/**
 * Returns the exclusive tax amount.
 * PostDiscountLessInclTaxes * TaxRate
 */
function checkoutExclusiveTax($amount, $discount, $exclusiveTaxRate, $inclusiveTaxRates)
{
    // return calculatePostDiscountLessInclTaxes($amount, $discount, $inclusiveTaxRates) * ($exclusiveTaxRate / 100);
    return calculatePostDiscount($amount, $discount) * ($exclusiveTaxRate / 100);
}

/**
 * Returns the discount amount.
 * Amount * Discount%
 */
function calculateDiscount($amount, $discount)
{
    return $amount * ($discount / 100);
}

/**
 * Returns the amount after discount and included taxes.
 * PostDiscount - InclusiveTaxes$
 */
function calculatePostDiscountLessInclTaxes($amount, $discount, $inclusiveTaxRates)
{
    return calculatePostDiscount($amount, $discount) - calculateInclusiveTaxes($amount, $discount, $inclusiveTaxRates);
}

/**
 * Returns the inclusive taxes amount.
 * PostDiscount - PostDiscount / (1 + TaxRate)
 */
function calculateInclusiveTaxes($amount, $discount, $inclusiveTaxRate)
{
    return calculatePostDiscount($amount, $discount) - (calculatePostDiscount($amount, $discount) / (1 + ($inclusiveTaxRate / 100)));
}

// Format the page titles.
function formatTitle($value = null)
{
    if (is_array($value)) {
        return implode(" - ", $value);
    }

    return $value;
}

//check if the demo mode is enabled
function isDemoMode () {
	return config('app.demo_mode');
}