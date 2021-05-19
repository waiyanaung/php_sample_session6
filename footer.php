        <!-- FOOTER -->
        <footer class="container">
            <div class="text-center">

                <p class="float-right"><button onclick="topFunction()" id="myBtn" title="Go to top">Top</button></p>

                <p>© <?php echo date("Y"); ?> Created By <a href='http://www.digitaltreemyanmar.com'>Wai Yan Aung</a> @ <a href="https://www.facebook.com/digitaltreemyanmar">William</a></p>
                <p><a href="http://www.digitaltreemyanmar.com">Digital Tree Myanmar</p>

                <a href="https://www.facebook.com/digitaltreemyanmar" class="fa fa-facebook"></a>
                <a href="http://www.digitaltreemyanmar.com" class="fa fa-twitter"></a>
                <a href="http://www.digitaltreemyanmar.com" class="fa fa-google"></a>
                <a href="https://www.facebook.com/digitaltreemyanmar" class="fa fa-linkedin"></a>
                <a href="#" class="fa fa-youtube"></a>
                <a href="https://www.facebook.com/digitaltreemyanmar" class="fa fa-instagram"></a>
            </div>

        </footer>
        </main>

        </body>

        </html>

        <script>
            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function() {
                scrollFunction()
            };

            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    document.getElementById("myBtn").style.display = "block";
                } else {
                    document.getElementById("myBtn").style.display = "none";
                }
            }

            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }
        </script>