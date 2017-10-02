
jQuery(window).load(function() {
   
   // Page Preloader
   jQuery('#status').fadeOut();
   jQuery('#preloader').delay(350).fadeOut(function(){
      jQuery('body').delay(350).css({'overflow':'visible'});
   });
});

jQuery(document).ready(function() {
   
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
				 clear_form();
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
			if(data.draw != '') {
				$('.draw').html(data.draw);
			}
			if(data.reload	==	1	||	data.reload	==	'1') {
				setTimeout(function() { window.location.reload(true); }, 3000);
			}
			$(':button[type=submit]').button('reset');
		},
		error: function() {
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
   
   // Sparkline
   jQuery('#sidebar-chart').sparkline([4,3,3,1,4,3,2,2,3,10,9,6], {
	  type: 'bar', 
	  height:'30px',
      barColor: '#428BCA'
   });
   
   jQuery('#sidebar-chart2').sparkline([1,3,4,5,4,10,8,5,7,6,9,3], {
	  type: 'bar', 
	  height:'30px',
      barColor: '#D9534F'
   });
   
   jQuery('#sidebar-chart3').sparkline([5,9,3,8,4,10,8,5,7,6,9,3], {
	  type: 'bar', 
	  height:'30px',
      barColor: '#1CAF9A'
   });
   
   jQuery('#sidebar-chart4').sparkline([4,3,3,1,4,3,2,2,3,10,9,6], {
	  type: 'bar', 
	  height:'30px',
      barColor: '#428BCA'
   });
   
   jQuery('#sidebar-chart5').sparkline([1,3,4,5,4,10,8,5,7,6,9,3], {
	  type: 'bar', 
	  height:'30px',
      barColor: '#F0AD4E'
   });
   
   
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
		
		var cburl	=	$('#tableAjax-'+cls).attr('cb-url');
		
		TableTools.classes.container	=	"btn-group btn-overlap";
		TableTools.classes.print		=	{
												"body": "DTTT_Print",
												"info": "tableTools-alert gritter-item-wrapper gritter-info gritter-center white",
												"message": "tableTools-print-navbar"
											}
		
		var tableTools_obj = new $.fn.dataTable.TableTools( tableAjax, {
			"sSwfPath": THEME_URL+"/js/dataTables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
			"sRowSelector": "td:not(:last-child)",
			"sRowSelect": "multi",
			"fnRowSelected": function(row) {
				try { 
					var cbx = $(row).find('input[type=checkbox]');
					cbx.get(0).checked = true;
					if(cburl.length	>	0) {
						$.getJSON(cburl, {'idtransaksi':''+cbx.attr('data-idtransaksi'), 'idobat':''+cbx.attr('data-idobat'), 'jumlah':''+cbx.attr('data-jumlah'), 'status':'1'}, function(r){
							$.each(r, function(i, v){
								$.gritter.add({
									title: 'Mengirim Data!',
									text: v.pesan,
									class_name: 'gritter-info',
									time: 300
								});	
							});
							cbx.attr('readonly', 'readonly');
							cbx.hide();
							window.location.reload(true);
						});	
					}
				}
				catch(e) {
				}
			},
			"fnRowDeselected": function(row) {
				try { 
					var cbx = $(row).find('input[type=checkbox]');
				}
				catch(e) {
				}
			},
			"sSelectedClass": "success",
			"aButtons": [
							/*{
								"sExtends": "copy",
								"sToolTip": "Salin ke Papan Klip",
								"sButtonClass": "btn btn-white btn-primary btn-bold",
								"sButtonText": "<i class=\"fa fa-copy bigger-110 pink\"></i>",
								"fnComplete": function() {
									this.fnInfo( '<h3 class="no-margin-top smaller">Menyalin Data</h3>\
										<p>Menyalin '+(tableAjax.fnSettings().fnRecordsTotal())+' data ke papan klip.</p>',
										1500
									);
								}
							},
							
							{
								"sExtends": "csv",
								"sToolTip": "Ekspor ke CSV",
								"sButtonClass": "btn btn-white btn-primary btn-bold",
								"sButtonText": "<i class=\"fa fa-file-excel-o bigger-110 green\"></i>"
							},
							
							{
								"sExtends": "pdf",
								"sToolTip": "Ekspor ke PDF",
								"sButtonClass": "btn btn-white btn-primary btn-bold",
								"sButtonText": "<i class=\"fa fa-file-pdf-o bigger-110 red\"></i>"
							},*/
							
							{
								"sExtends": "print",
								"sToolTip": "Cetak",
								"sButtonClass": "btn btn-white btn-primary btn-bold",
								"sButtonText": "<i class=\"fa fa-print bigger-110 grey\"></i>",
								
								"sMessage": "<div class=\"navbar navbar-default\">"+$('.navbar-header').html()+"</div>",
								
								"sInfo": "<h3 class=\"no-margin-top\">Lihat Cetak</h3>\
										  <p>Gunakan <b>CTRL+P</b> pada browser\
										  untuk cetak tabel.\
										  <br />Tekan tombol <b>escape</b> jika selesai.</p>",
							}
						]
		});
		
		
		// $(tableTools_obj.fnContainer()).appendTo($('.tableTools-container-'+cls));
		// setTimeout(function() {
			// $(tableTools_obj.fnContainer()).find('a.DTTT_button').each(function() {
				// var div = $(this).find('> div');
				// if(div.length > 0) { 
					// div.tooltip({container: 'body'});
				// }
				// else {
					// $(this).tooltip({container: 'body'});
				// }
			// });
		// }, 200);
		
		var colvis = new $.fn.dataTable.ColVis( tableAjax, {
			"buttonText": "<i class='fa fa-search'></i>",
			"aiExclude": [0],
			"bShowAll": true,
			"sAlign": "right",
			"fnLabel": function(i, title, th) {
				return $(th).text();
			}
		}); 
		
		$(colvis.button()).addClass('btn-group').find('button').addClass('btn btn-white btn-info btn-bold')

		$(colvis.button()).prependTo('.tableTools-container-'+cls+' .btn-group').attr('title', 'Tampilkan/Sembunyikan kolom').tooltip({container: 'body'});

		$(colvis.dom.collection).addClass('dropdown-menu dropdown-light dropdown-caret dropdown-caret-right').find('li').wrapInner('<a href="javascript:void(0)" />').find('input[type=checkbox]').addClass('ace').next().addClass('lbl padding-8');

		$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
					
		$('#tableAjax-'+cls+' > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
			var th_checked = this.checked;
			$(this).closest('table').find('tbody > tr').each(function(){
				var row = this;
				if(th_checked) tableTools_obj.fnSelect(row);
				else tableTools_obj.fnDeselect(row);
			});
		});
					
		$('#tableAjax-'+cls).on('click', 'td input[type=checkbox]' , function(){
			var row = $(this).closest('tr').get(0);
			if(!this.checked) tableTools_obj.fnSelect(row);
			else tableTools_obj.fnDeselect($(this).closest('tr').get(0));
		});
					
		$(document).on('click', '#tableAjax-'+cls+' .dropdown-toggle', function(e) {
			e.stopImmediatePropagation();
			e.stopPropagation();
			e.preventDefault();
		});
	});
	
}