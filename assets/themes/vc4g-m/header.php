<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon" />
    
    <title><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></title>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <?php wp_head(); ?>
</head>

<body id="page-top" class="index">
	<!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
        	<a class="logo"><img src="/assets/images/m/logo.png" width="166" style="float: left" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <img src="/assets/images/m/icon-close.png" class="imgclose" style="display: none;" />
                </button>
                
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                    	<div class="user-panel text-center">
                    		<div class="image">
                    			<img src="/assets/images/m/img-user.png" alt="User Image">
                    		</div>
                    		<div class="info">
                    			<p>Brandon Harris</p>
                    			<a href="#">Sign out</a>
                    		</div>
                    	</div>
                    </li>
                    <li>
                        <a class="page-scroll" href="#gold">Gold Forecast</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#webuy">We Buy Diamond</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#how">How To Sell</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#download">Download Pricing</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact Us</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="login.html">Login</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    
    <section class="banner">
    	<div class="container text-center">
    		<h4>Payment in Cash Gold, Silver</h4>
    		<h3>We buy diamond<br />at any size</h3>
    		<a href="tel:16045582026" class="btn call">604-558-2026</a>
    	</div>
    </section>
    <section class="forecast" id="gold">
    	<div class="container text-center">
    		<div class="row">
            	<div class="col-lg-12">
            		<h2>Gold Forecast</h2>
            		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
			        <button type="submit" class="btn body-content mt20">View Now</button>
            	</div>
            </div>
    	</div>
    </section>
    
 	<section class="webuy" id="webuy">
    	<div class="container bg-diamond text-center">
            <div class="row">
            	<div class="col-lg-12">
            		<h2>We buy diamond</h2>
            		<p>Does your old jewellery contain diamonds? Get extra cash by sending your diamond jewellery to us! We are GIA certified diamond buyer in Vancouver and currently looking for any 100% natural diamonds and will pay top dollar for your diamond jewellery.</p>
			        <button type="submit" class="btn body-content mt20">Read More</button>
            	</div>
            </div>
        </div>
    </section>
    
    <section class="logos">
    	<div class="text-center">
    		<div class="images">
    			<img src="/assets/images/m/logo-about.png" width="124" alt="GIA certified"/>
    			
    		</div>
    		<div class="images last">
    			<img src="/assets/images/m/top10.png" />
    		</div>
    	</div>
    </section>
    
    <section class="calculator-section">
    	<div class="tables">
            <h3 class="right">Gold Calculator</h3>
            <div class="calculator">
                <div class="bar-prd">
                    <div class="tabs row" data-tabs="tabs">
                        <a class="active col-md-6" href="#calcGold" aria-controls="calcGold" role="tab" data-toggle="tab">Gold</a>
                        <a class="col-md-6" href="#calcSilver" aria-controls="calcSilver" role="tab" data-toggle="tab">Silver</a>
                    </div>
                </div>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="calcGold">
                        <form id="calcGoldForm" method="post" class="form-horizontal" siq_id="autopick_3487">
                            <input type="hidden" name="type" value="gold">
                            <div class="form-group">
                                <label class="col-xs-3 control-label">Weight</label>
                                <div class="col-xs-5">
                                    <input type="number" class="form-control" name="weight" value="0">
                                </div>
                            
                                <div class="col-xs-4 selectContainer">
                                    <select name="unit" class="form-control arrow">
                                        <option value="oz">Ounce</option>
                                        <option selected="" value="g">Grams</option>
                                        <option value="dwt">DWT (Pennyweight)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">Purity</label>
                                <div class="col-xs-9 selectContainer">
                                    <select name="purity" class="form-control" size="1">
										<option value="1">24k Gold – 99.9%</option>
										<option value="2">22k Gold – 91.6%</option>
										<option value="3">20k Gold – 83.3%</option>
										<option value="4">18k Gold – 75%</option>
										<option value="5">14k Gold – 58.3%</option>
										<option value="6">12k Gold – 50%</option>
										<option value="7">10k Gold – 41.6%</option>
										<option value="8">8k Gold – 33.3%</option>                                            
									</select>
    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label btn calc">Result</label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control result" id="calculatedPrice" kname="" value="$0">
                                </div>
                            </div>
                            <div id="success"></div>
                        </form>
                        <a href="tel:16045582026" class="btn call icon-call">Call for better price</a>
                        <p class="text-center small">Today's Gold Price: $1457.28/oz</p>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="calcSilver">
                        <form id="calcSilverForm" method="post" class="form-horizontal" siq_id="autopick_9481">
                            <input type="hidden" name="type" value="silver">
                            <div class="form-group">
                                <label class="col-xs-3 control-label">Weight</label>
                                <div class="col-xs-5">
                                    <input type="number" class="form-control" name="weight" value="0">
                                </div>
                            <!--</div>-->
                            <!--<div class="form-group">-->
                                <div class="col-xs-4 selectContainer">
                                    <select name="unit" class="form-control arrow">
                                        <option value="oz">Ounce</option>
                                        <option selected="" value="g">Grams</option>
                                        <option value="dwt">DWT (Pennyweight)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label">Purity</label>
                                <div class="col-xs-9 selectContainer">
                                    <select name="purity" class="form-control" size="1">
<option value="1">.999</option><option value="2">Sterling</option><option value="3">SS</option><option value="4">.925</option><option value="5">.830</option><option value="6">.800</option>                                            </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-3 control-label btn calc">Result</label>
                                <div class="col-xs-9">
                                    <input type="text" class="form-control result" id="calculatedPrice" name="" value="$0">
                                </div>
                            </div>
                            <div id="success"></div>
                        </form>
                        <a href="tel:16045582026" class="btn call icon-call">Call for better price</a>
                        <p class="text-center small">Today's Siver Price: $21.39/oz</p>
                    </div>
                </div>
            </div>
            
        </div>
        
    </section>
    
    <section class="howtosell" id="how">
    
    		<div class="row">
    			<div class="col-lg-12 text-center">
	        		<h2>How to sell</h2>
	        		<p class="pb10">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
	        	</div>
    		</div>
    		<div class="panel-group" id="accordion">
			  <div class="panel panel-default">
			    <div class="panel-heading">
			      <h4 class="panel-title">
			        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
			        Gold Rates</a>
			        <i class="indicator fa fa-chevron-up  pull-right"></i>
			      </h4>
			    </div>
			    <div id="collapse1" class="panel-collapse collapse in">
			      <div class="panel-body">
			      	<table class="table table-striped table-hover footable toggle-medium">
	                    <thead>
	                        <tr><th>Scrap Gold</th>
	                        <th class="text-center">Individuals (&lt;100g)</th>
	                        <th class="text-right">Lots (&gt;=100g)</th>
	                    </tr></thead>
	                    <tbody>
	                        <tr>
	                            <td>24k Gold – 99.9%</td>            
	                            <td class="text-center">$37.24/g</td>            
	                            <td class="text-right">$38.00/g</td>            
	                        </tr>
	                        <tr>
	                            <td>22k Gold – 91.6%</td>            
	                            <td class="text-center">$34.11/g</td>            
	                            <td class="text-right">$34.81/g</td>            
	                        </tr>
	                        <tr>
	                            <td>20k Gold – 83.3%</td>            
	                            <td class="text-center">$31.02/g</td>            
	                            <td class="text-right">$31.66/g</td>            
	                        </tr>
	                        <tr>
	                            <td>18k Gold – 75%</td>            
	                            <td class="text-center">$27.93/g</td>            
	                            <td class="text-right">$28.50/g</td>            
	                        </tr>
	                        <tr>
	                            <td>14k Gold – 58.3%</td>            
	                            <td class="text-center">$21.71/g</td>            
	                            <td class="text-right">$22.16/g</td>            
	                        </tr>
	                        <tr>
	                            <td>12k Gold – 50%</td>            
	                            <td class="text-center">$18.62/g</td>            
	                            <td class="text-right">$19.00/g</td>            
	                        </tr>
	                        <tr>
	                            <td>10k Gold – 41.6%</td>            
	                            <td class="text-center">$15.49/g</td>            
	                            <td class="text-right">$15.81/g</td>            
	                        </tr>
	                        <tr>
	                            <td>8k Gold – 33.3%</td>            
	                            <td class="text-center">$12.40/g</td>            
	                            <td class="text-right">$12.65/g</td>            
	                        </tr>
	                    </tbody>
	                 </table>
			      </div>
			    </div>
			  </div>
			  <div class="panel panel-default">
			    <div class="panel-heading">
			      <h4 class="panel-title">
			        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
			        Gold Coin</a>
			        <i class="indicator fa fa-chevron-down  pull-right"></i>
			      </h4>
			    </div>
			    <div id="collapse2" class="panel-collapse collapse">
			      <div class="panel-body">
			      	<table class="table table-striped table-hover footable toggle-medium">
	                    <thead>
	                         <tr>
	                         	<th width="70%">Coin</th>
	                         	<th class="text-right">Buy Price</th>
	                    	</tr>
	                    </thead>
	                    <tbody>
                            <tr>
	                            <td>Canada 1 ounce (9999) Maple Leaf Coins</td>
	                            <td class="text-right">1387.04</td>
	                        </tr>
	                            <tr>
	                            <td>Canada 1 ounce (999) Maple Leaf Coins</td>
	                            <td class="text-right">1358.04</td>
	                        </tr>
	                            <tr>
	                            <td>Canada Maple leaf, less than 1 ounce</td>
	                            <td class="text-right">44.6/g</td>
	                        </tr>
	                    </tbody>
	                 </table>
			      </div>
			    </div>
			  </div>
			  <div class="panel panel-default">
			    <div class="panel-heading">
			      <h4 class="panel-title">
			        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
			        Gold Bars</a>
			        <i class="indicator fa fa-chevron-down  pull-right"></i>
			      </h4>
			    </div>
			    <div id="collapse3" class="panel-collapse collapse">
			      <div class="panel-body">
			      	<table class="table table-striped table-hover footable toggle-medium">
                    	<thead>
	                         <tr><th>Gold Bars</th>
		                         <th class="text-right">Buy Price</th>
		                     </tr>
		                </thead>
	                    <tbody>
	                            <tr>
	                            <td> Gold 1 ounce (Recognized)</td>
	                            <td class="text-right">1358.44</td>
	                        </tr>
	                            <tr>
	                            <td>Gold 10 ounce (Recognized)</td>
	                            <td class="text-right">13512.91</td>
	                        </tr>
	                            <tr>
	                            <td>Gold 1kg (Recognized)</td>
	                            <td class="text-right">43444.01</td>
	                        </tr>
	                            <tr>
	                            <td>Gold bars, less than 1 ounce (Recognized)</td>
	                            <td class="text-right">43.45/g</td>
	                        </tr>
	                            <tr>
	                            <td>999 Gold bar (Unrecognized)</td>
	                            <td class="text-right">42.3/g</td>
	                        </tr>
	                       
	                 	</tbody>
	                 </table>
			      </div>
			    </div>
			  </div>
			  <div class="panel panel-default">
			    <div class="panel-heading">
			      <h4 class="panel-title">
			        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
			        Silver and Platinum</a>
			        <i class="indicator fa fa-chevron-down  pull-right"></i>
			      </h4>
			    </div>
			    <div id="collapse4" class="panel-collapse collapse">
			      <div class="panel-body">
			      	<table class="table table-striped table-hover footable toggle-medium">
	                    <thead>
	                         <tr><th width="70%">silver jewellery and other siver</th>
	                         <th class="text-right">Price</th>
	                     </tr></thead>
	                    <tbody>
	                            <tr>
	                            <td>Silver Bars 1 ounce (Recognized)</td>
	                            <td class="text-right">18.47/g</td>
	                        </tr>
	                            <tr>
	                            <td>Silver Bars 10 ounce (Recognized)</td>
	                            <td class="text-right">182.72/g</td>
	                        </tr>
	                            <tr>
	                            <td>Maple Leaf (1 ounce Silver)</td>
	                            <td class="text-right">19.24/coin</td>
	                        </tr>
	                            <tr>
	                            <td>Stamped Sterling Silver Flatware</td>
	                            <td class="text-right">0.4/g</td>
	                        </tr>
	                            <tr>
	                            <td>Stamped Sterling Silver Jewellery</td>
	                            <td class="text-right">0.37/g</td>
	                        </tr>
	                            <tr>
	                            <td>Mexican Silver stamped 925</td>
	                            <td class="text-right">0.31/g</td>
	                        </tr>
	                            <tr>
	                            <td>Stamped 800 Silver</td>
	                            <td class="text-right">0.3/g</td>
	                        </tr>
	                            <tr>
	                            <td>Unstamped scrap silver</td>
	                            <td class="text-right">0.2/g</td>
	                        </tr>
	                            <tr>
	                            <td>Other silver coins</td>
	                            <td class="text-right">0.42/g</td>
	                        </tr>
	                        
	                 </tbody></table>
			      </div>
			    </div>
			  </div>
			</div>
    	</div>
    </section>
    
    <section class="download-section" id="download">
    	<div class="tables">
			<h3>Download pricing</h3>
			<div class="downloadForm">
		        <form class="form-horizontal" accept-charset="UTF-8" id="downloadForm" novalidate="" siq_id="autopick_3384">
				    <div class="form-group">
						<label class="control-label">First Name</label>
						<div class="input-theme">
						    <input type="text" class="form-control" placeholder="Your Name" id="name" name="name" required="" data-validation-required-message="Please enter your name." aria-invalid="false">
				            <p class="help-block text-danger"></p>
						</div>
					</div>
				    <div class="form-group">
				        <label class="control-label">Email Address</label>
				        <div class="input-theme">
						    <input type="text" class="form-control" placeholder="Email Address" id="email" name="email" required="" data-validation-required-message="Please enter your mail." aria-invalid="false">
				        	<p class="help-block text-danger"></p>
						</div>
				    </div>
				    
				    <a href="javascript:void(0);" class="btn download" style="cursor: pointer;"><span>Download</span></a>
				    <input type="hidden" name="action" value="ajax_download">
				    <input type="hidden" name="security" value="44d77d821d">
				    <input type="hidden" id="thanks" value="/thank/download/">
				</form>
				<p class="text-center small pl30 pr30">Enter your name and email above and click "DOWNLOAD!"</p>
			</div>
		</div>
	
    </section>
    
 	
 	
    <section class="p0 map-contact" id="contact">
    	<div class="row">
			<div class="col-lg-12 text-center">
        		<h2>Contact us</h2><br />
        	</div>
		</div>
    	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2605.3300847240066!2d-123.02873989999999!3d49.23223069999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5486768de1f9f631%3A0x6a8a503abb839809!2s3515+Kingsway%2C+Vancouver%2C+BC+V5R+5L8%2C+Canada!5e0!3m2!1svi!2s!4v1436262766642" width="100%" height="192" frameborder="0" style="border:0" allowfullscreen></iframe>
    </section>
	
	<section class="place-ct">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-4">
	                <div class="row">
	                    <div class="col-md-3 text-center">
	                        <i class="fa icon-place-lg"></i>
	                    </div>
	                    <div class="col-md-9 text-center">
	                        <p>3515 Kingsway,<br>Vancouver, BC V5R 5L8 The Canada</p>
	                    </div>
	                </div>
	            </div>
	            <div class="col-md-4">
	                <div class="row">
	                    <div class="col-md-3 text-center">
	                        <i class="fa icon-phone-lg"></i>
	                    </div>
	                    <div class="col-md-9  text-center">
	                        <p>Phone: <a href="16044494798">(604) 449-4798</a></p>
	                        <p class=""><i class="icon-phone-call"></i><a href="16044494798">(778) 882-8908</a></p>
	                    </div>
	                </div>
	            </div>
	            <div class="col-md-4">
	                <div class="row">
	                    <div class="col-md-3 text-center">
	                        <i class="fa icon-clock-lg"></i>
	                    </div>
	                    <div class="col-md-9 text-center">
	                        <p>Mon - Fri: 10:00 am – 6:00 pm</p>
							<p>Saturday: 10:00 am – 5:00 pm</p>
							<p class="email">
								<i class="icon-email-small"></i>
								<a href="mailto:info@vancouvercashforgold.com?Subject=Hello">info@vancouvercashforgold.com</a>
							</p>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
    <footer>
        <div class="container pt20">
            <div class="row">
                <div class="col-md-6 text-center">
                    <span class="copyright">Copyright Vancouver Cash for Gold 2016</span>
                </div>
            </div>
        </div>
    </footer>
   
   <script type="text/javascript">
     $(document).ready(function(){

			$('.tabs a').click(function(){
				var tab_id = $(this).attr('data-tab');
		
				$('.tabs a').removeClass('active');
				$('.tab-content').removeClass('current');
		
				$(this).addClass('active');
				$("#"+tab_id).addClass('active');
			})
			
			$('#accordion .accordion-toggle').click(function (e){
			  var chevState = $(e.target).siblings("i.indicator").toggleClass('fa-chevron-up fa-chevron-down');
			  $("i.indicator").not(chevState).removeClass("fa-chevron-up").addClass("fa-chevron-down");
			});
		
		})
	</script>

</body>

</html>
