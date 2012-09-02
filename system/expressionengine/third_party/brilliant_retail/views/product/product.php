<?php
/************************************************************/
/*	BrilliantRetail 										*/
/*															*/
/*	@package	BrilliantRetail								*/
/*	@Author		David Dexter  								*/
/* 	@copyright	Copyright (c) 2010-2012						*/
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
	
	$cp_pad_table_template["table_open"] = '<table id="productTable" cellpadding="0" cellspacing="0" class="product_edit" width="100%">';
	
	$this->table->set_template($cp_pad_table_template);

	$this->table->set_heading(
							array(
						    		'data' 	=> lang('br_product_id'), 
						    		'width' => '10%'),
						    array(
						    		'data' 	=> lang('br_title'), 
						    		'width' => '*'), 
						    array(
						    		'data' 	=> lang('br_sku'), 
									'width' => '10%'),
						   	array(
						    		'data' 	=> lang('br_qty'), 
									'width' => '10%'),
						   	array(
						    		'data' 	=> lang('br_type'), 
									'width' => '15%'),
							array(
						    		'data' 	=> lang('status'), 
						    		'width' => '10%px'),
						   	array(
						    		'data' 	=> '<input type="checkbox" id="toggle_check" />', 
									'style' => 'text-align:center',
									'width' => '5%')
						   );
	$content = $this->table->generate();
?>
<div id="b2r_page" class="b2r_category">
    <?=form_open_multipart('&D=cp&C=addons_modules&M=show_module_cp&module=brilliant_retail&method=product_batch',array('method' => 'POST', 'id' => 'productForm'))?>
        <div id="filterMenu"> 
			<fieldset>
				<legend>Search Products</legend> 
            	<select id="filter" style="margin-top:5px;margin-left:10px;">
            		<option value=""><?=lang('br_filter_by_category')?></option>
            		<?php
            		 	foreach($categories as $c) 
            		 	{ 
            		 		$selected = ($c['category_id']==$catid) ?  'selected="selected"' : '';
            		 		echo '<option value="'.$c['category_id'].'" '.$selected.' >'.$c['title'].'</option>';
            		 	} 
            		 ?>
            	</select>
			</fieldset> 
		</div>								
    	<div class="b2r_clearboth"><!-- --></div>
        <?=$content?>
		<div id="bottom_buttons">
    		<select id="action" name="action">
        		<option value="">------------</option> 
        		<option value="0"><?=lang('br_delete_selected_products')?></option>
        		<option value="1"><?=lang('br_enable_selected_products')?></option>
        		<option value="2"><?=lang('br_disable_selected_products')?></option>
        	</select>
        	<?=form_submit(array('name' => 'submit', 'value' => lang('submit'), 'class'=>'submit', 'id' => 'batch_submit'))?>
    	</div>
	</form>
</div> <!-- b2r_dashboard --> 

<?=$br_footer?>
  
<script type="text/javascript">
	$(function(){
		var oTable = $('#productTable').dataTable({
													"iDisplayLength": 25, 
													"aoColumns"	: [
																		{ "asSorting": [ "desc", "asc" ] }, 
																		null,
																		null,
																		null,
																		null,
																		null,
																		{ "bSortable": false }
																	], 
													"bProcessing": true,
													"bServerSide": true,
													"sAjaxSource": "<?=str_replace("&amp;","&",$ajax_url)?>", 
													"fnDrawCallback": function() {
														$('#toggle_check').click(function(){
															if(this.checked){
																$('input[type=checkbox]').attr('checked','checked');
															}else{
																$('input[type=checkbox]').each(function() {  
																	this.checked = false;  
																});  
															}
														});
													}
													
													});
		$('<p class="b2r_search_btn"><a href="#" id="clear" class="submit"><b><?=lang('br_clear')?></b></a></p>').insertBefore('#productTable_filter input');
		$('#clear').click(function(){
										oTable.fnFilterClear();
										return false
									});
		
		$('#filter').change(function(){
			location.href="<?=$base_url;?>&D=cp&C=addons_modules&M=show_module_cp&module=brilliant_retail&method=product&cat_id="+$("#filter").val();
		})
		
		$('#batch_submit').bind('click',function(){
			var val = $('#action').val();
			var message = Array(3);
			message[0] = '<?=lang('br_confirm_batch_delete')?>';
			message[1] = '<?=lang('br_confirm_batch_enable')?>';
			message[2] = '<?=lang('br_confirm_batch_disable')?>';
			if(val == ''){
				alert('<?=lang('br_batch_action_required')?>');
				return false;
			}
			if(confirm(message[val])){
				return true;
			}else{
				return false;
			}
		});
	});
</script>