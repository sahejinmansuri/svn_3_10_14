{include file='header.tpl'}
{include file='error.tpl'}
	
	<div class="box_wide">
		<div id="page">
			

                <div id="signup" class="formlayout">

				<form action="{$formbase}dashboard/savequestions" method="post">

					<div class="stepbox">
						
						<div class="notes">
							<h3>Please provide 3 Security Questions</h3>
						</div>
						
                        {foreach from=$questionsArr item=ques}
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
                                    <label for="question">{$ques.answer}</label>
                                {else}
                                    <input type="text" name="answer_{$ques.rec_num}" id="answer" maxlength="15" value="{$ANSWER}" />
                                    <p class="tip">Enter security answer</p>
                                 {/if}
                            </div>
                            <div style="clear:both;border-top: 1px solid #CCCCCC;"></div><br/>
                        {/foreach}

                    </div>


					<div class="submit">
						<div class="notes">
							<input type="submit" value="Save Questions" id="register" />
                            <a href="{$formbase}dashboard/questionslater">Remind me later</a>
						</div>
					</div>
					
				</form>


                </div>


            
		</div>
	</div>
	
{include file='footer.tpl'}