<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

use App\Http\Controllers\{
    ProfileController,
    TicketCategoryController,
    TicketPriorityController,
    UserTypeController,
    UserController,
    TicketController,
    TicketChatController,
    TicketExportController,
    LaporanPimpinanController,
    StaffTicketController,
    Admin\UserImportController,
    Admin\TicketManagementController,
    AdminDashboardController,
    MahasiswaDashboardController,
    Ketuap3tiDashboardController,
    StaffDashboardController,
    PimpinanDashboardController
};

// Redirect awal
Route::get('/', fn () => redirect()->route('login'));

// Redirect dashboard berdasarkan role
Route::get('/dashboard', fn () => redirect('/redirect-role'))->middleware('auth')->name('dashboard');

Route::get('/redirect-role', function () {
    return match (Auth::user()->usertype) {
        'admin'     => redirect()->route('admin.dashboard'),
        'mahasiswa' => redirect()->route('mahasiswa.dashboard'),
        'staff'     => redirect()->route('staff.dashboard'),
        'ketuap3ti' => redirect()->route('ketuap3ti.dashboard'),
        'pimpinan'  => redirect()->route('pimpinan.dashboard'),
        default     => abort(403, 'User type tidak dikenal'),
    };
})->middleware('auth');

// Protected Routes
Route::middleware(['auth'])->group(function () {

    // Dashboard per role
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/mahasiswa/dashboard', [MahasiswaDashboardController::class, 'index'])->name('mahasiswa.dashboard');
    Route::get('/ketuap3ti/dashboard', [Ketuap3tiDashboardController::class, 'index'])->name('ketuap3ti.dashboard');
    Route::get('/staff/dashboard', [StaffDashboardController::class, 'index'])->name('staff.dashboard');
    Route::get('/pimpinan/dashboard', [PimpinanDashboardController::class, 'index'])->name('pimpinan.dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Master Data
    Route::resource('ticket_categories', TicketCategoryController::class);
    Route::resource('ticket_priorities', TicketPriorityController::class);
    Route::resource('user_types', UserTypeController::class);
    Route::resource('users', UserController::class)->except(['create', 'store', 'show']);
    Route::resource('tickets', TicketController::class);

    // Admin - Manajemen Tiket
    Route::prefix('admin/tickets')->name('admin.tickets.')->group(function () {
        Route::get('/', [TicketManagementController::class, 'index'])->name('index');
        Route::get('/{ticket}', [TicketManagementController::class, 'show'])->name('show');
        Route::patch('/{ticket}/status', [TicketManagementController::class, 'updateStatus'])->name('updateStatus');
        Route::patch('/{ticket}/priority', [TicketManagementController::class, 'updatePriority'])->name('updatePriority');
        Route::get('/{ticket}/assign', [TicketManagementController::class, 'assignForm'])->name('assign.form');
        Route::post('/{ticket}/assign', [TicketManagementController::class, 'assign'])->name('assign');
    });

    // Staff - Tiket Tugas
    Route::get('/staff/tickets', [StaffTicketController::class, 'index'])->name('staff.tickets.index');

    // Import User
    Route::prefix('admin/users')->name('admin.users.')->group(function () {
        Route::get('/import', [UserImportController::class, 'form'])->name('import.form');
        Route::post('/import', [UserImportController::class, 'upload'])->name('import.upload');
    });

    // Laporan Pimpinan
    Route::get('/pimpinan/laporan', [PimpinanDashboardController::class, 'laporan'])->name('pimpinan.laporan');
    Route::get('/pimpinan/laporan/export/{format}', [PimpinanDashboardController::class, 'export'])->name('pimpinan.laporan.export');

    // Berita Acara dan Dokumen
    Route::post('/tickets/{ticket}/berita-acara', [TicketController::class, 'storeBeritaAcara'])->name('tickets.berita_acara.store');
    Route::post('/tickets/{ticket}/upload-dokumen', [TicketController::class, 'uploadDokumen'])->name('tickets.dokumen.store');
});

Route::middleware('auth')->group(function () {
    // Chat antara staff dan mahasiswa
Route::get('/tickets/{ticket}/chat/user/{receiver}', [TicketChatController::class, 'chatUser'])
    ->name('tickets.chat.user');

// Chat internal antara ketuap3ti dan staff
Route::get('/tickets/{ticket}/chat/internal/{receiver}', [TicketChatController::class, 'chatInternal'])
    ->name('tickets.chat.internal');
    // Ambil semua pesan chat (AJAX)
    Route::get('/tickets/{ticket}/messages', [TicketChatController::class, 'getMessages'])->name('tickets.chat.messages');

    // Kirim pesan
    Route::post('/tickets/{ticket}/chat', [TicketChatController::class, 'store'])->name('tickets.chat.store');
});

// Breeze Auth
require __DIR__.'/auth.php';
