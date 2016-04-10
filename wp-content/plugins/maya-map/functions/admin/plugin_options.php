<?php
function maya_map_plugin_pages() {  

 

    

    add_submenu_page(

                     'options-general.php',

                     'Maya- Map Settings',

                     'Map- Settings',

                     'administrator',

                     'maya_map_admin_settings',

                     'maya_map_admin_settings_callback'

    );

   

} 

add_action('admin_menu', 'maya_map_plugin_pages');



function maya_map_admin_settings_callback(){



    

    if($_POST['maya_map_option_submit']){

        

         $maya_map_options_submit = array(

      'global_lat' =>  sanitize_text_field($_POST['maya_map_glob_area_lat']),

      'global_long'=> sanitize_text_field($_POST['maya_map_glob_area_long']),

      'map_zoom'=>sanitize_text_field($_POST['maya_map_default_zoom']),

      'map_custom_marker'=>sanitize_text_field($_POST['maya_map_custom_marker']),

        'map_width'=>sanitize_text_field($_POST['maya_map_default_width']),

          'map_height'=>sanitize_text_field($_POST['maya_map_default_height']),
          
          'map_width_unit' =>sanitize_text_field($_POST['maya_map_width_unit']),
             'map_height_unit' =>sanitize_text_field($_POST['maya_map_height_unit']),

    );

    update_option( 'maya_map_admin_options', $maya_map_options_submit );

        

    }

     $admin_options=get_option('maya_map_admin_options');

    ?>

    <div id="maya_map_options_wrapper">

        <h2 class="main_title">Global map settings - Maya Map Location</h2>

        <form name="maya_map_options" id="maya_map_options" action="" method="post">

            

            <div class="option_section">

                <h3 class="option_seciton_title">Global map location area</h3>

                    <div class="field text_field">

                    <input type="text" name="maya_map_glob_area_lat" id="maya_map_glob_area_lat" value="<?php echo $admin_options['global_lat'];?>"  class="text_field"/>

                    <span class="input_description">enter the latitude value of desired area</span>

                    </div>

                     

                     <div class="field text_field">

                    <input type="text" name="maya_map_glob_area_long" id="maya_map_glob_area_long" value="<?php echo $admin_options['global_long'];?>" class="text_field" />

                    <span class="input_description">enter the longitude value of desired area</span>

                    </div>

                     <?php  if($admin_options['global_lat'] && $admin_options['global_long']){ ?>

                     <div class="admin_center_map">

                       <iframe  src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;t=m&amp;z=7&amp;ll=<?php echo $admin_options['global_lat'];?>,<?php echo $admin_options['global_long'];?>&amp;output=embed"></iframe>

                    </div>

                   <?php } ?>       

            </div>

            

            <div class="option_section">

                <h3 class="option_seciton_title">Map settings</h3>
                <p><small>These settings are applicable to the map view in the frontend.</small></p>

                     <div class="field">

                    <input type="text" name="maya_map_default_width" id="maya_map_default_width" value="<?php echo $admin_options['map_width'];?>" class="text_field" />
                    <select name="maya_map_width_unit" id="maya_map_width_unit">
                        <option value="pixel">px</option>
                        <option value="percentage" <?php if($admin_options['map_width_unit']==='percentage') echo "selected";?>>%</option>
                    </select>

                    <span class="input_description">Change the default width of map area</span>

                    </div>

                     

                     <div class="field">

                    <input type="text" name="maya_map_default_height" id="maya_map_default_height" value="<?php echo $admin_options['map_height'];?>" class="text_field" /> <select name="maya_map_height_unit" id="maya_map_height_unit">
                        <option value="pixel">px</option>
                        <option value="percentage" <?php if($admin_options['map_height_unit']==='percentage') echo "selected";?>>%</option>
                    </select>

                    <span class="input_description">Change the default height of map area</span>

                    </div>

                     

                    <div class="field">

                    <input type="text" name="maya_map_default_zoom" id="maya_map_default_zoom" value="<?php echo $admin_options['map_zoom'];?>" class="text_field" />

                    <span class="input_description">Change the default map zoom</span>

                    </div>

                     

                     <div class="field">

                      <input type="text" name="maya_map_custom_marker" id="maya_map_custom_marker" value="<?php echo $admin_options['map_custom_marker'];?>" class="text_field">

                      <input type="button" class="button button-primary" value="Upload" id="upload_maya_map_custom_marker" />

                      <?php if($admin_options['map_custom_marker']){ ?>

                      <div class="maya_map_custom_marker_img"><img src="<?php echo $admin_options['map_custom_marker'];?>" alt="" class="" /></div>

                      <?php } ?>

                       <span class="input_description">Change the custom marker of your map. <span class="important">If the uploaded image url is not set, please copy the image link url and paste it in the text field.</span></span>

                    </div>

            </div>
            
             

            

            <input type="submit" name="maya_map_option_submit" class="button button-primary" id="maya_map_option_submit" value="Save settings" />

        </form>
        
        
        
        <div class="option_section">
                <h3 class="option_seciton_title">Import and Export</h3>
        <?php
            $csvExport = new CSVExport();
            ?>
	    <p><a href="?page=download_report&download_report">Export Locations</a></p>
            <?php echo $message;?>
                
               <?php
                   if($_POST['upload_csv']){
                        if(!file_exists($_FILES['csv_upload_input']['tmp_name']) || !is_uploaded_file($_FILES['csv_upload_input']['tmp_name'])) {
                        $message="<p class='error'>File Uploading fail</p><p class='error_partial'>You need to upload your CSV file</p>";
                        $err1=1;
                       }else $err1=0;
                       
                       if(file_exists($_FILES['csv_upload_input']['tmp_name']) || is_uploaded_file($_FILES['csv_upload_input']['tmp_name'])){
                           $allowed =  array('csv');
                             $filename = $_FILES['csv_upload_input']['name'];
                              $ext = pathinfo($filename, PATHINFO_EXTENSION);
                                 if(!in_array($ext,$allowed) ) {
                                   $message="<p class='error'>Importing Data failed</p><p class='error_partial'>Only .csv file format is allowed</p>";
                                   $err2=1;
                                 }
                                 else $err2=0;
                       }else $err2=0;
                       
                       
                       if($err1==0 and $err2==0){
                        
                        //get the csv file
                        $file = $_FILES['csv_upload_input']['tmp_name'];
                        $handle = fopen($file,"r");
                        $row=0;
                        $insert_term_id='';
                        $new_loc_id='';
                        $faild_rows='';
                        $inserted_categories=array();
                        
                        //loop through the csv file and insert into database
                        do {
                         if($row>1){  
                            if ($data[0] && $data[1] && $data[2]) {

                                       
                                        if($data[6]){
                                          $insert_term= wp_insert_term(
                                           $data[6], // the term 
                                                'map-categories', // the taxonomy
                                                array(
                                                )
                                              );
                                        $t= term_exists($data[6], 'map-categories');
                                       
                            $insert_term_id=($t['term_id']) ? $t['term_id'] : $insert_term['term_id'];
                                        }else $insert_term_id='';
                                       
                                          $new_location = array(
                                                'post_title'    => $data[0],
                                                'post_status'   => 'publish',
                                                'post_type'=>'map-locations',
                                              );
                                            $new_loc_id=wp_insert_post( $new_location );
                                            if($new_loc_id){
                                                  if($data[1])  update_post_meta( $new_loc_id, '_maya_map_longitude', $data[1] );
                                                  if($data[2]) update_post_meta( $new_loc_id, '_maya_map_latitude', $data[2] );
                                                if($data[3]) update_post_meta( $new_loc_id, '_maya_map_branch_code', $data[3] );
                                                if($data[4])   update_post_meta( $new_loc_id, '_maya_map_address', $data[4] );
                                                if($data[5]) update_post_meta( $new_loc_id, '_maya_map_zip', $data[5] );
                                                 if($insert_term_id) wp_set_post_terms( $new_loc_id, array($insert_term_id),'map-categories' );
                                            }
                                            else{ 
                                                 $faild_rows.='<tr>';
                                                 $faild_rows.='<td>'.$data[0].'</td><td>'.$data[1].'</td><td>'.$data[3].'</td><td>'.$data[4].'</td><td>'.$data[5].'</td><td>'.$data[6].'</td>';
                                                 $faild_rows.='</tr>';
                                          }
 
                                    
                            } else{
                                                 $faild_rows.='<tr>';
                                                 $faild_rows.='<td>'.$data[0].'</td><td>'.$data[1].'</td><td>'.$data[3].'</td><td>'.$data[4].'</td><td>'.$data[5].'</td><td>'.$data[6].'</td>';
                                                 $faild_rows.='</tr>';
                                
                            }
                         }
                            $row++;
                            
                        } while ($data = fgetcsv($handle,0,",","'"));
                        
                        if($faild_rows){
                        $message.="<p class='partially_suc'>Importing Data Successful.But all rows are not imported</p>";
                        $message.='<div class="failed_rows_wrapper">';
                          $message.='<p class="failed_rows_wrapper_show">Show failed rows</p>';
                        $message.='<div class="table_wrapper">'; 
                        $message.='<table>';
                        $message.='<tr><th>Title</th><th>Longitude</th<th>Latitude</th><th>Branch code</th><th>Address</th><th>Zip</th><th>Category</th></tr>';
                        $message.=$faild_rows;
                        $message.='</table>';
                         $message.='</div>';
                        $message.='</div>';
                        }
                        else $message="<p class='suc'>Importing Data Successful</p>";
                       
                       }
                }
 
               ?>
               <?php echo $message;?>
                <form name="rate_csv_file_form" id="rate_csv_file_form" action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="csv_upload_input" class="" id="csv_upload_input" />
                    <input type="submit" value="Upload CSV file" name="upload_csv" class="button button-primary" />
                </form>
        
        </div>
        <div class="option_section">

                <h3 class="option_seciton_title">How to use ?</h3>
                  <div class="field">
                    <p> Use the shortcode anywhere in your page or post.</p>
                     <p><strong>[maya-map-shortcode]</strong></p>
                  </div>
             </div>

    </div>



<?php }