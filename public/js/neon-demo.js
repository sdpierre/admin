/**
 *	Neon Demo Scripts (Demo Theme Only)
 *
 *	Developed by Arlind Nushi - www.laborator.co
 */

if(typeof Dropzone != 'undefined')
{
	Dropzone.autoDiscover = false;
}

;(function($, window, undefined)
{
	"use strict";
	
	$(document).ready(function()
	{	
		// Dropzone Example
		if(typeof Dropzone != 'undefined')
		{
			if($("#dropzone_example").length)
			{
				var dz = new Dropzone("#dropzone_example"),
					dze_info = $("#dze_info"),
					status = {uploaded: 0, errors: 0};	
				
				var $f = $('<tr><td class="name"></td><td class="size"></td><td class="type"></td><td class="status"></td></tr>');

				dz.on("success", function(file) {
					
					var imageWidth = file.width;
					var imageHeight = file.height;

					if(imageHeight < 400 && imageWidth < 300){

					}else{

						var _$f = $f.clone();
						
						dze_info.removeClass('hidden');
						
						_$f.addClass('success');
						
						_$f.find('.name').html(file.name);
						_$f.find('.size').html(parseInt(file.size / 1024, 10) + ' KB');
						_$f.find('.type').html(file.type);
						_$f.find('.status').html('Uploaded <i class="entypo-check"></i>');
						
						dze_info.find('tbody').append( _$f );
						
						status.uploaded++;
						
						dze_info.find('tfoot td').html('<span class="label label-success">' + status.uploaded + ' uploaded</span> <span class="label label-danger">' + status.errors + ' not uploaded</span>');
					}
				})
				.on('error', function(file)
				{
					console.log(file)
					var _$f = $f.clone();
					
					dze_info.removeClass('hidden');
					
					_$f.addClass('danger');
					
					_$f.find('.name').html(file.name);
					_$f.find('.size').html(parseInt(file.size / 1024, 10) + ' KB');
					_$f.find('.type').html(file.type);
					_$f.find('.status').html('Uploaded <i class="entypo-cancel"></i>');
					
					dze_info.find('tbody').append( _$f );
					
					status.errors++;
					
					dze_info.find('tfoot td').html('<span class="label label-success">' + status.uploaded + ' uploaded</span> <span class="label label-danger">' + status.errors + ' not uploaded</span>');
				});
			}
			
		}

	});
	
})(jQuery, window);

var size;
var crop_max_width = 500;
var crop_max_height = 600;
var jcrop_api;
var canvas;
var context;
var image;

$(document).on("click", ".image-modal", function () {

	$('#modal-1').modal('show');
	var imageId = $(this).data('id');
	var imageUrl = $(this).data('image');
	var imageTitle = $(this).data('title');
	var imageKeywords = $(this).data('keywords');
	var imageDesc = $(this).data('desc');
	var photographer = $(this).data('photographer');

	$("#modal-1 .modal-body #photographer").val( photographer);
	$("#modal-1 .modal-body #imageId").val(imageId);
	$("#modal-1 .modal-body #cropbox").attr("src", imageUrl );
	$("#modal-1 .modal-body #imageTitle").val( imageTitle );
	$("#modal-1 .modal-body #imageKeywords").val( imageKeywords );
	$("#modal-1 .modal-body #imageDesc").val( imageDesc );

	$("#image-crop-modal").find("#imageKeywords").attr('value',$(this).find(".imageKeywords").val());
    $("#image-crop-modal").find("#imageKeywords").attr('data-role','tagsinput');

    // Destroy all previous bootstrap tags inputs (optional)
    $('input[data-role="tagsinput"]').tagsinput('destroy');
    // Create the bootstrap tag input UI
    $('input[data-role="tagsinput"]').tagsinput('items');

    $("#cropbox").Jcrop({
        aspectRatio: (400/600), // This should be Width/Height
	    boxWidth: crop_max_width,   //Maximum width you want for your bigger images
	    boxHeight: crop_max_height,  //Maximum Height for your bigger images
	    onSelect: selectcanvas,
	    setSelect: [0,0,400,600],
	    minSize: [ 400, 600 ]
      }, function() {
        jcrop_api = this;
      });
});


$(document).on("click", ".delete-image", function () {
	$('#modal-2').modal('show');
	var imageId = $(this).data('id');
	$("#modal-2 .modal-body #delImageId").val( imageId );
});


$(document).on("change", "#resize", function () {


	var resize_val = $(this).val();

	if(resize_val == 1){
		$("#resize option[value='0']").removeAttr("selected","");
		$("#resize option[value='1']").attr("selected","selected");

		$("#cropbox").Jcrop({
	        aspectRatio: (600/400), // This should be Width/Height
		    boxWidth: 535,   //Maximum width you want for your bigger images
		    boxHeight: 400,  //Maximum Height for your bigger images
		    onSelect: selectcanvas,
		    setSelect: [0,0,600,400],
		    minSize: [ 600, 400 ]
      	}, function() {
        	jcrop_api = this;
      	});
	} else {
		$("#resize option[value='1']").removeAttr("selected","");
		$("#resize option[value='0']").attr("selected","selected");

		$("#cropbox").Jcrop({
        aspectRatio: (400/600), // This should be Width/Height
	    boxWidth: 500,   //Maximum width you want for your bigger images
	    boxHeight: 700,  //Maximum Height for your bigger images
	    onSelect: selectcanvas,
	    setSelect: [0,0,400,600],
	    minSize: [ 400, 600 ]
      	}, function() {
	        jcrop_api = this;
	    });
	}
	
});


$(document).on("click", "#crop", function () {
	var img = $("#cropbox").attr('src');

    $("#cropped_img").show();
    var selected = $('#resize').val();
    
    if(selected == 1){
    	$("#cropped_img").attr("width","535");
    	$("#cropped_img").attr("height","400");
    } else {
    	$("#cropped_img").attr("width","500");
    	$("#cropped_img").attr("height","700");
    }

	var croppedImageUrl = APP_URL+'/media/cropimage?x='+prefsize.x+'&y='+prefsize.y+'&w='+prefsize.w+'&h='+prefsize.h+'&img='+img;
    $("#cropped_img").attr('src',croppedImageUrl);
    $("#cropImageUrl").val(croppedImageUrl);
    
});

function selectcanvas(coords) {
  prefsize = {
    x: Math.round(coords.x),
    y: Math.round(coords.y),
    w: Math.round(coords.w),
    h: Math.round(coords.h)
  };
  $("#crop").css("visibility", "visible");
}

function clearcanvas() {
  prefsize = {
    x: 0,
    y: 0,
    w: canvas.width,
    h: canvas.height,
  };
}


$(document).ready(function(){
	$('#modal-1').on('hidden.bs.modal', function () {
	  jcrop_api.destroy();
	  $("#crop").css("visibility", "hidden");
	  $("#cropped_img").hide();
	  $("#cropped_img_error").hide();
	});
});

$(document).on("click", ".bulk-modal", function (e) {
	e.preventDefault();
	var bulk_delete = $('#bulk-delete').val();
	if(bulk_delete == 'delete'){
		$('#modal-3').modal('show');
	}
});

$(document).on("click", ".bulk-btn", function () {
	var action_url = APP_URL+'/media/bulk_delete';
	$("#bulk-form").attr('action',action_url);
	$("#bulk-form").submit();
});

$(document).on("click", "#all-delete", function () {
	if ($('input.media').is(':checked')) {
		$(".media").prop('checked',false);
	}else{
		$(".media").attr('checked',true);
	}
});

$(document).on("click", ".attach-modal", function () {
	$('#modal-4').modal('show');
	var mediaId = $(this).data('id');
	$("#modal-4 .modal-body #mediaId").val( mediaId );
	getArticles();
	
});

var ARTICLEID = [];
$(document).on("click", ".article-list .pagination .page-item a", function (e) {
	e.preventDefault();
	// $.each($("input[name='article_id']:checked"), function(){
	// 	ARTICLEID.push($(this).val());
	// });
	var pagelink = $(this).attr('href');
	getArticles(pagelink);
	
});


$(document).on("click", "#search-btn", function (e) {
	e.preventDefault();
	var ser_val = $("#article-serach").val();
	var search_url = APP_URL+'/media/get_all_articles?title='+ser_val;
	getArticles(search_url);
});


function getArticles(url)
{
	var url = (url)?url:APP_URL+'/media/get_all_articles';

	$.ajax({
		url: url,
		type: 'get',
		data:{media_id:$('#mediaId').val()},
		beforeSend: function() {
        	$('#post-list').html('<p>loading...</p>');
       	},
		success: function(response) {
			$('#post-list').html(response);
		}
	});
}

function showMoreArticle(media_id){


	$.ajax({
		url: APP_URL+'/media/get_more_articles',
		type: 'get',
		data:{media_id:media_id},
		beforeSend: function() {
        	$('#more-article-list').html('<p>loading...</p>');
       	},
		success: function(response) {
			$('#more-article-list').html(response);
			$('#modal-8').modal('show');
		}
	});
}

function addArticleToPhoto(){

	// $.each($("input[name='article_id']:checked"), function(){
	// 	ARTICLEID.push($(this).val());
	// });
	ARTICLEID = ARTICLEID.filter( function( item, index, inputArray ) {
			return inputArray.indexOf(item) == index;
	});
	console.log(ARTICLEID);
	var fd = new FormData(); 
	fd.append('articleIds',JSON.stringify(ARTICLEID));
	fd.append('media_id',$('#mediaId').val());
	fd.append('type',$('#type').val());
	
	$.ajax({
		url: APP_URL+'/media/add_featured_image',
		type: 'POST',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		data:fd,
		dataType: 'json',
		processData: false,
        contentType: false,
		success: function(response) {
			$('#modal-4').modal('hide');
			window.location.reload();
		}
	});
}

function removeAddElement(media_id){
	media_id = parseInt(media_id);
	if(!$('#art_'+media_id).is(':checked')){
		var index = ARTICLEID.indexOf(media_id);
		if (index !== -1) {
			ARTICLEID.splice(index, 1);
		}
	}else{
		ARTICLEID.push(media_id);
	}
	console.log(ARTICLEID);
} 


function editArticle(media_id){
	$("#modal-4 .modal-body #mediaId").val( media_id );
	$('#type').val('edit');
	$.ajax({
		url: APP_URL+'/media/get_all_articles',
		type: 'get',
		data:{media_id:media_id},
		beforeSend: function() {
        	$('#more-article-list').html('<p>loading...</p>');
       	},
		success: function(response) {
			var previous;
			setTimeout(function(){
				previous = $('#previous').val();
				var previousArray = JSON.parse("[" + previous + "]");
				for(let i=0;i<previousArray.length;i++){
					ARTICLEID.push(previousArray[i]);
				}
				console.log(ARTICLEID);
			},1000);
			
			$('#post-list').html(response);
			$('#modal-8').modal('hide');
			$('#modal-4').modal('show');
		}
	});
}

var x = 1; //Initial field counter is 1

$(document).ready(function(){
    var maxField = 50; //Input fields increment limitation
    var addButton = $('.add-more'); //Add button selector
    
    //Once add button is clicked
    $(addButton).on('click', '.add_button', function(){
    	var dataArticleId = $(this).attr("data-id");
    	var fieldHTML = '<div class="col-md-3"><div class="add-photo-column"><div class="photo"><div class="add-photo-btn" data-articleid="'+dataArticleId+'">Add photo</div></div><div class="del-edit-btn"><a href="javascript:void(0);" class="remove_button">Delete</a></div><div class="photo-caption"><label>Caption</label><input type="text" readonly="" value="" /></div><div class="photo-desc"><label>Description</label><textarea readonly=""></textarea></div></div></div>'; //New input field html
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(this).closest('.col-md-3').before(fieldHTML); //Add field html
        }
    });
});


$(document).on("click", ".remove_button", function (e) {
	e.preventDefault();
	/*if( x !== 1 ){
		$(this).closest('.col-md-3').remove(); //Remove field html
		x--; //Decrement field counter
	}else{
		alert('You do not delete by default block');
	}*/

	$(this).closest('.col-md-3').remove(); //Remove field html
	x--; //Decrement field counter

});

$(document).on("click", ".article-photo-modal", function () {
	$('#modal-5').modal('show');
	var mediaArticleId = $(this).data('id');
	var articleId = $(this).data('article-id');
	$("#modal-5 .modal-body #mediaArticleId").val( mediaArticleId );
	$("#modal-5 .modal-body #articleId").val( articleId );
});


$(document).on("click", ".add-photo-btn", function () {
	$('#modal-6').modal('show');
	var articleid = $(this).data('articleid');
	$("#modal-6 #articleid").val( articleid );

	$.ajax({
		url: APP_URL+'/article/get-media-photo',
		type: 'get',
		beforeSend: function() {
        	$('#media-list').html('<p>loading...</p>');
       	},
		success: function(response) {
			$('#media-list').html(response);
		}
	});
});

$(document).on("click", ".media_photo_block", function () {

	$("#modal-6 .modal-footer .btn-info").removeAttr("disabled");
	$("#modal-7 .modal-footer .btn-info").removeAttr("disabled");
});

$(document).on("click", ".modal-close", function () {

	$("#modal-6 .modal-footer .btn-info").attr("disabled","disabled");
	$("#modal-7 .modal-footer .btn-info").attr("disabled","disabled");
});

$(document).on("click", ".edit-article-photo-modal", function () {
	$('#modal-7').modal('show');
	var articleid = $(this).data('article-id');
	var mediaarticleid = $(this).data('id');
	$("#modal-7 #article-id").val( articleid );
	$("#modal-7 #media-article-id").val( mediaarticleid );

	$.ajax({
		url: APP_URL+'/article/get-media-photo',
		type: 'get',
		beforeSend: function() {
        	$('#edit-media-list').html('<p>loading...</p>');
       	},
		success: function(response) {
			$('#edit-media-list').html(response);
		}
	});
});


$(document).ready(function(){
	$('#modal-6').on('hidden.bs.modal', function () {
	  	$("#modal-6 .modal-footer .btn-info").attr("disabled","disabled");
	});
	$('#modal-7').on('hidden.bs.modal', function () {
		$("#modal-7 .modal-footer .btn-info").attr("disabled","disabled");
	});
});


function addFeaturedPhoto(d) {
  	var article_id = d.getAttribute("data-article-id");
  	var media_article_id = d.getAttribute('data-id');

  	$.ajax({
  		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		url: APP_URL+'/article/add-to-featured-photo',
		type: 'post',
		data: 'media_article_id='+media_article_id+'&article_id='+article_id,
		success: function(response) {

			if(response === 'TRUE'){
				// Get the snackbar DIV
				var x = document.getElementById("snackbar");

				// Add the "show" class to DIV
				x.className = "show";

				// After 3 seconds, remove the show class from DIV
	  			setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
			}
			
		}
	});
}
