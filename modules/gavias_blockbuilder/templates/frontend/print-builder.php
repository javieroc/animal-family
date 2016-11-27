<div class="<?php print $row_class ?>"  <?php if(isset($row_attr['row_id']) && $row_attr['row_id']) print 'id="'.$row_attr['row_id'].'"' ?> style="<?php print $row_style ?>" >         
  <div class="bb-inner <?php if(isset($row_attr['style_space']) && $row_attr['style_space']) print $row_attr['style_space']; ?>">  
    <div class="bb-container <?php print $row_attr['layout'] ?>">
      <div class="row">
        <div class="row-wrapper clearfix">
          <?php
            if(isset($row['columns']) && is_array($row['columns'])){
              foreach( $row['columns'] as $column ){
                if(isset($column['attr']) && $column['attr']){
                  $col_attr = $column['attr'];
                }else{
                  $col_attr = null;
                }  
                $class  = '';
                $id = '';
                if($col_attr && isset($classes[$col_attr['size']]) && $classes[$col_attr['size']]){
                  $class = $classes[$col_attr['size']];
                }   
                if(isset($col_attr['class']) && $col_attr['class']){
                  $class .= ' ' . $col_attr['class'];
                }
                 if(isset($col_attr['id']) && $col_attr['id']){
                  $id .= ' ' . $col_attr['id'];
                }

                //Responsive
                if(isset($col_attr['hidden_lg']) && $col_attr['hidden_lg'] == 'hidden'){
                  $class .= ' hidden-lg'; 
                }
                if(isset($col_attr['hidden_md']) && !$col_attr['hidden_md'] == 'hidden'){
                  $class .= ' hidden-md'; 
                }
                if(isset($col_attr['hidden_sm']) && !$col_attr['hidden_sm'] == 'hidden'){
                  $class .= ' hidden-sm'; 
                }
                if(isset($col_attr['hidden_xs']) && !$col_attr['hidden_xs'] == 'hidden'){
                  $class .= ' hidden-xs'; 
                }

                $col_style_array = array();
      
                // Background for columns
                if(isset($col_attr['bg_color']) && $col_attr['bg_color']){
                  $col_style_array[]  = 'background-color:'. $col_attr['bg_color'];
                }
                if( $col_attr['bg_image'] ){
                  $col_style_array[]  = 'background-image:url('. $base_url . '/' . $col_attr['bg_image'] .')';
                  $col_style_array[]  = 'background-repeat:' . $col_attr['bg_repeat'];
                  $col_style_array[]    = 'background-attachment:' . $col_attr['bg_attachment']; 
                  if(isset($col_attr['bg_attachment']) && $col_attr['bg_attachment']=='fixed'){
                    $col_style_array[]  = 'background-position: 50% 0';
                    $col_style_array[] = 'gavias-parallax';
                  }else{
                    $col_style_array[]  = 'background-position:' . $col_attr['bg_position'];
                  }
                }
                $col_style  = implode('; ', $col_style_array );
                
            ?>
              <div <?php if($id) print ('id="' . $id . '"') ?> class="gsc-column <?php print $class; ?>">
                <div class="column-inner" <?php echo(($col_style) ? 'style="'.$col_style.'"' : '');  ?>>
                  <?php 
                     if( is_array( $column['items'] ) ){       
                        foreach( $column['items'] as $item ){
                           $shortcode = '\\Drupal\gavias_blockbuilder\shortcodes\\'.$item['type'];
                           if( class_exists($shortcode) ){
                              $sc = new $shortcode;
                              if(method_exists($sc, 'render_content')){
                                 $sc->render_content($item);
                              } 
                           }
                        }
                     }
                  ?>
                </div>
              </div>
            <?php      
              }
            }
          ?>    
        </div>
      </div>
    </div>
  </div>  
</div>  