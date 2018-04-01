<?php

function content(){
	$html = '	
	<div id="maincontent">
		<div class="container">	
		<link href="css/ihover.css" rel="stylesheet">

		<div id="teamcontent">
			<div class="container">	
				<div class="row">
					<div class="col-md-12">
					<h1 class="text-center">THE TEAM</h1>
					<hr>
					</div>
				</div>
';

		if(($file = fopen("data/team/members.csv","r")) !== FALSE){
			if(($keys = fgetcsv($file)) !== FALSE){
				$member_data 	 = array();
				$tmp_member_data = array();
				while(($entry = fgetcsv($file)) !== FALSE){
					for($i = 0; $i < count($keys); $i++){
						$tmp_member_data = array_merge($tmp_member_data,array($keys[$i]=>$entry[$i]));
					}
					array_push($member_data,$tmp_member_data);
				}
 			}
			
			$rows = array();

			foreach($member_data as $entry){
				if(in_array($entry['position'], array_keys($rows))){
					if(is_array($rows[$entry['position']])){
						array_push($rows[$entry['position']],$entry);
					}
				}else{
					$rows = array_merge($rows,array($entry['position']=>array($entry)));
				}
			}

			$image_file_path='data/team/member_data/images/people';
			$content_file_path='data/team/member_data/content';
			$images 	= scandir($image_file_path);
			$contents 	= scandir($content_file_path);

			foreach($rows as $key=>$row){
				if($key==NULL||$key=="") continue;
				$multi = (count($row)>1)?'s':'';
				$html .= '<h2 style="padding-bottom:18px;">'.ucwords($key).$multi.'</h2>';
				$html .= '<div class="row">';
				foreach($row as $person){
					$fullname = strtolower($person['fname']).'<br>'.strtolower($person['lname']);
					$name_id  = str_replace(" ","",strtolower($person['fname']).'_'.strtolower($person['lname']));
					$picture  = $image_file_path.'/';
					foreach($images as $image){
						if(explode('.',$image)[0]==$name_id){
							$picture.=$image;
							break;
						}
					}
					$html .= '<div class="col-xs-4 col-md-3">';
					$html .= '<div class="ih-item square colored  ">

						<figure class="snip1584 ">
						 	    <img src="'.$picture.'" alt="'.ucwords($fullname).'">
                                <figcaption class="info">
                                    <h3>'.ucwords($fullname).'</h3>
                                    <h5>'.ucwords($person['subtitle']).'</h5>
                                </figcaption>
			
					    <a href="http://risk.ou.edu/team.html#" id="'.$name_id.'" data-toggle="modal" data-target="#modal_'.$name_id.'"></a>
					 	
					 	</figure>	
					 	</div>
					 	<p class="contactlink">
					 		<a href="mailto:'.$person['email'].'"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> EMAIL</a>
					 	</p>	
					';
					$html .= '</div>';
				}

				$html .='</div><!-- end row -->';
			}

			foreach($rows as $key=>$row){
				foreach($row as $person){
					$fullname = strtolower($person['fname']).' '.strtolower($person['lname']);
					$name_id  = str_replace(" ","",strtolower($person['fname']).'_'.strtolower($person['lname']));					
					$picture  = $image_file_path.'/';
					$person_content_file = null;
					foreach($images as $image){
						if(explode('.',$image)[0]==$name_id){
							$picture.=$image;
							break;
						}
					}

					foreach($contents as $content){
						if(explode('.',$content)[0]==$name_id){
							$person_content_file = fopen($content_file_path."/".$content,"r");
							break;
						}
					}

					$html .= '<div class="modal fade" id="modal_'.$name_id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
					$html .= '
						<div class="modal-dialog" role="document">
					   		<div class="modal-content">
					   			<div class="modal-body">
					';

					$html .= '<br>
								<div class="modal-header>" style="height:25%">
									<table width=100%>
										<tr>
											<td><h3 class="modal-title">'.ucwords($fullname).'</h3></td>
											<td><img src="'.$picture.'" alt="'.ucwords($fullname).'" class="" style="max-height:125px; float:right; margin-right: 30px;"></td>
										</tr>
									</table>
									
					    			
								</div>
								<br>

								<div class="">';

						// $html .= "<hr>";

						while($person_content_file!=null && !feof($person_content_file)){
							$line = fgets($person_content_file);
							$html .= "<p>".$line."</p>";
						}

					$html .= '	</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						      			</div>
						    		</div>
						  		</div>
							</div>
						</div>
						';
					}

				}
			}
						
	$html .= '

		</div>
		</div>
		</div>
		</div>
		<br><br>';

	return $html;
}
?>