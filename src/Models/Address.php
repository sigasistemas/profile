<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
 namespace Callcocam\Profile\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends AbstractProfileModel
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    public function addressable()
    {
        return $this->morphTo();
    }

    protected function slugTo()
    {
        return false;
    }

}