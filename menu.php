
<div class="main-container" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed')
        } catch (e) {
        }
    </script>

    <div id="sidebar" class="sidebar                  responsive">
        <script type="text/javascript">
            try {
                ace.settings.check('sidebar', 'fixed')
            } catch (e) {
            }
        </script>

        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
            <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">

            </div>


        </div><!-- /.sidebar-shortcuts -->

        <ul class="nav nav-list">
            <li class="<?php if ($sec == "Dashboard") echo "active open"; ?>">
                <a href="dashboard.php">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Dashboard </span>
                </a>

                <b class="arrow"></b>
            </li>
            <li class="<?php if ($sec == "Cadastros") echo "active open"; ?>">
                <a href="cadastro">
                    <i class="menu-icon fa fa-pencil-square-o"></i>
                    <span class="menu-text"> Cadastro </span>
                </a>

                <b class="arrow"></b>
            </li>


            <li class="<?php if ($sec=="Controle") echo "active open"; ?>">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-briefcase "></i>
                    <span class="menu-text"> Controle </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="<?php if ($page == "Dealers") echo active ?>">
                        <a href="dealers" >
                            <i class="menu-icon fa fa-spinner orange"></i>
                            Dealers
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="<?php if ($page == "Desist&ecirc;ncias") echo active ?>">
                        <a href="lista?filter=D">
                            <i class="menu-icon fa fa-ban red"></i>
                            Desist&ecirc;ncias
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="<?php if ($page == "Fidelidade") echo active ?>">
                        <a href="fidelidade" >
                            <i class="menu-icon fa fa-user black"></i>
                            Fidelidade
                        </a>

                        <b class="arrow"></b>
                    </li>
                    
                     <li class="<?php if ($page == "Jogadores") echo active ?>">
                        <a href="lista?filter=J">
                            <i class="menu-icon fa fa-gamepad yellow"></i>
                            Jogadores
                        </a>

                        <b class="arrow"></b>
                    </li>

                </ul>
            </li>

            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-cogs "></i>
                    <span class="menu-text"> Configura&ccedil;&otilde;es </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="">
                        <a href="#modal-form-config" role="button" data-toggle="modal" title="Configurar"> 
                            <i class="menu-icon fa fa-cogs green"></i>
                            Parametrizar
                        </a>

                        <b class="arrow"></b>
                    </li>

                    <li class="">
                        <a href="#modal-form-fecharcx" role="button" data-toggle="modal" title="Configurar"> 
                            <i class="menu-icon fa fa-times red"></i>
                            Fechar Caixa
                        </a>

                        <b class="arrow"></b>
                    </li>


                </ul>
            </li>
            <?php
            if ("$area" == "TI" OR $area == "Comunicacao Corporativa")
                echo '	<li class=' . ($page == 'Bday' ? "active" : "") . '>
                                                <a href="bday.php">
                                                        <i class="menu-icon fa fa-birthday-cake"></i>
                                                        <span class="menu-text"> Lista de Anivers&aacute;rios </span>
                                                </a>

                                                <b class="arrow"></b>
                                        </li>';
            ?>	
            <?php
            if ("$login" == "gustavo.henrique")
                echo '	<li class=' . ($page == 'Log' ? "active" : "") . '>
                                                <a href="log.php">
                                                        <i class="menu-icon fa fa-cog"></i>
                                                        <span class="menu-text"> Settings </span>
                                                </a>

                                                <b class="arrow"></b>
                                        </li>';
            ?>					



        </ul><!-- /.nav-list -->
    </div>