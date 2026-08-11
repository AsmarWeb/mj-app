<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DeveloperController extends Controller
{
    /**
     * Display approved developers.
     */
    public function index(): View
    {
        $developers = Developer::query()
            ->where('approved', true)
            ->with('user')
            ->latest()
            ->get();

        $myDeveloper = Auth::check() ? Developer::query() ->where('user_id', Auth::id()) ->first() : null;

        return view('developer.index', compact('developers','myDeveloper'));
    }

    /**
     * Show the developer application form.
     */
    public function create(): View|RedirectResponse
    {
        if (!Auth::check()) {
            abort(403, 'You must be logged in to join the developer community.');
        }

        $existingDeveloper = Developer::query()
            ->where('user_id', Auth::id())
            ->with('user')
            ->first();

        if ($existingDeveloper) {
            return redirect()
                ->route('developer.show', [
                    'username' => $existingDeveloper->user->username,
                ])
                ->with('info', 'You already have a developer profile.');
        }

        return view('developer.create');
    }

    /**
     * Store a developer application.
     */
    public function store(Request $request): RedirectResponse
    {
        if (!Auth::check()) {
            abort(403, 'You must be logged in to join the developer community.');
        }

        // Prevent duplicate developer profiles.
        $existingDeveloper = Developer::query()
            ->where('user_id', Auth::id())
            ->with('user')
            ->first();

        if ($existingDeveloper) {
            return redirect()
                ->route('developer.show', [
                    'username' => $existingDeveloper->user->username,
                ])
                ->with('info', 'You already have a developer profile.');
        }

        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'role' => [
                'required',
                'string',
                'max:255',
            ],

            'github' => [
                'nullable',
                'url',
                'max:500',
            ],

            'linkedin' => [
                'nullable',
                'url',
                'max:500',
            ],

            'website' => [
                'nullable',
                'url',
                'max:500',
            ],

            'bio' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'avatar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        // Store avatar.
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request
                ->file('avatar')
                ->store('developers', 'public');
        }

        $data['user_id'] = Auth::id();

        // Requires admin approval.
        $data['approved'] = false;

        $developer = Developer::create($data);

        // Get the authenticated user's username.
        $username = Auth::user()->username;

        return redirect()
            ->route('developer.show', [
                'username' => $username,
            ])
            ->with(
                'success',
                'Your developer profile has been submitted and is waiting for approval.'
            );
    }

    /**
     * Display an approved developer profile by username.
     */
    public function show(string $username): View
    {
        $developer = Developer::query()
            ->where('approved', true)
            ->whereHas('user', function ($query) use ($username) {
                $query->where('username', $username);
            })
            ->with('user')
            ->firstOrFail();

        return view('developer.show', compact('developer'));
    }

    /**
     * Send users to the developer application.
     */
    public function join(): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()
                ->route('login')
                ->with(
                    'info',
                    'Please log in before joining the developer community.'
                );
        }

        $existingDeveloper = Developer::query()
            ->where('user_id', Auth::id())
            ->with('user')
            ->first();

        if ($existingDeveloper) {
            return redirect()
                ->route('developer.show', [
                    'username' => $existingDeveloper->user->username,
                ])
                ->with(
                    'info',
                    'You already have a developer profile.'
                );
        }

        return redirect()->route('developer.create');
    }
}