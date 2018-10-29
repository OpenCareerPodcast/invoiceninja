<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Crypt;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BankAccount.
 */
class BankAccount extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $fillable = [
        'bank_id',
        'app_version',
        'ofx_version',
    ];

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return Crypt::decrypt($this->username);
    }

    /**
     * @param $config
     */
    public function setUsername($value)
    {
        $this->username = Crypt::encrypt($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bank_subaccounts()
    {
        return $this->hasMany('App\Models\BankSubaccount');
    }
}