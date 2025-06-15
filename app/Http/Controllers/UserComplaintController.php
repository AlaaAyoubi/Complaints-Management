<?php

namespace App\Http\Controllers;

use App\Models\Complaint; // لاستخدام نموذج الشكوى
use App\Models\ComplaintType; // لاستخدام نموذج نوع الشكوى
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // لاستخدام Auth
use App\Http\Requests\StoreComplaintRequest;

class UserComplaintController extends Controller
{
    /**
     * Display a listing of the authenticated user's complaints.
     */
    public function index()
    {
        // جلب الشكاوى الخاصة بالمستخدم الذي قام بتسجيل الدخول فقط
        // ترتيبها زمنيًا عكسيًا (الأحدث أولاً) وتقسيمها إلى صفحات
        $complaints = Auth::user()->complaints()->with('complaintType')->latest()->paginate(config('complaints.pagination.user_index'));
        return view('user.complaints.index', compact('complaints'));
    }

    /**
     * Show the form for creating a new complaint.
     */
    public function create()
    {
        // جلب جميع أنواع الشكاوى المتاحة للمستخدم ليختار منها
        $complaintTypes = ComplaintType::all();
        return view('user.complaints.create', compact('complaintTypes'));
    }

    /**
     * Store a newly created complaint in storage.
     */
    public function store(StoreComplaintRequest $request) // **غيرنا Request إلى StoreComplaintRequest**
    {
        // 
        // التحقق من الصحة سيتم تلقائيًا قبل دخول الدالة.

        // البيانات التي تم التحقق من صحتها جاهزة للاستخدام
        // $request->validated() ترجع مصفوفة بالبيانات التي اجتازت التحقق.
        $validatedData = $request->validated();

        // إنشاء شكوى جديدة وربطها بالمستخدم الحالي
        Auth::user()->complaints()->create([
            'complaint_type_id' => $validatedData['complaint_type_id'], // نستخدم البيانات التي تم التحقق من صحتها
            'details' => $validatedData['details'],                     // نستخدم البيانات التي تم التحقق من صحتها
            'status' => config('complaints.default_status'),
        ]);

        // إعادة توجيه المستخدم إلى صفحة عرض شكاواه مع رسالة نجاح
        return redirect()->route('user.complaints.index')->with('success', 'Your complaint has been submitted successfully!');
    }

    /**
     * Display the specified complaint (عرض تفاصيل شكوى معينة للمستخدم).
     */
    public function show(Complaint $complaint)
    {
        // تأكد أن المستخدم الحالي هو صاحب هذه الشكوى لمنع الوصول غير المصرح به
        if ($complaint->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.'); // أو يمكنك إعادة توجيههم إلى صفحة أخرى
        }
        return view('user.complaints.show', compact('complaint'));
    }
}