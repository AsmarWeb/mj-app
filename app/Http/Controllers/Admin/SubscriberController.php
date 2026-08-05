<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscribers = (new Subscriber)->newQuery();
        $subscriberCount = Subscriber::count();

        if (request()->has('search')) {
            $subscribers->where('email', 'Like', '%'.request()->input('search').'%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $subscribers->orderBy($attribute, $sort_order);
        } else {
            $subscribers->latest();
        }

        $subscribers = $subscribers->paginate(5);

        return view('admin.subscribers.index', compact('subscribers', 'subscriberCount'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return redirect()->route('subscribers.index')
            ->with('message', __('Subscriber deleted successfully'));
    }
}
