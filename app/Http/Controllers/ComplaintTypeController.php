<?php

namespace App\Http\Controllers;

use App\Models\ComplaintType;
use Illuminate\Http\Request;

class ComplaintTypeController extends Controller
{
    /**
     * Display a listing of the resource (عرض جميع أنواع الشكاوى).
     */
    public function index()
    {
        $complaintTypes = ComplaintType::all();
        return view('admin.complaint_types.index', compact('complaintTypes'));
    }

    /**
     * Show the form for creating a new resource (عرض نموذج إضافة نوع شكوى جديد).
     */
    public function create()
    {
        return view('admin.complaint_types.create');
    }

    /**
     * Store a newly created resource in storage (تخزين نوع شكوى جديد في قاعدة البيانات).
     */
    public function store(Request $request)
    {
        // التحقق من صحة البيانات المرسلة من النموذج. نستخدم 'type' لأنه اسم العمود في DB
        $request->validate([
            'type' => 'required|string|max:255|unique:complaint_types,type',
        ]);

        // إنشاء نوع شكوى جديد. نستخدم 'type' لأن هذا هو اسم العمود في DB
        ComplaintType::create([
            'type' => $request->type,
        ]);

        // إعادة التوجيه إلى صفحة عرض وفلترة الشكاوى بدلاً من صفحة أنواع الشكاوى
        return redirect()->route('admin.complaints.index')->with('success', 'Complaint type added successfully!');
    }

    // يمكنك إضافة دوال edit, update, destroy إذا أردت للسماح بتعديل وحذف أنواع الشكاوى.
}