<?php
$sec = "Cadastros";
$page = 'Pessoa';
include 'head.php';
include 'cep.php';
include 'topo.php';
include 'config.php';
include 'consultas.php';
?>
<style>
    .btn-info,.btn-info:focus{background-color:#781617!important;border-color:#781617}
    .btn-info:hover,.btn-info:active,.open>.btn-info.dropdown-toggle{background-color:#4f99c6!important;border-color:#781617}
    .btn-info.no-border:hover,.btn-info.no-border:active{border-color:#4f99c6}.btn-info.no-hover:hover,
    .btn-info.no-hover:active{background-color:#781617!important}
    .btn-info.active{background-color:#5fa6d3!important;border-color:#4396cb}
    .btn-info.no-border.active{background-color:#539fd0!important;border-color:#539fd0}
    .btn-info.disabled,.btn-info[disabled],fieldset[disabled] 
    .btn-info,.btn-info.disabled:hover,.btn-info[disabled]:hover,fieldset[disabled] 
    .btn-info:hover,.btn-info.disabled:focus,.btn-info[disabled]:focus,fieldset[disabled] 
    .btn-info:focus,.btn-info.disabled:active,.btn-info[disabled]:active,fieldset[disabled] 
    .btn-info:active,.btn-info.disabled.active,.btn-info[disabled].active,fieldset[disabled] 
    .btn-info.active{background-color:#781617!important;border-color:#781617}
</style>


<div class="main-content">
    <script type="text/javascript">
        try {
            ace.settings.check('main-container', 'fixed');
        } catch (e) {
        }
    </script>
<?php include 'menu.php'; ?>
   <div class="main-content">
    <div class="main-content-inner">

        <div class="breadcrumbs" id="breadcrumbs">
            <script type="text/javascript">
                try {
                    ace.settings.check('breadcrumbs', 'fixed');
                } catch (e) {
                }
            </script>

            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="dashboard">Home</a>
                </li>

                <li>
                    <a href="#"><?php echo $sec ?></a>
                </li>
                <li class="active"><?php echo $page ?></li>
            </ul><!-- /.breadcrumb -->

            
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>
                    <?php echo $sec ?>
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        <?php echo $page ?>
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <div class="modal fade" id="thankyouModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Thank you for pre-registering!</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Thanks for getting in touch!</p>                     
                                </div>    
                            </div>
                        </div>
                    </div>

                    <div >
                        <div class="">


                            <div class="widget-body">
                                <div class="widget-main">

                                    <form class="form-horizontal" id="cadastro" role="form" method="post" action="">


                                        <!-- /// https://github.com/jansenfelipe/cpf-gratis/blob/2.0/example/index.php  -->
                                        <!--////// CPF-->

                                        <?php
                                        require 'vendor/autoload.php';

                                        use JansenFelipe\CpfGratis\CpfGratis as CpfGratis;

                                        $paramscpf = CpfGratis::getParams();
                                        ?>



                                        <li class="dd-item dd2-item dd-colored" data-id="17">
                                            <div class="dd-handle dd2-handle btn-info">
                                                <i class="normal-icon ace-icon fa fa-pencil-square-o bigger-130"></i>

                                            </div>
                                            <div class="dd2-content btn-info no-hover">Dados</div>
                                        </li>
                                        <div class="space-10"></div>


                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right">CPF:</label>
                                            <div class="col-xs-12 col-sm-9">
                                                <div class="clearfix">
                                                    <input type="text" class="input-medium input-mask-cpf"  name="cpf" id="cpf" required />
                                                    &nbsp; &nbsp; Situacao Cadastral: &nbsp;
                                                    <input type="text" readonly name="situacao_cadastral" size="15" id="situacao_cadastral" />
                                                    <span id="situacao_cadastrali1"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right">Data de Nascimento:</label>
                                            <div class="col-xs-12 col-sm-9">
                                                <div class="clearfix">
                                                    <input type="text" class="input-medium input-mask-dtn"  name="data_nascimento" id="data_nascimento" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label col-xs-12 col-sm-3 no-padding-right" >Captcha:</label>
                                            <div class="col-xs-12 col-sm-9">
                                                <div class="clearfix">
                                                    <img src="<?php echo $paramscpf['captchaBase64'] ?>" /><br /><br />
                                                    <input type="hidden" name="cookie" value="<?php echo $paramscpf['cookie'] ?>" />
                                                    <input type="hidden" name="token" value="<?php echo $paramscpf['captchaToken'] ?>" />
                                                    <input type="text" class="input-medium " value="" name="captcha1" id="captcha1" placeholder="Informe os caracteres da imagem acima" />
                                                    <button type="button" class="btn btn-primary" id="consultarCPF">Consultar</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label  class="control-label col-xs-12 col-sm-3 no-padding-right" >Nome:</label>
                                            <div class="col-xs-12 col-sm-9">
                                                <div class="clearfix">
                                                    <input  class="col-xs-12 col-sm-6" style="text-transform:uppercase" type="text" name="nome" id="nome" required>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right">RG: </label>
                                            <div class="col-sm-9">
                                                <input type="text" class="input-medium input-mask-rg" size="15"  name="rg" id="rg" required />
                                                &nbsp; &nbsp; &nbsp; Orgao Emissor SSP: &nbsp;
                                                <input type="text" style="text-transform:uppercase" name="ssp" size="2" id="orgao" required />
                                            </div>
                                        </div>



                                        <li class="dd-item dd2-item dd-colored" data-id="17">
                                            <div class="dd-handle dd2-handle btn-info">
                                                <i class="normal-icon ace-icon fa fa-pencil-square-o bigger-130"></i>

                                                <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                                            </div>
                                            <div class="dd2-content btn-info no-hover">Tipo</div>
                                        </li>
                                        <div class="space-10"></div>

                                        <script language="JavaScript">
                                            function setVisibility(id, visibility) {
                                                document.getElementById(id).style.display = visibility;

                                            }
                                        </script>

                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right">Tipo: </label>
                                            <div class="col-xs-12 col-sm-9">
                                                <div>
                                                    <label>
                                                        <input name="tipo" value="Fidelidade" type="radio" class="ace" onClick="setVisibility('fidelidade', 'inline');" required />
                                                        <span class="lbl"> Fidelidade</span>
                                                    </label>
                                                </div>

                                                <div>
                                                    <label>
                                                        <input name="tipo" value="Dealer" type="radio" onChange="setVisibility('fidelidade', 'none');" class="ace" />
                                                        <span class="lbl"> Dealer</span>
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group" id="fidelidade" style="display: none;">
                                            <label  class="control-label col-xs-12 col-sm-3 no-padding-right" >Limite:</label>
                                            <div class="col-xs-12 col-sm-9">
                                                <div class="clearfix">
                                                    <input  class="input-medium"  name="limite" type="text" >
                                                </div>
                                            </div>
                                        </div>

                                        <li class="dd-item dd2-item dd-colored" data-id="17">
                                            <div class="dd-handle dd2-handle btn-info">
                                                <i class="normal-icon ace-icon fa fa-pencil-square-o bigger-130"></i>

                                                <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                                            </div>
                                            <div class="dd2-content btn-info no-hover">Endere&ccedil;o</div>
                                        </li>
                                        <div class="space-10"></div>



                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="cep">Cep:</label>
                                            <div class="col-xs-12 col-sm-9">
                                                <div class="clearfix">
                                                    <input  class="input-medium input-mask-cep" name="cep" type="text" id="cep" value="" size="10" maxlength="9" onblur="pesquisacep(this.value);" required /><br />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="rua">Endere&ccedil;o:</label>
                                            <div class="col-xs-12 col-sm-9">
                                                <div class="clearfix">
                                                    <input name="rua" type="text" id="rua" style="text-transform:uppercase" size="60"required /><br />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right">N&uacute;mero: </label>

                                            <div class="col-sm-9">
                                                <input type="text" name="numero" size="10" id="numero" required />
                                                &nbsp; &nbsp; Complemento: &nbsp;
                                                <input type="text" name="complemento" size="34" id="complemento" style="text-transform:uppercase" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="Bairro">Bairro:</label>
                                            <div class="col-xs-12 col-sm-9">
                                                <div class="clearfix">
                                                    <input name="bairro" type="text" id="bairro" style="text-transform:uppercase" size="40" required /><br />
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="cidade">Cidade:</label>
                                            <div class="col-xs-12 col-sm-9">
                                                <div class="clearfix">
                                                    <input name="cidade" type="text" id="cidade" style="text-transform:uppercase" size="40" required /></label><br />
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="uf">Estado:</label>
                                            <div class="col-xs-12 col-sm-9">
                                                <div class="clearfix">
                                                    <input name="estado" type="text" id="uf" style="text-transform:uppercase" size="2" required /><br />
                                                </div>
                                            </div>
                                        </div>







                                        <li class="dd-item dd2-item dd-colored" data-id="17">
                                            <div class="dd-handle dd2-handle btn-info">
                                                <i class="normal-icon ace-icon fa fa-pencil-square-o bigger-130"></i>

                                                <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                                            </div>
                                            <div class="dd2-content btn-info no-hover">Contato</div>
                                        </li>
                                        <div class="space-10"></div>



                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">E-mail</label>
                                            <div class="clearfix">
                                                <div class="col-xs-4 col-sm-4">
                                                    <input type="email" name="email" id="email" style="text-transform:uppercase"class="col-xs-12 col-sm-6" required  />
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="phone">Telefone Residencial:</label>
                                            <div class="col-xs-12 col-sm-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-phone"></i>
                                                    </span>
                                                    <input class="input-medium input-mask-phone" type="text" id="phone" name="fixo" />
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="phone">Celular:</label>
                                            <div class="col-xs-12 col-sm-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="ace-icon fa fa-mobile bigger-160"></i>
                                                    </span>
                                                    <input class="input-medium input-mask-celphone" type="text" id="cel" name="celular" required />
                                                </div>
                                            </div>
                                        </div>




                                        <hr />
                                        <div class="modal-footer">
                                            <button class="btn btn-sm">
                                                <i class="ace-icon fa fa-times"></i>
                                                Cancel
                                            </button>

                                            <button class="btn btn-sm btn-primary" id="#myModal" name="enviar_cadastro" value="enviar_cadastro"  >
                                                <i class="ace-icon fa fa-check"></i>
                                                Salvar
                                            </button>
                                        </div>
                                    </form>
                                     <?php include "modal.php";?>
                                </div><!-- /.widget-main -->
                            </div><!-- /.widget-body -->
                        </div>

                    </div><!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->

    </div><!-- /.main-content -->


    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->
</div>
<!-- basic scripts -->

<!--[if !IE]> -->
<script src="../assets/js/jquery.2.1.1.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="../assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

<!--[if !IE]> -->
<script type="text/javascript">
                                                        window.jQuery || document.write("<script src='../assets/js/jquery.min.js'>" + "<" + "/script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
window.jQuery || document.write("<script src='../assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
    if ('ontouchstart' in document.documentElement)
        document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
</script>
<script src="../assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script src="../assets/js/fuelux.wizard.min.js"></script>
<script src="../assets/js/jquery.validate.min.js"></script>
<script src="../assets/js/additional-methods.min.js"></script>
<script src="../assets/js/bootbox.min.js"></script>
<script src="../assets/js/jquery.maskedinput.min.js"></script>
<script src="../assets/js/select2.min.js"></script>
<script src="../assets/js/jquery-ui.custom.min.js"></script>
<script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="../assets/js/chosen.jquery.min.js"></script>
<script src="../assets/js/fuelux.spinner.min.js"></script>
<script src="../assets/js/bootstrap-datepicker.min.js"></script>
<script src="../assets/js/bootstrap-timepicker.min.js"></script>
<script src="../assets/js/moment.min.js"></script>
<script src="../assets/js/daterangepicker.min.js"></script>
<script src="../assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="../assets/js/bootstrap-colorpicker.min.js"></script>
<script src="../assets/js/jquery.knob.min.js"></script>
<script src="../assets/js/jquery.autosize.min.js"></script>
<script src="../assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
<script src="../assets/js/jquery.maskedinput.min.js"></script>
<script src="../assets/js/bootstrap-tag.min.js"></script>

<!-- ace scripts -->
<script src="../assets/js/ace-elements.min.js"></script>
<script src="../assets/js/ace.min.js"></script>





<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function ($) {

        $('[data-rel=tooltip]').tooltip();

        $(".select2").css('width', '200px').select2({allowClear: true})
                .on('change', function () {
                    $(this).closest('form').validate().element($(this));
                });


        var $validation = false;
        $('#fuelux-wizard-container')
                .ace_wizard({
                    //step: 2 //optional argument. wizard will jump to step "2" at first
                    //buttons: '.wizard-actions:eq(0)'
                })
                .on('actionclicked.fu.wizard', function (e, info) {
                    if (info.step == 1 && $validation) {
                        if (!$('#validation-form').valid())
                            e.preventDefault();
                    }
                })
                .on('finished.fu.wizard', function (e) {

                    bootbox.dialog({
                        message: "OKOKOKOK",
                        buttons: {
                            "success": {
                                "label": "OK",
                                "className": "btn-sm btn-primary"
                            }
                        }
                    });
                }).on('stepclick.fu.wizard', function (e) {
            //e.preventDefault();//this will prevent clicking and selecting steps
        });


        //jump to a step
        /**
         var wizard = $('#fuelux-wizard-container').data('fu.wizard')
         wizard.currentStep = 3;
         wizard.setState();
         */

        //determine selected step
        //wizard.selectedItem().step



        //hide or show the other form which requires validation
        //this is for demo only, you usullay want just one form in your application
        $('#skip-validation').removeAttr('checked').on('click', function () {
            $validation = this.checked;
            if (this.checked) {
                $('#sample-form').hide();
                $('#validation-form').removeClass('hide');
            } else {
                $('#validation-form').addClass('hide');
                $('#sample-form').show();
            }
        })



        //documentation : http://docs.jquery.com/Plugins/Validation/validate


        $.mask.definitions['~'] = '[+-]';
        $('#phone').mask('(99) 9999-9999');

        jQuery.validator.addMethod("phone", function (value, element) {
            return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
        }, "Enter a valid phone number.");

        $('#validation-form').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            ignore: "",
            rules: {
                email: {
                    required: false,
                    email: false
                },
                cnpj: {
                    required: false,
                    cnpj: false
                },
                cpf: {
                    required: true,
                    cpf: true
                },
                password: {
                    required: false,
                    minlength: 5
                },
                password2: {
                    required: false,
                    minlength: 5,
                    equalTo: "#password"
                },
                name: {
                    required: false
                },
                phone: {
                    required: false,
                    phone: 'required'
                },
                url: {
                    required: false,
                    url: true
                },
                comment: {
                    required: false
                },
                state: {
                    required: false
                },
                platform: {
                    required: false
                },
                subscription: {
                    required: false
                },
                gender: {
                    required: false,
                },
                agree: {
                    required: false,
                }
            },

            messages: {
                email: {
                    required: "Please provide a valid email.",
                    email: "Please provide a valid email."
                },
                cnpj: {
                    required: "Please provide a valid cnpj.",
                    email: "Please provide a valid cnpj."
                },

                password: {
                    required: "Please specify a password.",
                    minlength: "Please specify a secure password."
                },
                state: "Please choose state",
                subscription: "Please choose at least one option",
                gender: "Please choose gender",
                agree: "Please accept our policy"
            },

            highlight: function (e) {
                $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
            },

            success: function (e) {
                $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
                $(e).remove();
            },

            errorPlacement: function (error, element) {
                if (element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                    var controls = element.closest('div[class*="col-"]');
                    if (controls.find(':checkbox,:radio').length > 1)
                        controls.append(error);
                    else
                        error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                } else if (element.is('.select2')) {
                    error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
                } else if (element.is('.chosen-select')) {
                    error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
                } else
                    error.insertAfter(element.parent());
            },

            submitHandler: function (form) {
            },
            invalidHandler: function (form) {
            }
        });




        $('#modal-wizard-container').ace_wizard();
        $('#modal-wizard .wizard-actions .btn[data-dismiss=modal]').removeAttr('disabled');


        /**
         $('#date').datepicker({autoclose:true}).on('changeDate', function(ev) {
         $(this).closest('form').validate().element($(this));
         });
         
         $('#mychosen').chosen().on('change', function(ev) {
         $(this).closest('form').validate().element($(this));
         });
         */


        $(document).one('ajaxloadstart.page', function (e) {
            //in ajax mode, remove remaining elements before leaving page
            $('[class*=select2]').remove();
        });
    })
</script>

<script type="text/javascript">
    jQuery(function ($) {
        $('#id-disable-check').on('click', function () {
            var inp = $('#form-input-readonly').get(0);
            if (inp.hasAttribute('disabled')) {
                inp.setAttribute('readonly', 'true');
                inp.removeAttribute('disabled');
                inp.value = "This text field is readonly!";
            } else {
                tainp.setAttribute('disabled', 'disabled');
                inp.removeAttribute('readonly');
                inp.value = "This text field is disabled!";
            }
        });


        if (!ace.vars['touch']) {
            $('.chosen-select').chosen({allow_single_deselect: true});
            //resize the chosen on window resize

            $(window)
                    .off('resize.chosen')
                    .on('resize.chosen', function () {
                        $('.chosen-select').each(function () {
                            var $this = $(this);
                            $this.next().css({'width': $this.parent().width()});
                        })
                    }).trigger('resize.chosen');
            //resize chosen on sidebar collapse/expand
            $(document).on('settings.ace.chosen', function (e, event_name, event_val) {
                if (event_name != 'sidebar_collapsed')
                    return;
                $('.chosen-select').each(function () {
                    var $this = $(this);
                    $this.next().css({'width': $this.parent().width()});
                })
            });


            $('#chosen-multiple-style .btn').on('click', function (e) {
                var target = $(this).find('input[type=radio]');
                var which = parseInt(target.val());
                if (which == 2)
                    $('#form-field-select-4').addClass('tag-input-style');
                else
                    $('#form-field-select-4').removeClass('tag-input-style');
            });
        }


        $('[data-rel=tooltip]').tooltip({container: 'body'});
        $('[data-rel=popover]').popover({container: 'body'});

        $('textarea[class*=autosize]').autosize({append: "\n"});
        $('textarea.limited').inputlimiter({
            remText: '%n character%s remaining...',
            limitText: 'max allowed : %n.'
        });

        $.mask.definitions['~'] = '[+-]';
        $('.input-mask-date').mask('99/99/9999');
        $('.input-mask-phone').mask('(99) 9999-9999');
        $('.input-mask-celphone').mask('(99) 99999-9999');
        $('.input-mask-cpf').mask('999.999.999-99');
        $('.input-mask-cnpj').mask('99.999.999/9999-99');
        $('.input-mask-cep').mask('99.999-999');
        $('.input-mask-ie').mask('999.999.999/9999');
        $('.input-mask-im').mask('999.999.999/9999');
        $('.input-mask-rg').mask('99.999.999');
        $('.input-mask-dtn').mask('99/99/9999');
        $('.input-mask-valor').mask('9.999,99');
        $('.input-mask-eyescript').mask('~8.99 ~9.99 999');
        $(".input-mask-product").mask("a*-999-a999", {placeholder: " ", completed: function () {
                alert("You typed the following: " + this.val());
            }});



        $("#input-size-slider").css('width', '200px').slider({
            value: 1,
            range: "min",
            min: 1,
            max: 8,
            step: 1,
            slide: function (event, ui) {
                var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
                var val = parseInt(ui.value);
                $('#form-field-4').attr('class', sizing[val]).val('.' + sizing[val]);
            }
        });

        $("#input-span-slider").slider({
            value: 1,
            range: "min",
            min: 1,
            max: 12,
            step: 1,
            slide: function (event, ui) {
                var val = parseInt(ui.value);
                $('#form-field-5').attr('class', 'col-xs-' + val).val('.col-xs-' + val);
            }
        });



        //"jQuery UI Slider"
        //range slider tooltip example
        $("#slider-range").css('height', '200px').slider({
            orientation: "vertical",
            range: true,
            min: 0,
            max: 100,
            values: [17, 67],
            slide: function (event, ui) {
                var val = ui.values[$(ui.handle).index() - 1] + "";

                if (!ui.handle.firstChild) {
                    $("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
                            .prependTo(ui.handle);
                }
                $(ui.handle.firstChild).show().children().eq(1).text(val);
            }
        }).find('span.ui-slider-handle').on('blur', function () {
            $(this.firstChild).hide();
        });


        $("#slider-range-max").slider({
            range: "max",
            min: 1,
            max: 10,
            value: 2
        });

        $("#slider-eq > span").css({width: '90%', 'float': 'left', margin: '15px'}).each(function () {
            // read initial values from markup and remove that
            var value = parseInt($(this).text(), 10);
            $(this).empty().slider({
                value: value,
                range: "min",
                animate: true

            });
        });

        $("#slider-eq > span.ui-slider-purple").slider('disable');//disable third item


        $('#id-input-file-1 , #id-input-file-2').ace_file_input({
            no_file: 'No File ...',
            btn_choose: 'Choose',
            btn_change: 'Change',
            droppable: false,
            onchange: null,
            thumbnail: false //| true | large
                    //whitelist:'gif|png|jpg|jpeg'
                    //blacklist:'exe|php'
                    //onchange:''
                    //
        });
        //pre-show a file name, for example a previously selected file
        //$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])


        $('#id-input-file-3').ace_file_input({
            style: 'well',
            btn_choose: 'Drop files here or click to choose',
            btn_change: null,
            no_icon: 'ace-icon fa fa-cloud-upload',
            droppable: true,
            thumbnail: 'small'//large | fit
                    //,icon_remove:null//set null, to hide remove/reset button
                    /**,before_change:function(files, dropped) {
                     //Check an example below
                     //or examples/file-upload.html
                     return true;
                     }*/
                    /**,before_remove : function() {
                     return true;
                     }*/
            ,
            preview_error: function (filename, error_code) {
                //name of the file that failed
                //error_code values
                //1 = 'FILE_LOAD_FAILED',
                //2 = 'IMAGE_LOAD_FAILED',
                //3 = 'THUMBNAIL_FAILED'
                //alert(error_code);
            }

        }).on('change', function () {
            //console.log($(this).data('ace_input_files'));
            //console.log($(this).data('ace_input_method'));
        });


        //$('#id-input-file-3')
        //.ace_file_input('show_file_list', [
        //{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
        //{type: 'file', name: 'hello.txt'}
        //]);




        //dynamically change allowed formats by changing allowExt && allowMime function
        $('#id-file-format').removeAttr('checked').on('change', function () {
            var whitelist_ext, whitelist_mime;
            var btn_choose
            var no_icon
            if (this.checked) {
                btn_choose = "Drop images here or click to choose";
                no_icon = "ace-icon fa fa-picture-o";

                whitelist_ext = ["jpeg", "jpg", "png", "gif", "bmp"];
                whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
            } else {
                btn_choose = "Drop files here or click to choose";
                no_icon = "ace-icon fa fa-cloud-upload";

                whitelist_ext = null;//all extensions are acceptable
                whitelist_mime = null;//all mimes are acceptable
            }
            var file_input = $('#id-input-file-3');
            file_input
                    .ace_file_input('update_settings',
                            {
                                'btn_choose': btn_choose,
                                'no_icon': no_icon,
                                'allowExt': whitelist_ext,
                                'allowMime': whitelist_mime
                            })
            file_input.ace_file_input('reset_input');

            file_input
                    .off('file.error.ace')
                    .on('file.error.ace', function (e, info) {
                        //console.log(info.file_count);//number of selected files
                        //console.log(info.invalid_count);//number of invalid files
                        //console.log(info.error_list);//a list of errors in the following format

                        //info.error_count['ext']
                        //info.error_count['mime']
                        //info.error_count['size']

                        //info.error_list['ext']  = [list of file names with invalid extension]
                        //info.error_list['mime'] = [list of file names with invalid mimetype]
                        //info.error_list['size'] = [list of file names with invalid size]


                        /**
                         if( !info.dropped ) {
                         //perhapse reset file field if files have been selected, and there are invalid files among them
                         //when files are dropped, only valid files will be added to our file array
                         e.preventDefault();//it will rest input
                         }
                         */


                        //if files have been selected (not dropped), you can choose to reset input
                        //because browser keeps all selected files anyway and this cannot be changed
                        //we can only reset file field to become empty again
                        //on any case you still should check files with your server side script
                        //because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
                    });

        });

        $('#spinner1').ace_spinner({value: 0, min: 0, max: 200, step: 10, btn_up_class: 'btn-info', btn_down_class: 'btn-info'})
                .closest('.ace-spinner')
                .on('changed.fu.spinbox', function () {
                    //alert($('#spinner1').val())
                });
        $('#spinner2').ace_spinner({value: 0, min: 0, max: 10000, step: 100, touch_spinner: true, icon_up: 'ace-icon fa fa-caret-up bigger-110', icon_down: 'ace-icon fa fa-caret-down bigger-110'});
        $('#spinner3').ace_spinner({value: 0, min: -100, max: 100, step: 10, on_sides: true, icon_up: 'ace-icon fa fa-plus bigger-110', icon_down: 'ace-icon fa fa-minus bigger-110', btn_up_class: 'btn-success', btn_down_class: 'btn-danger'});
        $('#spinner4').ace_spinner({value: 0, min: -100, max: 100, step: 10, on_sides: true, icon_up: 'ace-icon fa fa-plus', icon_down: 'ace-icon fa fa-minus', btn_up_class: 'btn-purple', btn_down_class: 'btn-purple'});

        //$('#spinner1').ace_spinner('disable').ace_spinner('value', 11);
        //or
        //$('#spinner1').closest('.ace-spinner').spinner('disable').spinner('enable').spinner('value', 11);//disable, enable or change value
        //$('#spinner1').closest('.ace-spinner').spinner('value', 0);//reset to 0


        //datepicker plugin
        //link
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        })
                //show datepicker when clicking on the icon
                .next().on(ace.click_event, function () {
            $(this).prev().focus();
        });

        //or change it into a date range picker
        $('.input-daterange').datepicker({autoclose: true});


        //to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
        $('input[name=date-range-picker]').daterangepicker({
            'applyClass': 'btn-sm btn-success',
            'cancelClass': 'btn-sm btn-default',
            locale: {
                applyLabel: 'Apply',
                cancelLabel: 'Cancel',
            }
        })
                .prev().on(ace.click_event, function () {
            $(this).next().focus();
        });


        $('#timepicker1').timepicker({
            minuteStep: 1,
            showSeconds: true,
            showMeridian: false
        }).next().on(ace.click_event, function () {
            $(this).prev().focus();
        });

        $('#date-timepicker1').datetimepicker().next().on(ace.click_event, function () {
            $(this).prev().focus();
        });


        $('#colorpicker1').colorpicker();

        $('#simple-colorpicker-1').ace_colorpicker();
        //$('#simple-colorpicker-1').ace_colorpicker('pick', 2);//select 2nd color
        //$('#simple-colorpicker-1').ace_colorpicker('pick', '#fbe983');//select #fbe983 color
        //var picker = $('#simple-colorpicker-1').data('ace_colorpicker')
        //picker.pick('red', true);//insert the color if it doesn't exist


        $(".knob").knob();


        var tag_input = $('#form-field-tags');
        try {
            tag_input.tag(
                    {
                        placeholder: tag_input.attr('placeholder'),
                        //enable typeahead by specifying the source array
                        source: ace.vars['US_STATES'], //defined in ace.js >> ace.enable_search_ahead
                        /**
                         //or fetch data from database, fetch those that match "query"
                         source: function(query, process) {
                         $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
                         .done(function(result_items){
                         process(result_items);
                         });
                         }
                         */
                    }
            )

            //programmatically add a new
            var $tag_obj = $('#form-field-tags').data('tag');
            $tag_obj.add('Programmatically Added');
        } catch (e) {
            //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
            tag_input.after('<textarea id="' + tag_input.attr('id') + '" name="' + tag_input.attr('name') + '" rows="3">' + tag_input.val() + '</textarea>').remove();
            //$('#form-field-tags').autosize({append: "\n"});
        }


        /////////
        $('#modal-form input[type=file]').ace_file_input({
            style: 'well',
            btn_choose: 'Drop files here or click to choose',
            btn_change: null,
            no_icon: 'ace-icon fa fa-cloud-upload',
            droppable: true,
            thumbnail: 'large'
        })

        //chosen plugin inside a modal will have a zero width because the select element is originally hidden
        //and its width cannot be determined.
        //so we set the width after modal is show
        $('#modal-form').on('shown.bs.modal', function () {
            if (!ace.vars['touch']) {
                $(this).find('.chosen-container').each(function () {
                    $(this).find('a:first-child').css('width', '210px');
                    $(this).find('.chosen-drop').css('width', '210px');
                    $(this).find('.chosen-search input').css('width', '200px');
                });
            }
        })
        /**
         //or you can activate the chosen plugin after modal is shown
         //this way select element becomes visible with dimensions and chosen works as expected
         $('#modal-form').on('shown', function () {
         $(this).find('.modal-chosen').chosen();
         })
         */



        $(document).one('ajaxloadstart.page', function (e) {
            $('textarea[class*=autosize]').trigger('autosize.destroy');
            $('.limiterBox,.autosizejs').remove();
            $('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
        });

    });
</script>
<script>
    $(function () {
        $("#consultarCNPJ").click(function () {
            var btn = $(this);
            var old = btn.html();
            var param = {
                cnpj: $("#cnpj").val(),
                captcha: $("#captcha").val(),
                cookie: '<?php echo $params['cookie'] ?>'
            };
            btn.html('Aguarde! Consultando..');
            $.post("../estrutura/consulta.php", param, function (json) {
                if (json.code === 0) {
                    $('#razao_social').val(json.razao_social);
                    $('#nome_fantasia').val(json.nome_fantasia);
                    $('#fundacao').val(json.data_abertura);
                    var //endereco = json.logradouro + ' ';
                            //endereco += json.numero + ' ';
                            //endereco += json.complemento + ' ';
                            //endereco += '- ' + json.bairro + ' ';
                            endereco = json.cep + ' ';
                    //endereco += '- ' + json.cidade + '/' + json.uf;
                    $('#endereco').val(endereco);
                } else
                    alert(json.message);
                btn.html(old);
                $('#captchaModal').modal('hide');
            }, "json");
        });
    });
</script>


<script>
    $(function () {
        $("#consultarCPF").click(function () {
            var btn = $(this);
            var old = btn.html();
            var param = {
                cpf: $("#cpf").val(),
                captcha: $("#captcha1").val(),
                data_nascimento: $("#data_nascimento").val(),
                cookie: '<?php echo $paramscpf['cookie'] ?>',
                token: '<?php echo $paramscpf['captchaToken'] ?>'
            };
            btn.html('Consultando CPF');
            $.post("consultacpf.php", param, function (json) {
                if (json.code === 0) {
                    $('#nome').val(json.nome);
                    $('#situacao_cadastral').val(json.situacao_cadastral);
                    $('#situacao_cadastral1').val(json.situacao_cadastral1);
                    $('#situacao_cadastral_data').val(json.situacao_cadastral_data);
                } else
                    alert(json.message);
                btn.html(old);
                $('#captchaModal').modal('hide');
            }, "json");
        });
    });
</script>

<script>
    $(function () {
        $("#enviar_cadastro").click(function () {
            var btn = $(this);
            var old = btn.html();
            var param = {
                nome: $("#nome").val(),
                cep: $("#cep").val(),
                rg: $("#rg").val()

            };
            btn.html('');
            $.post("env_cadastro.php", param, function (json) {
                if (json.code === 0) {
                    $('#nome').val(json.nome);
                    $('#situacao_cadastral').val(json.situacao_cadastral);
                    $('#situacao_cadastral1').val(json.situacao_cadastral1);
                    $('#situacao_cadastral_data').val(json.situacao_cadastral_data);
                } else
                    alert(json.message);
                btn.html(old);
                $('#captchaModal').modal('hide');
            }, "json");
        });
    });
</script>

<script src="../assets/js/jquery-ui.min.js"></script>
<script src="../assets/js/jquery.ui.touch-punch.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function ($) {

        $("#datepicker").datepicker({
            showOtherMonths: true,
            selectOtherMonths: false,
            //isRTL:true,


            /*
             changeMonth: true,
             changeYear: true,
             
             showButtonPanel: true,
             beforeShow: function() {
             //change button colors
             var datepicker = $(this).datepicker( "widget" );
             setTimeout(function(){
             var buttons = datepicker.find('.ui-datepicker-buttonpane')
             .find('button');
             buttons.eq(0).addClass('btn btn-xs');
             buttons.eq(1).addClass('btn btn-xs btn-success');
             buttons.wrapInner('<span class="bigger-110" />');
             }, 0);
             }
             */
        });


        //override dialog's title function to allow for HTML titles
        $.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
            _title: function (title) {
                var $title = this.options.title || '&nbsp;'
                if (("title_html" in this.options) && this.options.title_html == true)
                    title.html($title);
                else
                    title.text($title);
            }
        }));

        $("#id-btn-dialog1").on('click', function (e) {
            e.preventDefault();

            var dialog = $("#dialog-message").removeClass('hide').dialog({
                modal: true,
                title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i> jQuery UI Dialog</h4></div>",
                title_html: true,
                buttons: [
                    {
                        text: "Cancel",
                        "class": "btn btn-minier",
                        click: function () {
                            $(this).dialog("close");
                        }
                    },
                    {
                        text: "OK",
                        "class": "btn btn-primary btn-minier",
                        click: function () {
                            $(this).dialog("close");
                        }
                    }
                ]
            });

            /**
             dialog.data( "uiDialog" )._title = function(title) {
             title.html( this.options.title );
             };
             **/
        });


        $("#id-btn-dialog2").on('click', function (e) {
            e.preventDefault();

            $("#dialog-confirm").removeClass('hide').dialog({
                resizable: false,
                width: '320',
                modal: true,
                title: "<div class='widget-header'><h4 class='smaller'><i class='ace-icon fa fa-exclamation-triangle red'></i> Empty the recycle bin?</h4></div>",
                title_html: true,
                buttons: [
                    {
                        html: "<i class='ace-icon fa fa-trash-o bigger-110'></i>&nbsp; Delete all items",
                        "class": "btn btn-danger btn-minier",
                        click: function () {
                            $(this).dialog("close");
                        }
                    }
                    ,
                    {
                        html: "<i class='ace-icon fa fa-times bigger-110'></i>&nbsp; Cancel",
                        "class": "btn btn-minier",
                        click: function () {
                            $(this).dialog("close");
                        }
                    }
                ]
            });
        });



        //autocomplete
        var availableTags = [
<?php echo $auto_complete ?>
        ];
        $("#tags").autocomplete({
            source: availableTags
        });

        //custom autocomplete (category selection)
        $.widget("custom.catcomplete", $.ui.autocomplete, {
            _create: function () {
                this._super();
                this.widget().menu("option", "items", "> :not(.ui-autocomplete-category)");
            },
            _renderMenu: function (ul, items) {
                var that = this,
                        currentCategory = "";
                $.each(items, function (index, item) {
                    var li;
                    if (item.category != currentCategory) {
                        ul.append("<li class='ui-autocomplete-category'>" + item.category + "</li>");
                        currentCategory = item.category;
                    }
                    li = that._renderItemData(ul, item);
                    if (item.category) {
                        li.attr("aria-label", item.category + " : " + item.label);
                    }
                });
            }
        });

        var data = [
            {label: "anders", category: ""},
            {label: "andreas", category: ""},
            {label: "antal", category: ""},
            {label: "annhhx10", category: "Products"},
            {label: "annk K12", category: "Products"},
            {label: "annttop C13", category: "Products"},
            {label: "anders andersson", category: "People"},
            {label: "andreas andersson", category: "People"},
            {label: "andreas johnson", category: "People"}
        ];
        $("#search").catcomplete({
            delay: 0,
            source: data
        });


        //tooltips
        $("#show-option").tooltip({
            show: {
                effect: "slideDown",
                delay: 250
            }
        });

        $("#hide-option").tooltip({
            hide: {
                effect: "explode",
                delay: 250
            }
        });

        $("#open-event").tooltip({
            show: null,
            position: {
                my: "left top",
                at: "left bottom"
            },
            open: function (event, ui) {
                ui.tooltip.animate({top: ui.tooltip.position().top + 10}, "fast");
            }
        });


        //Menu
        $("#menu").menu();


        //spinner
        var spinner = $("#spinner").spinner({
            create: function (event, ui) {
                //add custom classes and icons
                $(this)
                        .next().addClass('btn btn-success').html('<i class="ace-icon fa fa-plus"></i>')
                        .next().addClass('btn btn-danger').html('<i class="ace-icon fa fa-minus"></i>')

                //larger buttons on touch devices
                if ('touchstart' in document.documentElement)
                    $(this).closest('.ui-spinner').addClass('ui-spinner-touch');
            }
        });

        //slider example
        $("#slider").slider({
            range: true,
            min: 0,
            max: 500,
            values: [75, 300]
        });



        //jquery accordion
        $("#accordion").accordion({
            collapsible: true,
            heightStyle: "content",
            animate: 250,
            header: ".accordion-header"
        }).sortable({
            axis: "y",
            handle: ".accordion-header",
            stop: function (event, ui) {
                // IE doesn't register the blur when sorting
                // so trigger focusout handlers to remove .ui-state-focus
                ui.item.children(".accordion-header").triggerHandler("focusout");
            }
        });
        //jquery tabs
        $("#tabs").tabs();


        //progressbar
        $("#progressbar").progressbar({
            value: 37,
            create: function (event, ui) {
                $(this).addClass('progress progress-striped active')
                        .children(0).addClass('progress-bar progress-bar-success');
            }
        });


        //selectmenu
        $("#number").css('width', '200px')
                .selectmenu({position: {my: "left bottom", at: "left top"}})

    });
</script>


</body>
</html>

