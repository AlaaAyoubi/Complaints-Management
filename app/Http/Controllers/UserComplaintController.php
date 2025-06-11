<?php

namespace App\Http\Controllers;

use App\Models\Complaint; // لاستخدام نموذج الشكوى
use App\Models\ComplaintType; // لاستخدام نموذج نوع الشكوى
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // لاستخدام Auth

class UserComplaintController extends Controller
{
    /**
     * Display a listing of the authenticated user's complaints.
     */
    public function index()
    {
        // جلب الشكاوى الخاصة بالمستخدم الذي قام بتسجيل الدخول فقط
        // ترتيبها زمنيًا عكسيًا (الأحدث أولاً) وتقسيمها إلى صفحات
        $complaints = Auth::user()->complaints()->latest()->paginate(10);
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
    public function store(Request $request)
    {
        // التحقق من صحة البيانات المدخلة من قبل المستخدم
        $request->validate([
            'complaint_type_id' => 'required|exists:complaint_types,id', // يجب أن يكون موجودًا في جدول أنواع الشكاوى
            'details' => 'required|string|max:1000', // النص مطلوب، نصي، بحد أقصى 1000 حرف
        ]);

        // إنشاء شكوى جديدة وربطها بالمستخدم الحالي
        // حالة الشكوى الافتراضية هي 'pending'
        Auth::user()->complaints()->create([
            'complaint_type_id' => $request->complaint_type_id,
            'details' => $request->details,
            'status' => 'pending',
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