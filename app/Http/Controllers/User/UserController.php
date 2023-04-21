<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{

    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials['role'] = 'client';

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('our-products');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $users = User::query()
            ->when($request->input(['search']), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10)
            ->withQueryString()
            ->through(fn($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'image' => $user->image,
                'email' => $user->email,
                'joined' => $user->created_at,
                'role' => $user->role
            ]);
        return Inertia::render('Admin/Customers', [
            "users" => $users,
            "filters" => $request->only(['search'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Client/Signup');
    }

    /**
     * Show the form for login a new resource.
     */
    public function login(): Response
    {
        return Inertia::render('Client/Signin');
    }

    /**
     * Logout the user
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $userData = [
            'name' => $request->name,
            'image' => $request->image,
            'email' => $request->email,
            'password' => $request->password,
            'birth_date' => $request->birth_date,
            'phone_number' => $request->phone_number,
            'region' => $request->region,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
            'street_address' => $request->street_address,
            'role' => 'client'
        ];
        $imageFile = $userData['image']->store('public/usersImages');
        $imageName = explode('/', $imageFile);
        $userData['image'] = $imageName[2];
        User::create($userData);
        return redirect()->intended('signin');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
