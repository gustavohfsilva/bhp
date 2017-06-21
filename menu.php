
<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed');}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed');}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				
					<li class="<?php //if($sec=="Dashboard") echo "active open"; ?>">
						<a href="dashboard">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>

                                        <li class="<?php if ($sec == "Cadastros") {
                                            echo "active open";
                                        }
                                        ?>">
						<a href="cadastro">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> Cadastro </span>
						</a>

						<b class="arrow"></b>
					</li>
					
					
<?php /*if ($area=="TI" OR $area=="Diretoria")
							echo '
							
							
					<!-- <li class='.($sec=='Servidores' ? " 'active open' " : " " ).'>
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-desktop"></i>
							<span class="menu-text">
								Servidores
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class='.($ses=='Odin' ? " 'active open' " : " ").'>
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-linux"></i>

									Odin
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class='.($page=='Painel de Controle' ? "active" : "noactive").'>
										<a href="odin-painel.php">
											<i class="menu-icon fa fa-tachometer"></i>
											Painel de Controle
										</a>

										<b class="arrow"></b>
									</li>

									<li class='.($page=='Rede' ? "active" : "noactive").'>
										<a href="odin-monitor-rede.php">
											<i class="menu-icon fa fa-line-chart"></i>
											Monitor de Rede
										</a>

										<b class="arrow"></b>
									</li>

									<li class='.($page=='Servico' ? "active" : "noactive").'>
										<a href="odin-monitor-srv.php">
											<i class="menu-icon fa fa-area-chart"></i>
											Monitor de Servico
										</a>

										<b class="arrow"></b>
									</li>

									<li class='.($page=='Sarg' ? "active" : "noactive").'>
										<a href="odin-sarg.php">
											<i class="menu-icon fa fa-search"></i>
											Sarg
										</a>

										<b class="arrow"></b>
									</li>

									<li class='.($page=='Sisloc Now' ? "active" : "noactive").'>
										<a href="odin-sislocnow.php">
											<i class="menu-icon fa fa-clock-o"></i>
											Sisloc Now
										</a>

										<b class="arrow"></b>
									</li>

										
																		
								</ul>
							</li>

							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-linux"></i>

									Net1
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="">
										<a href="top-menu.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Top Menu
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="two-menu-1.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Two Menus 1
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="two-menu-2.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Two Menus 2
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="mobile-menu-1.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Default Mobile Menu
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="mobile-menu-2.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Mobile Menu 2
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="mobile-menu-3.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Mobile Menu 3
										</a>

										<b class="arrow"></b>
									</li>
									
									
									
								</ul>
							</li>
							
						<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-linux"></i>

									UC
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="">
										<a href="top-menu.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Top Menu
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="two-menu-1.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Two Menus 1
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="two-menu-2.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Two Menus 2
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="mobile-menu-1.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Default Mobile Menu
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="mobile-menu-2.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Mobile Menu 2
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="mobile-menu-3.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Mobile Menu 3
										</a>

										<b class="arrow"></b>
									</li>
									
									
									
								</ul>
							</li>
							
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-linux"></i>

									Update
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="">
										<a href="top-menu.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Top Menu
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="two-menu-1.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Two Menus 1
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="two-menu-2.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Two Menus 2
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="mobile-menu-1.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Default Mobile Menu
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="mobile-menu-2.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Mobile Menu 2
										</a>

										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="mobile-menu-3.html">
											<i class="menu-icon fa fa-caret-right"></i>
											Mobile Menu 3
										</a>

										<b class="arrow"></b>
									</li>
									
									
									
								</ul>
							</li>
							
							
							
						</ul>
					</li> 

					<li class='.($sec=='Controle' ? "active" : "").'>
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-cubes "></i>
							<span class="menu-text"> Controle </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php if($page=="Update") echo active?>">
								<a href="<?php  if ($area=="TI") { echo "usuarios-edit.php"; } else {echo "usuarios.php";} ?>">
									<i class="menu-icon fa fa-download"></i>
									Item
								</a>

								<b class="arrow"></b>
							</li>

							<li class="<?php if($page=="Sic") echo active?>">
								<a href="sic.php">
									<i class="menu-icon fa fa-cloud"></i>
									Item 1
								</a>

								<b class="arrow"></b>
							</li>

							
						</ul>
					</li> -->
										
					
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text"> Cadastros </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="form-elements.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Form Elements
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="form-elements-2.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Form Elements 2
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="form-wizard.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Wizard &amp; Validation
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="wysiwyg.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Wysiwyg &amp; Markdown
								</a>

								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="dropzone.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Dropzone File Upload
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					
					
					<li class='.($page=='Agenda' ? "active" : "").'>
						<a href="manutencao.php">
							<i class="menu-icon fa fa-calendar"></i>

							<span class="menu-text">
								Agenda

								</span>
							</span>
						</a>

						<b class="arrow"></b>
					</li>

					<!-- <li class='.($page=='Monitoramento' ? "active" : "").'>
						<a href="monitoramento.php">
							<i class="menu-icon fa fa-line-chart"></i>

							<span class="menu-text">
								Monitoramento

								</span>
							</span>
						</a>

						<b class="arrow"></b>
					</li> '; */?>
					
					<!--<li class="<?php //if($sec=="Sisloc") echo "active open";?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-briefcase "></i>
							<span class="menu-text"> Sisloc </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php //if($page=="Update") echo active?>">
								<a href="<?php  //if ($area=="TI") { echo "usuarios-edit.php"; } else {echo "usuarios.php";} ?>">
									<i class="menu-icon fa fa-download"></i>
									Update
								</a>

								<b class="arrow"></b>
							</li>

							

							<?php /*if ($area=="TI" OR $area=="Diretoria")
							echo '
							<li class='.($page=='Auditoria' ? "active" : "").'>
                                <a href="auditoria.php">
                                    <i class="menu-icon fa fa-search"></i>
                                    Auditoria
                                </a>

                                <b class="arrow"></b>
                            </li>';*/?>



							<li class="<?php //if($page=="Sic") echo active?>">
								<a href="sic.php">
									<i class="menu-icon fa fa-cloud"></i>
									in Cloud
								</a>

								<b class="arrow"></b>
							</li>

							<li class="<?php //if($page=="3camadas") echo active ?>">
								<a href="3camadas.php">
									<i class="menu-icon fa fa-globe"></i>
									3 Camadas
								</a>

								<b class="arrow"></b>
							</li>
							
							<li class="<?php //if($page=="Ramais") echo active?>">
								<a href="ramais.php">
									<i class="menu-icon fa fa-phone"></i>
									Ramais
								</a>

								<b class="arrow"></b>
							</li>
							
						</ul>
					</li> -->
					
					<!--<li class="<?php //if($page=="Diagrama") echo active?>">
						<a href="gallery.php">
							<i class="menu-icon fa fa-picture-o"></i>
							<span class="menu-text"> Diagramas </span>
						</a>

						<b class="arrow"></b>
					</li> -->

					<?php /*
if ("$area" == "TI" OR $area=="Comunicacao Corporativa") 
				echo '	<li class='.($page=='Bday' ? "active" : "").'>
                                                <a href="bday.php">
                                                        <i class="menu-icon fa fa-birthday-cake"></i>
                                                        <span class="menu-text"> Lista de Anivers&aacute;rios </span>
                                                </a>

                                                <b class="arrow"></b>
                                        </li>';

*/?>	
					
					
				
                                        <!--	<li class="<?phpif ($sec == "Monitoramento") {
                                            echo "active open";
                                        }
                                        ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-line-chart "></i>
							<span class="menu-text"> Monitoramento </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php //if($page=="Mon-Ativos") echo active?>">
								<a href="usuarios.php">
									<i class="menu-icon fa fa-server"></i>
									Ativos de Rede
								</a>

								<b class="arrow"></b>
							</li>

							<li class="<?php //if($page=="Mon-Sic") echo active?>">
								<a href="sic.php">
									<i class="menu-icon fa fa-cloud"></i>
									Sisloc in Cloud
								</a>

								<b class="arrow"></b>
							</li>

							
						</ul>
					</li> -->
					
				<!-- /.nav-list -->
