<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $subscriptions = Subscription::where('user_id', auth()->id())->get();
        return $this->response(true, 'success', $subscriptions);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
