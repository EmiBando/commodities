<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Company;
use App\Models\Product;
use Kyslik\ColumnSortable\Sortable;
class Product extends Model
{
    use HasFactory;
    use Sortable;

    public $sortable = ['id', 'product_name', 'price', 'stock', 'company_id'];
    
    public function company():BelongsTo{
        return $this->belongsTo(Company::class);
    }
    public function author():BelongsToMany{
        return $this->belongsToMany(Author::class);
    }
}
