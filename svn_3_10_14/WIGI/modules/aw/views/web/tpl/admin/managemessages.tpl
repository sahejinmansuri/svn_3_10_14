<h4>
<span class="icons2">
    <span class="ui-state-default2 bgrey ui-corner-all">
        <span class="ui-icon-circle-triangle-e ui-icon ugrey"></span>
    </span>
</span>&nbsp;Messages
</h4>
        <div class="dtable">
            <div class="dhead">
                <div class="drow">
                    <div class="dcol" style="width:50px;">&nbsp;</div>
                    <div class="dcol">Subject</div>
                    <!--<div class="dcol summarycol3">Status</div>-->
                </div>
            </div>
            <div class="dbody">
                {foreach from=$manage_messages item=data}
                    <div class="drow drowalt">
                        <div class="dnormal">
                            <div class="dcol" style="width:50px;" onClick="toggleS('{$data.message_id}');">
                                <span class="icons2"><span class="ui-state-default2 bgreen ui-corner-all"><span id="c_{$data.message_id}" class="ui-icon-plus ui-icon ugreen"></span></span></span>
                            </div>
                            <div class="dcol" {if $data.msg_status=='UR'}font-weight:bold;{/if}">{$data.subject}</div>
                            <!--<div class="dcol summarycol3">{$data.status}</div>-->
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <div id="{$data.message_id}" style="display:none;padding:10px;background:#E4F5C8;padding:4px;">
                            <div class="recrow2"> 
                                <a href="{$formbase}admin/editmessage/MSGID/{$data.message_id}">Edit</a>
                            </div>
							<div class="recrow3"> 
                                <a href="{$formbase}admin/deletemessage/MSGID/{$data.message_id}">Delete</a>
                            </div>
							<div class="recrow1"> 
                                {$data.message}
                            </div>
							
                    </div>
                    <div style="clear:both;"></div> 

                {foreachelse}
                {/foreach}

           </div>
    </div>

<ul class="actionlinks">
	<li><a href="{$formbase}admin/addmessage">Add new</a></li>
</ul>
<div style="clear:both;"></div>
{literal}
<script>
function toggleS(div)
{
$('#'+div).toggle();
$('#c_'+div).toggleClass('ui-icon-minus');
}
</script>
<style>
.recrow1 {
  /*float: left;*/
  margin: 4px;
  padding: 4px;
  width: 450px;
}
.recrow2{
	margin:4px;
	padding:4px;
	float: left;
}
.recrow3{
	margin:4px;
	padding:4px;
}
.recrow2 a, .recrow3 a{
	background: -moz-linear-gradient(center top , #006BC6 5%, #006BC6 100%) repeat scroll 0 0 #006BC6;
	border: 1px solid #006BC6;
	border-radius: 3px;
	box-shadow: 0 0 0 -28px #006BC6 inset;
	color: #FFFFFF !important;
	display: inline-block;
	font-family: arial;
	font-size: 13px;
	font-weight: bold;
	margin-bottom: 4px;
	padding: 2px 11px;
	text-decoration: none;
}
</style>
{/literal}