<?php
/**
 * Template Name: Navidad
 *
 */
get_header();

$price = 27.2;
?>

<!-- #main-content -->
<div class="navidad">
    <div id="homebanner">
       <div class="phoenix-feather">
			<div class="slider_content">
                <div class="clock"><span id="clock_navidad"><?php echo date("d M H:i:s", strtotime("12/22/2015 14:00:00")) ?></span></div>
                <script type="text/javascript">
                jQuery(document).ready(function () {
					var days ='<?php _e("days","twentythirteen") ?>';
					var hrs ='<?php _e("hrs","twentythirteen") ?>';
					var min ='<?php _e("min","twentythirteen") ?>';
					var sec ='<?php _e("sec","twentythirteen") ?>';
					var date = "<?php echo date("Y-m-d H:i:s", strtotime("12/22/2015 14:00:00"))  ?>";
                    jQuery("#clock_navidad").countdown(date, function (event) {
                        jQuery(this).html(event.strftime("<table><tr><td><h1><span>%D</span></h1></td><td><h1><span>%H</span></h1></td><td><h1><span>%M</span></h1></td><td><h1><span>%S</span></h1></td></tr><tr><td>"+days+"</td><td>"+hrs+"</td><td>"+min+"</td><td>"+sec+"</td></tr></table>"));
						});
                });
                </script>
                <div class="hadding">
					<h2>El Gordo DeNavidad 2015 Raffle</h2>
					<h1>€2,240,000,000 </h1>

                </div>
            </div>
            <img src="<?php echo get_template_directory_uri(); ?>/images/navidadbanner.jpg" alt="" />
        </div>
    </div>
</div>

<div id="middle" class="innerbgnavidad">

    <div class="wrap">

		<div id="faqpage">
        <div class="innerpage">
        <div class="navidad">
		<div class="suffleleft">
            <div class="selectallbtngeneral selectallbtn2" id="Button1"><?php _e('Shuffle Tickets','twentythirteen');?></div>
        </div>
            <div class="ticketswrapper">
        <div class="block">
            <div class="ticketsline">
                <div class="ticketslinecontainer">
                    <div class="ticket ticket1">
                        <div class="viactive" id="viactive1"></div>
                        <div class="line1">
                            <div class="fivedigits">
                                <p class="digit digit1">
                                    <span id="line1_number">00000</span>
                                </p>
                            </div>
                            <div class="price price1">
                                <p>
                                    <span id="line1_sit">000</span>
                                </p>
                            </div>
                            <div class="price price2">
                                <p>
                                    <span id="line1_ticket">0</span>
                                </p>
                            </div>
                            <div class="price price4">
                                <p>
                                    <?php echo number_format($price, 2); ?>
                                </p>
                            </div>
                        </div>
					<div class="navidadstamp">
                    </div>
                    </div>
                    <div class="spiral">
                    </div>
                    <div class="addshares">
                        <p class="sharestop"><?php _e('Add Shares:','twentythirteen');?></p>
                        <div id="minus" class="plusminus minus">

                        </div>
                        <div class="numofshares">
                            <span id="numofshares">1</span>
                            <span class="numofsharesof">/</span>
                            <span class="numofsharesof">10</span>
                        </div>
                        <div id="plus" class="plusminus plus">

                        </div>
						<div style="text-align:center;font-size:13px;font-weight:normal;margin-top:15px;"><?php _e('Availible shares:','twentythirteen');?> <span id="availableSharesText"></span></div>
                    </div>
                    </div>
                </div>
                <!--End container-->
            </div>

        </div>
    </div>


    <div class="block">
        <div class="selectallticketswrapper">
            <div class="block selectallticketswrapperblock">
			<div class="twoblocks">
                <div class="europerticket">
                    <span><?php _e('TICKET PRICE','twentythirteen');?></span>
                    <span>:</span>
                    <span class="bold">
                        <span><?php echo number_format($price, 2); ?></span>
                    </span>

                </div>
                <div class="totaltickets">
                    <span><?php _e('NUMBER OF SHARES','twentythirteen');?> </span>
                    <span>:</span>
                    <span class="bold">
                        <span id="ContentPlaceHolder1_LabelTicketsSelected">1</span>
                    </span>
                </div>
				</div>
				<div class="oneblock">
                <div class="totalticketscost">
                    <span><?php _e('TOTAL COST','twentythirteen');?> </span>
                    <span>:</span>
                    <span class="bold">
                        <span id="ContentPlaceHolder1_totalticketscost_label"></span>
                    </span>
                </div>


                <div class="selectallbtngeneral selectallbtn">

                    <p>
                        <span id="ContentPlaceHolder1_Label9"><?php _e('continue','twentythirteen');?></span>
                    </p>
                </div>

				</div>

            </div>

        </div>
        <!--End select all tickets wrapper-->
    </div>
	<div class="clear"></div>
	<form id="iFormValuesRaffle" name="nFormValuesRaffle" action="<?php echo home_url(); ?>/payment" method="post">
		<input type="hidden" id="choosenTab" value="#single" />
		<input type="hidden" id="lines" name="lines" value=""/>
		<input type="hidden" id="selno" name="selno" value=""/>
		<input type="hidden" id="singtp" name="totalprice" value="<"/>
		<input type="hidden" id="singsubtp" name="subtotal" value=""/>
		<input type="hidden" id="singbm" name="bonusmoney" value=""/>
		<input type="hidden" id="minl" value=""/>
		<input type="hidden" id="maxl" value=""/>
		<input type="hidden" id="storeselected" value="" name="storeselected"/>
		<input type="hidden" id="otherdata" name="otherdata" value="$|Navidad|">
        <input type="hidden" id="productid" name="productid" value="15">
	</form>
<script type="text/javascript">

    jQuery(document).ready(function() {
        var shuffleBtn = $('#Button1');
        var fiveDigitNumber = $('#line1_number');
        var threeNumbersLine = $('#line1_sit');
        var oneNumberLine = $('#line1_ticket');
        var availableSharesText = $('#availableSharesText');
        var priceText = $('#ContentPlaceHolder1_totalticketscost_label');
        var price = <?php echo number_format($price, 2); ?>; //29.90;
        var numberOfTickets = $('#ContentPlaceHolder1_LabelTicketsSelected');
		var ticketsNumbers = $("#ticketsNumbers");

        var minNum = 0;
        var maxNum = 9;
		var choosenTickets = 1;
        var plusBtn = $('#plus');
        var minusBtn = $('#minus');
        var numberOfShares = $('#numofshares');
        var totalNumberOfShares = 10;


		var numbers = [];
		function getTicketsIdsAndInsertThem(num){
			var selectedNums = getTicketsIds(num);
			$('#lines').val(num);
			$('#selno').val(selectedNums);
			$('#singtp').val(price * num);
			$('#singbm').val(0);
			insertNavidadNumbers(selectedNums);
		}
        function randomIntFromInterval(minNum,maxNum)
        {
            return Math.floor(Math.random()*(maxNum-minNum+1)+minNum);
        }

		function getTicketsIds(num)
		{
			if(numbers.length > 0)
			{
				var startIndx = parseInt(0);
				var selectedNums = numbers[startIndx].Id;
				startIndx = startIndx + 1;
				while(startIndx < num)
				{
					selectedNums += "," + numbers[startIndx].Id;
					startIndx = startIndx + 1;
				}
				return selectedNums;
			}
			else
			{
				return "";
			}
		}

        function shuffleNumbers() {
			restoreNavidadTicketNumber(numbers);
			//console.log(numbers);

            //shuffle the fiveNumbers
			$(fiveDigitNumber).text(pad(numbers[0].Number, 5));
            //shuffle the threeNumbers
			$(threeNumbersLine).text(numbers[0].Seat);

            //shuffle the one number line
            $(oneNumberLine).text(numbers[0].Ticket);

            //shuffle available shares
            availableShares = numbers.length;
			//console.log(availableShares);
            totalNumberOfShares = availableShares;
            $(availableSharesText).text(availableShares);

            //restart shares && price
            $(numberOfShares).text('1');
            $(priceText).text('$' + price);
            $(numberOfTickets).text('1');
			$(ticketsNumbers).val(numbers[0].Id);
			//console.log($(ticketsNumbers).val());
        }

		function pad(num, size) {
			var s = num+"";
			while (s.length < size) s = "0" + s;
			return s;
		}

        function increment(){
            var currentShares = numberOfShares.text();
            if (currentShares >=totalNumberOfShares)   {
                //parseInt(currentShares);
                //numberOfShares.text(totalNumberOfShares);
            }else{
                currentShares++;
                parseInt(currentShares);
                numberOfShares.text(currentShares++);
                numberOfTickets.text(currentShares-1);
                var currentPrice = price*(currentShares-1);

                priceText.text('$'+ parseFloat(currentPrice).toFixed(2));
				//$(ticketsNumbers).val($(ticketsNumbers).val()+ "," + numbers[currentShares - 1].Id);
            };

			console.log(ticketsNumbers.val());
        }

        function decrement(){
            var currentShares = numberOfShares.text();
            if (currentShares > 1)   {
                parseInt(currentShares);
                var currentTickets = currentShares-1;
                numberOfTickets.text(currentTickets);
                numberOfShares.text(currentShares-1);

                var currentPrice = price*(currentShares-1);
                priceText.text('$'+ parseFloat(currentPrice).toFixed(2));
				//ticketsNumbers.val(ticketsNumbers.val().substring(0, ticketsNumbers.val().lastIndexOf(',')));
				//console.log(ticketsNumbers.val());
            }
        }


        //get the string parameters from the iframe
        var qs = (function(a) {
            if (a == "") return {};
            var b = {};
            for (var i = 0; i < a.length; ++i)
            {
                var p=a[i].split('=', 2);
                if (p.length == 1)
                    b[p[0]] = "";
                else
                    b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
            }
            return b;
        })(window.location.search.substr(1).split('&'));

        var greenBtn = $('#ContentPlaceHolder1_Label9');

       greenBtn.click(function (){
		   var currentShares = numberOfShares.text();
           getTicketsIdsAndInsertThem(parseInt(currentShares));
       });
       plusBtn.click(increment);
       minusBtn.click(decrement);


       shuffleBtn.on('click', function() {

			getNavidadNumbers(getTicketsIds(parseInt(totalNumberOfShares)),shuffleNumbers);
	   });

		shuffleBtn.trigger("click");
		function restoreNavidadTicketNumber(numbers) {
			for(var i=0;i< numbers.length;i++) {
				//console.log(numbers[i]);
				if(numbers[i].Number % 10 == 0) {
					numbers[i].Number = numbers[i].Number/10;
				}
				numbers[i].Number = parseInt(numbers[i].Number/10, 10);
				//console.log(numbers[i]);
			}
		}
	    function getNavidadNumbers(releaseIds, callback){
                var datastring = "action=lottery_data&m=playlottery/get-navidad-numbers&lt=" + releaseIds;
				jQuery.ajax({
				type: "POST",
				url: CONFIG.adminURL,
				data: datastring,
				dataType: 'json',
				success: function (res) {
					numbers = res;
					callback();
				}
			});
        }

		function insertNavidadNumbers(selectedIds){
                var datastring = "action=lottery_data&m=playlottery/insert-navidad-numbers&lt=" + selectedIds;
				jQuery.ajax({
				type: "POST",
				url: CONFIG.adminURL,
				data: datastring,
				dataType: 'json',
				success: function (res) {
					var otherdata = jQuery("#otherdata").val();
					if (res.ProductManagementCounter > 0) {
						var splitedData = otherdata.split("|");
						otherdata = splitedData[0] + '|' + splitedData[1] + '|0|' + res.ProductManagementCounter + '|false';
						jQuery("#otherdata").val(otherdata);
					}

					setTimeout(function() {
						document.forms['iFormValuesRaffle'].submit();
					}, 200);
				}
			});
        }
    });
</script>
        </div>
             <div class="comman">
                    <?php
                    if (have_posts()) :
                        while (have_posts()) :
                            the_post();
                            the_content();
                        endwhile;
                    endif;
                    ?>
            </div>
        </div>
    </div>
	</div>
	</div>
</div>
<?php
//get_sidebar();
get_footer();