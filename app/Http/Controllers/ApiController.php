<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\CategoryTranslation;
use App\Models\Product;
use App\Models\ProductTranslation;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;
use Log;

class ApiController extends Controller
{
    public function apiimport(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->all();


            $sku = $data['Product']['article_number'];


            $product = Product::where('custom_article_number', $sku)->first();

            if ($product) {

                $product->updateDate()->updateOrCreate(
                    ['article_number' => $product->article_number],
                    [
                        'UpdateDateMake' => $data['Product']['UpdateDateMake'],
                        'UpdateDateAPI' => now(),
                    ]
                );



                foreach ($data['translations'] as $translation) {
                    ProductTranslation::updateOrCreate(
                        ['article_number' => $product->article_number, 'LanguageCode' => $translation['LanguageCode']],
                        $translation
                    );
                }

                foreach ($data['CategoryTranslations'] as $translation) {
                    CategoryTranslation::updateOrCreate(
                        ['article_number' => $product->article_number, 'CategoryLanguageCode' => $translation['CategoryLanguageCode']],
                        $translation
                    );
                }

                DB::commit();

                return response()->json(['message' => 'Product saved successfully']);
            } else {

                Log::channel('api')->error("Error saving product data: article_number not found $sku");
                return response()->json(['message' => 'Product not found']);
            }
        } catch (Exception $e) {
            DB::rollBack();


            Log::channel('api')->error('Error saving product data: ' . $e->getMessage(), ['exception' => $e]);

            return response()->json(['message' => 'An error occurred while saving the product data'], 500);
        }

    }


    public function apiexport(Request $request)
    {
        if ($request->email !== 'max@vimtronix.com' || $request->password !== '#xf?$RsLko@grH5NME') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {

            $filters = $request->only([
                'article_number',
                'CreateDateSupplier_start',
                'CreateDateSupplier_end',
                'CreateDateSupplier_before',
                'CreateDateSupplier_after',
                'UpdateDateAPI_start',
                'UpdateDateAPI_end',
                'UpdateDateAPI_before',
                'UpdateDateAPI_after',
                'UpdateDateSupplier_before',
                'UpdateDateSupplier_after',
                'UpdateDateAPI',
                'category_id',
                'result_limit'
            ]);
            $query = Product::with(['updateDate', 'categories']);

            if (!empty($filters['article_number'])) {
                $query->where(function ($q) use ($filters) {
                    $q->where('custom_article_number', 'like', '%' . $filters['article_number'] . '%')
                        ->orWhere('article_number', 'like', '%' . $filters['article_number'] . '%');
                });
            }

            if (!empty($filters['category_id'])) {
                $query->whereHas('categories', function ($q) use ($filters) {
                    $q->where('categories.id', $filters['category_id']);
                });
            }

            if (!empty($filters['CreateDateSupplier_start']) && !empty($filters['CreateDateSupplier_end'])) {
                $createStartDate = Carbon::parse($filters['CreateDateSupplier_start']);
                $createEndDate = Carbon::parse($filters['CreateDateSupplier_end']);
                $query->whereBetween('created_at', [$createStartDate, $createEndDate]);
            }

            if (!empty($filters['CreateDateSupplier_before'])) {
                $createBeforeDate = Carbon::parse($filters['CreateDateSupplier_before']);
                $query->where('created_at', '<', $createBeforeDate);
            }

            if (!empty($filters['CreateDateSupplier_after'])) {
                $createAfterDate = Carbon::parse($filters['CreateDateSupplier_after']);
                $query->where('created_at', '>', $createAfterDate);
            }


            if (!empty($filters['UpdateDateAPI_start']) && !empty($filters['UpdateDateAPI_end'])) {
                $updateStartDate = Carbon::parse($filters['UpdateDateAPI_start']);
                $updateEndDate = Carbon::parse($filters['UpdateDateAPI_end']);
                $query->whereHas('updateDate', function ($q) use ($updateStartDate, $updateEndDate) {
                    $q->whereBetween('UpdateDateAPI', [$updateStartDate, $updateEndDate]);
                });
            }

            if (!empty($filters['UpdateDateAPI_before'])) {
                $updateBeforeDate = Carbon::parse($filters['UpdateDateAPI_before']);
                $query->whereHas('updateDate', function ($q) use ($updateBeforeDate) {
                    $q->where('UpdateDateAPI', '<', $updateBeforeDate);
                });
            }

            if (!empty($filters['UpdateDateAPI_after'])) {
                $updateAfterDate = Carbon::parse($filters['UpdateDateAPI_after']);
                $query->whereHas('updateDate', function ($q) use ($updateAfterDate) {
                    $q->where('UpdateDateAPI', '>', $updateAfterDate);
                });
            }


            if (!empty($filters['UpdateDateSupplier_before'])) {
                $updateSupplierBeforeDate = Carbon::parse($filters['UpdateDateSupplier_before']);
                $query->whereHas('updateDate', function ($q) use ($updateSupplierBeforeDate) {
                    $q->where('UpdateDateMake', '<', $updateSupplierBeforeDate);
                });
            }

            if (!empty($filters['UpdateDateSupplier_after'])) {
                $updateSupplierAfterDate = Carbon::parse($filters['UpdateDateSupplier_after']);
                $query->whereHas('updateDate', function ($q) use ($updateSupplierAfterDate) {
                    $q->where('UpdateDateMake', '>', $updateSupplierAfterDate);
                });
            }

            if (!empty($filters['UpdateDateAPI']) && in_array(strtolower($filters['UpdateDateAPI']), ['empty', '0'])) {
                $query->whereHas('updateDate', function ($q) {
                    $q->whereNull('UpdateDateAPI');
                });
            }

            $limit = !empty($filters['result_limit']) ? (int) $filters['result_limit'] : 500;
            $query->limit($limit);

            $parentProducts = $query->get();

            return ProductResource::collection($parentProducts)->collection;

        } catch (Exception $e) {

            Log::channel('api')->error('An error occurred in apiexport', [
                'exception' => $e->getMessage(),
            ]);

            return response()->json([
                'error' => 'An unexpected error occurred. Please contact support if the problem persists.',
            ], 500);
        }
    }
}
