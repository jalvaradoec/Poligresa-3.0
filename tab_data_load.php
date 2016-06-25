
<!-- The timeline -->
<div class="post">
    <div class="row margin-bottom">
        <div class="col-sm-4">
            <div class="data1">
                <i class="fa fa-hdd-o fa-5x"></i>
            </div>
            <h3>Portfolio Data Load</h3>

        </div>
        <div class="col-sm-8">
            <div class="data_p">
                <p>Dripper half and half galão robust ristretto iced, macchiato, blue
                    mountain, affogato cream a mazagran robusta organic decaffeinated as
                    caffeine, cappuccino pumpkin spice roast saucer froth. Cup cream
                    coffee, cup cream, eu, body, robusta irish, spoon rich black
                    caffeine, grounds milk filter viennese chicory to go. Whipped eu
                    cream, qui shop as grounds body beans, that single origin grounds
                    con panna extraction medium, strong skinny extra turkish fair trade
                    coffee. Percolator rich so blue mountain, cup grinder crema
                    cultivar, trifecta single shot sugar, est redeye variety macchiato
                    to go frappuccino. Cup, con panna, aroma, cultivar shop, sugar
                    americano black iced skinny whipped french press macchiato
                    sugar.</p>
            </div>
			<form action="#" method="post" enctype="multipart/form-data">
				<div class="data_button">
					
					<div class="col-md-12">
						<input id="csv" type="file" name="fileToUpload" id="fileToUpload">
						<button class="btn  btn-default btn-flat">Address</button>
					</div>
					
					<div class="col-md-12">
						<input type="file" name="fileToUpload" id="fileToUpload">
						<button class="btn btn-default btn-flat">Clients</button>	
					</div>
					
					<div class="col-md-12">
						<input type="file" name="fileToUpload" id="fileToUpload">
						<button class="btn  btn-default btn-flat">Contacts</button>
					</div>
					
					<div class="col-md-12">
						<input type="file" name="fileToUpload" id="fileToUpload">
						<button class="btn  btn-default btn-flat">Credits</button>
					</div>
					
					<div class="col-md-12">
						<input type="file" name="fileToUpload" id="fileToUpload">
						<button class="btn btn-default btn-flat">Fees</button>
					</div>
					
					<div class="col-md-12"> 
						<input type="file" name="fileToUpload" id="fileToUpload">
						<button class="btn  btn-default btn-flat">Phones</button>
					</div>
					<!--<button class="btn btn-default">Load New Portfolio Information</button>-->
				</div>	
			</form>
        </div>
    </div>
</div>
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
	
		
		
	
		var fileInput = document.getElementById("csv"),
		
			readFile = function () {
				var reader = new FileReader();
				reader.onload = function () {
					document.getElementById('out').innerHTML = reader.result;
				};
				// start reading the file. When it is done, calls the onload event defined above.
				reader.readAsBinaryString(fileInput.files[0]);
			};
			fileInput.addEventListener('change', readFile);		
		
	});
		
		/*
		var fileInput = document.getElementById("csv"),

    readFile = function () {
        var reader = new FileReader();
        reader.onload = function () {
            document.getElementById('out').innerHTML = reader.result;
        };
        // start reading the file. When it is done, calls the onload event defined above.
        reader.readAsBinaryString(fileInput.files[0]);
    };

fileInput.addEventListener('change', readFile);

	*/
	
	
</script>
