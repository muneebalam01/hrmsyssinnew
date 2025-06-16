use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\User; // adjust namespace if your model is in a different path

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('adminpassword'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]
        );
    }
}
