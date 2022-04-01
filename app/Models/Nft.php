<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Nft extends Model
{
    use Sortable;
    use HasFactory;

    protected $fillable = [
        'name',
        'base_price',
        'limit_date',
        'available',
        'actual_price',
        'collection_id',
        'user_id',
        'type_id'
    ];

    public $sortable = [
        'name',
        'base_price',
        'limit_date',
        'available',
        'actual_price',
        'collection_id',
        'type_id'
    ];

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bids()
    {
        return $this->belongsToMany(User::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function putOnSaleNFT(int $id): bool
    {
        return false;
    }

    public function bidNFT(int $id): bool
    {
        return false;
    }

    public function purchaseNFT(int $id): bool
    {
        return false;
    }

    public function auction(int $id): bool
    {
        return false;
    }
}
