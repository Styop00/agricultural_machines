<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

final class CategoryObserver
{
    public function saving(Category $category): void
    {
        if (! $category->exists || $category->isDirty('name')) {
            $category->slug = $this->uniqueSlug($category);
        }
    }

    private function uniqueSlug(Category $category): string
    {
        $baseSlug = Str::slug($category->name);
        $slug = $baseSlug;
        $counter = 2;

        while (
            Category::query()
                ->where('slug', $slug)
                ->when($category->exists, fn ($query) => $query->whereKeyNot($category->id))
                ->exists()
        ) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
