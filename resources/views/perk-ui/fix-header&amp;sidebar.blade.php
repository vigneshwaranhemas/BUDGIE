@extends('layouts.simple.master')
@section('title', 'Fix Header & Sidebar')

@section('css')
<link rel="stylesheet" type="text/css" href="{{route('/')}}/assets/css/prism.css">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
	<h2>Fix<span>Header & Sidebar</span></h2>
@endsection

@section('breadcrumb-items')
	<li class="breadcrumb-item">Perk UI</li>
    <li class="breadcrumb-item">Menu Options</li>	
	<li class="breadcrumb-item active">Fix Header & Sidebar</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="card alert alert-primary" role="alert">
            <h4 class="alert-heading">Tip!</h4>
            <p>Add the position attribute set to fixed to the page-main-header & page-sidebar class to get this layout.</p>
         </div>
      </div>
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header">
               <h5>Title</h5>
               <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                     <li><i class="icofont icofont-simple-left"></i></li>
                     <li><i class="view-html fa fa-code"></i></li>
                     <li><i class="icofont icofont-maximize full-card"></i></li>
                     <li><i class="icofont icofont-minus minimize-card"></i></li>
                     <li><i class="icofont icofont-refresh reload-card"></i></li>
                     <li><i class="icofont icofont-error close-card"></i></li>
                  </ul>
               </div>
            </div>
            <div class="card-body">
               <span>Start Here</span>
               <div class="code-box-copy">
                  <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                  <pre><code class="language-html" id="example-head">&lt;!-- Cod Box Copy begin --&gt;
&lt;div class=&quot;card-body&quot;&gt;
&lt;span&gt;Start Here&lt;/span&gt;
&lt;/div&gt;
&lt;!-- Cod Box Copy end --&gt;</code></pre>
               </div>
            </div>
            <div class="card-footer">
               <h6 class="mb-0">Card Footer</h6>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
<script src="{{route('/')}}/assets/js/prism/prism.min.js"></script>
<script src="{{route('/')}}/assets/js/clipboard/clipboard.min.js"></script>
<script src="{{route('/')}}/assets/js/custom-card/custom-card.js"></script>
@endsection