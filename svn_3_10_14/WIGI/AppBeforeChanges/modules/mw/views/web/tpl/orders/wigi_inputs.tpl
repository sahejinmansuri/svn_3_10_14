						<form action="{$formbase}orders/wigic" method="get">
							<ul class="filter">
								<li>
									<p><strong>Select Source Transaction Type</strong></p>
									<ul class="withlabels">
										<li>
                                        <select name="typecode" style="width:120px;">
                                               <option value="">Select..</option>
                                                {foreach from=$typelist key=k item=v}
                                                   <option value="{$k}">{$k}&nbsp;|&nbsp;{$v}</option>
                                                {/foreach}                        
                                        </select>
                                        </li>
									</ul>
								</li>

								<!--<li>
									<p><strong>Select A User Setting</strong></p>
									<ul class="withlabels">
										<li>
											<select name="userdata" style="width:120px;">
											       <option value="">Select..</option>
												   <option value="100-F-75|101-P-0.95|">User 1: 100-F-75|101-P-0.95|</option>
												   <option value="100-F-75|101-F-0.95|">User 2: 100-F-75|101-F-0.95|</option>
												   <option value="101-P-2|102-P-0.95|">User 2: 101-P-2|102-P-0.95|</option>
												   <option value="101-F-20|102-P-0.2|">User 2: 101-F-20|102-P-0.2|</option>
												   <option value="100-P-0.2|102-P-2.0|">User 2: 100-P-0.2|102-P-2.0|</option>
											</select>
										</li>
									</ul>
								</li>-->

                                
								<li>
									<p><strong>Enter Transaction Amount</strong></p>
									<ul>
										<li><input type="text" name="trans_amount" value="" maxlength="10" style="width:90px;"/></li>
									</ul>
								</li>
								<li class="submit">
									<input type="submit" name="" value="Calculate" />
								</li>
							</ul>
						</form>

