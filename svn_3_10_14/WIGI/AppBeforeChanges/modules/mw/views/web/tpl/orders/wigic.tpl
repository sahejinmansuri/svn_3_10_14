{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide box_withsidebar">
		
		{include file='sidebar.tpl'}
		
		<div id="page">

        {include file='orders/wigishare.tpl'}

			<div class="information">
				
				<div class="tabfield">
					
					<div class="tab setup scanandpay">

                    {include file='orders/wigi_inputs.tpl'}

                                                
							<ul class="filter">
								<li>
									<p><strong>Source Transaction Type</strong></p>
									<ul class="withlabels">
										<li>{$typecode}</li>
									</ul>
								</li>

								<li>
									<p><strong>Select A User Setting</strong></p>
									<ul class="withlabels">
										<li>{$userdata}</li>
									</ul>
								</li>

                                
                                <li>
									<p><strong>Enter Transaction Amount</strong></p>
									<ul>
                                        <li>${$trans_amount}</li>
									</ul>
								</li>

							</ul>

                            <br/><br/>
                            <div style="width:98%;font-size:18px;color:black;font-weight:bold;background:#c3c3c3;margin:5px;padding:5px;">
                               Wigi Charge is:  ${$wigicharge}
			       <br/>
                               Wigi Charge Description is:  {$wigichargedesc}
                            </div>
					
				</div>
				
			</div>
			
		</div>

	  </div>
		
	</div>
	
{include file='footer.tpl'}
