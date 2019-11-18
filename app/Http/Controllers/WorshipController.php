<?php

namespace App\Http\Controllers;

use App\Record;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        Log::info($request->input());
        date_default_timezone_set('Asia/Taipei');
        $items = Item::whereIn('item',$request['item'])->select('item')
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
        if ($create){
            $request = $request->toArray();
            $request['time'] = date('Y-m-d H:i:s');
            return json_encode($request);
            return $this->sendResponse($request, 200);
        }

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
