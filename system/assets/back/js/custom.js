function clear_form(){
	$(':input:not([type=hidden])').val('').attr('value', '');
	$('textarea').val('').attr('value', '').text('');
	/*$('.select2').select2('val', '');*/
	$('.npm').attr('class', 'npm hidden');
}

jQuery(window).load(function() {
   
   // Page Preloader
   jQuery('#status').fadeOut();
   jQuery('#preloader').delay(350).fadeOut(function(){
      jQuery('body').delay(350).css({'overflow':'visible'});
   });
});

jQuery(document).ready(function() {
   $('.date-picker').datepicker({
				format: 'yyyy/mm/dd'
			});
   $('.form-act').ajaxForm({
		url: $(this).attr('action'),
		type: $(this).attr('method'),
		dataType: 'json',
		resetForm: $(this).attr('reset-form'),
		beforeSerialize: function(form, options) {
			$(':button[type=submit]').button('loading');
		},
		beforeSubmit: function(arr, form, options) { 
			$(':button[type=submit]').button('loading');
			$.gritter.add({
				title: 'Mengirim Data!',
				text: '<div class="progress progress-striped active"><div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><small>Tunggu...</small><span class="sr-only">Tunggu...</span></div></div>',
				class_name: 'gritter-info',
				time: 300
			});
		},
		uploadProgress: function(event, position, total, percentComplete) {
			$(':button[type=submit]').button('loading');
			$.gritter.add({
				title: 'Proses Upload '+percentComplete+'%',
				text: '<div class="progress progress-striped active"><div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="'+percentComplete+'" aria-valuemin="0" aria-valuemax="100" style="width: '+percentComplete+'%;"><small>Memproses '+percentComplete+'%...</small><span class="sr-only">Memproses '+percentComplete+'%...</span></div></div>',
				class_name: 'gritter-info',
				time: 300
			});
		},
		success: function(data) {
			if(data.status === '1'	||	data.status === 1) { 
				if(typeof	data.tabel	!==	'undefined')	{
					if(data.tabel.refresh_tabel){
						$('#tableAjax-'+data.tabel.data_tabel).dataTable().fnDestroy();
						initTable(data.tabel.link_tabel, data.tabel.data_tabel);
					}
				}
				$.gritter.add({
					title: 'Sukses!',
					text: data.pesan,
					class_name: 'gritter-success',
					time: 500
				});
			} 
			else {
				$.gritter.add({
					title: 'Gagal!',
					text: data.pesan,
					class_name: 'gritter-warning'
				});
				$.each(data.form, function(index, item) {
					if(item.length > 0) {
						$.gritter.add({
							title: 'Gagal!',
							text: item,
							class_name: 'gritter-warning'
						});
					}
				});
			}
			if(data.thash != '') {
				$('input[name='+TOKEN_NAME+']').val(data.thash).attr('value', data.thash);
			}
			if(data.draw != '') {
				$('.draw').html(data.draw);
			}
			if(data.reload	==	1	||	data.reload	==	'1') {
				setTimeout(function() { window.location.reload(true); }, 3000);
			}
			$(':button[type=submit]').button('reset');
		},
		error: function() {
			var	
				now		=	new Date().getTime() / 1000,
				s			=	parseInt(now, 10),
				mktime	=	(Math.round((now - s) * 1000) / 1000);
			$.getJSON(API_URL, {'get-thash':''+mktime}, function(data){
				if(data.thash != '') {
					$('input[name='+TOKEN_NAME+']').val(data.thash).attr('value', data.thash);
				}
			});
			$.gritter.add({
				title: 'Gagal!',
				text: 'Kesalahan terdapat pada server.',
				class_name: 'gritter-error',
				time: 300
			});
			$(':button[type=submit]').button('reset');
		}
	});
   
   // Toggle Left Menu
   jQuery('.nav-parent > a').click(function() {
      
      var parent = jQuery(this).parent();
      var sub = parent.find('> ul');
      
      // Dropdown works only when leftpanel is not collapsed
      if(!jQuery('body').hasClass('leftpanel-collapsed')) {
         if(sub.is(':visible')) {
            sub.slideUp(200, function(){
               parent.removeClass('nav-active');
               jQuery('.mainpanel').css({height: ''});
               adjustmainpanelheight();
            });
         } else {
            closeVisibleSubMenu();
            parent.addClass('nav-active');
            sub.slideDown(200, function(){
               adjustmainpanelheight();
            });
         }
      }
      return false;
   });
   
   function closeVisibleSubMenu() {
      jQuery('.nav-parent').each(function() {
         var t = jQuery(this);
         if(t.hasClass('nav-active')) {
            t.find('> ul').slideUp(200, function(){
               t.removeClass('nav-active');
            });
         }
      });
   }
   
   function adjustmainpanelheight() {
      // Adjust mainpanel height
      var docHeight = jQuery(document).height();
      if(docHeight > jQuery('.mainpanel').height())
         jQuery('.mainpanel').height(docHeight);
   }
   
   
   // Tooltip
   jQuery('.tooltips').tooltip({ container: 'body'});
   
   // Popover
   jQuery('.popovers').popover();
   
   // Close Button in Panels
   jQuery('.panel .panel-close').click(function(){
      jQuery(this).closest('.panel').fadeOut(200);
      return false;
   });
   
   // Form Toggles
   jQuery('.toggle').toggles({on: true});
   
   jQuery('.toggle-chat1').toggles({on: false});
   
   // Minimize Button in Panels
   jQuery('.minimize').click(function(){
      var t = jQuery(this);
      var p = t.closest('.panel');
      if(!jQuery(this).hasClass('maximize')) {
         p.find('.panel-body, .panel-footer').slideUp(200);
         t.addClass('maximize');
         t.html('&plus;');
      } else {
         p.find('.panel-body, .panel-footer').slideDown(200);
         t.removeClass('maximize');
         t.html('&minus;');
      }
      return false;
   });
   
   
   // Add class everytime a mouse pointer hover over it
   jQuery('.nav-bracket > li').hover(function(){
      jQuery(this).addClass('nav-hover');
   }, function(){
      jQuery(this).removeClass('nav-hover');
   });
   
   
   // Menu Toggle
   jQuery('.menutoggle').click(function(){
      
      var body = jQuery('body');
      var bodypos = body.css('position');
      
      if(bodypos != 'relative') {
         
         if(!body.hasClass('leftpanel-collapsed')) {
            body.addClass('leftpanel-collapsed');
            jQuery('.nav-bracket ul').attr('style','');
            
            jQuery(this).addClass('menu-collapsed');
            
         } else {
            body.removeClass('leftpanel-collapsed chat-view');
            jQuery('.nav-bracket li.active ul').css({display: 'block'});
            
            jQuery(this).removeClass('menu-collapsed');
            
         }
      } else {
         
         if(body.hasClass('leftpanel-show'))
            body.removeClass('leftpanel-show');
         else
            body.addClass('leftpanel-show');
         
         adjustmainpanelheight();         
      }

   });
   
   // Chat View
   jQuery('#chatview').click(function(){
      
      var body = jQuery('body');
      var bodypos = body.css('position');
      
      if(bodypos != 'relative') {
         
         if(!body.hasClass('chat-view')) {
            body.addClass('leftpanel-collapsed chat-view');
            jQuery('.nav-bracket ul').attr('style','');
            
         } else {
            
            body.removeClass('chat-view');
            
            if(!jQuery('.menutoggle').hasClass('menu-collapsed')) {
               jQuery('body').removeClass('leftpanel-collapsed');
               jQuery('.nav-bracket li.active ul').css({display: 'block'});
            } else {
               
            }
         }
         
      } else {
         
         if(!body.hasClass('chat-relative-view')) {
            
            body.addClass('chat-relative-view');
            body.css({left: ''});
         
         } else {
            body.removeClass('chat-relative-view');   
         }
      }
      
   });
   
   reposition_searchform();
   
   jQuery(window).resize(function(){
      
      if(jQuery('body').css('position') == 'relative') {

         jQuery('body').removeClass('leftpanel-collapsed chat-view');
         
      } else {
         
         jQuery('body').removeClass('chat-relative-view');         
         jQuery('body').css({left: '', marginRight: ''});
      }
      
      reposition_searchform();
      
   });
   
   function reposition_searchform() {
      if(jQuery('.searchform').css('position') == 'relative') {
         jQuery('.searchform').insertBefore('.leftpanelinner .userlogged');
      } else {
         jQuery('.searchform').insertBefore('.header-right');
      }
   }
   
   
   // Sticky Header
   if(jQuery.cookie('sticky-header'))
      jQuery('body').addClass('stickyheader');
      
   // Sticky Left Panel
   if(jQuery.cookie('sticky-leftpanel')) {
      jQuery('body').addClass('stickyheader');
      jQuery('.leftpanel').addClass('sticky-leftpanel');
   }
   
   // Left Panel Collapsed
   if(jQuery.cookie('leftpanel-collapsed')) {
      jQuery('body').addClass('leftpanel-collapsed');
      jQuery('.menutoggle').addClass('menu-collapsed');
   }
   
   // Changing Skin
   var c = jQuery.cookie('change-skin');
   if(c) {
      jQuery('head').append('<link id="skinswitch" rel="stylesheet" href="css/style.'+c+'.css" />');
   }
   

});

function delete_this(link, id, nama) {
	jQuery(function($) {

		"use strict";	
		var	
			now		=	new Date().getTime() / 1000,
			s			=	parseInt(now, 10),
			mktime	=	(Math.round((now - s) * 1000) / 1000),
			dialog	=	'Apakah Anda yakin ingin menghapus '+nama+' ?';
		$('.konfirmasi-hapus').attr('title', 'Menghapus Data');
		$('.dialog-hapus').html(dialog);		
		$('.konfirmasi-hapus').dialog({
			resizable:	false,
			width:	350,
			height:	150,
			modal:	true,
			show: {
				effect: "blind",
				duration: 500
			},
			hide: {
				effect: "explode",
				duration: 500
			},
			buttons: {
				'Ya': function() {
					$.getJSON(link, {'delete-data':''+id}, function(data){
						if(data.status === '1'	||	data.status === 1) { 
							$.gritter.add({
								title: 'Sukses!',
								text: data.pesan,
								class_name: 'gritter-success',
								time: 500
							});
						} 
						else {
							$.gritter.add({
								title: 'Gagal!',
								text: data.pesan,
								class_name: 'gritter-error'
							});
							$.each(data.form, function(index, item) {
								if(item.length > 0) {
									$.gritter.add({
										title: 'Gagal!',
										text: item,
										class_name: 'gritter-error'
									});
								}
							});
						}
						if(data.thash != '') {
							$('input[name='+TOKEN_NAME+']').val(data.thash).attr('value', data.thash);
						}
						if(data.reload	==	1	||	data.reload	==	'1') {
							setTimeout(function() { window.location.reload(true); }, 3000);
						}
					});
					$(this).dialog("close");
				},
				'Tidak': function() {
					$(this).dialog("close");
				}
			}
		});
	});
}

function proses_this(link, id, layanan, nama) {
	jQuery(function($) {

		"use strict";	
		var	
			now		=	new Date().getTime() / 1000,
			s			=	parseInt(now, 10),
			mktime	=	(Math.round((now - s) * 1000) / 1000),
			dialog	=	confirm('Apakah akan diproses selanjutnya '+nama+' ?');
		$('.konfirmasi-hapus').attr('title', 'Memproses Data');
		$('.dialog-hapus').html(dialog);		
		$('.konfirmasi-hapus').dialog({
			resizable:	false,
			width:	350,
			height:	150,
			modal:	true,
			show: {
				effect: "blind",
				duration: 500
			},
			hide: {
				effect: "explode",
				duration: 500
			},
			buttons: {
				'Ya': function() {
					$.getJSON(link, {'update-data':''+id,'layanan-data':''+layanan}, function(data){
						if(data.status === '1'	||	data.status === 1) { 
							$.gritter.add({
								title: 'Sukses!',
								text: data.pesan,
								class_name: 'gritter-success',
								time: 500
							});
						} 
						else {
							$.gritter.add({
								title: 'Gagal!',
								text: data.pesan,
								class_name: 'gritter-error'
							});
							$.each(data.form, function(index, item) {
								if(item.length > 0) {
									$.gritter.add({
										title: 'Gagal!',
										text: item,
										class_name: 'gritter-error'
									});
								}
							});
						}
						if(data.thash != '') {
							$('input[name='+TOKEN_NAME+']').val(data.thash).attr('value', data.thash);
						}
						if(data.reload	==	1	||	data.reload	==	'1') {
							setTimeout(function() { window.location.reload(true); }, 3000);
						}
					});
					$(this).dialog("close");
				},
				'Tidak': function() {
					$(this).dialog("close");
				}
			}
		});
	});
}

function initTable(dataurl, cls) {
	jQuery(function($) {
		"use strict";
		
		$('.tableAjax-'+cls).attr('id',	'tableAjax-'+cls);
		
		if(dataurl.length	>	0) {
			var tableAjax	=	
			
			$('#tableAjax-'+cls).dataTable({
				"bSort": false,
				"processing": true,
				"serverSide": true,
				"ajax": dataurl			
			});	
			
		}
		else {
			var tableAjax	=	
			
			$('#tableAjax-'+cls).dataTable({
				"bSort": true,
				"processing": true,
				"serverSide": true
			});	
		}
	});
	
}