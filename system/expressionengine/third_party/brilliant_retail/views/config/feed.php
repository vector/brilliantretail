<?php
/************************************************************/
/*	BrilliantRetail 										*/
/*															*/
/*	@package	BrilliantRetail								*/
/*	@Author		David Dexter 								*/
/* 	@copyright	Copyright (c) 2011, Brilliant2.com 			*/
/* 	@license	http://brilliantretail.com/license.html		*/
/* 	@link		http://brilliantretail.com 					*/
/*															*/
/************************************************************/
/* NOTICE													*/
/*															*/
/* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF 	*/
/* ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED	*/
/* TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A 		*/
/* PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT 		*/
/* SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY */
/* CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION	*/
/* OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR 	*/
/* IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER 		*/
/* DEALINGS IN THE SOFTWARE. 								*/	
/************************************************************/
?>
<div id="b2r_page" class="b2r_category">
	<table id="feeds_tbl" class="mainTable" cellspacing="0" cellpadding="0">
		<tr>
			<th style="width:160px"><?=lang('br_feed_title')?></th>
			<th><?=lang('br_feed_code')?></th>
			<th style="width:60px"><?=lang('br_products')?></th>
		</tr>
	<?php
	if( count($feeds) > 0 ){
		foreach($feeds as $f){
			echo '	<tr>
						<td><a href="'.$base_url.'&method=config_feeds_edit&feed_id='.$f['feed_id'].'">'.$f['feed_title'].'</a></td>
						<td>'.$f['feed_code'].'</td>
						<td>'.$f['feed_product_count'].'</td>
					</tr>';							
		} 
	}else{
			echo '	<tr class="odd">
						<td colspan="3">
							'.lang('br_config_no_feeds').'</td
					</tr>';
	}
	?>
	</table>
</div>
<script type="text/javascript">
$(function(){
	$('#feeds_tbl').tablesorter();
});
</script>
<div class="b2r_clearboth"><!-- --></div>                        