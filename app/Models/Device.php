<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed|string client_token
 * @property mixed subscription_status
 * @property mixed receipt
 */
class Device extends Model
{
    use HasFactory;

    protected $guarded = [];

    const SUBSCRIPTION_STATUS = 0; // subscribed yet initial status
    const SUBSCRIPTION_STATUS_STARTED = 1; // subscribe started
    const SUBSCRIPTION_STATUS_RENEWED = 2; // subscribe renewed
    const SUBSCRIPTION_STATUS_CANCELED = 3; // subscribe canceled

    /**
     * @var mixed
     */
    private $id;
    /**
     * @var mixed
     */
    private $app;

    /**
     * App.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function app()
    {
        return $this->belongsTo(App::class);
    }
}
