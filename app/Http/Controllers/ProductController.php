<?php

namespace App\Http\Controllers;

use App\Mail\CommentSubmitted;
use App\Models\Category;
use App\Models\CategoryUser;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->query('categoryId') ?? null;
        $user_id = Auth::id();
      
        $user = User::find($user_id);
        $category = $user->categories;
      
        // Check if the category exists
        if (!$category) {
            return response()->json(['message' => 'Category not found for this user'], 404);
        }

        // Return the category data in a variable
        if ($categoryId !== null) {
            return view('content.front-page.productPage', ['categoryy' => $category,'categoryyId' => $categoryId]); 
        }else{
            $categoryId==null;
            return view('content.front-page.productPage', ['categoryy' => $category,'categoryyId' => $categoryId   ]);
        }



        
    }
    public function indexDashboard()
    {
        $categories = Category::all();
        $user = Auth::user();
        $products_data=Product::all();

        
        return view('content.dashboard.productData.productData', compact('categories', 'user','products_data'));
    }
    public function saveCategory(Request $request)
{
    $userId = auth()->id(); // Retrieve the user ID from the authenticated user

    $categories = $request->input('categories');

    // Delete all existing CategoryUser records for the user
    CategoryUser::where('user_id', $userId)->delete();

    foreach ($categories as $categoryName) {
        $categoryId = $this->getCategoryIDByName($categoryName); // Call the method within the controller

        if ($categoryId !== null) {
            // Save CategoryUser record
            CategoryUser::create([
                'category_id' => $categoryId,
                'user_id' => $userId,
            ]);
        }
    }

    return response()->json(['message' => 'Categories saved successfully']);
}

    // Move the getCategoryIDByName method inside the controller
    private function getCategoryIDByName($categoryName)
    {
        // Assuming you have a Category model with a 'name' column
        $category = Category::where('name', $categoryName)->first();

        if ($category) {
            return $category->id;
        } else {
            // Handle the case where the category with the given name does not exist
            return null;
        }
    }

    public function createProductsData(Request $request)
{
    
    $data = $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'category_id' => 'required|exists:categories,id', // Ensure the category exists
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'sku' => 'required|string',
        'barcode' => 'nullable|string',
    ]);

    $path = time() . '.' . $data['image']->extension();
    $data['image']->move(public_path('images'), $path);
     $user_id = Auth::id();
    $product = Product::create([
        
        'title' => $data['title'],
        'description' => $data['description'],
        'image' => $path,
        'category_id' => $data['category_id'],
        'price' => $data['price'],
        'quantity' => $data['quantity'],
        'sku' => $data['sku'],
        'barcode' => $data['barcode'],
    ]);

    return response()->json(['message' => 'Product saved successfully', 'product' => $product]);
}

public function updateProducts(Request $request, $id)
{
    $validatedData = $request->validate([
        'description_edit' => 'required|string',
        'title_edit' => 'required|string',
        'image_edit' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation for image upload
        // Add validation rules for other fields as needed
        'category_edit' => 'required|integer|exists:categories,id', // Example validation for category ID
        'price_edit' => 'required|numeric|min:0', // Example validation for price
        'quantity_edit' => 'required|integer|min:0', // Example validation for quantity
        'sku_edit' => 'required|string', // Example validation for SKU
        'barcode_edit' => 'required|string', // Example validation for barcode
    ]);
  

    // Find the product by ID
    $product = Product::find($id);

    // Check if the product exists
    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    // Handle image upload if a new image is provided
    if ($request->hasFile('image_edit')) {
        $path = time() . '.' . $request->image_edit->extension();
        $request->image_edit->move(public_path('images'), $path);

    }

    // Update product attributes
    $product->title = $validatedData['title_edit'];
    $product->image = $path;
    $product->description = $validatedData['description_edit'];
    // Add updates for other fields as needed
    $product->category_id = $validatedData['category_edit'];
    $product->price = $validatedData['price_edit'];
    $product->quantity = $validatedData['quantity_edit'];
    $product->sku = $validatedData['sku_edit'];
    $product->barcode = $validatedData['barcode_edit'];

    // Save the changes to the database
    $product->save();

    // Return a JSON response indicating success
    return response()->json(['message' => 'Product updated successfully', 'product' => $product]);
}

public function destroy($id)
{

    $product = Product::find($id);
    if (!$product) {
        return response()->json(['error' => 'Product not found'], 404);
    }
    $product->delete();
    return response()->json(['message' => 'Product deleted successfully']);
}
    
public function getCategoryProducts($categoryId)
{
  $category = Category::find($categoryId);
  $products = $category->products;

  return response()->json($products);
}  

public function showDetailsProductPage(Request $request)
{
    $id = $request->query('id');
    $product = Product::with('category')->findOrFail($id);
    $data['product']=$product;
    return view('content.front-page.detailsProduct',$data);
    
}


public function ajaxAdd(Request $request, Product $product)
{
   
    $cart = $request->session()->get('carts', []);
    
    if (!isset($cart[$product->id])) {
        $category = Category::find($product->category_id);
        $cart[$product->id] = [
            'id'=>$product->id,
            'title' => $product->title,
            'price' => $product->price,
            'image'=>$product->image,
            'barcode'=>$product->barcode,
            'quantity' => 1,
            'sku'=>$product->sku,
            'category_name'=>$category->name,
            'description'=>$product->description,
        ];
    } else {
        
        $cart[$product->id]['quantity']++;
    }

    
    $request->session()->put('carts', $cart);
   

   
    return response()->json(['message' => 'Item added to cart successfully.']);
}

public function showCart(Request $request)
{
    
    $carts = $request->session()->get('carts', []);
    return view('content.front-page.cartProduct', compact('carts'));
}
public function submitFormOrder(Request $request)
{
    $items = json_decode($request->input('items'), true);
    $user_id = auth()->user()->id;

    $customplace = $request->input('customplace');
    $customfullName = $request->input('customfullName');
    $customphoneNumber = $request->input('customphoneNumber');
    $custommodalemail = $request->input('custommodalemail');
    $modalAddressCountry = $request->input('modalAddressCountry');
    $customaddress = $request->input('customaddress');
    $customdelivery = $request->input('customdelivery');
    $total_price = 0;
    $switchonOmt = $request->has('onOmt') ? true : false;
    $switchonDelivery = $request->has('onDelivery') ? true : false;

    // Check if the customer exists
    $existingCustomer = Order::where('customphoneNumber', $customphoneNumber)->exists();
    $customer_type = $existingCustomer ? 'Old Customer' : 'New Customer';

    $order = Order::create([
        'user_id' => $user_id,
        'items' => 'empty',
        'customplace' => $customplace,
        'customfullName' => $customfullName,
        'customphoneNumber' => $customphoneNumber,
        'custommodalemail' => $custommodalemail,
        'modalAddressCountry' => $modalAddressCountry,
        'customaddress' => $customaddress,
        'customdelivery' => $customdelivery,
        'total_price' => $total_price,
        'switchonOmt' => $switchonOmt,
        'switchondelivery' => $switchonDelivery,
        'status' => 'pending',
        'customer_type' => $customer_type,
        'created_by' => 'Website Order',
    ]);

    foreach ($items as $item) {
        $subtotal = $item['price'] * $item['quantity'];
        OrderItem::create([
            'user_id' => $user_id,
            'order_id' => $order->id,
            'product_id' => $item['id'],
            'quantity' => $item['quantity'],
            'price_per_unit' => $item['price'],
            'subtotal' => $subtotal,
        ]);
        $total_price += $subtotal;
    }

    $order->total_price = $total_price;
    $order->save();
    $request->session()->forget('carts');
    return response()->json(['message' => 'Order created successfully', 'status' => 'success', 'orderId' => $order->id], 201);
}

public function showOrderDashboard(Request $request)
{
    $user_id = auth()->user()->id;
    $orders = Order::where('user_id', $user_id)->get();
    $data['orders']=$orders;
    return view('content.dashboard.orderData.index',$data );
}

public function markAsCompleted($orderId)
    {
        
        $order = Order::findOrFail($orderId);
        $order->status == 'completed'?'pending':'completed';
        $order->save();

        return response()->json(['message' => 'Order status updated to completed']);
    }
    public function showDetailsOrder(Request $request)
    {
      
        $orderId =  $request->query('orderId');
        $order=Order::findOrFail($orderId);
        $orders = OrderItem::where('order_id', $orderId)->with('order', 'product')
        ->get();
        $data['orders']=$orders;
        
        $data['order']=$order;
        return view('content.dashboard.orderData.detailsOrder',$data );
        
    }
    public function showCreateOrderDashboard(Request $request)
    {
        $user_id = auth()->user()->id;
        $user = User::findOrFail($user_id);
        $category = $user->categories;
        $data['categories']=$category;
        return view('content.dashboard.orderData.createOrder',$data );
        
    }
    public function getProductsByCategory(Request $request,$categoryId)
    {
       
        
       
        $user_id = auth()->user()->id;
        $user = User::findOrFail($user_id);
        $products = $user->categories()
                 ->where('category_id', $categoryId)
                 ->firstOrFail() // Assuming the category exists for the user
                 ->products;
     

        return response()->json($products);
    }
    public function getProductPrice($productId)
    {
        $product = Product::findOrFail($productId);

        return response()->json(['price' => $product->price]);
    }
    public function storeOrder(Request $request)
    {
       
        // Get the user ID, you might need to get this from the authenticated user or another source
        $user_id = auth()->id(); 
    
        // Extract the customer information from the request
        $customer_name = $request->input('customer_name');
        $customplace = 'Some Place'; // Assuming this is hardcoded or comes from another source
        $customfullName = $customer_name;
        $customphoneNumber = '1234567890'; // Example phone number, should be fetched from request
        $custommodalemail = 'example@example.com'; // Example email, should be fetched from request
        $modalAddressCountry = 'Country'; // Example country, should be fetched from request
        $customaddress = 'Customer Address'; // Example address, should be fetched from request
        $customdelivery = 'Standard'; // Example delivery type, should be fetched from request
        $switchonOmt = false; // Example switch, should be fetched from request
        $switchonDelivery = true; // Example switch, should be fetched from request
        $total_price = 0; // Initialize total price
    
        // Create the order
        $order = Order::create([
            'user_id' => $user_id,
            'items' => 'empty',
            'customplace' => $customplace,
            'customfullName' => $customfullName,
            'customphoneNumber' => $customphoneNumber,
            'custommodalemail' => $custommodalemail,
            'modalAddressCountry' => $modalAddressCountry,
            'customaddress' => $customaddress,
            'customdelivery' => $customdelivery,
            'total_price' => $total_price,
            'switchonOmt' => $switchonOmt,
            'switchondelivery' => $switchonDelivery,
            'status' => 'pending',
            'customer_type' => 'New Customer',
            'created_by' => 'Admin Order',
        ]);
    
        // Extract items from the request
        $items = $request->input('products', []);
    
        // Loop through each item and create order items
        foreach ($items as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            OrderItem::create([
                'user_id' => $user_id,
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price_per_unit' => $item['price'],
                'subtotal' => $subtotal,
            ]);
            $total_price += $subtotal;
        }
    
        // Update the order with the correct total price
        $order->total_price = $total_price;
        $order->save();
        $user = User::findOrFail($user_id);
        $category = $user->categories;
        $data['categories']=$category;
    
        return view('content.dashboard.orderData.createOrder',$data );
    }
    public function storeComment(Request $request)
    {
       
        $comment = $request->input('description');
        $orderEmail = $request->input('orderEmail'); // Adjust to fetch the order email correctly
        
        // Send the email
        Mail::to($orderEmail)->send(new CommentSubmitted($comment));

        return redirect()->back()->with('success', 'Comment submitted and email sent!');
    }
    public function destroyOrderDashboard($id)
    {
      
            $order = Order::findOrFail($id);
           
            if (!$order) {
                return response()->json(['error' => 'Order not found'], 404);
            }
            $order->delete();
            return response()->json(['message' => 'Order deleted successfully']);
            
        
    }

}
