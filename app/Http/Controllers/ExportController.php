<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\EmployeeExport;
use Excel;

class ExportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
         
        $data = array();
        foreach($request->id as $key=>$item){
            array_push($data,[
                'id' => $request->id[$key],
                'name' => $request->name[$key],
                'designation' => $request->designation[$key],
                'joinDate' => $request->joinDate[$key],
            ]);
        }

        $data = Excel::store(new EmployeeExport($data), 'employee.csv');
        return redirect()->back()->with('success', 'your message,here');
    }
}
