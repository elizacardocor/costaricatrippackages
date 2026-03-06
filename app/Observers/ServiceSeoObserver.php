<?php

namespace App\Observers;

use App\Models\SlugRedirect;
use App\Services\Seo\ServiceSeoValidator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class ServiceSeoObserver
{
    public function __construct(private ServiceSeoValidator $validator)
    {
    }

    public function saving(Model $model): void
    {
        $baseSlug = $model->slug ?: $model->name;
        $normalized = Str::slug((string) $baseSlug);

        if ($normalized === '') {
            $normalized = Str::slug((string) class_basename($model) . '-' . now()->timestamp);
        }

        $model->slug = $this->makeUniqueSlug($model, $normalized);

        if ($model->exists && $model->isDirty('slug')) {
            $model->seo_old_slug = $model->getOriginal('slug');
        }

        if ($this->isPublishedStatus((string) $model->status)) {
            $errors = $this->validator->validate($model);
            if (!empty($errors)) {
                throw ValidationException::withMessages([
                    'seo' => $errors,
                ]);
            }
        }
    }

    public function updated(Model $model): void
    {
        $oldSlug = $model->seo_old_slug ?? null;
        $newSlug = $model->slug;

        if (!$oldSlug || $oldSlug === $newSlug || !$this->isPublishedStatus((string) $model->status)) {
            return;
        }

        SlugRedirect::updateOrCreate(
            [
                'service_type' => $this->serviceType($model),
                'old_slug' => $oldSlug,
            ],
            [
                'service_id' => $model->id,
                'new_slug' => $newSlug,
            ]
        );
    }

    private function makeUniqueSlug(Model $model, string $slug): string
    {
        $modelClass = $model::class;
        $candidate = $slug;
        $suffix = 1;

        do {
            $query = $modelClass::query();

            if (in_array('Illuminate\\Database\\Eloquent\\SoftDeletes', class_uses_recursive($modelClass), true)) {
                $query = $query->withTrashed();
            }

            $exists = $query
                ->where('slug', $candidate)
                ->when($model->exists, fn ($q) => $q->where('id', '!=', $model->id))
                ->exists();

            if ($exists) {
                $suffix++;
                $candidate = $slug . '-' . $suffix;
            }
        } while ($exists);

        return $candidate;
    }

    private function isPublishedStatus(string $status): bool
    {
        return in_array(strtolower($status), ['active', 'published'], true);
    }

    private function serviceType(Model $model): string
    {
        return match (class_basename($model)) {
            'Tour' => 'tour',
            'Hotel' => 'hotel',
            'Transport' => 'transport',
            default => 'service',
        };
    }
}
