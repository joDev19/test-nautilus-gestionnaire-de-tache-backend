<?php
namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class UserService extends BaseService
{

    public function __construct(private User $user)
    {
        parent::__construct($user);
    }
    public function register($data)
    {
        return $this->store($data);
    }
    public function login($data)
    {
        if (Auth::attempt($data)) {
            return User::where('email', $data['email'])->first();
        }
        abort(401, "Mauvais identifiant");
    }
    public function logout()
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return 1;
    }
}
