{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}	
<!--{include file='content_header.tpl'}-->
	<!--		{include file='dashboard/status.tpl'}-->

<script>
jQuery(document).ready(function(){
    jQuery('.msglist li').click(function(){
        jQuery('.msglist li').each(function(){ jQuery(this).removeClass('selected')});
        jQuery(this).addClass('selected');
		
        
        // for mobile
        jQuery('.msglist').click(function(){
            if(jQuery(window).width() < 480) {
                jQuery('.messageright, .messagemenu .back').show();
                jQuery('.messageleft').hide();
            }
        });
        
        jQuery('.messagemenu .back').click(function(){
            if(jQuery(window).width() < 480) {
                jQuery('.messageright, .messagemenu .back').hide();
                jQuery('.messageleft').show();
            }
        });
    });
});
</script>

			
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Messages</li>
		{if $logged_in == 1}
		<li class="right">
			Last login: {$lastlogin}<br />IP address: {$lastip}
		</li>
		
		{/if}
	</ul> 
	<div class="maincontent">
        <div class="maincontentinner">
			<div class="row">
				<div id="dashboard-left" class="col-md-12">
		<div class="pageheader">
			<div class="searchbar">Total Account Balance : {$balance} <br>Available Account Balance : {$tbalance}</div>
            <div class="pageicon"><span class="iconfa-laptop"></span></div>
            <div class="pagetitle">
                <h5></h5>
                <h1>Messages</h1>
            </div>
        </div>
<div class="box_wide box_withsidebar box-info">
		<div id="page">				
			<div class="information">
				
				<!--<h4>Advanced Features</h4>-->
				
				
				<div class="tabfield">
					
					<div class="tab setup messages" style="display:block">
						
						<h4 class="widgettitle">Messages for {if $selectedcellalias != null}{$selectedcellalias}, {App_DataUtils::fmtphone($selectedcellphone)}{else}{App_DataUtils::fmtphone($selectedcellphone)}{/if}.</h4>
						<div class="widgetcontent" >
						
						
							
								
								<div>
									<div class="maincontentinner">
                <div class="messagepanel">
                    <div class="messagehead">
                        <button class="btn btn-success btn-large">Compose Message</button>
                    </div><!--messagehead-->
                    <div class="messagemenu">
                        <ul>
                            <li class="back"><a><span class="iconfa-chevron-left"></span> Back</a></li>
                            <li class="active"><a href=""><span class="iconfa-inbox"></span> Inbox</a></li>
                           <!-- <li><a href=""><span class="iconfa-plane"></span> Sent</a></li>
                            <li><a href=""><span class="iconfa-edit"></span> Draft</a></li>
                            <li><a href=""><span class="iconfa-trash"></span> Trash</a></li>-->
                        </ul>
                    </div>
					
                    <div class="messagecontent">
                        <div class="messageleft">
                            <form class="messagesearch">
                                <input type="text" class="form-control" placeholder="Search message and hit enter..." />
                            </form>
							
                            <ul class="msglist">
								{foreach from=$msgs item=v name=msgs_loop}
                                <li class="">
								<a href="">
                                    <div class="thumb"><img src="images/photos/thumb1.png" alt="" /></div>
								
                                    <div class="summary">
									
                                        <span class="date pull-right"><small></small></span>
										
                                      <a href="#{$v.subject}">  <h4>{$v.subject}</h4> </a>
                                        <p><strong></strong></p>
										
                                    </div>
									</a>
                                </li>
								{foreachelse}
		                      	<div>
		                       		<div><em>There are no messages associated with this cell phone.</em></div>
		                       	</div>
							{/foreach}
							</ul>
							
                        </div><!--messageleft-->
						
                        <div class="messageright">
                            <div class="messageview">
                             {foreach from=$msgs item=v name=msgs_loop}
                                <div id="{$v.subject}" class="show">
                                <h1 class="subject"></h1>
                                <div class="msgauthor" style="background: none repeat scroll 0px 0px #DDD;" >
                                    <div class="thumb"><img src="images/photos/thumb1.png" alt="" /></div>
									
                                    <div class="authorinfo" >
                                        <span class="date pull-right">
										<h5><strong>Messages for : {if $selectedcellalias != null}{$selectedcellalias}</strong> <span></span></h5>
										<span class="to">{App_DataUtils::fmtphone($selectedcellphone)}{else}{App_DataUtils::fmtphone($selectedcellphone)}{/if}</span>
										</span>
										
                                        subject : <strong>{$v.subject}</strong>
                                        
                                    </div><!--authorinfo-->
                                </div><!--msgauthor-->
                                
                                <div class="msgbody">
                                     <p>{$v.message}</p>
                                </div><!--msgbody-->
								
								</div>
                                {foreachelse}
		                      	<div>
		                       		<div><em>There are no messages associated with this cell phone.</em></div>
		                       	</div>
							{/foreach}
                            </div><!--messageview-->
                            
                     
                        </div><!--messageright-->
						
						
                    </div><!--messagecontent-->
                </div><!--messagepanel-->
                
               
                
            </div><!--maincontentinner-->
						
							
						</div>
						
						<!--<div class="dtable">
							<div class="dhead">
								<div class="drow">
									<div class="dcol col1">Subject</div>
								</div>
							</div>
							<div class="dbody">
								{foreach from=$msgs item=v name=msgs_loop}
									<div id="{$v.id}" class="drow{if $smarty.foreach.msgs_loop.index%2} drowalt{/if}">
									
										<div class="dextend">
											<div class="expandarrow"></div>
											<div class="expandtype transactionbox">
												<h4>{$v.subject}</h4>
												<p>{$v.message}</p>
												<tr class="rowactions">
													<td><a href="{$formbase}advanced/messagesdelete/C/{$item}/M/{$v.id}"><input type="button" class="btn btn-info" value="Delete"/></a></td>
												</tr>
											</div>
										</div>
									</div>
								{foreachelse}
		                        	<div class="drow">
		                        		<div class="dcol"><em>There are no messages associated with this cell phone.</em></div>
		                        	</div>
								{/foreach}
							</div>
						</div>-->
						<div>
						{if count($msgs) > 0}
							<tr class="rowactions">
								<td><a href="{$formbase}advanced/messagesdelete/C/{$item}/M/all"><input type="button" class="btn btn-info" value="Delete all"/></a></td>							</tr>
						{/if}
					</div>	
					
					</div>
					
				</div>
				
			</div>
				</div>
				
			</div>
	
{include file='footer.tpl'}
