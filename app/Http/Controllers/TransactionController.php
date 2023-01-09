<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->id == 1) {
            $payment = Payment::all();
        } else {
            $payment = Payment::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        }

        return view('admin.transaction', ['page' => __('Transaction'), 'transaction' => $payment]);
    }
}
