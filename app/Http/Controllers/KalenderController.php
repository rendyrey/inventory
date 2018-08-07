<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;

class KalenderController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
      $data['user'] = Auth::user();
      return view('kalender.index',$data);
    }

    public function get_order(){
  		$order = Order::where('tanggal_order','>=',date('Y'))->get();
  		$events = array();
      $color = ['#990000','#992600','#994d00','#997300','#999900','#739900','#4d9900','#269900','#009999',
                '#007399','#000099','#730099','#990026','#f56954','#f39c12','#0073b7','#00c0ef','#00a65a','#3c8dbc',
                '#800080','#fc2165','#666666','#43c2c1','#fd882d','#fc4b54','#fc4b54','#1e1c73','#d178c0','#55428e','#1a1122'];
  		foreach($order as $key => $value){
  			$e = array();
  			$e['id'] = $value->id;
  			$e['title'] = "$value->nomor_order";
  			$e['start'] = date('Y-m-d',strtotime($value->tanggal_order));
  			$e['end'] = date('Y-m-d',strtotime($value->tanggal_selesai."+1 day"));
  			$e['allDay'] = TRUE;
        $warna = $color[rand(0,29)];
        $e['backgroundColor'] = $warna;
        $e['borderColor'] = $warna;
        $e['pemberi_order'] = $value->pemberi_order;
        $e['tanggal_order'] = date('d M Y',strtotime($value->tanggal_order));
        $e['tanggal_selesai'] = date('d M Y',strtotime($value->tanggal_selesai));
        array_push($events,$e);
  		}
  		echo json_encode($events);
  	}
}
