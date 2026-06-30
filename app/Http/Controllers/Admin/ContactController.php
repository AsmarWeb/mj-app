<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = (new Contact)->newQuery();
        $contactCount = Contact::count();

        if (request()->has('search')) {
            $contacts->where('email', 'Like', '%' . request()->input('search') . '%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $contacts->orderBy($attribute, $sort_order);
        } else {
            $contacts->latest();
        }

        $contacts = $contacts->paginate(5);

        return view('admin.contacts.index', compact('contacts', 'contactCount'));
    }
}
