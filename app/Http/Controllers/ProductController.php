<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Http\Requests\ProductAddRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Traits\StorageImageTrait;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use StorageImageTrait;

    public function index()
    {
        $products = Product::latest()->paginate(5);

        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $htmlOption = $this->getCategory($parentId = '');
        return view('admin.product.add', compact('htmlOption'));
    }

    public function getCategory($parentId)
    {
        $data = Category::all();
        $recusive = new Recusive($data);

        $htmlOption = $recusive->handleRecusive($parentId);

        return $htmlOption;
    }

    public function store(ProductAddRequest $request)
    {
        try {
            DB::beginTransaction();

            $dataProductCreate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->user()->id,
                'category_id' => $request->category_id,

            ];

            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');

            if (!empty($dataUploadFeatureImage)) {

                $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
            }

            $product = Product::create($dataProductCreate);

            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMutiple($fileItem, 'product');

                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name'],
                    ]);
                }
            }

            // insert product tag
            foreach ($request->tags as $tagItem) {
                // insert to tags
                $tagInstance = Tag::firstOrCreate(['name' => $tagItem]);

                $tagIds[] = $tagInstance->id;
            }
            $product->tags()->attach($tagIds);

            DB::commit();

            return redirect()->route('admin.products.index');

        } catch (\Throwable $exception) {

            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());

        }

    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $htmlOption = $this->getCategory($product->category_id);

        return view('admin.product.edit', compact('htmlOption', 'product'));
    }

    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();

            $dataProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->user()->id,
                'category_id' => $request->category_id,

            ];

            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');

            if (!empty($dataUploadFeatureImage)) {

                $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
                $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
            }

            Product::find($id)->update($dataProductUpdate);

            $product = Product::find($id);

            if ($request->hasFile('image_path')) {

                ProductImage::where('product_id', $id)->delete();

                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMutiple($fileItem, 'product');

                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name'],
                    ]);
                }
            }

            // insert product tag

            foreach ($request->tags as $tagItem) {
                // insert to tags
                $tagInstance = Tag::firstOrCreate(['name' => $tagItem]);

                $tagIds[] = $tagInstance->id;
            }

            $product->tags()->sync($tagIds);

            DB::commit();

            return redirect()->route('admin.products.index');

        } catch (\Throwable $exception) {

            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());

        }
    }

    public function delete($id)
    {
        try {
            Product::findOrFail($id)->delete();

            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], 200);

        } catch (\Throwable $exception) {
            Log::error('Message: ' . $exception->getMessage() . ' --- Line : ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'success',
            ], 500);

        }
    }

}
