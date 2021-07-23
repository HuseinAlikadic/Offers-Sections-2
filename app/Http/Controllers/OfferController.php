<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Section;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
 
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
       

        return view('offer/offer')->with($myArray);
    }

    public function add_offer(Request $request)
    {  
       $addOffer= new Offer;
       $addOffer->title=$request->title;
       $addOffer->slug=$request->slug;
       $addOffer->published_at= $request->published_at ;
       $addOffer->published=$request->published;
       $addOffer->introduction=$request->introduction;
       $addOffer->description=$request->description;
       $addOffer->author_id=$request->author_id;
       $addOffer->section_id=$request->section_id;
       $addOffer->image=$request->image;

       $addOffer->save();
        return redirect('offer')->with('success','You have successfully added a new offer.');
    }

    public function edit_offer(Request $request)
    {
        $idOffer=$request->id;
        $editOffer= Offer::find($idOffer);
        $editOffer->title=$request->title;
        $editOffer->slug=$request->slug;
        $editOffer->published=$request->published;
        $editOffer->introduction=$request->introduction;
        $editOffer->description=$request->description;
        $editOffer->author_id=$request->author_id;
        $editOffer->section_id=$request->section_id;
        $editOffer->image=$request->image;

        $editOffer->save();
       
        return redirect('offer')->with('success','You have successfully edit a offer.');
    }

    public function delete_offer(Request $request)
    {
        $deleteId=$request->id;

        Offer::where('id',$deleteId)->delete();
        
        return redirect('offer');
    }
}