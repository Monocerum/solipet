namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'voucher_code',
        'description',
        'discount_type',
        'discount_value',
        'minimum_amount',
        'usage_limit',
        'used_count',
        'is_active',
        'valid_from',
        'valid_until',
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'minimum_amount' => 'decimal:2',
        'is_active' => 'boolean',
        'valid_from' => 'datetime',
        'valid_until' => 'datetime',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function usages()
    {
        return $this->hasMany(PromotionUsage::class);
    }

    public function getRemainingUsesAttribute()
    {
        if (!$this->usage_limit) {
            return null; // Unlimited
        }
        return max(0, $this->usage_limit - $this->used_count);
    }

    public function isValid()
    {
        return $this->is_active 
            && now()->between($this->valid_from, $this->valid_until)
            && ($this->usage_limit === null || $this->used_count < $this->usage_limit);
    }
}