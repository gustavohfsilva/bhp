<?php
include "head.php";
include "config.php";
?>

<div id="modal-form-compra" class="modal" tabindex="-1">
										<form method="post">
											<div class="modal-dialog ">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="blue bigger">Compra</h4>
													</div>

													<div class="modal-body">
														<div class="row">
															<div class="col-xs-12 col-sm-7">
															
																<div>
																	<label for="form-field-mask-4">
																		Valor
																		
																	</label>

																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="ace-icon fa fa-money"></i>
																		</span>

																		<input class="input-mask-valor" type="number" name="valor" id="form-field-mask-4" required/>
																	</div>
																</div>

																<div class="space-4"></div>
																		
																<div class="form-group">
																	<label class="col-sm  " for="form-field-1">Forma de Pagamento</label>
																	<div>
																		<select name="pagamento" id="pagamento" required="">
																			<option></option>
																			<?php
																			$sql = "SELECT * FROM f_pagamento where fpg_ativo='1' ORDER BY fpg_nome ASC";
																						$qry = mysqli_query($conn, $sql);

																								while($ar = mysqli_fetch_array($qry)){
																												$fpg_id = $ar["fpg_id"];
																												$f_pagamento = $ar["fpg_nome"];	
																												$f_pagamento = utf8_encode($f_pagamento);
																			?>
																			
																			<option  value="<?php echo $fpg_id ?>"><?php echo $f_pagamento?></option>
																								
																			<?php }?>
																		</select>
																	</div>
																</div>
																
																<input type="hidden" name="id" id="form-field-username"  value="<?php echo $_GET["fichas"]?>"/>	
															</div>
															
														</div>
														
													</div>

													<div class="modal-footer">
														<button class="btn btn-sm" data-dismiss="modal">
															<i class="ace-icon fa fa-times"></i>
															Cancel
														</button>

														<button name="compra" value="compra" class="btn btn-sm btn-primary">
															<i class="ace-icon fa fa-check"></i>
															Salvar
														</button>
													</div>
												</div>
											</div>
										</form>
									</div><!-- PAGE CONTENT ENDS -->