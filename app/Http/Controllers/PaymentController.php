<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function createPaymentIntent(Request $request)
    {
        // Set your secret Stripe key
        Stripe::setApiKey(env('STRIPE_SECRET')); // bech te5ou mel .env
        try { // Create a PaymentIntent
            $charge = Charge::create([ // bech nsna3 paiment
                'amount' => $request->input('amount'), // Le montant à payer en cents (100 = 1 dollar) // el mentent
                'currency' => 'usd', // La devise // chni naw3iet devise
                'source' => $request->input('token'), //Le token Stripe de la carte de crédit // eli ijini mel front
                'description' => 'Paiement via Stripe', // Description facultative // affichage

            ]);
            // Le paiement a réussi
            return response()->json(['message' => 'Paiement réussi']); // ken el 3amaliaa nej7et yani paiment mchet
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
