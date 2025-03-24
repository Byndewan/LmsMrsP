<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    public function StoreTestimonial(Request $request)
    {
        // $user = $request->user_id;

        $request->validate([
            'rating' => 'required',
            'comment' => 'required',
        ]);

        Testimonial::insert([
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Testimonial Will Approved By Admin',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function AdminPendingTestimonial()
    {
        $testimonial = Testimonial::where('status',0)->orderBy('id','DESC')->get();
        return view('admin.backend.testimonial.pending_testimonial', compact('testimonial'));
    }

    public function UpdateTestimonialStatus(Request $request)
    {
        $testimonialId = $request->input('testimonial_id');
        $isChecked = $request->input('is_checked',0);

        $testimonial = Testimonial::find($testimonialId);
        if($testimonial) {
            $testimonial->status = $isChecked;
            $testimonial->save();
        }

        return response()->json(['message' => 'Testimonial Status Updated Successfully']);
    }

    public function AdminActiveTestimonial()
    {
        $testimonial = Testimonial::where('status',1)->orderBy('id','DESC')->get();
        return view('admin.backend.testimonial.active_testimonial', compact('testimonial'));
    }
}
