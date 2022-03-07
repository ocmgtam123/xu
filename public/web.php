<!DOCTYPE html>
<html>
    <head>
        <?php require PATH_INCLUDES . 'head.php'; ?>
    </head>
    <body>
        <div id="wrapper">
            <?php
            $follow = $this->getData('follow');
            ?>
            <header>
                <?php require PATH_INCLUDES . 'header.php'; ?>
            </header>
            <?php require PATH_INCLUDES . 'banner.php'; ?>
            <main>
                <?php require $this->_fileView; ?>   
            </main>
            <footer>
                <?php require PATH_INCLUDES . 'footer.php'; ?>       
            </footer>
        </div>

        <!-- Modal mess -->
        <div class="modal fade" id="messModal" tabindex="-1" role="dialog" aria-labelledby="messModal" aria-hidden="true">
            <div class="modal-dialog" role="document" style="width: 585px;margin-top: 10%;">
                <div class="modal-content">            
                    <div class="modal-body">             
                        <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                            <p class="form_item_error" id="mess"></p>
                            <div class="cl"></div>
                        </div>
                        <div class="col-xs-12" style="padding: 10px 0px; text-align: center;">
                            <button type="button" class="btn btn-grey btnborderclose" data-dismiss="modal">Đóng</button>                    
                        </div>
                        <div class="cl"></div>
                    </div><div class="cl"></div>
                </div><div class="cl"></div>
            </div><div class="cl"></div>
        </div>
        <!-- end modal mess -->

    </body>
</html>


