<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Section;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OfferController extends Controller
{
    public function show_offer()
    {

        $myArray['offer']=Offer::leftJoin('users','offers.author_id','=','users.id')
        ->leftJoin('sections','offers.section_id','=','sections.id')
        ->select('offers.id as offerId','offers.title','offers.slug','offers.published_at','offers.unpublished_at','offers.published',
        'offers.introduction','offers.description','offers.image','users.name as author','offers.author_id as authorId','offers.section_id as sectionId','sections.name as sectionNama')
        ->get();

        $myArray['section']=Section::get();
        $myArray['user']=User::get();
        // šalje 1 ili 0
        $myArray['isAdmin']=Auth::user()->is_admin;
        $myArray['isCreateOffer']=Auth::user()->id;
        
        return view('offer/offer')->with($myArray);
    }

    public function add_offer(Request $request)
    { 
        $validation = $request->validate([
            'title' => 'required|max:255',
            'published_at'=>'required',
            'published'=>'required',
            'introduction'=>'required',
            'description'=>'required',
            'author_id'=>'required',
            'section_id'=>'required',
            'image'=>'required',               
        ]);
     $slug= Str::slug($request->title , '-');

       $addOffer= new Offer();
       $addOffer->fill($validation);
       $addOffer->slug=$slug; 
       $addOffer->save();
        return redirect('offer')->with('success','You have successfully added a new offer.');
    }

    public function edit_offer(Request $request)
    {
        $validation = $request->validate([
            'title' => 'required|max:255',
            'published_at'=>'required',
            'published'=>'required',
            'introduction'=>'required',
            'description'=>'required',
            'author_id'=>'required',
            'section_id'=>'required',
            'image'=>'required',               
        ]);
        $slug= Str::slug($request->title , '-');

        $idOffer=$request->id;
        $editOffer= Offer::find($idOffer);
        $editOffer->fill($validation);
        $editOffer->slug=$slug;
        $editOffer->save();
       
        return redirect('offer')->with('success','You have successfully edit a offer.');
    }

    public function delete_offer(Request $request)
    {
        $deleteId=$request->id;
        Offer::where('id',$deleteId)->delete();
    
        return redirect('offer');
    }

    public function search_offer_by_title()
    {
        $search=request()->get('rezultat');
        $offer=Offer::where('title','LIKE', '%'. $search . '%')->get();
       
        return $offer;     
    }
}