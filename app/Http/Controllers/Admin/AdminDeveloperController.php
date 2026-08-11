<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminDeveloperController extends Controller
{
    /**
     * Developer management dashboard.
     */
    public function index(Request $request): View
    {
        $query = Developer::query()
            ->with('user');

        /*
         * Search
         */
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('role', 'like', "%{$search}%")
                    ->orWhere('bio', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('email', 'like', "%{$search}%");
                    });
            });
        }

        /*
         * Status filter
         */
        if ($request->filled('status')) {

            if ($request->status === 'pending') {
                $query->where('approved', false);
            }

            if ($request->status === 'approved') {
                $query->where('approved', true);
            }
        }

        $developers = $query
            ->latest()
            ->paginate(12)
            ->withQueryString();

        /*
         * Dashboard statistics
         */
        $totalDevelopers = Developer::count();

        $pendingDevelopers = Developer::where(
            'approved',
            false
        )->count();

        $approvedDevelopers = Developer::where(
            'approved',
            true
        )->count();

        return view(
            'admin.developers.index',
            compact(
                'developers',
                'totalDevelopers',
                'pendingDevelopers',
                'approvedDevelopers'
            )
        );
    }

    /**
     * View developer.
     */
    public function show(Developer $developer): View
    {
        $developer->load('user');

        return view(
            'admin.developers.show',
            compact('developer')
        );
    }

    /**
     * Edit developer.
     */
    public function edit(Developer $developer): View
    {
        $developer->load('user');

        return view(
            'admin.developers.edit',
            compact('developer')
        );
    }

    /**
     * Update developer.
     */
    public function update(
        Request $request,
        Developer $developer
    ): RedirectResponse {

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

            'bio' => [
                'nullable',
                'string',
                'max:2000',
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

            'avatar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'approved' => [
                'nullable',
                'boolean',
            ],
        ]);

        /*
         * Upload new avatar.
         */
        if ($request->hasFile('avatar')) {

            if ($developer->avatar) {
                Storage::disk('public')
                    ->delete($developer->avatar);
            }

            $data['avatar'] = $request
                ->file('avatar')
                ->store('developers', 'public');
        }

        $data['approved'] = $request->boolean('approved');

        $developer->update($data);

        return redirect()
            ->route('admin.developers.index')
            ->with(
                'success',
                'Developer profile updated successfully.'
            );
    }

    /**
     * Approve developer.
     */
    public function approve(
        Developer $developer
    ): RedirectResponse {

        $developer->update([
            'approved' => true,
        ]);

        return back()->with(
            'success',
            "{$developer->name} has been approved."
        );
    }

    /**
     * Reject developer.
     */
    public function reject(
        Developer $developer
    ): RedirectResponse {

        $developer->update([
            'approved' => false,
        ]);

        return back()->with(
            'success',
            "{$developer->name} has been rejected."
        );
    }

    /**
     * Delete developer.
     */
    public function destroy(
        Developer $developer
    ): RedirectResponse {

        /*
         * Delete avatar from storage.
         */
        if ($developer->avatar) {
            Storage::disk('public')
                ->delete($developer->avatar);
        }

        $developer->delete();

        return redirect()
            ->route('admin.developers.index')
            ->with(
                'success',
                'Developer profile deleted successfully.'
            );
    }
}
