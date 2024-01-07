<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Category;
use App\Models\Item;

class Item extends Model
{
    use HasFactory;
    public function category():BelongsTo{
        return $this->belongsTo(Category::class);
    }
    public function author():BelongsToMany{
        return $this->belongsToMany(Author::class);
    }
}
