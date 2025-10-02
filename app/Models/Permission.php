<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Mindscms\Entrust\EntrustPermission;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Translatable\HasTranslations;
use App\Models\Role; // تأكد من المسار الصحيح للموديل Role

class Permission extends EntrustPermission
{
    use HasFactory, HasTranslations, SearchableTrait;

    protected $guarded = [];
    public $translatable = ['display_name', 'description'];

    protected $searchable = [
        'columns' => [
            'permissions.display_name' => 10,
            'permissions.description' => 10,
        ]
    ];

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    // العلاقات الأساسية
    public function parent()
    {
        return $this->hasOne(Permission::class, 'id', 'parent');
    }

    public function children()
    {
        return $this->hasMany(Permission::class, 'parent', 'id');
    }

    public function appearedChildren()
    {
        return $this->hasMany(Permission::class, 'parent', 'id')->where('appear', 1);
    }

    // شجرة عامة للـ admin
    public static function tree($level = 1)
    {
        return static::with(implode('.', array_fill(0, $level, 'children')))
            ->whereParent(0)
            ->whereAppear(1)
            ->whereSidebarLink(1)
            ->orderBy('ordering', 'asc')
            ->get();
    }

    // شجرة خاصة بدور محدد مثل التاجر
    public static function forRole($roleName, $level = 1)
    {
        $role = Role::where('name', $roleName)->first();
        if (!$role) {
            return collect(); // فارغ إذا الدور غير موجود
        }

        return $role->perms() // العلاقة many-to-many بين role و permission في Entrust
            ->where('appear', 1)
            ->where('sidebar_link', 1)
            ->with(implode('.', array_fill(0, $level, 'children')))
            ->orderBy('ordering', 'asc')
            ->get();
    }

    // الأصناف المعينة مسبقاً (مثل assigned_childern)
    public static function assigned_childern($level = 1)
    {
        return static::with(implode('.', array_fill(0, $level, 'assigned_childern')))
            ->whereParentOriginal(0)
            ->whereAppear(1)
            ->orderBy('ordering', 'asc')
            ->get();
    }


    /// =========================== tree by prefix ===========================



    /**
     * شجرة صلاحيات مفلترة حسب بادئة الاسم (prefix) عبر جميع المستويات.
     * مثال الاستخدام: Permission::treeByPrefix('frontend_dashboard_', 4)
     */
    public static function treeByPrefix(string $prefix, int $level = 3)
    {
        // نبني مصفوفة with مع قيود (closures) لكل مستوى
        $with = [];
        for ($i = 1; $i <= $level; $i++) {
            $relation = implode('.', array_fill(0, $i, 'children'));
            $with[$relation] = function ($q) use ($prefix) {
                $q->where('appear', 1)
                  ->where('sidebar_link', 1)
                  ->where('name', 'like', $prefix.'%')
                  ->orderBy('ordering', 'asc');
            };
        }

        return static::query()
            ->where('parent', 0)
            ->where('appear', 1)
            ->where('sidebar_link', 1)
            ->where('name', 'like', $prefix.'%')
            ->orderBy('ordering', 'asc')
            ->with($with)
            ->get();
    }

    /**
     * مساعد لاستخدامه في الـ Blade لتصفية الأبناء المحمّلين مسبقًا حسب البادئة.
     * يتجنب N+1 إذا حمّلناهم بـ with().
     */
    public function childrenForPrefix(string $prefix)
    {
        return $this->children
            ->filter(fn ($c) => ($c->appear ?? 0) == 1
                             && ($c->sidebar_link ?? 0) == 1
                             && \Illuminate\Support\Str::startsWith($c->name, $prefix))
            ->sortBy('ordering')
            ->values();
    }




}
