namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingInfo extends Model
{
    use HasFactory;

    protected $table = 'shipping_info';

    protected $fillable = [
        'order_id',
        'recipient_name',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'phone',
        'shipping_method',
        'shipping_cost',
        'tracking_number',
    ];

    protected $casts = [
        'shipping_cost' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getFullAddressAttribute()
    {
        return "{$this->address}, {$this->city}, {$this->state} {$this->postal_code}, {$this->country}";
    }
}