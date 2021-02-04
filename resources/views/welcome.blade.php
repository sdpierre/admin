<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Le Nouvelliste - @yield('title') </title>

	<link rel="stylesheet" href="{{ asset('js/jquery-ui/js/jquery-ui.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/font-icons/entypo/css/entypo.css') }}">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('css/neon-core.css') }}">
	<link rel="stylesheet" href="{{ asset('css/neon-theme.css') }}">
	<link rel="stylesheet" href="{{ asset('css/neon-forms.css') }}">
	<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
	<link rel="stylesheet" href="{{ asset('css/skins/blue.css') }}">
	<link rel="stylesheet" href="{{ asset('css/lightbox.css') }}">
	<link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
	<link rel="stylesheet" href="{{ asset('js/dropzone/dropzone.css') }}">
	<link rel="stylesheet" href="{{ asset('css/jquery.Jcrop.min.css') }}">
	<link href="{{ asset('css/tagsinput.css') }}" rel="stylesheet" type="text/css">
	<script src="{{ asset('js/jquery-ui/js/jquery-3.2.1.min.js') }}"></script>
	<!-- <script src="{{ asset('js/jquery-1.11.3.min.js') }}"></script> -->
	
	
	
	<script>
	function resizeIframe(obj) {
    	obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  	}
	</script>

	@yield('my-css')


	<!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<script type="text/javascript">
		var APP_URL = "{{ url('/') }}";
	</script>

</head>

<body class="page-body" data-url="http://neon.dev">

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

	<div class="sidebar-menu">

		<div class="sidebar-menu-inner">

			<header class="logo-env">

				<!-- logo -->
				<div class="logo">
					<a href="/">
						<img src="{{ asset('images/logo@2x.png') }}" width="120" alt="" />
					</a>
				</div>

				<!-- logo collapse icon -->
				<div class="sidebar-collapse">
					<a href="#" class="sidebar-collapse-icon">
						<!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
						<i class="entypo-menu"></i>
					</a>
				</div>


				<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
				<div class="sidebar-mobile-menu visible-xs">
					<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
						<i class="entypo-menu"></i>
					</a>
				</div>

			</header>


			<ul id="main-menu" class="main-menu">
				<!-- add class "multiple-expanded" to allow multiple submenus to open -->
				<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
				<li>
					<a href="{{ url('/') }}">
						<i class="entypo-gauge"></i>
						<span class="title">Tableau de bord</span>
					</a>
				</li>

				<li>
					<a href="{{ url('/') }}/search">
						<i class="entypo-search"></i>
						<span class="title">Recherche</span>
					</a>
				</li>
	  			
				<!-- <li>
					<a href="{{ url('/') }}/annonces">
						<i class="entypo-pencil"></i>
						<span class="title">Annonces</span>
					</a>
					<ul>
						<li>
							<a href="{{ url('/') }}/annonces">
								<span class="title">List</span>
							</a>
						</li>
						<li>
							<a href="{{ url('/') }}/annonces">
								<span class="title">Les catégories</span>
							</a>
						</li>
					</ul>
				</li> -->

				

				<li>
					<a href="{{ url('/') }}/article/addnew/post/">
						<i class="entypo-pencil"></i>
						<span class="title">Article</span>
					</a>
				</li>

				<li>
					<a href="{{ url('/') }}/article">
						<i class="entypo-pencil"></i>
						<span class="title">Publications</span>
					</a>
				</li>

				<li>
					<a href="{{ url('/') }}/breaking">
						<i class="entypo-pencil"></i>
						<span class="title">Breaking News</span>
					</a>
				</li>
				
				<li>
					<a href="{{ url('/') }}/medias">
						<i class="entypo-camera"></i>
						<span class="title">Apparence</span>
					</a>
					<ul>
						<li>
							<a href="{{ url('/') }}/widgets/">
								<span class="title">Widgets</span>
							</a>
						</li>
					</ul>
				</li>

				<li>
					<a href="{{ url('/') }}/media">
						<i class="entypo-camera"></i>
						<span class="title">Médias</span>
					</a>
					<ul>
						<li>
							<a href="{{ url('/') }}/media/">
								<span class="title">Bibliothèque</span>
							</a>
						</li>
						<li>
							<a href="{{ url('/') }}/media/create">
								<span class="title">Ajouter</span>
							</a>
						</li>
					</ul>
				</li>
				

				<li>
					<a href="#">
						<i class="entypo-mail"></i>
						<span class="title">Newsletters</span>
					</a>
					<ul>
						<li>
							<a href="{{ url('/') }}/newsletters/">
								<span class="title">All newsletters</span>
							</a>
						</li>
						<li>
							<a href="{{ url('/') }}/newsletters/emails">
								<span class="title">All emails</span>
							</a>
						</li>

						<li>
							<a href="{{ url('/') }}/newsletters/custom">
								<span class="title">Custom</span>
							</a>
						</li>
					</ul>
				</li>

				<!-- <li>
					<a href="/caricatures">
						<i class="entypo-brush"></i>
						<span class="title">Caricatures</span>
					</a>
					<ul>
						<li>
							<a href="{{ url('/') }}/caricatures">
								<span class="title">All Caricatures</span>
							</a>
						</li>
						<li>
							<a href="{{ url('/') }}/caricatures-new/">
								<span class="title">Add new</span>
							</a>
						</li>
					</ul>
				</li> -->

				<li>
					<a href="/user">
						<i class="entypo-users"></i>
						<span class="title">Users</span>
					</a>
					<ul>
						<li>
							<a href="/user/">
								<span class="title">All users</span>
							</a>
						</li>

						<li>
							<a href="/user/create">
								<span class="title">Add a user</span>
							</a>
						</li>

						<li>
							<a href="/groups">
								<span class="title">Roles</span>
							</a>
						</li>

					</ul>
				</li>
				

				

			</ul>

		</div>

	</div>



	<div class="main-content">
		<div class="row">

			<!-- Profile Info and Notifications -->
			<div class="col-md-6 col-sm-8 clearfix">

				<ul class="user-info pull-left pull-none-xsm">

					<!-- Profile Info -->
					<li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->

						<a href="#" class="dropdown-toggle" data-toggle="dropdown">



						@if (empty(Auth::user()->photo ))
						<img src="{{ asset('images/nophoto.png')}}" alt="" class="img-circle" width="44">
						@else
						<img src="http://images.lenouvelliste.com/staff/{{ Auth::user()->photo }}" alt="" class="img-circle" width="44">
						@endif



							<?php if (Auth::check())
								{ ?>
								{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
								<?php $user_id = Auth::user()->id ?>
							<?php } ?>
						</a>



						<ul class="dropdown-menu">

							<!-- Reverse Caret -->
							<li class="caret"></li>

							<!-- Profile sub-links -->
							<li>
								<a href="{{ url('user/edit/'.$user_id.'')}}">
									<i class="entypo-user"></i>
									Modifier votre profil
								</a>
							</li>
						</ul>
					</li>

				</ul>

			</div>


			<!-- Raw Links -->
			<div class="col-md-6 col-sm-4 clearfix hidden-xs">

				<ul class="list-inline links-list pull-right">

					<li class="sep"></li>

					<li>
					<form method="POST" action="{{ url('/') }}/logout">
					    {!! csrf_field() !!}
					    <button type="submit" class="btn btn-link">Se déconnecter <i class="entypo-logout right"></i></button>
					</form>

					</li>
				</ul>

			</div>

		</div>

		<hr>

		@yield('content')


	</div>



</div>




	<!-- Bottom scripts (common) -->

	<script src="{{ asset('js/gsap/main-gsap.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/moment.js') }}"></script>
	<!-- <script src="{{ asset('js/jquery-ui/js/jquery-ui.min.js') }}"></script> -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
	
	<script src="{{ asset('js/bootstrap-datepicker.fr.min.js') }}"></script>
	<script src="{{ asset('js/joinable.js') }}"></script>
	<script src="{{ asset('js/resizeable.js') }}"></script>
	<script src="{{ asset('js/neon-api.js') }}"></script>
	<script src="{{ asset('js/wysihtml5/wysihtml5-0.4.0pre.min.js') }}"></script>
	<script src="{{ asset('js/lightbox.js') }}"></script>
	<script src="{{ asset('js/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
	<script src="{{ asset('js/dropzone/dropzone.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
	<script src="{{ asset('js/tagsinput.js') }}"></script>


	@yield('javascript')

	<!-- JavaScripts initializations and stuff -->
	<script src="{{ asset('js/neon-custom.js') }}"></script>

	<script src="{{ asset('js/jquery.Jcrop.min.js') }}"></script>
	<!-- Demo Settings -->
	<script src="{{ asset('js/neon-demo.js') }}"></script>

	<!-- Modal 1 (Basic)-->
	<div class="modal fade" id="modal-1">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Update and Crop Image</h4>
				</div>
				<form method="post" action="{{ url('media/update') }}" enctype="multipart/form-data" class="form-horizontal form-groups-bordered" role="form" id="image-crop-modal">
					<div class="modal-body">
							{{ csrf_field() }}
							<input type="hidden" name="image_id" id="imageId" value="" />
							<input type="hidden" name="crop_img_url" id="cropImageUrl" value="" />
							<div class="form-group">
								<div class="col-sm-12">
									<img src="" id="cropbox" class="img responsive-img" />
								</div>
							</div>
							<div class="form-group">
								<div class="row" style="margin: 0">
									<div id="btn" class="col-sm-3 col-xs-4">
									    <input type='button' id="crop" value='CROP' />
									</div>
									<div class="col-sm-6 col-xs-8">
									    <select class="form-control" id="resize">
									    	<option value="0" selected="selected">Potrait (400x600)</option>
									    	<option value="1">Landscape (600x400)</option>
									    </select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
								   <img src="#" width="500" height="700" class="responsive-img" id="cropped_img" style="display:none;" />
								</div>
							</div>
							<div class="form-group">
								<label for="field-1" class="col-sm-12">Title</label>
								<div class="col-sm-12">
									<input type="text" class="form-control" name="title" id="imageTitle" value="" placeholder="Enter image title" />
								</div>
							</div>
							<div class="form-group">
								<label for="field-1" class="col-sm-12">Keyword</label>
								<div class="col-sm-12">
									<input type="text" class="form-control" data-role="tagsinput" name="keywords" id="imageKeywords" value="" placeholder="Enter image keywords" />
								</div>
							</div>
							<div class="form-group">
								<label for="field-1" class="col-sm-12">Photographer</label>
								<div class="col-sm-12">
									<input type="text" class="form-control" data-role="tagsinput" name="photographer" id="photographer" value="" placeholder="Enter photographer name" />
								</div>
							</div>
							<div class="form-group">
								<label for="field-2" class="col-sm-12">Description</label>
								<div class="col-sm-12">
									<textarea cols="6" rows="6" name="description" id="imageDesc" class="form-control" placeholder="Enter image description"></textarea>
								</div>
							</div>
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-info">Apply changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Modal 2 (Basic)-->
	<div class="modal fade" id="modal-2">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Delete Image</h4>
				</div>
				<form method="post" action="{{ url('media/destroy') }}" class="form-horizontal form-groups-bordered" role="form">
					<div class="modal-body">
						{{ csrf_field() }}
						<input type="hidden" name="del_image_id" id="delImageId" value="" />
						<p>Do you want to delete this image ?</p>
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-info">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Modal 3 (Basic)-->
	<div class="modal fade" id="modal-3">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Bulk Delete</h4>
				</div>
				<div class="modal-body">
					<p>You are about to delete these items from your site.</p>
					<p>This action cannot be undone.</p>
					<p>'Cancel' to stop, 'OK' to delete.</p>
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button class="btn btn-info bulk-btn">OK</button>
				</div>
			</div>
		</div>
	</div>


	<!-- Modal 4 (Basic)-->
	<div class="modal fade" id="modal-4">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Attach to existing content</h4>
				</div>
				<form method="post" action="{{ url('media/add_featured_image') }}">
					{{ csrf_field() }}
					<div class="modal-body">
						<input type="hidden" name="media_id" id="mediaId" value="" />
						<div class="row">
							<div class="col-md-12">
								<input type="text" id="article-serach" />
								<button id="search-btn">Search</button>
								<br>
								<div id="post-list"></div>
							</div>
						</div>
						
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-info bulk-btn">Select</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Modal 5 (Basic)-->
	<div class="modal fade" id="modal-5">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Remove Photo</h4>
				</div>
				<form method="post" action="{{ url('article/media-article/destroy') }}" class="form-horizontal form-groups-bordered" role="form">
					<div class="modal-body">
						{{ csrf_field() }}
						<input type="hidden" name="media_article_id" id="mediaArticleId" value="" />
						<input type="hidden" name="article_id" id="articleId" value="" />
						<p>Do you want to remove this image ?</p>
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-info">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Modal 6 (Basic)-->
	<div class="modal fade" id="modal-6">
		<div class="modal-dialog" style="width: 80%">
			<div class="modal-content">
				<form method="post" action="{{ url('article/media-article/store') }}" class="form-horizontal form-groups-bordered" role="form">
					{{ csrf_field() }}
					<input type="hidden" name="article_id" id="articleid" value="" />
					<div class="modal-header">
						<button type="button" class="close modal-close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Media Gallery</h4>
					</div>
					<div class="modal-body">
						<div id="media-list"></div>
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-info" disabled="">Add</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Modal 7 (Basic)-->
	<div class="modal fade" id="modal-7">
		<div class="modal-dialog" style="width: 80%">
			<div class="modal-content">
				<form method="post" action="{{ url('article/media-article/update') }}" class="form-horizontal form-groups-bordered" role="form">
					{{ csrf_field() }}
					<input type="hidden" name="article_id" id="article-id" value="" />
					<input type="hidden" name="media_article_id" id="media-article-id" value="" />
					<div class="modal-header">
						<button type="button" class="close modal-close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Media Gallery</h4>
					</div>
					<div class="modal-body">
						<div id="edit-media-list"></div>
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-info" disabled="">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- The actual snackbar -->
	<div id="snackbar">Add to featured image...</div>
</body>
</html>