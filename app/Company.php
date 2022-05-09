<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'phone'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param object $request
     * @return Company
     */
    public function createCompany(object $request): Company
    {
        return $this->create([
            'user_id' => auth()->user()->getAuthIdentifier(),
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'phone' => $request->get('phone')
        ]);
    }

    /**
     * @return object
     */
    public function getUserCompanies(): object
    {
        return $this->with('user')->where('user_id', auth()->user()->getAuthIdentifier())->get();
    }
}
