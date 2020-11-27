<?php
 
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Config;

class User_message extends Model
{
    protected $table = 'user_messages';
	
	public function from_user_profile_image() {
		return User::find($this->from_id)->profile_image();
	}
	
	public function to_user_profile_image() {
		return User::find($this->to_id)->profile_image();
	}
	
	public function get_messages_html($messages,$user_id) {
		$countries = Config::get('countries');
		$messages_html = '';
		foreach($messages as $message) {
			$msg = $message->message;
			preg_match('/{CARD\s*(\d+)/', $msg, $matches);
			$card_html = false;
			
			if(isset($matches[1])) {
				$card_id = $matches[1];
				$opc = Opportunity_card::find($card_id);
				
				if($opc !== null) {
					
					$card_html = (String) view('opp_card_item',[
						'opc' => $opc,
						'user_id' => $user_id,
						'countries' => $countries
					]);
					
					$msg = str_replace("{CARD".$card_id."}","",$msg);
				}
			}
			
			$am_pm_time = date('h:i A  |  F d', strtotime($message->created_at));
			if($message->to_id == $user_id) {
				
				if($card_html !== false) {
					$messages_html .= '<div class="incoming_opp_card">'.$card_html.'</div>';
				}
				
				$messages_html .= '<div data-msg-id="'.$message->id.'" class="message_item_row incoming_msg">';
					$messages_html .= '<div class="incoming_msg_img"> <img src="'.$message->from_user_profile_image().'" alt="sunil"> </div>';
					$messages_html .= '<div class="received_msg">';
						$messages_html .= '<div class="received_withd_msg">';
						   $messages_html .= '<p>'.$msg.'</p>';
						$messages_html .= '<span class="time_date"> '.$am_pm_time.'</span></div>';
					$messages_html .= '</div>';
				$messages_html .= '</div>';
			} else {
				if($card_html !== false) {
					$messages_html .= '<div class="outgoing_opp_card">'.$card_html.'</div>';
				}
				
				$messages_html .= '<div data-msg-id="'.$message->id.'" class="message_item_row outgoing_msg">';
					$messages_html .= '<div class="sent_msg">';
						$messages_html .= '<p class="sent_msg_text">'.$msg.'</p>';
						$messages_html .= '<span class="time_date"> '.$am_pm_time.'</span>'; 
					$messages_html .= '</div>';
				$messages_html .= '</div>';
			}
		}
		
		return $messages_html;
	}
	
	public function get_conversations_html($user_id,$messages = NULL,$to_user = NULL,$conversation_messages_count=0) {
		$conversations = DB::table('user_message_conversations')
			->leftJoin('user_messages', 'user_messages.conversation_id', '=', 'user_message_conversations.id')
			->leftJoin('users AS from_user', 'user_messages.from_id', '=', 'from_user.id')
			->leftJoin('users AS to_user', 'user_messages.to_id', '=', 'to_user.id')
			->select(
				'user_message_conversations.*',
				'user_messages.from_id',
				'user_messages.to_id',
				'from_user.full_name AS from_user_name',
				'to_user.full_name AS to_user_name',
				'from_user.profile_image_cropped AS from_user_profile_image_cropped',
				'to_user.profile_image_cropped AS to_user_profile_image_cropped'
			)
			->whereRaw ("(user_messages.from_id ='$user_id' OR user_messages.to_id ='$user_id')")
			->groupBy('user_message_conversations.id')
			->orderBy('user_message_conversations.updated_at','desc')
			->get();
			
		$con_html = '';
		
		if($to_user !== NULL && $messages !== NULL && $conversation_messages_count == 0 ) {
			$con_html .= '<div data-user-id = "0" class="messages_conversation_item_block">';
				$con_html .= '<img src="'.$to_user->profile_image().'" />';
				$con_html .= '<div class="messages_conversation_item_info_block">';
					$con_html .= '<h4>'.$to_user->full_name.'</h4>';
					$con_html .= '<p>...</p>';
				$con_html .= '</div>';
			$con_html .= '</div>';
		}
		
		foreach($conversations as $con) {
			if($con->from_id == $user_id) {
				$name = $con->to_user_name;
				$id = $con->to_id;
			} else {
				$name = $con->from_user_name;
				$id = $con->from_id;
			}
			$u = User::find($id);
			
			$active_conversation = false;
			$active_conversation_class = '';
			
			if($to_user !== NULL) {
				$to_user_id  = $to_user->id;
				
				if($to_user_id == $id) {
					$active_conversation = true;
					$active_conversation_class = ' active_conversation ';
				}
			}
			
			$not_read_class = '';
			
			if($con->is_read == 0 && $con->last_to_id == $user_id) {
				$not_read_class = ' not_read_conversation ';
			}
			
			$con_html .= '<div data-user-id = "'.$id.'" class="' . $not_read_class . $active_conversation_class .' messages_conversation_item_block">';
				
				$con_html .= '<img src="'.$u->profile_image().'" />';
				$con_html .= '<div class="messages_conversation_item_info_block">';
					$con_html .= '<div class="msg_conversation_middle_block">';
						$con_html .= '<h4>'.$name.'</h4>';
						$con_html .= '<p>'.(strlen($con->last_message) > 30 ? substr($con->last_message,0,30).'...' : $con->last_message  ).'</p>';
					$con_html .= '</div>';
					$con_html .= '<div class="msg_conversation_right_block"><p>'.(date('M d', strtotime($con->updated_at))).'</p></div>';
				$con_html .= '</div>';
			$con_html .= '</div>';
		}
		
		return $con_html;
	}
}
