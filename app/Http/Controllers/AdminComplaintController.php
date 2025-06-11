<?php

namespace App\Http\Controllers;

use App\Models\Complaint; // لاستخدام نموذج الشكوى
use App\Models\User;      // لاستخدام نموذج المستخدم (للفلترة)
use App\Models\ComplaintType; // لاستخدام نموذج نوع الشكوى (للفلترة)
use Illuminate\Http\Request;

class AdminComplaintController extends Controller
{
    /**
     * Display a listing of all complaints with filtering options.
     */
    public function index(Request $request)
    {
        // نبدأ بإنشاء Query Builder لجلب الشكاوى، مع تحميل العلاقات (user, complaintType) مسبقًا
        $query = Complaint::with(['user', 'complaintType']);

        // فلترة حسب المستخدم
        if ($request->filled('user_id')) { // التحقق إذا كان حقل user_id موجودًا وبه قيمة
            $query->where('user_id', $request->user_id);
        }

        // فلترة حسب نوع الشكوى
        if ($request->filled('complaint_type_id')) { // التحقق إذا كان حقل complaint_type_id موجودًا وبه قيمة
            $query->where('complaint_type_id', $request->complaint_type_id);
        }

        // جلب الشكاوى بترتيب زمني عكسي (الأحدث أولاً) وتقسيمها إلى صفحات
        $complaints = $query->latest()->paginate(10); // 10 شكاوى لكل صفحة

        // جلب جميع المستخدمين (لتعبئة قائمة الفلترة)
        // يمكنك فلترة هنا لجلب المستخدمين العاديين فقط إذا أردت
        $users = User::where('userType', 'user')->get(); // نستخدم userType بدلاً من role

        // جلب جميع أنواع الشكاوى (لتعبئة قائمة الفلترة)
        $complaintTypes = ComplaintType::all();

        // تمرير البيانات إلى View
        return view('admin.complaints.index', compact('complaints', 'users', 'complaintTypes'));
    }

    /**
     * Display the specified complaint (عرض تفاصيل شكوى معينة).
     */
    public function show(Complaint $complaint)
    {
        // تم تحميل الشكوى تلقائيًا بواسطة Route Model Binding
        return view('admin.complaints.show', compact('complaint'));
    }

    /**
     * Update the status of the specified complaint (تحديث حالة الشكوى).
     */
    public function updateStatus(Request $request, Complaint $complaint)
    {
        // التحقق من صحة حالة الشكوى
        $request->validate([
            'status' => 'required|in:pending,in_progress,resolved,rejected', // الحالات الممكنة
        ]);

        // تحديث حالة الشكوى
        $complaint->update(['status' => $request->status]);

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->back()->with('success', 'Complaint status updated successfully!');
    }
}