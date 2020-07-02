<?php

namespace App\Contracts;
use Illuminate\Foundation\Http\FormRequest;

interface ServiceProviderContract {
   // public function validateRequest(FormRequest $request);
   public function addEntity(FormRequest $request);
   public function deleteEntity(Int $entityId);
}