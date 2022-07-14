@extends('layouts.vertical.master')
@section('title', 'Vertical Menu')

@section('css')
<link rel="stylesheet" type="text/css" href="{{route('/')}}/assets/css/prism.css">
<link rel="stylesheet" type="text/css" href="{{route('/')}}/assets/css/vertical-menu.css">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
	<h2>Vertical<span>Menu</span></h2>
@endsection

@section('breadcrumb-items')
	<li class="breadcrumb-item">Perk UI</li>
    <li class="breadcrumb-item">Menu Options</li>	
	<li class="breadcrumb-item active">Vertical Menu</li>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
     <div class="col-sm-12">
        <div class="card alert alert-primary" role="alert">
           <h4 class="alert-heading">Tip!</h4>
           <p>
              When you want to set the sidebar vertically, than use this Page Layout and you will easily be able to set the
              vertical menu.
           </p>
        </div>
     </div>
     <div class="col-sm-12">
        <div class="card">
           <div class="card-header">
              <h5>How to use it?</h5>
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
              <h5>Step 1</h5>
              <p>Include vertical-menu.js & vertical-menu.css</p>
              <h5>Step 2</h5>
              <p>You need to replace page-sidebar call to vertical-menu-main class when you want to use vertical menu.</p>
              <h5>Step 3</h5>
              <p>Copy html code of navbar according to your requirement in this layout.</p>
              <h5>Step 4</h5>
              <p class="mb-0">Finally, you can change the content according to your need.</p>
              <div class="code-box-copy">
                 <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                 <pre class="language-html"><code class="language-html" id="example-head">&lt;!-- Cod Box Copy begin --&gt;
&lt;div class=&quot;card-body&quot;&gt;
&lt;h5&gt;Step 1&lt;/h5&gt;
&lt;p&gt;Include vertical-menu.js & vertical-menu.css&lt;/p&gt;
&lt;h5&gt;Step 2&lt;/h5&gt;
&lt;p&gt;You need to replace page-sidebar call to vertical-menu-main class when you want to use vertical menu.&lt;/p&gt;
&lt;h5&gt;Step 3&lt;/h5&gt;
&lt;p&gt;Copy html code of navbar according to your requirement in this layout.&lt;/p&gt;
&lt;h5&gt;Step 4&lt;/h5&gt;
&lt;p&gt;Finally, you can change the content according to your need.&lt;/p&gt;
&lt;/div&gt;
&lt;!-- Cod Box Copy end --&gt;</code></pre>
              </div>
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
<script src="{{route('/')}}/assets/js/jquery.drilldown.js"></script>
<script src="{{route('/')}}/assets/js/vertical-menu.js"></script>
<script src="{{route('/')}}/assets/js/megamenu.js"></script>
@endsection

