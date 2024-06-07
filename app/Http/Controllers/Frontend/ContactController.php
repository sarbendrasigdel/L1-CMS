<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactRequest;
use Illuminate\Http\Request;
// use Mail;
use App\Mail\ContactMail;
use GrahamCampbell\ResultType\Success;
use App\Models\Admins\Pagesettings\Mail;
use Illuminate\Support\Facades\DB;
use App\Library\BreadCrumbs;
use App\Library\AuthUser;

class ContactController extends Controller
{
    use AuthUser,BreadCrumbs;   

    public function index()
    {

        $data['title'] = 'Mail';
        $data['menu'] = 'Mails';
        $data['subMenu'] = 'inbox';
        $data['breadCrumbs'] = $this->getBreadCrumbDetails($data);
        $data['mail']= Mail::get();
        return view('admin.pagesettings.mail.index',$data);
    }


    public function store(ContactRequest $request)
    {
        try{
        DB::beginTransaction();
        $mail = new Mail();
        $mail->name = $request->name;
        $mail->email = $request->email;
        $mail->description = $request->description;
        $mail->save();
        DB::commit();
                $data['status'] = true;
                $data['title'] = 'Contact';
                $data['message'] = 'Thankyou for your query';
        }
        catch (\Exception $e) {
            DB::rollback();
            $data['status'] = false;
            $data['title'] = 'Contact';
            $data['message'] = 'Something went wrong. please try again';
            $data['error'] = $e->getMessage();
        }

        return $data;

    }

    public function fetchMailList(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'created_at',
            
        );
        $data['team'] = array();
        $totalData = Mail::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $dat = array();
        $datas = array();

        $searchKey = $request->input('search.value');
            $MailLists =  Mail::FilterByGlobalSearch($searchKey);
            $totalData = $MailLists->count();
            $Mails = $MailLists->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
            $totalFiltered = $totalData;
    
    if(!empty($Mails)){
        $MailData = array();
        foreach($Mails as $index => $Mail){
            $nestedData = array();
            $nestedData['id'] = $index + 1;
            $nestedData['MailId'] = encrypt($Mail->id);
            $nestedData['name'] = $Mail->name;
            $nestedData['email'] = $Mail->email;
            $nestedData['description'] = $Mail->description;
            $nestedData['created_at'] = $Mail->created_at->toDateTimeString();
            $nestedData['edit_permission'] = true;
            $nestedData['delete_permission'] = true;
            $nestedData['is_editable'] = true;
            $MailData[] = $nestedData;
        }

        $tableContent = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $MailData,
        );

        return $tableContent;
    }
    

    }

}
