<?php
namespace App\Http\Controllers;
// namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use ErlandMuchasaj\LaravelFileUploader\FileUploader;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function create()
    {
        // You may need to pass additional data to the form view if required
        $categories = Category::all(); // Retrieve all categories from the database
        return view('products.form', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'pricing' => 'required|numeric',
            'description' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each uploaded image
        ]);

        // Initialize an empty array to store formatted image data
        $formattedImages = [];

        // Retrieve the uploaded files and store them in the public directory
        foreach ($request->file('images') as $file) {
            // Generate a unique filename for each image
            $filename = uniqid() . '_' . $file->getClientOriginalName();

            // Store the file in the public directory
            $filePath = $file->storeAs('public', $filename);

            // Get the full URL of the stored file and prepend the base URL
            $imageUrl = url(Storage::url($filePath));

            // Add the formatted image data to the array
            $formattedImages[] = [
                'alt' => 'Image', // You can set a default alt text or customize it as needed
                'url' => $imageUrl,
            ];
        }

        // Convert the array of formatted image data to JSON
        $jsonFormattedImages = json_encode($formattedImages);

        // Create the product with the validated data and formatted image URLs
        $product = Product::create([
            'name' => $validatedData['name'],
            'category_id' => $validatedData['category_id'],
            'pricing' => $validatedData['pricing'],
            'description' => $validatedData['description'],
            'images' => $jsonFormattedImages,
        ]);

        // Optionally, you can return a response indicating success
        return response()->json(['message' => 'Product created successfully', 'product' => $product], 201);
    }
}
