<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComplaintController; // تأكد أنها لا تزال موجودة إذا كنت تستخدمها
use App\Http\Controllers\ComplaintTypeController; // أضف هذا
use App\Http\Controllers\AdminComplaintController; // أضف هذا
use App\Http\Controllers\UserComplaintController; // أضف هذا

Route::get('/', function () {
    return view('welcome');
});

// مسار لوحة تحكم المدير الأساسي
Route::get('/admin', function () {
    // بدلًا من عرض adminPage مباشرة، سنقوم بإعادة توجيه المدير إلى صفحة الشكاوى
    return redirect()->route('admin.complaints.index');
})->middleware(['auth', 'is_admin'])->name('admin.dashboard'); // اسم هذا المسار لسهولة الوصول إليه

// مسارات المدير
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    // إدارة أنواع الشكاوى
    Route::resource('complaint_types', ComplaintTypeController::class)->only(['index', 'create', 'store']);

    // إدارة شكاوى المستخدمين
    Route::get('complaints', [AdminComplaintController::class, 'index'])->name('complaints.index');
    Route::get('complaints/{complaint}', [AdminComplaintController::class, 'show'])->name('complaints.show');
    Route::put('complaints/{complaint}/status', [AdminComplaintController::class, 'updateStatus'])->name('complaints.updateStatus');
});

// مسارات المستخدم
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    // شكاوى المستخدم
    Route::get('complaints', [UserComplaintController::class, 'index'])->name('complaints.index');
    Route::get('complaints/create', [UserComplaintController::class, 'create'])->name('complaints.create');
    Route::post('complaints', [UserComplaintController::class, 'store'])->name('complaints.store');
    Route::get('complaints/{complaint}', [UserComplaintController::class, 'show'])->name('complaints.show');
});


Route::get('/dashboard', function () {
    // بناءً على userType، سيتم توجيه المستخدم أو المدير إلى الصفحة المناسبة
    if (auth()->user()->userType == 'admin') {
        return redirect()->route('admin.complaints.index'); // أو admin.dashboard إذا أردت صفحة داشبورد عامة
    }
    return redirect()->route('user.complaints.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';