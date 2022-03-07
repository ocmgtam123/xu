<div class="w-100 footer-top pt-4 pb-4">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <div class="col-footer">
                        <div class="title_footer">
                           <span class="s-24"><span class="color-or">Xoài Úc</span> Cam Lâm</span>
                        </div>
                        <div class="main_footer">
                           <div class="row">
                              <div class="col-md-3">
                                <?=$info["addressfooter"]?>
                              </div>
                              <div class="col-md-6">
                                 <p class="mb-0">Phone: <?=$info["hotline"]?></p>
                                 <p class="mb-0">Email: <?=$info["email"]?></p>
                                 <p class="mb-0">Website: <?=$info["website"]?></p>  
                              </div>
                              <div class="col-md-3">
                                 <div class="title_footer">
                                    <span>Follow us</span>
                                 </div>
                                 <div class="main_footer">
                                    <span class="float-left lh34">
                                        <?php foreach ($follow as $fl){?>
                                        <a style="text-decoration: none;" class="p-1" href="<?=$fl["link"]?>" target="_blank">
                                           <i style="color: #356a02!important; font-size: 14px" class="fa <?=$fl["icon"]?>" aria-hidden="true"></i>
                                        </a>
                                        <?php }?>
                                    </span>
                                 </div> 
                              </div>
                           </div>                              
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="w-100 footer-bottom">
            <div class="container p-0">
               <div class="row">
                  <div class="col-md-12 text-center">
                     <span class="lh30 color-b1"><?=$info["copyright"]?></span>
                  </div>
               </div>
            </div>
         </div>
