<footer id="footer">

    <div class="links">
        <a href="#">Nous contacter</a>
        <a href="#"> F.A.Q </a>
        <a href="#"> Questions </a>
        <a href="#"> A propos... </a>

    </div>

	<div class="socialicon">

    <a href="#"><i class="icon-twitter"></i></a>
    <a href="#"><i class="icon-facebook-sign"></i> 
    <a href="#"> <i class="icon-google-plus"></i>
    

    </div>
    

	<h3>
    <a href="index.php"><i class="icon-chevron-sign-right"></i> STA<span style="color:red">QUE</span> <?php echo date("Y"); ?> </a>
    </h3>

	</div>

</footer>


		<script src="js/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                SearchText();
            });
            function SearchText() {
                $(".autosuggest").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            type: "POST",
                            contentType: "application/json; charset=utf-8",
                            url: "http://localhost/Projet-STAQUE/askquestions.php",
                            data: "{'keyword':'" + document.getElementById('key1').value + "'}",
                            dataType: "json",
                            success: function (data) {
                                if (data != null) {

                                    response(data.d);
                                }
                            },
                            error: function(result) {
                                alert("Error");
                            }
                        });
                    }
                });
            }
        </script>
        <script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
        tinymce.init({
            selector: "textarea"
         });
        </script>


</body>
</html>