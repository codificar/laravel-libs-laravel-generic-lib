<?php $layout = '.master'; ?>
       
@extends('layout'.$layout)

@section('breadcrumbs')
<div class="row page-titles">
	<div class="col-md-6 col-8 align-self-center">

		<h3 class="text-themecolor m-b-0 m-t-0">{{ trans('libTans::generic.generic')}}</h3>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('libTans::generic.home') }}</a></li>
			<li class="breadcrumb-item active">{{ trans('libTans::generic.settings') }}</li>
		</ol>
	</div>
</div>	
@stop


@section('content')
	<div id="VueJs">
		
		<genericvuejs 
			teste="{{ $teste }}"	
			
		>
		</genericvuejs>
		
	</div>

		

	</div>

@stop

@section('javascripts')
<script src="/libs/lang.trans/generic"> </script> 



<script src="{{ elixir('vendor/codificar/generic/generic.vue.js') }}"> </script> 
       
@stop
