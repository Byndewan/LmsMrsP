<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Notifications\OrderComplete;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Intervention\Image\ImageManager;
use App\Models\Course;
use App\Models\CourseLecture;
use App\Models\CourseSection;
use App\Models\Course_goal;
use App\Models\Coupon;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use App\Mail\Orderconfirm;
use Midtrans\Config;
use Midtrans\Notification as MidtransNotification;
use Midtrans\Snap;
use Stripe;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id)
    {
        $course = Course::find($id);

        if (Session::has('coupon')){
            Session::forget('coupon');
        }

        // Check if the course already in the cart
        $cartItem = Cart::search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id === $id;
        });

        if($cartItem->isNotEmpty()) {
            return response()->json(['error' => 'Course is already in your cart']);
        }

        if ($course->discount_price == NULL) {
            Cart::add([
                'id' => $id,
                'name' => $request->course_name,
                'qty' => 1,
                'price' => $course->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $course->course_image,
                    'slug' => $course->course_name_slug,
                    'instructor' => $request->instructor,
                ],
            ]);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $request->course_name,
                'qty' => 1,
                'price' => $course->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $course->course_image,
                    'slug' => $course->course_name_slug,
                    'instructor' => $request->instructor,
                ],
            ]);
        }

        return response()->json(['success' => 'Successfully Added on Your Cart']);
    }

    public function CartData()
    {
        $carts = Cart::content();
        $cartTotal = Cart::total();
        $cartQty = Cart::count();

        return response()->json(array(
            'carts' => $carts,
            'cartTotal' => $cartTotal,
            'cartQty' => $cartQty,
        ));
    }

    public function AddMiniCart()
    {
        $carts = Cart::content();
        $cartTotal = Cart::total();
        $cartQty = Cart::count();

        return response()->json(array(
            'carts' => $carts,
            'cartTotal' => $cartTotal,
            'cartQty' => $cartQty,
        ));
    }

    public function RemoveMiniCart($rowId)
    {
        Cart::remove($rowId);
        return response()->json(['success' => 'Course Remove From Cart']);
    }

    public function MyCart()
    {
        return view('frontend.mycart.view_mycart');
    }

    public function GetCartCourse()
    {
        $carts = Cart::content();
        $cartTotal = Cart::total();
        $cartQty = Cart::count();

        return response()->json(array(
            'carts' => $carts,
            'cartTotal' => $cartTotal,
            'cartQty' => $cartQty,
        ));
    }

    public function CartRemove($rowId)
    {
        Cart::remove($rowId);

        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100),
            ]);
        }
        return response()->json(['success' => 'Course Remove From Cart']);
    }

    public function CouponApply(Request $request)
    {
        $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();

        if($coupon) {
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100),
            ]);

            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon Applied Successfully'
            ));
        } else {
            return response()->json(['error' => 'Invalid Coupon']);
        }
    }

    public function InsCouponApply(Request $request)
    {
        $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();

        if ($coupon) {
            if ($coupon->course_id == $request->course_id && $coupon->instructor_id == $request->instructor_id) {
                Session::put('coupon',[
                    'coupon_name' => $coupon->coupon_name,
                    'coupon_discount' => $coupon->coupon_discount,
                    'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                    'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100),
                ]);

                return response()->json(array(
                    'validity' => true,
                    'success' => 'Coupon Applied Successfully'
                ));
            } else {
                return response()->json(['error' => 'Coupon criteria not met for this course and instructor']);
            }
        } else {
            return response()->json(['error' => 'Invalid Coupon']);
        }
    }

    public function CouponCalculation()
    {
        if (Session::has('coupon')){
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        } else {
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }
    }

    public function CouponRemove()
    {
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);
    }

    public function CheckoutCreate()
    {

        if (Auth::check()) {

            if (Cart::total() > 0) {
                $carts = Cart::content();
                $cartTotal = Cart::total();
                $cartQty = Cart::count();

                return view('frontend.checkout.checkout_view',compact('carts','cartTotal','cartQty'));
            } else {

                $notification = array(
                    'message' => 'Add at least one Course!',
                    'alert-type' => 'error'
                 );

                 return redirect()->route('index')->with($notification);
            }

        } else {

            $notification = array(
                'message' => 'You Need to Login Fisrt!',
                'alert-type' => 'error'
             );

             return redirect()->route('login')->with($notification);

        }
    }

    public function Payment(Request $request)
    {
        $user = User::where('role','instructor')->get();

        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }

            $data = array();
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
            $data['address'] = $request->address;
            $data['course_title'] = $request->course_title;
            $cartTotal = Cart::total();
            $carts = Cart::content();


        if ($request->cash_delivery == 'stripe') {
            return view('frontend.payment.stripe', compact('data','cartTotal','carts'));
        } elseif ($request->cash_delivery == 'handcash') {
           // Create a new Payment Record
        $data = new Payment();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->cash_delivery = $request->cash_delivery;
        $data->total_amount = $total_amount;
        $data->payment_type = 'Direct Payment';

        $data->invoice_no = 'EOS' . mt_rand(10000000, 99999999);
        $data->order_date = Carbon::now()->format('d F Y');
        $data->order_month = Carbon::now()->format('F');
        $data->order_year = Carbon::now()->format('Y');
        $data->status = 'pending';
        $data->created_at = Carbon::now();
        $data->save();

        foreach ($request->course_title as $key => $course_title) {

            $existingOrder = Order::where('user_id', Auth::user()->id)->where('course_id',$request->course_id[$key])->first();

            if ($existingOrder) {
                $notification = array(
                    'message' => 'You have already enrolled in this course',
                    'alert-type' => 'error'
                 );

                 return redirect()->back()->with($notification);
            }

            $order = new Order();
            $order->payment_id = $data->id;
            $order->user_id = Auth::user()->id;
            $order->course_id = $request->course_id[$key];
            $order->instructor_id = $request->instructor_id[$key];
            $order->course_title = $course_title;
            $order->price = $request->price[$key];
            $order->save();
        }

            $request->session()->forget('cart');

            $paymentId = $data->id;

            // Start send email to student //
            $sendmail = Payment::find($paymentId);
            $data = [
                'invoice_no' => $sendmail->invoice_no,
                'amount' => $total_amount,
                'name' => $sendmail->name,
                'email' => $sendmail->email,
            ];

            Mail::to($request->email)->send(new Orderconfirm($data));

            // End send email to student //

            /// Send Notification
            Notification::send($user, new OrderComplete($request->name));

            $notification = array(
                'message' => 'Cash Payment Submit Successfully',
                'alert-type' => 'success'
                );

                return redirect()->route('index')->with($notification);
        } elseif ($request->cash_delivery == 'midtrans') {
            Config::$serverKey = 'SB-Mid-server-39zR0mT9p972NtZIVsAKw-ws';
            Config::$isProduction = env('MIDTRANS_IS_PRODUCTION') == 'true';
            Config::$isSanitized = true;
            Config::$is3ds = true;



            $data = new Payment();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->address = $request->address;
            $data->cash_delivery = $request->cash_delivery;
            $data->total_amount = $total_amount * 16560;
            $data->payment_type = 'Midtrans';
            $data->invoice_no = 'EOS' . mt_rand(10000000, 99999999);
            $data->order_date = Carbon::now()->format('d F Y');
            $data->order_month = Carbon::now()->format('F');
            $data->order_year = Carbon::now()->format('Y');
            $data->status = 'pending';
            $data->created_at = Carbon::now();
            $data->save();

            $transaction = [
                'transaction_details' => [
                    'order_id' => $data->invoice_no,
                    'gross_amount' => $total_amount * 16560,
                ],
                'customer_details' => [
                    'first_name' => $data = $request->name,
                    'email' => $data = $request->email,
                    'phone' => $data = $request->phone,
                ]
            ];

            $orderId = Payment::first();

            $snapToken = Snap::getSnapToken($transaction);
            return view('frontend.payment.midtrans', ['data' => $data, 'order_id' => $orderId->invoice_no, 'snap_token' => $snapToken, 'carts' => $carts]);
        }
    }

    public function StripeOrder(Request $request)
    {
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round(Cart::total());
        }

        \Stripe\Stripe::setApiKey('sk_test_51QvvNyIWwFr15ddxVTiC1nY8PuXLfdZhbJeIxaxjJrHs1xEPgXl7yrwaYcsPkB8qgrnD4jjo2Yeyl3tOia0ccpiz00eJpEx0eE');

        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            'amount' => $total_amount*100,
            'currency' => 'usd',
            'description' => 'Lms',
            'source' => $token,
            'metadata' => ['order_id' => 3434],
        ]);

        $order_id = Payment::insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_amount' => $total_amount,
            'payment_type' => 'Stripe',
            'invoice_no' => 'EOS' . mt_rand(10000000, 99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'pending',
            'created_at' => Carbon::now(),
        ]);

        $carts = Cart::content();
        foreach ($carts as $cart) {
            Order::insert([
                'payment_id' => $order_id,
                'user_id' => Auth::user()->id,
                'course_id' => $cart->id,
                'instructor_id' => $cart->options->instructor,
                'course_title' => $cart->options->name,
                'price' => $cart->price,
            ]);
        }

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        Cart::destroy();

        $notification = array(
            'message' => 'Stripe Payment Submit Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('index')->with($notification);
    }


    public function MidtransOrder(Request $request){
        $result = $request->input('result');

            if (!$result) {
                return response()->json(['message' => 'Result not found.'], 400);
            }

            $order_id = $result['order_id'] ?? null;
            $transaction_status = $result['transaction_status'] ?? 'unknown';
            $payment_type = $result['payment_type'] ?? 'unknown';
            $fraud_status = $result['fraud_status'] ?? null;

            $payment = Payment::where('invoice_no', $order_id)->first();

            if (!$payment) {
                return response()->json(['message' => 'Payment not found.'], 404);
            }

            if ($transaction_status == 'capture') {
                if ($fraud_status == 'challenge') {
                    $payment->status = 'challenge';
                } elseif ($fraud_status == 'accept') {
                    $payment->status = 'confirm';
                }
            } elseif ($transaction_status == 'settlement') {
                $payment->status = 'confirm';
            } elseif ($transaction_status == 'pending') {
                $payment->status = 'pending';
            } elseif (in_array($transaction_status, ['deny', 'cancel', 'expire'])) {
                $payment->status = 'failed';
            }

            $payment->payment_type = 'Midtrans';
            $payment->invoice_no = 'EOS' . $result['transaction_id'] ?? null;
            $payment->update();

            $carts = Cart::content();
            foreach ($carts as $cart) {
                Order::insert([
                    'payment_id' => $payment->id,
                    'user_id' => Auth::user()->id,
                    'course_id' => $cart->id,
                    'instructor_id' => $cart->options->instructor,
                    'course_title' => $cart->name,
                    'price' => $cart->price * 16560,
                    'created_at' => Carbon::now(),
                ]);
            }

            if (Session::has('coupon')) {
                Session::forget('coupon');
            }
            Cart::destroy();
    
            return response()->json(['message' => 'Payment Confirm Successfully']);

        }

    public function BuyToCart(Request $request, $id)
    {
        $course = Course::find($id);

        // Check if the course already in the cart
        $cartItem = Cart::search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id === $id;
        });

        if($cartItem->isNotEmpty()) {
            return response()->json(['error' => 'Course is already in your cart']);
        }

        if ($course->discount_price == NULL) {
            Cart::add([
                'id' => $id,
                'name' => $request->course_name,
                'qty' => 1,
                'price' => $course->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $course->course_image,
                    'slug' => $course->course_name_slug,
                    'instructor' => $request->instructor,
                ],
            ]);
        } else {
            Cart::add([
                'id' => $id,
                'name' => $request->course_name,
                'qty' => 1,
                'price' => $course->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $course->course_image,
                    'slug' => $course->course_name_slug,
                    'instructor' => $request->instructor,
                ],
            ]);
        }

        return response()->json(['success' => 'Successfully Added on Your Cart']);
    }

    public function markAsRead(Request $request, $notificationId)
    {
        $user = Auth::user();
        $notification = $user->notifications()->where('id',$notificationId)->first();

        if ($notification) {
            $notification->markAsRead();
        }
        return response()->json(['count' => $user->unreadNotifications()->count()]);

    }// End Method
}
