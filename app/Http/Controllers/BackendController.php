<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;


class BackendController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index(){
    	return view('backend.panel');
    }

    public function reports(Request $request){
        $fromdate = $request->input('fromdate');
        $todate = $request->input('todate');
        $newfromdate=date("Y-m-d", strtotime($fromdate));
        $newtodate=date("Y-m-d", strtotime($todate));
        date_default_timezone_set('Asia/Dhaka');
        $thismonth = date('Y-m');
        if(empty($fromdate)){
            $reports = DB::table('reports')->whereBetween('reports.created_at', [$thismonth.'-01'.' 00:00:00', $thismonth.'-31'.' 23:59:59'])->join('categories', 'category', '=', 'categories.id')->select('reports.created_at as date', 'reports.description', 'categories.id as categoryid', 'categories.name as category', 'reports.income', 'reports.expense', 'reports.balance', 'reports.ie')->orderBy('reports.id', 'asc')->paginate(15);
        }
        else{
            $reports = DB::table('reports')->whereBetween('reports.created_at', [$newfromdate.' 00:00:00', $newtodate.' 23:59:59'])->join('categories', 'category', '=', 'categories.id')->select('reports.created_at as date', 'reports.description', 'categories.id as categoryid', 'categories.name as category', 'reports.income', 'reports.expense', 'reports.balance', 'reports.ie')->orderBy('reports.id', 'asc')->paginate(1000);
        }
        $sections=DB::table('categories')->get();
        $lastbalance = DB::table('reports')->select('balance')->orderBy('id', 'desc')->first();
        return view('backend.reports')->with('sections', $sections)->with('reports', $reports)->with('lastbalance', $lastbalance);
    }

    public function reportadd(Request $request){
        date_default_timezone_set('Asia/Dhaka');
        if(empty($request->input('date'))){
            $newdate=date('Y-m-d h:m:s');
        }else{
            $newdate=date("Y-m-d", strtotime($request->input('date')));
        }
        $description = $request->input('description');
        $category = $request->input('category');
        $income = $request->input('income');
        $expense = $request->input('expense');
        $balance = $request->input('balance');
        if(!empty($request->input('income'))){
            $ie = '0';
        }elseif (!empty($request->input('expense'))) {
            $ie = '1';
        }else{
            $ie = '3';
        }
        DB::table('reports')->insert(['description' => $description, 'category' => $category, 'income'=> $income, 'expense' => $expense, 'balance' => $balance, 'ie' => $ie, 'created_at' => $newdate]);
        return redirect('reports');
    }

    public function categoryinfo($categoryid){
        $categoryname=DB::table('categories')->where('id', $categoryid)->first();
        $categoryinfos=DB::table('reports')->where('category', $categoryid)->select('reports.created_at as date', 'reports.description', 'reports.income', 'reports.expense', 'reports.balance', 'reports.ie')->orderBy('reports.id', 'asc')->paginate(100);
        return view('backend.category')->with('categoryinfos', $categoryinfos)->with('categoryname', $categoryname);
    }

    public function charts(){
        date_default_timezone_set('Asia/Dhaka');
        $thismonth = date('Y-m');
        $chartdatas=DB::table('reports')->whereBetween('reports.created_at', [$thismonth.'-01'.' 00:00:00', $thismonth.'-31'.' 23:59:59'])->get();
        $lastbalance = DB::table('reports')->select('balance')->orderBy('id', 'desc')->first();
        $numofsupplier=DB::table('suppliers')->count();
        $amountofjute=DB::table('transactions')->whereBetween('transactions.created_at', [$thismonth.'-01'.' 00:00:00', $thismonth.'-31'.' 23:59:59'])->sum('transactions.quantity');
        $numofworker=DB::table('workers')->count();
        $supplierdue=DB::table('suppliers')->sum('suppliers.totaldue');
        $supplierpaid=DB::table('suppliers')->sum('suppliers.totalpaid');
        $totaldue=$supplierdue-$supplierpaid;
        $incomecategory=DB::table('categories')->where('ie', 0)->get();
        $expensecategory=DB::table('categories')->where('ie', 1)->get();
        return view('backend.panel')->with('chartdatas', $chartdatas)->with('lastbalance', $lastbalance)->with('numofsupplier', $numofsupplier)->with('amountofjute', $amountofjute)->with('numofworker', $numofworker)->with('totaldue', $totaldue)->with('incomecategory', $incomecategory)->with('expensecategory', $expensecategory);
    }

    public function supplier(){
        $suppliers = DB::table('suppliers')->paginate(15);
        return view('backend.supplier', compact('suppliers'));
    }

    public function addSupplier(Request $request){
        $name = $request->input('name');
        $phone = $request->input('phone');
        $mokam = $request->input('mokam');
        $address = $request->input('address');
        $totaldue = $request->input('totaldue');
        $totalpaid = $request->input('totalpaid');
        DB::table('suppliers')->insert(['name' => $name, 'phone' => $phone, 'mokam' => $mokam, 'address' => $address, 'totaldue' => $totaldue, 'totalpaid' => $totalpaid]);
        return redirect('supplier');
    }

    public function deleteSupplier($supplier){
        DB::table('suppliers')->where('id', '=', $supplier)->delete();
        return redirect('supplier');
    }

    public function supplierinfo($supplierid){
        $supplierinfo = DB::table('suppliers')->where('id', $supplierid)->first();
        $transactions=DB::table('transactions')->where('supplier_id', $supplierid)->paginate(15);
        $payments = DB::table('suppliers_payment')->where('supplier_id', $supplierid)->paginate(15);
        return view('backend.supplierinfo')->with('supplierinfo', $supplierinfo)->with('transactions', $transactions)->with('payments', $payments);
    }

    public function DailyReport(Request $request){
        $fromdate = $request->input('fromdate');
        $todate = $request->input('todate');
        $newfromdate=date("Y-m-d", strtotime($fromdate));
        $newtodate=date("Y-m-d", strtotime($todate));
        date_default_timezone_set('Asia/Dhaka');
        $thismonth = date('Y-m');
        if(empty($fromdate)){
            $transactions = DB::table('transactions')->whereBetween('transactions.created_at', [$thismonth.'-01'.' 00:00:00', $thismonth.'-31'.' 23:59:59'])->join('suppliers', 'supplier_id', '=', 'suppliers.id')->select('transactions.created_at as date', 'suppliers.id', 'suppliers.name', 'suppliers.mokam', 'transactions.lot', 'transactions.quantity', 'transactions.price', 'transactions.totalprice', 'suppliers.totaldue', 'suppliers.totalpaid')->orderBy('transactions.id', 'desc')->paginate(15);
        }
        else{
            $transactions = DB::table('transactions')->whereBetween('transactions.created_at', [$newfromdate.' 00:00:00', $newtodate.' 23:59:59'])->join('suppliers', 'supplier_id', '=', 'suppliers.id')->select('transactions.created_at as date', 'suppliers.id', 'suppliers.name', 'suppliers.mokam', 'transactions.lot', 'transactions.quantity', 'transactions.price', 'transactions.totalprice', 'suppliers.totaldue', 'suppliers.totalpaid')->orderBy('transactions.id', 'desc')->paginate(1000);
        }
       $suppliers=DB::table('suppliers')->get();
       return view('backend.dailyreport')->with('transactions', $transactions)->with('suppliers', $suppliers);
    }
    

    public function addReport(Request $request){
        date_default_timezone_set('Asia/Dhaka');
        $date=date('Y-m-d h:m:s');
        $supplierid = $request->input('supplierid');
        $lot = $request->input('lot');
        $quantity = $request->input('quantity');
        $price = $request->input('price');
        $totalprice = $request->input('totalprice');


        DB::table('transactions')->insert(['supplier_id' => $supplierid, 'lot' => $lot, 'quantity' => $quantity, 'price' => $price, 'totalprice' => $totalprice, 'created_at' => $date]);

        $olddue=DB::table('suppliers')->select('totaldue')->where('id', $supplierid)->value('totaldue');
        
        $newdue=$olddue+$totalprice;

        DB::table('suppliers')->where('id', $supplierid)->update(['totaldue' => $newdue]);

        return redirect('dailyreport');
    }

    public function supplierpay(Request $request, $supplier_id){
        date_default_timezone_set('Asia/Dhaka');
        $date=date('Y-m-d h:m:s');
        $amount = $request->input('amount');
        $oldpaid=DB::table('suppliers')->select('totalpaid')->where('id', $supplier_id)->value('totalpaid');
        DB::table('suppliers_payment')->insert(['supplier_id' => $supplier_id, 'amount' => $amount, 'created_at' => $date]);
        $totalpaid = $oldpaid+$amount;
        DB::table('suppliers')->where('id', $supplier_id)->update(['totalpaid' => $totalpaid]);
        return redirect('supplierinfo/'.$supplier_id);
    }

    public function worker(){
        $workers=DB::table('workers')->paginate(15);
        return view('backend.workers')->with('workers', $workers);
    }

    public function addworker(Request $request){
        $card = $request->input('card');
        $name = $request->input('name');
        $designation = $request->input('designation');
        $dateofbirth = $request->input('dateofbirth');
        $newdateofbirth=date("Y-m-d", strtotime($dateofbirth));
        $bloodgroup = $request->input('bloodgroup');
        $phone = $request->input('phone');
        $address = $request->input('address');

        DB::table('workers')->insert(['cardnumber' => $card, 'name' => $name,'designation' => $designation, 'dateofbirth' => $newdateofbirth, 'bloodgroup' => $bloodgroup, 'phone' => $phone, 'address' => $address]);
        return redirect('worker'); 
    }

    public function deleteworker($workerid){
    DB::table('workers')->where('id', '=', $workerid)->delete();
    return redirect('worker');
    }

    public function workerinfo($workerid){
        $workerinfo = DB::table('workers')->where('id', $workerid)->first();
        $workerwages=DB::table('worker_report')->where('worker_id', $workerid)->paginate(15);
        $payments = DB::table('workers_payment')->where('worker_id', $workerid)->paginate(15);
        return view('backend.workerinfo')->with('workerinfo', $workerinfo)->with('workerwages', $workerwages)->with('payments', $payments);
    }

    public function workersearch(Request $request){
        $cardnumber=$request->input('cardnumber');
        $workerinfo = DB::table('workers')->where('cardnumber', $cardnumber)->first();
        if(!empty($workerinfo)){
            return redirect('workerinfo/'.$workerinfo->id);
        }else{
            return redirect('worker');
        }
    }

    public function workerreport(Request $request){
        $fromdate = $request->input('fromdate');
        $todate = $request->input('todate');
        $newfromdate=date("Y-m-d", strtotime($fromdate));
        $newtodate=date("Y-m-d", strtotime($todate));
        date_default_timezone_set('Asia/Dhaka');
        $thismonth = date('Y-m');
        if(empty($fromdate)){
            $worker_reports = DB::table('worker_report')->whereBetween('worker_report.created_at', [$thismonth.'-01'.' 00:00:00', $thismonth.'-31'.' 23:59:59'])->join('workers', 'worker_id', '=', 'workers.id')->select('workers.cardnumber as cardnumber', 'workers.id as workerid', 'workers.name as name', 'workers.designation as designation', 'worker_report.shift as shift', 'worker_report.d1 as d1', 'worker_report.d2 as d2','worker_report.d3 as d3','worker_report.d4 as d4','worker_report.d5 as d5','worker_report.d6 as d6','worker_report.d7 as d7', 'worker_report.totalhour as totalhour', 'worker_report.wages as wages', 'worker_report.bonus as bonus', 'worker_report.night as night', 'worker_report.friday as friday', 'worker_report.totalwages as totalwages', 'worker_report.created_at as created_at')->orderBy('worker_report.id', 'desc')->paginate(15);
        }
        else{
            $worker_reports = DB::table('worker_report')->whereBetween('worker_report.created_at', [$newfromdate.' 00:00:00', $newtodate.' 23:59:59'])->join('workers', 'worker_id', '=', 'workers.id')->select('workers.cardnumber as cardnumber', 'workers.id as workerid', 'workers.name as name', 'workers.designation as designation', 'worker_report.shift as shift', 'worker_report.d1 as d1', 'worker_report.d2 as d2','worker_report.d3 as d3','worker_report.d4 as d4','worker_report.d5 as d5','worker_report.d6 as d6','worker_report.d7 as d7', 'worker_report.totalhour as totalhour', 'worker_report.wages as wages', 'worker_report.bonus as bonus', 'worker_report.night as night', 'worker_report.friday as friday', 'worker_report.totalwages as totalwages', 'worker_report.created_at as created_at')->orderBy('worker_report.id', 'desc')->paginate(1000);
        }
        $workers=DB::table('workers')->orderBy('workers.cardnumber', 'asc')->get();
        return view('backend.workerreport')->with('worker_reports', $worker_reports)->with('workers', $workers);
    }

    public function addwages(Request $request){
        $worker_id = $request->input('workerid');
        $shift = $request->input('shift');
        $d1 = $request->input('d1');
        $d2 = $request->input('d2');
        $d3 = $request->input('d3');
        $d4 = $request->input('d4');
        $d5 = $request->input('d5');
        $d6 = $request->input('d6');
        $d7 = $request->input('d7');
        $totalhour =$request->input('totalhour');
        $wages =$request->input('wages');
        $bonus =$request->input('bonus');
        $night =$request->input('night');
        $friday =$request->input('friday');
        $totalwages =$request->input('totalwages');
        date_default_timezone_set('Asia/Dhaka');
        $date=date('Y-m-d h:m:s');

        $save=DB::table('worker_report')->insert(['worker_id' => $worker_id, 'shift' => $shift, 'd1' => $d1, 'd2' => $d2, 'd3' => $d3, 'd4' => $d4, 'd5' => $d5, 'd6' => $d6, 'd7' => $d7, 'totalhour' => $totalhour, 'wages' => $wages, 'bonus' => $bonus, 'night'=>$bonus, 'friday'=>$friday, 'totalwages'=>$totalwages, 'created_at' => $date]);

        if($save){

        $olddue=DB::table('workers')->select('totaldue')->where('id', $worker_id)->value('totaldue');
        
        $newdue=$olddue+$totalwages;

        DB::table('workers')->where('id', $worker_id)->update(['totaldue' => $newdue]); 
        }

        return redirect('workerreport');
    }

    public function workerpay(Request $request, $worker_id){
        date_default_timezone_set('Asia/Dhaka');
        $date=date('Y-m-d h:m:s');
        $amount = $request->input('amount');
        $olddue=DB::table('workers')->select('totaldue')->where('id', $worker_id)->value('totaldue');
        $oldpaid=DB::table('workers')->select('totalpaid')->where('id', $worker_id)->value('totalpaid');
        $due = $olddue-($oldpaid+$amount); 
        DB::table('workers_payment')->insert(['worker_id' => $worker_id, 'amount' => $amount, 'due' => $due, 'created_at' => $date]);
        $totalpaid = $oldpaid+$amount;
        DB::table('workers')->where('id', $worker_id)->update(['totalpaid' => $totalpaid]);
        return redirect('workerinfo/'.$worker_id);
    }

    public function staff(){
        $staffs=DB::table('staffs')->paginate(15);
        return view('backend.staff')->with('staffs', $staffs);
    }

    public function addStaff(Request $request){
        $name=$request->input('name');
        $designation=$request->input('designation');
        $dateofbirth = $request->input('dateofbirth');
        $newdateofbirth=date("Y-m-d", strtotime($dateofbirth));
        $bloodgroup = $request->input('bloodgroup');
        $phone=$request->input('phone');
        $address=$request->input('address');

        DB::table('staffs')->insert(['name' => $name, 'designation' => $designation, 'dateofbirth' => $newdateofbirth, 'bloodgroup' => $bloodgroup, 'phone' => $phone, 'address' => $address]);
        return redirect('staff');


    }

    public function staffreport(Request $request){
        $fromdate = $request->input('fromdate');
        $todate = $request->input('todate');
        $newfromdate=date("Y-m-d", strtotime($fromdate));
        $newtodate=date("Y-m-d", strtotime($todate));
        date_default_timezone_set('Asia/Dhaka');
        $thismonth = date('Y-m');
        if(empty($fromdate)){
            $staff_reports=DB::table('staff_reports')->whereBetween('staff_reports.created_at', [$thismonth.'-01'.' 00:00:00', $thismonth.'-31'.' 23:59:59'])->join('staffs', 'staff_id', '=', 'staffs.id')->select('staff_reports.created_at as date', 'staffs.name', 'staffs.designation', 'staff_reports.salary', 'staff_reports.minus', 'staff_reports.totalsalary', 'staff_reports.description', 'staffs.id')->orderBy('staff_reports.id', 'desc')->paginate(15);
        }
        else{
            $staff_reports=DB::table('staff_reports')->whereBetween('staff_reports.created_at', [$newfromdate.' 00:00:00', $newtodate.' 23:59:59'])->join('staffs', 'staff_id', '=', 'staffs.id')->select('staff_reports.created_at as date', 'staffs.name', 'staffs.designation', 'staff_reports.salary', 'staff_reports.minus', 'staff_reports.totalsalary', 'staff_reports.description', 'staffs.id')->orderBy('staff_reports.id', 'desc')->paginate(1000);
        }
        $staffs=DB::table('staffs')->get();
        return view('backend.staffreport')->with('staff_reports', $staff_reports)->with('staffs', $staffs);  
    }

    public function addstaffreport(Request $request){
        date_default_timezone_set('Asia/Dhaka');
        $date=date('Y-m-d h:m:s');        $staffid = $request->input('staff_id');
        $salary = $request->input('salary');
        $minus = $request->input('minus');
        $totalsalary = $request->input('totalsalary');
        $description = $request->input('description');
        
        DB::table('staff_reports')
        ->insert([
            'staff_id' => $staffid, 
            'salary' => $salary, 
            'minus' => $minus, 
            'totalsalary' => $totalsalary, 
            'description' => $description, 
            'created_at' => $date
            ]);

        $olddue=DB::table('staffs')->select('totaldue')
        ->where('id', $staffid)->value('totaldue');
        
        $newdue=$totalsalary+$olddue;

        DB::table('staffs')
        ->where('id', $staffid)
        ->update(['totaldue' => $newdue]);

        return redirect('staffreport');

    }
    public function deletestaff($staffid){
        DB::table('staffs')->where('id', '=', $staffid)->delete();
        return redirect('staff');
    }

    public function staffinfo($staffid){
        $staffinfo = DB::table('staffs')->where('id', $staffid)->first();
        $staff_reports=DB::table('staff_reports')->where('staff_id', $staffid)->paginate(15);
        $payments = DB::table('staffs_payment')->where('staff_id', $staffid)->paginate(15);
        return view('backend.staffinfo')->with('staffinfo', $staffinfo)->with('staff_reports', $staff_reports)->with('payments', $payments);
    }

    public function staffpay(Request $request, $staffid){
        date_default_timezone_set('Asia/Dhaka');
        $date=date('Y-m-d h:m:s');
        $amount = $request->input('amount');
        $olddue=DB::table('staffs')->select('totaldue')->where('id', $staffid)->value('totaldue');
        $oldpaid=DB::table('staffs')->select('totalpaid')->where('id', $staffid)->value('totalpaid');
        $due = $olddue-($oldpaid+$amount); 

            DB::table('staffs_payment')->insert(['staff_id' => $staffid, 'amount' => $amount, 'due' => $due, 'created_at' => $date]);
            $totalpaid = $oldpaid+$amount;
            DB::table('staffs')->where('id', $staffid)->update(['totalpaid' => $totalpaid]);
            
        return redirect('staffinfo/'.$staffid);
    }

    public function gaurds(){
        $gaurds=DB::table('gaurds')->paginate(15);
        return view('backend.gaurds')->with('gaurds', $gaurds);
    }

    public function addgaurd(Request $request){
        $name=$request->input('name');
        $designation=$request->input('designation');
        $dateofbirth = $request->input('dateofbirth');
        $newdateofbirth=date("Y-m-d", strtotime($dateofbirth));
        $bloodgroup = $request->input('bloodgroup');
        $phone=$request->input('phone');
        $address=$request->input('address');

        DB::table('gaurds')->insert(['name' => $name, 'designation' => $designation, 'dateofbirth' => $newdateofbirth, 'bloodgroup' => $bloodgroup,'phone' => $phone, 'address' => $address]);
        return redirect('gaurds');

    }
    public function deletegaurd($gaurdid){
        DB::table('gaurds')->where('id', '=', $gaurdid)->delete();
        return redirect('gaurds');
    }
    public function gaurdsreport(Request $request){
        $fromdate = $request->input('fromdate');
        $todate = $request->input('todate');
        $newfromdate=date("Y-m-d", strtotime($fromdate));
        $newtodate=date("Y-m-d", strtotime($todate));
        date_default_timezone_set('Asia/Dhaka');
        $thismonth = date('Y-m');
        if(empty($fromdate)){
            $gaurd_reports=DB::table('gaurd_reports')->whereBetween('gaurd_reports.created_at', [$thismonth.'-01'.' 00:00:00', $thismonth.'-31'.' 23:59:59'])->join('gaurds', 'gaurd_id', '=', 'gaurds.id')->select('gaurd_reports.created_at as date', 'gaurds.name', 'gaurds.designation', 'gaurd_reports.salary', 'gaurd_reports.minus', 'gaurd_reports.totalsalary', 'gaurd_reports.description', 'gaurds.id')->orderBy('gaurd_reports.id', 'desc')->paginate(15);
        }
        else{
            $gaurd_reports=DB::table('gaurd_reports')->whereBetween('gaurd_reports.created_at', [$newfromdate.' 00:00:00', $newtodate.' 23:59:59'])->join('gaurds', 'gaurd_id', '=', 'gaurds.id')->select('gaurd_reports.created_at as date', 'gaurds.name', 'gaurds.designation', 'gaurd_reports.salary', 'gaurd_reports.minus', 'gaurd_reports.totalsalary', 'gaurd_reports.description', 'gaurds.id')->orderBy('gaurd_reports.id', 'desc')->paginate(1000);
        }
        $gaurds=DB::table('gaurds')->get();
        return view('backend.gaurdsreport')->with('gaurd_reports', $gaurd_reports)->with('gaurds', $gaurds);  
    }
    public function addgaurdreport(Request $request){
        date_default_timezone_set('Asia/Dhaka');
        $date=date('Y-m-d h:m:s');        $gaurdid = $request->input('gaurd_id');
        $salary = $request->input('salary');
        $minus = $request->input('minus');
        $totalsalary = $request->input('totalsalary');
        $description = $request->input('description');
        
        DB::table('gaurd_reports')
        ->insert([
            'gaurd_id' => $gaurdid, 
            'salary' => $salary, 
            'minus' => $minus, 
            'totalsalary' => $totalsalary, 
            'description' => $description, 
            'created_at' => $date
            ]);

        $olddue=DB::table('gaurds')->select('totaldue')
        ->where('id', $gaurdid)->value('totaldue');
        
        $newdue=$totalsalary+$olddue;

        DB::table('gaurds')
        ->where('id', $gaurdid)
        ->update(['totaldue' => $newdue]);

        return redirect('gaurdsreport');

    }
    public function gaurdinfo($gaurdid){
        $gaurdinfo = DB::table('gaurds')->where('id', $gaurdid)->first();
        $gaurd_reports=DB::table('gaurd_reports')->where('gaurd_id', $gaurdid)->paginate(15);
        $payments = DB::table('gaurds_payment')->where('gaurd_id', $gaurdid)->paginate(15);
        return view('backend.gaurdinfo')->with('gaurdinfo', $gaurdinfo)->with('gaurd_reports', $gaurd_reports)->with('payments', $payments);
    }
    public function gaurdpay(Request $request, $gaurdid){
        date_default_timezone_set('Asia/Dhaka');
        $date=date('Y-m-d h:m:s');
        $amount = $request->input('amount');
        $olddue=DB::table('gaurds')->select('totaldue')->where('id', $gaurdid)->value('totaldue');
        $oldpaid=DB::table('gaurds')->select('totalpaid')->where('id', $gaurdid)->value('totalpaid');
        $due = $olddue-($oldpaid+$amount); 

            DB::table('gaurds_payment')->insert(['gaurd_id' => $gaurdid, 'amount' => $amount, 'due' => $due, 'created_at' => $date]);
            $totalpaid = $oldpaid+$amount;
            DB::table('gaurds')->where('id', $gaurdid)->update(['totalpaid' => $totalpaid]);
            
        return redirect('gaurdinfo/'.$gaurdid);
    }
}
