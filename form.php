<?php

$con = mysql_connect('localhost','dbsadhu','Shravak@sadhu123') or mysql_query('Database connection error!');
						
	mysql_select_db('dbsadhu',$con) or mysql_query('Database select error!');
	if(!empty($_GET['id'])){
		$sql = "SELECT mobile_number,email_address FROM app_users WHERE   user_id  = '".$_GET['id']."'";
		$sql_result = mysql_query($sql) OR DIE("errrr".mysql_error());
		$result =  mysql_num_rows($sql_result) ;
		$query_array = mysql_fetch_object($sql_result);
		
		
		
		$sql_dikhsha = "SELECT sadhu_name_hindi,
		diksha_parada_hindi,
		guru_hindi,
		sadhu_mandal_hindi,
		dikhsa_place_hindi,
		badi_diksha_pradata_hindi,
		dikhha_date,
		badi_dikhsa_date,
		badi_diksha_place_hindi FROM diksha_vivran WHERE user_id = '".$_GET['id']."' ";
		
		$sql_result_two = mysql_query($sql_dikhsha) OR DIE("errrr".mysql_error());
		$result_two =  mysql_num_rows($sql_result_two) ;
		$sql_array = mysql_fetch_object($sql_result_two);
		
		$sql_in = "SELECT sadhu_person_first_hindi,
		relation_first_hindi,
		sadhu_person_secondt_hindi,
		relation_second_hindi,
		sadhu_person_third_hind,
		relation_third_hindi,
		sadhu_person_fourth_hindi,
		relation_fourth_hindi,
		sadhu_person_fifth_hindi,relation_fifth_hindi FROM dikshit_sankarik_pariwar  WHERE user_id = '".$_GET['id']."' ";
		$sql_result_three = mysql_query($sql_in) OR DIE("errrr".mysql_error());
		$result =  mysql_num_rows($sql_result_three) ;
		$sql_in_array = mysql_fetch_object($sql_result_three);
		
  
		$sql_query = "SELECT user_name_hindi,
		dob,
		birth_place_hindi,
		father_name_hindi,
		gotra_hindi,
		mother_name_hindi
		 FROM sansari_jivan    WHERE user_id = '".$_GET['id']."'"  ;
		 
		 $sql_result_four = mysql_query($sql_query) OR DIE("errrr".mysql_error());
		$result =  mysql_num_rows($sql_result_four) ;
		$sql_query_array = mysql_fetch_object($sql_result_four);
		 
		
  
   $sql_arr = "SELECT degree_hindi,
		sadhana_place_hindi,
		vihar_place_hindi,
		chaturmars_vivran_hindi,
		aagam_gyan_hindi,
		tatv_gyan_hindi,
		tap_vivran_hindi,
		language_gyan_hindi,
		pratistha_vivran_hindi,diksha_sadhu_hindi FROM sadhana_achivement   WHERE user_id = '".$_GET['id']."' ";
		 
		 
		 
		 
		  $sql_result_four = mysql_query($sql_arr) OR DIE("errrr".mysql_error());
		$result =  mysql_num_rows($sql_result_four) ;
		$sql_arr_array = mysql_fetch_object($sql_result_four);
		// print_r($row5 );die;
  
 // print_r($row);die;
	}
	
$var=	'<head><meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<table width="100%" style = "border-collapse:collapse ;">
<tbody>
<tr>
<td colspan="6" width="598">
<p><strong>दीक्षा विवरण</strong></p>
</td>
</tr>
<tr>
<td width="179">
<p>साधु / साध्वी नाम:</p>
</td>
<td colspan="5" width="419">
<p>'.$sql_array->sadhu_name_hindi.'</p>
</td>
</tr>
<tr>
<td width="179">
<p>दीक्षा प्रदाता:</p>
</td>
<td colspan="5" width="419">
<p>'.$sql_array->diksha_parada_hindi.'</p>
</td>
</tr>
<tr>
<td width="179">
<p>गुरु:</p>
</td>
<td colspan="5" width="419">
<p>'.$sql_array->guru_hindi.'</p>
</td>
</tr>
<tr>
<td width="179">
<p>साधु / साध्वी मंडल:</p>
</td>
<td colspan="5" width="419">
<p>'.$sql_array->sadhu_mandal_hindi.'</p>
</td>
</tr>
<tr>
<td width="179">
<p>दीक्षा तिथि:</p>
</td>
<td colspan="2" width="134">
<p>'.$sql_array->dikhha_date.'</p>
</td>
<td colspan="2" width="146">
<p>दीक्षा स्थल:</p>
</td>
<td width="139">
<p>'.$sql_array->dikhsa_place_hindi.'</p>
</td>
</tr>
<tr>
<td width="179">
<p>बड़ी दीक्षा प्रदाता:</p>
</td>
<td colspan="5" width="419">
<p>'.$sql_array->badi_diksha_pradata_hindi.'</p>
</td>
</tr>
<tr>
<td width="179">
<p>बड़ी दीक्षा तिथि:</p>
</td>
<td colspan="2" width="134">
<p>'.$sql_array->badi_dikhsa_date.'</p>
</td>
<td colspan="2" width="146">
<p>बड़ी दीक्षा स्थल:</p>
</td>
<td width="139">
<p>'.$sql_array->badi_diksha_place_hindi.'</p>
</td>
</tr>

<tr>
<td colspan="6" width="598">
<p><strong>साधनाव उपलब्धि</strong></p>
</td>
</tr>
<tr>
<td colspan="2" width="246">
<p>विशिष्ट डिग्री (Ph.D, MA,…)</p>
</td>
<td width="68">
<p>'.$sql_arr_array->degree_hindi.'</p>
</td>
<td width="140">
<p>साधना का केन्द्र:</p>
</td>
<td colspan="2" width="145">
<p>'.$sql_arr_array->sadhana_place_hindi.'</p>
</td>
</tr>
<tr>
<td colspan="2" width="246">
<p>विहार क्षेत्र:</p>
</td>
<td colspan="4" width="353">
<p>'.$sql_arr_array->vihar_place_hindi.'</p>
</td>
</tr>
<tr>
<td colspan="2" width="246">
<p>चातुर्मास विवरण:</p>
</td>
<td colspan="4" width="353">
<p>'.$sql_arr_array->chaturmars_vivran_hindi.'</p>
</td>
</tr>
<tr>
<td colspan="2" width="246">
<p>आगम ज्ञान:</p>
</td>
<td colspan="4" width="353">
<p>'.$sql_arr_array->aagam_gyan_hindi.'</p>
</td>
</tr>
<tr>
<td colspan="2" width="246">
<p>तत्त्व ज्ञान:</p>
</td>
<td colspan="4" width="353">
<p>'.$sql_arr_array->tatv_gyan_hindi.'</p>
</td>
</tr>
<tr>
<td colspan="2" width="246">
<p>तप विवरण:</p>
</td>
<td colspan="4" width="353">
<p>'.$sql_arr_array->tap_vivran_hindi.'</p>
</td>
</tr>
<tr>
<td colspan="2" width="246">
<p>भाषा ज्ञान:</p>
</td>
<td colspan="4" width="353">
<p>'.$sql_arr_array->language_gyan_hindi.'</p>
</td>
</tr>
<tr>
<td colspan="2" width="246">
<p>आपके द्वारा की गई प्रतिष्ठा का विवरण:</p>
</td>
<td colspan="4" width="353">
<p>'.$sql_arr_array->pratistha_vivran_hindi.'</p>
</td>
</tr>
<tr>
<td colspan="2" width="246">
<p>आपके द्वारा दीक्षित साधु साध्वी:</p>
</td>
<td colspan="4" width="353">
<p>'.$sql_arr_array->diksha_sadhu_hindi.'</p>
</td>
</tr>

</tbody>
</table>

<table width="100%"style = "border-collapse:collapse ;">
<tbody>
<tr>
<td colspan="8" width="601">
<p><strong>सांसारिक विवरण</strong></p>
</td>
</tr>
<tr>
<td colspan="3" width="177">
<p>सांसारिक नाम:</p>
</td>
<td colspan="5" width="424">
<p>'.$sql_query_array->user_name_hindi.'</p>
</td>
</tr>
<tr>
<td colspan="3" width="177">
<p>जन्म तिथि:</p>
</td>
<td colspan="2" width="138">
<p>'.$sql_query_array->dob.'</p>
</td>
<td colspan="2" width="143">
<p>जन्म तारीख:</p>
</td>
<td width="143">
<p>'.$sql_query_array->dob.'</p>
</td>
</tr>
<tr>
<td colspan="3" width="177">
<p>जन्म स्थल:</p>
</td>
<td colspan="5" width="424">
<p>'.$sql_query_array->birth_place_hindi.'</p>
</td>
</tr>
<tr>
<td colspan="3" width="177">
<p>पिता:</p>
</td>
<td colspan="2" width="138">
<p>'.$sql_query_array->father_name_hindi.'</p>
</td>
<td colspan="2" width="143">
<p>गोत्र:</p>
</td>
<td width="143">
<p>'.$sql_query_array->gotra_hindi.'</p>
</td>
</tr>
<tr>
<td colspan="3" width="177">
<p>माता:</p>
</td>
<td colspan="5" width="424">
<p>'.$sql_query_array->mother_name_hindi.'</p>
</td>
</tr>
<tr>
<td colspan="8" width="601">
<p>दीक्षित सांसारिक परिवार:</p>
</td>
</tr>
<tr>
<td width="36">
<p>सं</p>
</td>
<td colspan="6" width="422">
<p>साधु / साध्वी नाम</p>
</td>
<td width="143">
<p>सांसारिक रिश्ता</p>
</td>
</tr>
<tr>
<td width="36">
<p>1.</p>
</td>
<td colspan="6" width="422">
<p>'.$sql_in_array->sadhu_person_first_hindi.'</p>
</td>
<td width="143">
<p>'.$sql_in_array->relation_first_hindi.'</p>
</td>
</tr>
<tr>
<td width="36">
<p>2.</p>
</td>

<td colspan="6" width="422">
<p>'.$sql_in_array->sadhu_person_secondt_hindi.'</p>
</td>
<td width="143">
<p>'.$sql_in_array->relation_second_hindi.'</p>
</td>
</tr>
<tr>
<td width="36">
<p>3.</p>
</td>
<td colspan="6" width="100%"style = "border-collapse:collapse ;">
<p>'.$sql_in_array->sadhu_person_third_hind.'</p>
</td>
<td width="143">
<p>'.$sql_in_array->relation_third_hindi.'</p>
</td>
</tr>
<tr>
<td width="36">
<p>4.</p>
</td>
<td colspan="6" width="422">
<p>'.$sql_in_array->sadhu_person_fourth_hindi.'</p>
</td>
<td width="143">
<p>'.$sql_in_array->relation_fourth_hindi.'</p>
</td>
</tr>
<tr>
<td width="36">
<p>5.</p>
</td>
<td colspan="6" width="422">
<p>'.$sql_in_array->sadhu_person_fifth_hindi.'</p>
</td>
<td width="143">
<p>'.$sql_in_array->relation_fifth_hindi.'</p>
</td>
</tr>

<tr>
<td colspan="8" width="601">
<p><strong>संपर्क सूत्र</strong></p>
</td>
</tr>
<tr>
<td colspan="2" width="150">
<p>फ़ोन:</p>
</td>
<td colspan="2" width="150">
<p>'.$query_array->mobile_number.'</p>
</td>
<td colspan="2" width="150">
<p>ई-मेल:</p>
</td>
<td colspan="2" width="151">
<p>'.$query_array->email_address.'</p>
</td>
</tr>

</tbody>
</table>

<style>
table {
    border: 1px solid #ccc;
	font-family:Verdana, Geneva, sans-serif;
	font-size:14px;
}

tr td{
	 border: 1px solid #ccc;
	 padding:10px;
	}

</style>';

echo $var ;
?>
