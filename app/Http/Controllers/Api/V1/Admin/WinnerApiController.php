<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreWinnerRequest;
use App\Http\Requests\UpdateWinnerRequest;
use App\Http\Resources\Admin\WinnerResource;
use App\Models\Winner;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WinnerApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('winner_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WinnerResource(Winner::with(['cupon_numbers', 'created_by'])->get());
    }

    public function store(StoreWinnerRequest $request)
    {
        $winner = Winner::create($request->all());
        $winner->cupon_numbers()->sync($request->input('cupon_numbers', []));
        if ($request->input('customer_photo', false)) {
            $winner->addMedia(storage_path('tmp/uploads/' . basename($request->input('customer_photo'))))->toMediaCollection('customer_photo');
        }

        foreach ($request->input('product_photo', []) as $file) {
            $winner->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('product_photo');
        }

        return (new WinnerResource($winner))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Winner $winner)
    {
        abort_if(Gate::denies('winner_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WinnerResource($winner->load(['cupon_numbers', 'created_by']));
    }

    public function update(UpdateWinnerRequest $request, Winner $winner)
    {
        $winner->update($request->all());
        $winner->cupon_numbers()->sync($request->input('cupon_numbers', []));
        if ($request->input('customer_photo', false)) {
            if (! $winner->customer_photo || $request->input('customer_photo') !== $winner->customer_photo->file_name) {
                if ($winner->customer_photo) {
                    $winner->customer_photo->delete();
                }
                $winner->addMedia(storage_path('tmp/uploads/' . basename($request->input('customer_photo'))))->toMediaCollection('customer_photo');
            }
        } elseif ($winner->customer_photo) {
            $winner->customer_photo->delete();
        }

        if (count($winner->product_photo) > 0) {
            foreach ($winner->product_photo as $media) {
                if (! in_array($media->file_name, $request->input('product_photo', []))) {
                    $media->delete();
                }
            }
        }
        $media = $winner->product_photo->pluck('file_name')->toArray();
        foreach ($request->input('product_photo', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $winner->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('product_photo');
            }
        }

        return (new WinnerResource($winner))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Winner $winner)
    {
        abort_if(Gate::denies('winner_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $winner->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
