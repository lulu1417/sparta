<?php

namespace App\Http\Controllers;

use App\Record;
use App\Item;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

class WorshipController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            Record::all();
            return response()->json(Record::all());
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $items = Item::whereIn('item',$request->item)->select('item')
            ->get();
        $items = $items->toArray();
        $i = 1;
        foreach ($items as $item) {
            $create = Record::create([
                'item' => $item['item'],
                'name' => $request->name,
                'god' => 'Apollo'
            ]);
            $result[$i] = $create->toArray();
            $i++;
        }
        $result['message'] = "Worship successfully.";
        if ($create)
            return $this->sendResponse($result, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
