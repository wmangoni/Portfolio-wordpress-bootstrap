        <footer>
            <div class="center row">
                <div class="col-xs-11 col-xs-offset-1 col-sm-11 col-sm-offset-1 col-md-12 col-md-offset-0">
                    <p><a target="_blank" href="http://www.dow.com/brasil/">Dow Home</a>  |  <a target="_blank" href="http://www.dow.com/homepage/privacy.htm?lang=PORTUGUESE-brazil  ">Privacy</a>  |  <a target="_blank" href="http://www.dow.com/en-us/terms-of-use/ ">Terms of Use</a>  |  <a target="_blank" href="http://www.dow.com/en-us/accessibility-statement">Accessibility</a></p>
                    <p>Copyright © The Dow Chemical Company (1995 - <?php echo date('Y'); ?>) All Right Reserved. &reg; &trade; Trademark of The Dow Chemical Company ("Dow") or any affilated company of Dow.</p>
                </div>
                <div class="col-xs-11 col-xs-offset-1 visible-xs parceiros">
                    <center><span>EM PARCERIA COM</span></center>
                    <a target="_blank" href="http://www.danicacorporation.com">
                        <div id="danica" class="logo col-xs-4">
                            <img src="<?php echo IMG_PATH.'danica.png'; ?>">
                        </div>
                    </a>

                    <a target="_blank" href="http://www.isoeste.com.br">
                        <div id="isoeste" class="logo col-xs-4">
                            <img src="<?php echo IMG_PATH.'isoeste.png'; ?>">
                        </div>
                    </a>

                    <a target="_blank" href="http://www.mbp.com.br">
                        <div id="isoblock" class="logo col-xs-4">
                            <img src="<?php echo IMG_PATH.'isoblock.png'; ?>">
                        </div>
                    </a>
                </div>
            </div>
        </footer>
        <?php wp_footer() ?>
        <!-- jQuery CDN -->

       <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-36998971-5', 'auto');
        ga('send', 'pageview');

        </script>

    </body>
    <script src="<?php echo BASE_ASSETS.'mask/src/jquery.mask.js' ?>"></script>
    <script src="<?php echo BASE_ASSETS.'js/contato.js' ?>"></script>
    </html>
