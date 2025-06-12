<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // **أضيفي هذا السطر**
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // هذا الاستيراد جيد
use App\Models\User; // **تأكدي من وجود هذا السطر**
use App\Models\ComplaintType; // **تأكدي من وجود هذا السطر**

class Complaint extends Model
{
    use HasFactory; // **أضيفي هذا السطر**

    protected $fillable = [
        'user_id',
        'complaint_type_id',
        'details',
        'status', // **تأكدي أن status موجود في fillable إذا كان سيتم تعيينه يدوياً**
                  // إذا كان لديه default value في DB فقط، فقد لا تحتاجه هنا
                  // لكن الأفضل تضمينه لمرونة أكبر
    ];

    public function user() // هذه العلاقة صحيحة الآن
    {
        return $this->belongsTo(User::class);
    }

    // **هنا نقوم بتصحيح اسم العلاقة إلى complaintType**
    public function complaintType(): BelongsTo
    {
        return $this->belongsTo(ComplaintType::class);
    }
}