<?php 
$news = $this->getData('news'); 
?>
<div class="content-center color-row pbb-5 ptt-5">

            <div class="container p0">
            <div class="row">
    			<div class="col-md-12">
    				<div class="sort-bar">
    					<div class="row w-100">
    						<div class="col-md-8 display-flex" style="margin-top: 5px;">					
    							
    						</div>
    						<div class="col-md-4 p-0">
    							<div class="pull-right">
    				                <?php echo $news['paging'];?>
    				                
    				            </div>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>	
              <div class="row">
              	<?php foreach ($news['data'] as $key => $value) { ?>
                 <div class="col-md-12 mb-3">
                    <div class="box-shadow">
                       <div class="card color-b1">
                           <div class="row no-gutters">
                              <div class="col-md-4">
                                 <a href="news-detail.html"><img src="<?=URL_BASE?><?=$value['image']?>" class="card-img" alt="<?=$this->language("l_news")?>"></a>
                              </div>
                              <div class="col-md-8">
                                 <div class="card-body">
                                   <h5 class="card-title"><a href="<?=URL_BASE?>/news-detail/<?=$value['slug']?>.html"><?=$value['title']?></a></h5>
                                   <p class="card-text"><?=$value['longtitle']?></p>
                                 </div>
                              </div>
                           </div>
                        </div>
                    </div>
                 </div>
                 <?php }?>
              </div>
            </div>
         </div>