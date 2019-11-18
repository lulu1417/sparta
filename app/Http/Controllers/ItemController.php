<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Item::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
                $request->validate([
                    'item' => ['required', 'unique:items'],
                    'image' => ['required', 'mimes:jpg,jpeg,bmp,png'],
                ]);
                $parameters = request()->all();
                if (request()->hasFile('image')) {
                    $imageURL = request()->file('image')->store('public');
                    $parameters['image'] = substr($imageURL, 7);
                } else {
                    $e = "Please upload an image for item.";
                    return $this->sendError($e->getMessage(), 400);
                }
                $create = Item::create([
                    'item' => $request['item'],
                    'image' => $parameters['image'],
                ]);
                $result = $create->toArray();
                if ($parameters['image'] != null)
                    $result['imageURL'] = asset('storage/' . $parameters['image']);
                if ($create) {
                    return $this->sendResponse($result, 200);
                }

        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
