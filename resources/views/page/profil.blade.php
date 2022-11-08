    @extends('app')

    @section('header')
        @include('component.header')
    @endsection	

    @section('menu')
        @include('component.menu')
    @endsection	

    @section('footer')
        @include('component.footer')
    @endsection	

    @section('content')
    <?php
    foreach($content as $rowcontent){
        $parent1 = '';
        $parentid1 = '';
        $parent_link1 = '#';
        $query2 = \App\Helpers\AppHelper::menu_id2($rowcontent->parent_id_kip);
        foreach ($query2 as $row2) {
            $parent1 = $row2->menu_name;
            $parentid1 = $row2->parent_id_kip;
            $parent_link1 = $row2->menu_link.'/'.$row2->menu_link_slug;
        }

        $parent2 = '';
        $parent_link2 = '#';
        if($parentid1){
            $query2 = \App\Helpers\AppHelper::menu_id2($parentid1);
            foreach ($query2 as $row2) {
                $parent2 = $row2->menu_name;
                $parent_link2 = $row2->menu_link.'/'.$row2->menu_link_slug;
            }
        }
    ?>
	<div class="layout_padding">
        <div class="container-image">
            <img src="{{ url('image/bg-informasi.jpg') }}" alt="Snow" style="width:100%;" id="img-height">
            <div class="centered">
               <div style="font-weight:bold;" id="title-menu"><?php echo $rowcontent->menu_name; ?></div>
                <div style="line-height:1.2;" id="detail-menu">
                <?php if($parent2){ echo '<a href="'.url($parent_link2).'" style="color:#fff;">'.$parent2.'</a>'; ?> <font class="fa fa-angle-right" style="color:#fff; font-weight:bold; margin-left:7px; margin-right:7px;"></font> <?php } if($parent1){ echo '<a href="'.url($parent_link1).'" style="color:#fff;">'.$parent1; ?> <font class="fa fa-angle-right" style="color:#fff; font-weight:bold; margin-left:7px; margin-right:7px;"></font> <?php } echo '<a href="'.url($rowcontent->menu_link.'/'.$rowcontent->menu_link_slug).'" style="color:#fff;">'.$rowcontent->menu_name; ?>
                </div>
            </div>
        </div>
	</div>
	<?php } ?>

	<div>
        <div style="width:95%; margin-top:-75px;">
            <div class="row">
                <div class="col-md-3" id="side_div">
                    <div class="full">
                        <div class="panel-group" id="accordion">
                          <?php
                          foreach($content as $rowcontent){
                            $numsub0 = \App\Helpers\AppHelper::menu_child_num($rowcontent->ifg_menu_id);	
                            if($numsub0 > 0 or $rowcontent->parent_id_kip > 0){
                            $query = \App\Helpers\AppHelper::menu_child($rowcontent->parent_id_kip);
                            foreach ($query as $row) {	
                            $numsub1 = \App\Helpers\AppHelper::menu_child_num($row->id);
                            //echo $numsub1.' '.$rowcontent->parent_id_kip;	
                          ?>
                          <div class="panel panel-default" <?php if($rowcontent->menu_link_slug <> $row->menu_link_slug){ ?>style="background-color:#E5E5E5;"<?php } ?>>
							<div class="panel-heading" <?php if($rowcontent->menu_link_slug == $row->menu_link_slug){ ?>style="background-image: linear-gradient(#CC0000, #ff0000, #CC0000); padding:15px; color:#ffffff; font-weight:600;"<?php } else { ?>style="padding:15px; color:#000000; font-weight:600;"<?php } ?>>
							  <div class="panel-title">
								<a <?php if($numsub1){ ?>data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $row->id; ?>"<?php } else { ?> href="<?= url($row->menu_link.'/'.$row->menu_link_slug); ?>"<?php } ?> style="font-size:16px;">
                                    
                                    <?php if($numsub1){ ?>
                                        <font style="<?php if($numsub1){ if($rowcontent->menu_link_slug == $row->menu_link_slug){ echo 'color:#ffffff;'; }} else { if($rowcontent->menu_link_slug == $row->menu_link_slug){ echo 'color:#ffffff;'; } } ?>"><?php echo $row->menu_name; ?></font> 
                                        <font class="fa fa-chevron-down" style="float:right; margin-top:8px;"></font>
                                    <?php } else { ?>
                                        <div style="<?php if($numsub1){ if($rowcontent->menu_link_slug == $row->menu_link_slug){ echo 'color:#ffffff;'; }} else { if($rowcontent->menu_link_slug == $row->menu_link_slug){ echo 'color:#ffffff;'; } } ?>"><?php echo $row->menu_name; ?></div> 
                                        <div style="float:right; position:absolute; margin-top:-40px; margin-left:78%;">
                                            <?php 
                                            if($rowcontent->menu_link_slug == $row->menu_link_slug){
                                            ?>
                                            <img src="http://localhost:8080/ifg/image/image/serong.png" style="width:30px;">
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </a>
							  </div>
							</div>
                            <?php
                            if($numsub1){
                            ?>
							<div id="collapse<?php echo $row->id; ?>" class="panel-collapse collapse <?php if($rowcontent->menu_link_slug == $row->menu_link_slug){ echo 'show'; } ?>">
								<div style="background-color:#999999; color:#FFFFFF;">
                                  <?php
                                    $query2 = \App\Helpers\AppHelper::menu_child($row->id);
                                    foreach ($query2 as $row2) {		
                                  ?>
								  <div class="panel-body" style="padding:15px 15px 15px 25px; background-color:#666666;"><a href="<?= url($row->menu_link.'/'.$row2->menu_link_slug); ?>" style="color:#fff;"><?php echo $row2->menu_name; ?></a></div>
								  <div style="border:0.5px solid #E5E5E5; width:100%;"></div>
                                  <?php } ?>
								</div>
							</div>
                            <?php } ?>
						  </div>
						  <div style="border:0.5px solid #ffff; width:100%;"></div>
                          <?php } ?>
                          <?php } else { ?>
                          <div class="panel panel-default">
							<div class="panel-heading" style="background-image: linear-gradient(#CC0000, #ff0000, #CC0000); padding:15px; color:#ffffff;">
							  <div class="panel-title">
								<a href="<?= url($rowcontent->menu_link.'/'.$rowcontent->menu_link_slug); ?>" style="font-size:16px; font-weight:600;">
                                    <div style="color:#ffffff;"><?php echo $rowcontent->menu_name; ?></div> 
                                    <div style="float:right; position:absolute; margin-top:-40px; margin-left:77.5%;">
                                        <img src="http://localhost:8080/ifg/image/image/serong.png" style="width:30px;">
                                    </div>
                                </a>
							  </div>
							</div>   
                          </div>   
                          <?php }} ?>
						</div>
                    </div>
                </div>
                <div class="col-md-9" id="body-content-inner">
                    <?php
                    foreach($content as $row){
                    ?>
                    <div class="full" style="padding-top:40px; margin-bottom:20px; padding-left:10px; padding-right:10px;">
                        <h2 style="color:#000000; font-size:23px; font-weight:bold;">
							<?php echo $parent1; ?>
						</h2>
                        <div style="color:#000000; font-size:15px; margin-top:10px; margin-bottom:30px; line-height:1.4; text-align:justify;">
                            <?php echo $row->content_body; ?>   
                        </div>
                        <h2 style="color:#000000; font-size:23px; font-weight:bold;">
                            <?php echo $row->content_title; ?>
                        </h2>
                        <div class="row">
                            <?php
                            $no = 1;
                            $query2 = \App\Helpers\AppHelper::select_ifg_pages_content_list_item($row->id);
                            foreach ($query2 as $row2) {	
                            ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-center" style="margin-bottom:25px;">
                                <a href="<?php echo url('storage/files/'.$row2->item_link); ?>" target="_blank"> 
                                    <div style="background-image: linear-gradient(#ffffff, #cccccc); padding:10%; font-size:18px; font-weight:bold; box-shadow: 0 0 2px 2px #ccc;">
                                        <?php echo $row2->item_title; ?>
                                    </div>
                                    <div style="float:right; margin-top:-180px;">
                                        <img src="{{ url('image/triagle.png') }}" style="height:50px;">
                                    </div>
                                    <!-- <div style="float:right; margin-top:-150px; padding-right:15px;">
                                        <img src="{{ url('image/pdf.png') }}" style="height:120px; opacity: 0.2;">
                                    </div> -->
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>    
                    <?php } ?>
                </div>   
            </div>
        </div>
    </div>
	@endsection	
	@section('script_additional')
	@endsection