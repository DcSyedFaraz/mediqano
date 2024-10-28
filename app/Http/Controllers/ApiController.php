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
            // dd($data);
            // Retrieve the SKU from the custom SKU relation
            $sku = $data['Product']['SKU'];

            // Find the product by SKU
            $product = Product::where('custom_article_number', $sku)->first();

            if ($product) {
                // Update the product's UpdateDateMake
                $product->updateDate()->updateOrCreate(
                    ['article_number' => $product->article_number], // Matching condition
                    [
                        'UpdateDateMake' => $data['Product']['UpdateDateMake'],
                        'UpdateDateAPI' => now(),
                    ]
                );


                // Update or create product translations
                foreach ($data['ProductTranslations'] as $translation) {
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

                Log::error("Error saving product data: SKU not found$sku");
                return response()->json(['message' => 'Product not found']);
            }
        } catch (Exception $e) {
            DB::rollBack();

            // Log the error for debugging
            Log::error('Error saving product data: ' . $e->getMessage(), ['exception' => $e]);

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
                'SKU',
                'ProductNameDE',
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
                'FirstCategory',
                'SecondCategory',
                'ThirdCategory',
                'result_limit'
            ]);

            $query = Product::with(['details', 'images', 'custome_sku', 'static_content_single', 'categoryTranslations', 'imprintOptions', 'translations'])
                ->take(500);

            // Apply SKU filter
            if (!empty($filters['SKU'])) {
                $query->whereHas('custome_sku', function ($q) use ($filters) {
                    $q->where('custom_sku', 'like', '%' . $filters['SKU'] . '%');
                });
            }

            // Apply ProductNameDE filter
            if (!empty($filters['ProductNameDE'])) {
                $query->whereHas('details', function ($q) use ($filters) {
                    $q->where('name', 'like', '%' . $filters['ProductNameDE'] . '%');
                });
            }

            // Apply create date range filter
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

            // Apply update date range filter
            if (!empty($filters['UpdateDateAPI_start']) && !empty($filters['UpdateDateAPI_end'])) {
                $updateStartDate = Carbon::parse($filters['UpdateDateAPI_start']);
                $updateEndDate = Carbon::parse($filters['UpdateDateAPI_end']);
                $query->whereBetween('UpdateDateAPI', [$updateStartDate, $updateEndDate]);
            }
            if (!empty($filters['UpdateDateAPI_before'])) {
                $updateBeforeDate = Carbon::parse($filters['UpdateDateAPI_before']);
                $query->where('UpdateDateAPI', '<', $updateBeforeDate);
            }
            if (!empty($filters['UpdateDateAPI_after'])) {
                $updateAfterDate = Carbon::parse($filters['UpdateDateAPI_after']);
                $query->where('UpdateDateAPI', '>', $updateAfterDate);
            }

            // Apply update date supplier filter
            if (!empty($filters['UpdateDateSupplier_before'])) {
                $updateSupplierBeforeDate = Carbon::parse($filters['UpdateDateSupplier_before']);
                $query->where('update_date', '<', $updateSupplierBeforeDate);
            }
            if (!empty($filters['UpdateDateSupplier_after'])) {
                $updateSupplierAfterDate = Carbon::parse($filters['UpdateDateSupplier_after']);
                $query->where('update_date', '>', $updateSupplierAfterDate);
            }

            // Apply FirstCategory filter
            if (!empty($filters['FirstCategory'])) {
                $query->whereHas('details', function ($q) use ($filters) {
                    $q->where('unstructured_information->SupplierMainCategory', 'like', '%' . $filters['SecondCategory'] . '%');
                });
            }

            // // Apply SecondCategory filter
            if (!empty($filters['SecondCategory'])) {
                // Assuming FirstCategory is in static_content_single
                $query->whereHas('static_content_single', function ($q) use ($filters) {
                    $q->where('category', 'like', '%' . $filters['FirstCategory'] . '%');
                });
            }

            if (!empty($filters['UpdateDateAPI']) && ($filters['UpdateDateAPI'] == 'empty' || $filters['UpdateDateAPI'] == null || $filters['UpdateDateAPI'] == 0 || $filters['UpdateDateAPI'] === '0')) {
                // dd($filters['UpdateDateAPI']);
                $query->whereNull('UpdateDateAPI');
            }

            // Limit the results
            $limit = !empty($filters['result_limit']) ? (int) $filters['result_limit'] : 500;
            $query->take($limit);

            $parentProducts = $query->get();

            return ProductResource::collection($parentProducts)->collection;

        } catch (Exception $e) {
            Log::error('An error occurred in apiexport', [
                'exception' => $e,
            ]);

            return response()->json(['error' => 'An unexpected error occurred. Please contact support if the problem persists.' . $e->getMessage()], 500);
        }
    }
}
