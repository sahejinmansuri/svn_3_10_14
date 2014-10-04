{include file='header.tpl'}
{include file='error.tpl'}
{include file='sidebar.tpl'}	
<!--{include file='content_header.tpl'}-->
<div class="rightpanel">
	<ul class="breadcrumbs">
		<li><a href="{$formbase}dashboard/home"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
		<li>Security Questions</li>
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
			<!--<div class="searchbar">Total Account Balance : {$balance} <br>Available Account Balance : {$tbalance}</div>-->
            <div class="pageicon"><span class="iconfa-laptop"></span></div>
            <div class="pagetitle">
                <h5></h5>
                <h1>Security Questions</h1>
            </div>
        </div>
	
	<div class="box_wide box_withsidebar">
		<div id="page">		

                <div id="signup" class="formlayout box-info">

				<form action="{$formbase}dashboard/savequestions" method="post" class="stdform">

				  <div class="stepbox">
					<h4 class="widgettitle">Please provide 3 Security Questions</h4>
					<div class="widgetcontent"> 
						
										
                                            
						
                        {foreach from=$questionsArr item=ques}
							
							<div class="form-group">
								<label class="col-md-4 control-label">Security Question {$ques.rec_num} : </label>
								<div class="col-md-4">
								  {if $ques.question !=''}
									<span class="profile_detail">{$ques.question}</span>
                                    
                                {else}
                                    <select name="question_{$ques.rec_num}" id="question"><option value="">Choose...</option>{foreach name=questions_loop from=$questions item=q}<option value="{$q}">{$q}</option>{/foreach}</select>
                                    <small class="desc">Choose a security question</small>
                                {/if}
								</div>
                            </div>
							<div class="form-group">
								<label class="col-md-4 control-label">Security Answer {$ques.rec_num} : </label>
								<div class="col-md-4">
								  
								  {if $ques.answer}
                                    <span class="profile_detail">****</span>
                                {else}
                                    <input type="text" name="answer_{$ques.rec_num}" id="answer" maxlength="15" value="{$ANSWER}" />
                                    <small class="desc">Enter security answer</small>
                                 {/if}
								 
								</div>
                            </div>
						{/foreach}
						
					<div class="submit">
						<div class="notes">
							<input type="submit" value="Save Questions" id="register" class="btn btn-info" />
                            <a href="{$formbase}dashboard/questionslater" class="btn btn-info"><small>Remind me later</small></a>
						</div>
					</div>
						
						<!--{foreach from=$questionsArr item=ques}	
                            <div class="prompt question">
                                <label for="question">Security Question {$ques.rec_num}</label>
                                {if $ques.question !=''}
                                    <label for="question">{$ques.question}</label>
                                {else}
                                    <select name="question_{$ques.rec_num}" id="question"><option value="">Choose...</option>{foreach name=questions_loop from=$questions item=q}<option value="{$q}">{$q}</option>{/foreach}</select>
                                    <p class="tip">Choose a security question</p>
                                {/if}
                            </div>
                            <div class="prompt answer">
                                <label for="answer">Security Answer {$ques.rec_num}</label>
                                {if $ques.answer}
                                    <label for="question">****</label>
                                {else}
                                    <input type="text" name="answer_{$ques.rec_num}" id="answer" maxlength="15" value="{$ANSWER}" />
                                    <p class="tip">Enter security answer</p>
                                 {/if}
                            </div>
                            <div style="clear:both;border-top: 1px solid #CCCCCC;"></div><br/>
                        {/foreach}-->

                    </div>
                    </div>


					
				</form>


                </div>
                </div>
                </div>


           
{include file='footer.tpl'}