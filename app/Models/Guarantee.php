<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Guarantee extends Model
{
    use HasFactory;
    protected $table = 'guarantees';

    protected $fillable = [
        'corporate_reference_number',
        'guarantee_type',
        'nominal_amount',
        'nominal_amount_currency',
        'expiry_date',
        'applicant_name',
        'applicant_address',
        'beneficiary_name',
        'beneficiary_address',
        'user_id',
        'status',
    ];

    public function setCorporateReferenceNumberAttribute($value)
    {
        if ($this->exists) {
            throw new \Exception('Corporate Reference Number is immutable.');
        }
        $this->attributes['corporate_reference_number'] = $value;
    }

    public function setExpiryDateAttribute($value)
    {
        if (strtotime($value) < strtotime(now())) {
            throw new \Exception('Expiry Date must be a future date.');
        }
        $this->attributes['expiry_date'] = $value;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
