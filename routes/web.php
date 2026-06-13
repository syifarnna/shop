use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Rute untuk Login & Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Contoh halaman yang hanya bisa diakses kalau SUDAH LOGIN (dilindungi middleware 'auth')
Route::get('/dashboard', function () {
    return 'Selamat datang di Dashboard! Ini halaman rahasia.';
})->middleware('auth');