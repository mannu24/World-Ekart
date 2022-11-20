<?php

namespace Webkul\Admin\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Webkul\Admin\DataGrids\TrackingDataGrid;

class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @var \Illuminate\Http\Response
     */
    protected $_config;

    public function __construct() {
        $this->_config = request('_config');
        $this->middleware('guest', ['except' => 'destroy']);
    }

    public function index() {
        if (request()->ajax()) {
            return app(TrackingDataGrid::class)->toJson();
        }

        return view($this->_config['view']);
    }

    public function store() {

        $data = request()->validate([
            'name' => 'required|string',
            'link' => 'required|url',
        ]) ;

        $res = DB::table('courier_titles')->insert($data) ;

        if($res) session()->flash('success', 'Tracking Link Added Successfully!');
        else session()->flash('failed', 'Server Error Occured!');

        return redirect()->back() ;
    }

    public function destroy($id) {
        try {
            DB::table('courier_titles')->where('id',$id)->delete();
            return response()->json(['message' => 'Deleted Successfully']);
        } catch (\Exception $e) {}

        return response()->json(['message' => 'Deletion Failed'], 500);
    }
}
