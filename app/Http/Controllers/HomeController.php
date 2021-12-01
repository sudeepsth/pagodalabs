<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $path=public_path('employee.csv');
        $file = null;
        if(file_exists($path))
            $file = true;
        return view('home',compact('file'));
    }


    public function editEmployee(Request $request)
    {
             $path = public_path('employee.csv');
             $file = true;
             $data = array();
             $id = null;
             if(file_exists($path)){
                $fin = fopen($path, 'r');


                $row = 0;
                while ($line = fgetcsv($fin, 10000)) {
                if($row!=0){
                    $data[] = $line;

                }
                $row++;
                }
                $id = isset($data) && count($data)>=1?$data[$row-2][0]:0;
             }else{
                 $file = false;
             }

            return view('edit',compact('data','id','file'));
    }

    public function updateEmployee(Request $request)
    {

            $path=public_path('employee.csv');

            $data = array();
            $fin = fopen($path, 'r');
            $data = array();
            /***********
             * header row
             */
            $data[] = fgetcsv($fin, 1000);
            /***********
             * data rows
             */

            fclose($fin);
            if(isset($request->id)){
                foreach($request->id as $key=>$item){
                    array_push($data,[
                        0 => $request->id[$key],
                        1 => $request->name[$key],
                        2 => $request->designation[$key],
                        3 => $request->joinDate[$key],
                    ]);
                 }
            }


            $fout = fopen($path, 'w');
            foreach ($data as $line) {
                 fputcsv($fout, $line);
            }
            fclose($fout);

            return redirect()->back()->with('success','File Upated Successfully');
    }
}
