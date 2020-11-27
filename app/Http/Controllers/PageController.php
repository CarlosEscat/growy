<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Helpers;
use App\Page; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($title,$id)
    {
		$page = Page::find($id);
		$meta_title = $page->title;	
		return view('page',[
			'meta_title' => $meta_title,
			'page' => $page,
			'content_page_id' => $id
		]);
	}
	
	public function contact_us_post(Request $request) {
		
		$v = Validator::make($request->all(), [
			'email_address' => 'required|email',
			'subject' => 'required|string',
			'text_message' => 'required|string',
			//'contact_agreement' => 'required|numeric'
		]);
		
		if ($v->fails())
		{
			return redirect()->back()->withInput()->withErrors($v->errors());
		}
		
		$email = $request->email_address;
		$subject = $request->subject;
		$text_message = $request->text_message;
				
		$logo_url = URL::to('/').'/assets/images/email_logo.jpg';
			
		$email_html = '<div style="padding:20px;border:3px solid #118ED3;width:600px;min-height:600px;">';
			$email_html .= '<div style="margin-top:20px;"></div>';
			$email_html .= '<div><img src="'.$logo_url.'" /></div>';
			$email_html .= '<div>';
				$email_html .= '<p>Email: '.$email.'</p><br/>';
				$email_html .= '<p>'.nl2br ($text_message).'</p>';
			$email_html .= '</div>';
			
		$email_html .= '</div>';
		
		$data = [
			'to' => 'maguga91@gmail.com',
			'subject' => $subject,
			'body' => $email_html
		];
		
		//$is_sent = Helpers::send_ses_email($data);
		Helpers::send_mail_html('manuel.maguga@growyspace.com', $subject, $email_html, $email);
			
		
		$message = 'Email Sent Successfully';
        return redirect()->back()->with('message',  $message);
		
	}
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
    */
}