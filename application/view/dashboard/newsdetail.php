 <?php 
$news = $this->getData('news'); 
$othernews = $this->getData('othernews');
?>
         <div class="content-center color-row pbb-5 ptt-5">
            <div class="container p0"> 
               <div class="row">
                  <div class="col-md-12">
                     <div class="box-shadow pp-5">
                        <?=$news['content']?>
                     </div>
                  </div>
                  
                  
                  <div class="col-md-12 mt-4">
                     <div class="box-shadow p-4">
                        <div class="row bottomline pb-4">
                           <div class="col-md-12">
                              <h2 class="m-0 card-title color-b1">Tin khác</h2>
                           </div>                           
                        </div>
                        <div class="row mt-2">
                        
                        	<?php $co=0;
                        	foreach ($othernews as $key => $value) {
                	    	  if($co==4) break;
                	    	  $co++;?>
                           <div class="col-sm-3">
                               <div class="card mb-4 shadow-sm">
                                 <div class="news-item-1">
                                 	<a href="<?=URL_BASE?>/news-detail/<?=$value['slug']?>.html"><img alt="" src="<?=URL_BASE?><?=$value['image']?>" style="width: 100%;height: 200px;object-fit: cover;"></a>
                                 </div>
                                 <div class="card-body">
                                   <p class="card-text"><a href="<?=URL_BASE?>/news-detail/<?=$value['slug']?>.html"><?=$value['title']?></a></p>
                                 </div>
                             </div>
                           </div>
                           <?php }?>
                           
                        
                           
                       </div>
                     </div>
                  </div>
                  
                  
               </div>
            </div>
         </div>
    