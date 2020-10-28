<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait DeleteAjaxTrait
{
    public function deleteAjax($model, $id)
    {
        try {
            $model->find($id)->delete();

            return response()->json([
                'code' => 200,
                'message' => 'Delete success',
            ], 200);

        } catch (\Throwable $exception) {

            Log::error('Lỗi : ' . $exception->getMessage() . '---Line: ' . $exception->getLine());

            return response()->json([
                'code' => 500,
                'message' => 'Delete fail',
            ], 500);
        }
    }
}
