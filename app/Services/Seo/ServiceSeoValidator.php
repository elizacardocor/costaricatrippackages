<?php

namespace App\Services\Seo;

use App\Models\Hotel;
use App\Models\Tour;
use App\Models\Transport;

class ServiceSeoValidator
{
    public function validate(object $model): array
    {
        if ($model instanceof Tour) {
            return $this->validateTour($model);
        }

        if ($model instanceof Hotel) {
            return $this->validateHotel($model);
        }

        if ($model instanceof Transport) {
            return $this->validateTransport($model);
        }

        return [];
    }

    private function validateTour(Tour $tour): array
    {
        $errors = $this->validateCommon($tour);

        if (!$tour->destinations()->exists()) {
            $errors[] = 'Tour must have at least one destination.';
        }

        if (!$tour->tourImages()->exists()) {
            $errors[] = 'Tour must have at least one image.';
        }

        if (!$tour->pricing()->where('active', true)->exists()) {
            $errors[] = 'Tour must have at least one active price.';
        }

        return $errors;
    }

    private function validateHotel(Hotel $hotel): array
    {
        $errors = $this->validateCommon($hotel);

        if (!$hotel->destinations()->exists()) {
            $errors[] = 'Hotel must have at least one destination.';
        }

        if (!$hotel->hotelImages()->exists()) {
            $errors[] = 'Hotel must have at least one image.';
        }

        if (!$hotel->pricing()->where('active', true)->exists()) {
            $errors[] = 'Hotel must have at least one active price.';
        }

        return $errors;
    }

    private function validateTransport(Transport $transport): array
    {
        $errors = $this->validateCommon($transport);

        if (!$transport->destinations()->exists()) {
            $errors[] = 'Transport must have at least one destination.';
        }

        if (!$transport->transportImages()->exists()) {
            $errors[] = 'Transport must have at least one image.';
        }

        if (!$transport->pricing()->where('active', true)->exists()) {
            $errors[] = 'Transport must have at least one active price.';
        }

        return $errors;
    }

    private function validateCommon(object $model): array
    {
        $errors = [];

        $name = trim((string) ($model->name ?? ''));
        $slug = trim((string) ($model->slug ?? ''));
        $description = trim(strip_tags((string) ($model->description ?? '')));

        if ($name === '') {
            $errors[] = 'Name is required.';
        }

        if ($slug === '') {
            $errors[] = 'Slug is required.';
        }

        if ($description === '') {
            $errors[] = 'Description is required.';
        } elseif (mb_strlen($description) < 120) {
            $errors[] = 'Description should be at least 120 characters for SEO.';
        }

        return $errors;
    }
}
