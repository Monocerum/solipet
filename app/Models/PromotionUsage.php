namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionUsage extends Model
{
    use HasFactory;

    protected $fillable = [
        'promotion_id',
        'order_id',
        'user_id',
        'discount_applied',
    ];

    protected $casts = [
        'discount_applied' => 'decimal:2',
    ];

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
