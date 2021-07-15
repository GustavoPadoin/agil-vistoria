@extends('layout.site')

@section('content')
    <!-- Content -->
    <div class="page-content">
        <!-- Slider -->
        <div id="div-home" class="main-slider style-two default-banner">
            <div class="tp-banner-container">
                <div class="tp-banner" >
                    <div id="rev_slider_1014_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="typewriter-effect" data-source="gallery">
                        <!-- START REVOLUTION SLIDER 5.3.0.2 -->
                        <div id="rev_slider_1014_1" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.3.0.2">
                            <ul>
                                <!-- SLIDE 1 -->
                                <li data-index="rs-1000" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="{{ asset('img/slide1.jpg') }}" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                                    <!-- MAIN IMAGE -->
                                    <img src="{{ asset('img/slide1.jpg') }}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina/>
                                    <!-- LAYER NR. 1 [ for overlay ] -->
                                    <div class="tp-caption tp-shape tp-shapewrapper " 
										id="slide-100-layer-1" 
										data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
										data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" 
										data-width="full"
										data-height="full"
										data-whitespace="nowrap"
										data-type="shape" 
										data-basealign="slide" 
										data-responsive_offset="off" 
										data-responsive="off"
										data-frames='[{"from":"opacity:0;","speed":1000,"to":"o:1;","delay":0,"ease":"Power4.easeOut"},{"delay":"wait","speed":1000,"to":"opacity:0;","ease":"Power4.easeOut"}]'
										data-textAlign="['left','left','left','left']"
										data-paddingtop="[0,0,0,0]"
										data-paddingright="[0,0,0,0]"
										data-paddingbottom="[0,0,0,0]"
										data-paddingleft="[0,0,0,0]"
										style="z-index: 12;background-color:rgba(0, 0, 0, 0.50);border-color:rgba(0, 0, 0, 0);border-width:0px;"> 
									</div>
									
									<!-- LAYER NR. 2 [ for title ] -->
									<div class="tp-caption tp-resizeme" 
										id="slide-100-layer-2" 
										data-x="['left','left','left','left']" data-hoffset="['30','30','30','30']" 
										data-y="['top','top','top','top']" data-voffset="['150','110','110','70']" 
										data-fontsize="['55','55','55','36']"
										data-lineheight="['60','60','60','46']"
										data-width="['1000','1000','1000','1000']"
										data-height="['none','none','none','none']"
										data-whitespace="['normal','normal','normal','normal']"
										data-type="text" 
										data-responsive_offset="on"
										data-frames='[{"from":"y:50px(R);opacity:0;","speed":1500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},{"delay":"wait","speed":1000,"to":"y:-50px;opacity:0;","ease":"Power2.easeInOut"}]'
										data-textAlign="['left','left','left','left']"
										data-paddingtop="[0,0,0,0]"
										data-paddingright="[0,0,0,0]"
										data-paddingbottom="[0,0,0,0]"
										data-paddingleft="[0,0,0,0]"
										style="z-index: 13; white-space: normal; font-size: 60px; line-height: 60px; font-weight: 700; color: rgba(255, 255, 255, 1.00); border-width:0px;"> 
										
                                        <a href="#" class="btn btn-danger btn-agendar" style="padding: 10px 15px; font-size: 18px; margin-bottom: 20px;">AGENDAR PELO SITE</a>
                                        <a href="http://api.whatsapp.com/send?1=pt_BR&phone=5586999970691" target="_blank" class="btn btn-danger" style="padding: 10px 15px; font-size: 18px; margin-bottom: 20px;">AGENDAR VIA WHATSAPP</a><br/>
                                        <span class="text-uppercase" style="font-family: 'Poppins',sans-serif;">VISTORIA VEICULAR</span>
									</div>
									
									<!-- LAYER NR. 3 [ for paragraph] -->
									<div class="tp-caption tp-resizeme" 
										id="slide-100-layer-3" 
										data-x="['left','left','left','left']" data-hoffset="['30','30','30','30']" 
										data-y="['top','top','top','top']" data-voffset="['300','250','250','190']" 
										data-fontsize="['20','20','20','20']"
										data-lineheight="['30','30','30','30']"
										data-width="['800','800','700','420']"
										data-height="['none','none','none','none']"
										data-whitespace="['normal','normal','normal','normal']"
										data-type="text" 
										data-responsive_offset="on"
										data-frames='[
										{"from":"y:50px(R);opacity:0;","speed":1500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},
										{"delay":"wait","speed":1000,"to":"y:-50px;opacity:0;","ease":"Power2.easeInOut"}]'
										data-textAlign="['left','left','left','left']"
										data-paddingtop="[0,0,0,0]"
										data-paddingright="[0,0,0,0]"
										data-paddingbottom="[0,0,0,0]"
										data-paddingleft="[0,0,0,0]"
										style="z-index: 13; font-weight: 500; color: rgba(255, 255, 255, 0.85); border-width:0px;"> 
										<span>A vistoria veicular que se da por meio de um laudo de transferência é exigido pelo detran para fazer alteração 
                                            de proprietário do veiculo, município e alterações de características .Os dados de chassi , motor e renavam são 
                                            confrontados com a base estadual e nacional para saber se o veiculo passou por alguma adulteração. <br/><br/>
                                            É uma forma que as autoridades de transito visualizam a diminuição de furtos , roubos e adulterações de carros.</span> 
									</div>
                                </li>
                            </ul>
                            <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
                        </div>
                    </div>
                    <!-- END REVOLUTION SLIDER -->
                </div>
            </div>
        </div>
        <!-- Slider END -->
        <!-- meet & ask -->
        <div class="section-full z-index100 meet-ask-outer bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 meet-ask-row p-tb30">
                        <div class="row d-flex">
                            <div class="col-lg-12 m-t20"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- meet & ask END -->
        <!-- About Company -->
        <div id="div-agendar" class="section-full bg-white content-inner-1" style="background-image: url({{ asset('img/bg-img.png') }}); background-repeat: repeat-x; background-position: left bottom -37px;">
            <div class="container">
				<div class="row">
					<div class="col-lg-12 about-contant">
						<div class="m-b20">
							<h2 class="text-uppercase m-t0 m-b10">Agendar<span class="text-primary"> Vistoria</span></h2>
							<div class="clear"></div>
						</div>

                        {{ Form::model(null, array('route' => 'site.store', 'method' => 'post', 'id' => 'site-form')) }}

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php 
                                            $itens[''] = 'Selecione um servico ...';
                                            foreach ($servicos as $servico){
                                                $itens[$servico->id] = $servico->nome . ' - R$ ' . $servico->valor;
                                            }
                                        ?>
                                        {{ Form::label('servico_id', 'Serviço*') }}
                                        {{ Form::select('servico_id', $itens, null, array('class' => 'form-control')) }}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php 
                                            $itens3[''] = 'Selecione uma cidade ...';
                                            foreach ($cidades as $cidade){
                                                $itens3[$cidade->id] = $cidade->nome;
                                            }
                                        ?>   
                                        {{ Form::label('cidade_id', 'Cidade*') }}
                                        {{ Form::select('cidade_id', $itens3, null, array('class' => 'form-control')) }}
                                    </div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {{ Form::label('data', 'Data*') }}
                                        {{ Form::text('data', null, array('class' => 'form-control', 'id' => 'datepicker', 'style' => 'display: inline-block; width: 85%;')) }}
                                    </div>        
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {{ Form::label('hora', 'Hora*') }}
                                        {{ Form::select('hora', [], null, array('class' => 'form-control')) }}
                                    </div>
                                </div>        
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <?php 
                                            $itens2[''] = 'Selecione uma marca ...';
                                            foreach ($marcas as $marca){
                                                $itens2[$marca->id] = $marca->nome;
                                            }
                                        ?>    
                                        {{ Form::label('marca_id', 'Marca') }}
                                        {{ Form::select('marca_id', $itens2, null, array('class' => 'form-control', 'onchange' => 'carrega_modelos(this.value)')) }}
                                    </div>    
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {{ Form::label('modelo_id', 'Veiculo') }}
                                        {{ Form::select('modelo_id', [], null, array('class' => 'form-control')) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {{ Form::label('outro', 'Outro') }}
                                        {{ Form::text('outro', null, array('class' => 'form-control', 'maxlength' => '60')) }}
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {{ Form::label('placa', 'Placa*') }}
                                        {{ Form::text('placa', null, array('class' => 'form-control', 'maxlength' => '7')) }}
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <?php $itens4 = ['' => 'Selecione uma opção', 1 => 'Pagamento Online', 2 => 'Pagamento Balcão']; ?>
                                        {{ Form::label('pagamento', 'Pagamento*') }}
                                        {{ Form::select('pagamento', $itens4, null, array('class' => 'form-control')) }}  
                                    </div>  
                                </div>        
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {{ Form::label('nome', 'Nome*') }}
                                        {{ Form::text('nome', null, array('class' => 'form-control', 'maxlength' => '60')) }}
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {{ Form::label('cpf', 'CPF') }}
                                        {{ Form::text('cpf', null, array('class' => 'form-control')) }}
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {{ Form::label('cnpj', 'CNPJ') }}
                                        {{ Form::text('cnpj', null, array('class' => 'form-control')) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        {{ Form::label('telefone', 'Telefone*') }}
                                        {{ Form::text('telefone', null, array('class' => 'form-control')) }}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {{ Form::label('email', 'Email*') }}
                                        {{ Form::text('email', null, array('class' => 'form-control', 'maxlength' => '80')) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    {{ Form::button('Agendar', array('class' => 'site-button', 'id' => 'site-button')) }}    
                                </div>        
                            </div><br/>    

                        {{ Form::close() }}

					</div>
                </div>
            </div>
        </div>
        <!-- About Company END -->
        <!-- Our Projects  -->
        <div id="div-fotos" class="section-full bg-img-fix content-inner overlay-black-middle" style="background-image:url({{ asset('img/bg1.jpg') }});">
            <div class="container">
                <div class="section-head  text-center text-white">
                    <h2 class="text-uppercase">Galeria de Fotos</h2>
                    <div class="dlab-separator-outer ">
                        <div class="dlab-separator bg-white style-skew"></div>
                    </div>
                </div>
				<ul id="masonry" class="row dlab-gallery-listing gallery-grid-4 lightgallery gallery s m-b0">
                    <?php $fotos = ['foto1.jpg', 'foto2.jpg', 'foto3.jpg', 'foto4.jpg', 'foto5.jpg']; ?>
                    @foreach ($fotos as $foto)
                        <li class="home card-container col-lg-4 col-md-4 col-sm-6">
                            <div class="dlab-box dlab-gallery-box">
                                <div class="dlab-media dlab-img-overlay1 dlab-img-effect zoom-slow"> <a href="javascript:void(0);"> <img src="{{ asset('img/'.$foto) }}"  alt=""> </a>
                                    <div class="overlay-bx">
                                        <div class="overlay-icon"> 
                                            <a href="javascript:void(0);"> <i class="fa fa-link icon-bx-xs"></i> </a> 
                                            <span data-exthumbimage="{{ asset('img/'.$foto) }}" data-src="{{ asset('img/'.$foto) }}" class="fa fa-picture-o icon-bx-xs check-km" title="Light Gallery Grid 1"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach	
				</ul>
            </div>
        </div>
        <!-- Our Projects END -->
        <!-- OUR SERVICES -->
        <div id="div-servicos" class="section-full bg-white content-inner">
            <div class="container">
                <div class="section-head text-center">
                    <h2 class="text-uppercase"> SERVIÇOS</h2>
                    <div class="dlab-separator-outer ">
                        <div class="dlab-separator bg-secondry style-skew"></div>
                    </div>
                </div>
                <div class="row">
                    <?php $services = ['PEQUENO', 'MÉDIO', 'GRANDE']; ?>                
                    @foreach ($services as $service)                
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="icon-bx-wraper center m-b40">
                                <div class="icon-bx-lg"> <i class="fa fa-4x fa-car" style="color: #EE3131;"></i> </div>
                                <div class="icon-content">
                                    <h5 class="dlab-tilte text-uppercase">VISTORIA DE TRANSFERÊNCIA DE {{ $service }} PORTE</h5>
                                    <p style="font-size: 18px;"><strong>R$ 131,40</strong></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- OUR SERVICES END-->
    </div>
    <!-- Content END-->
@endsection

@section('js')
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/jquery.form.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap2.min.js') }}"></script>
    <script src="{{ asset('js/bootbox.min.js') }}"></script>
    <script src="{{ asset('js/vistorias.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('js/site.js') }}"></script>
@endsection