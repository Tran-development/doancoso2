
<div id="page-wrapper" class="bg-silver" >

            <div>
            	<?php if (DEMO) {?>
               <div class="row">
	               	<div class='col-md-6'>
						<div class='alert alert-info'>
							<strong>Info!</strong> CRUD operations disabled in DEMO
						</div>
					</div>
				</div>	
			<?php } ?>


				<div class="row">
			   
			   <?php echo $this->session->flashdata('message');?>
			   
					<div class="col-md-4 col-lg-3">
					<a href="<?php echo URL_MENU_INDEX;?>" title="<?php echo get_languageword('menu');?>">
                        <div class="media stats-media-white bg-white">
                            <div class="media-left">
                                <img src="<?php echo FRONT_IMAGES;?>restaurant.svg" width="50" height="50" alt="Menu">
                            </div>
                            <div class="media-body text-right">
                                <p><?php echo get_languageword('menu');?></p>
                                <h4><?php if(isset($modules_count->menu_count)) echo $modules_count->menu_count;?></h4>
								
                            </div>
							
							
                        </div>
					</a>	
                    </div>
					
					
                    <div class="col-md-4 col-lg-3">
					<a href="<?php echo URL_ITEMS_INDEX;?>" title="<?php echo get_languageword('items');?>">
                        <div class="media stats-media-white bg-white">
                            <div class="media-left">
                                <img src="<?php echo FRONT_IMAGES;?>dashboard-fast-food.svg" width="50" height="50" alt="Items">
                            </div>
                            <div class="media-body text-right">
                                <p> <?php echo get_languageword('items');?></p>
                                <h4><?php if(isset($modules_count->items_count)) echo $modules_count->items_count;?></h4>
                            </div>
                        </div>
					</a>	
                    </div>
					
					
                    <div class="col-md-4 col-lg-3">
					<a href="<?php echo URL_ADDONS_INDEX;?>" title="<?php echo get_languageword('addons');?>">
                        <div class="media stats-media-white bg-white">
                            <div class="media-left">
                                <img src="<?php echo FRONT_IMAGES;?>dashboard-condiment.svg" width="40" height="40" alt="Addons">
                            </div>
                            <div class="media-body text-right">
                                <p><?php echo get_languageword('addons');?></p>
                                <h4><?php if(isset($modules_count->addons_count)) echo $modules_count->addons_count;?> </h4>
                            </div>
                        </div>
					</a>	
                    </div>
					
					
					
                    <div class="col-md-4 col-lg-3">
					<a href="<?php echo URL_OPTIONS_INDEX;?>" title="<?php echo get_languageword('options');?>">
                        <div class="media stats-media-white bg-white">
                            <div class="media-left">
                                <img src="<?php echo FRONT_IMAGES;?>dashboard-pizza.svg" width="50" height="50" alt="Options">
                            </div>
                            <div class="media-body text-right">
                                <p><?php echo get_languageword('options');?></p>
                                <h4><?php if(isset($modules_count->options_count)) echo $modules_count->options_count;?></h4>
                            </div>
                        </div>
					</a>	
                    </div>
					
					
                
				
					
                
				
                <div class="col-md-4 col-lg-3">
				 <a href="<?php echo URL_CUSTOMERS_INDEX;?>" title="<?php echo get_languageword('customers');?>">
					<div class="media stats-media-white bg-white">
						<div class="media-left">
							<img src="<?php echo FRONT_IMAGES;?>dashboard-network.svg" width="50" height="50" alt="Customers">
						</div>
						<div class="media-body text-right">
							<p><?php echo get_languageword('customers');?></p>
							<h4><?php if(isset($modules_count->users_count)) echo $modules_count->users_count;?></h4>
						</div>
					</div>
				  </a>		
                 </div>
					
					
                
                <div class="col-md-4 col-lg-3">
				 <a href="<?php echo URL_ORDERS_INDEX;?>" title="<?php echo get_languageword('new_orders');?>">
					<div class="media stats-media-white bg-white">
						<div class="media-left">
							<img src="<?php echo FRONT_IMAGES;?>dashboard-list.svg" width="50" height="50" alt="Orders">
						</div>
						<div class="media-body text-right">
							<p><?php echo get_languageword('new_orders');?></p>
							<h4><?php if(isset($modules_count->orders_count)) echo $modules_count->orders_count;?></h4>
						</div>
					</div>
					</a>		
                   </div>
					
					
                
                
					
					
					
                </div>
				
				
          
<div class="clearfix"></div>
     
               
                <div class="row">
				
			
				<div class="col-md-12">
					<div class="panel panel-default">
                        <div class="panel-heading"> <?php echo get_languageword('orders');?> </div>
                        <div class="panel-body">
                 <div id="bar_chart"></div>
                 </div>
             </div>
				 
				</div>
	

				</div>

           </div>   

    </div>

             <!--/.PAGE INNER-->

            </div>

        
		 

<script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/loader.js"></script>

<!--script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script-->

<script type="text/javascript">
	// Load the Visualization API and the line package.
	google.charts.load('current', {'packages':['bar']});
	// Set a callback to run when the Google Visualization API is loaded.
	google.charts.setOnLoadCallback(drawChart);
	 
	function drawChart() {
	  $.ajax({
		type: 'POST',
		url: '<?php echo base_url();?>admin/orders_summary',
		success: function (data1) {
		  var data = new google.visualization.DataTable();
		  
		 
		  //Parse data into Json
		   var jsonData = $.parseJSON(data1);
			 
		   var curnt_year = jsonData[12];
		   
		  
		  // Add legends with data type
		  data.addColumn('string', 'Year-Month'+' '+curnt_year);
		  data.addColumn('number', 'Amount ('+'<?php echo $this->config->item('site_settings')->currency_symbol;?>'+')');
		  //data.addColumn('number', 'Expense');
		  
		  	 if (jsonData.length>0) {
				 for (var i = 0; i < 12; i++) {
				   data.addRow([jsonData[i].month, parseInt(jsonData[i].amount)]);
				 }
			 }
			 
			 
			 var options = {
        chart: {
          title: 'Orders Summary'
          //subtitle: 'Show Sales and Expense of Company'
        },
        width: 900,
        height: 600,
        axes: {
          x: {
            0: {side: 'bottom'}
          }
		  
        }
		
		
      };
      var chart = new google.charts.Bar(document.getElementById('bar_chart'));
      chart.draw(data, options);
	  
	  
				 
		}
	  });
	}
</script>		  