Number.prototype.formatMoney	=	function(c, d, t) {
	var n = this, 
	c = isNaN(c = Math.abs(c)) ? 2 : c, 
	d = d == undefined ? "." : d, 
	t = t == undefined ? "," : t, 
	s = n < 0 ? "-" : "", 
	i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
	j = (j = i.length) > 3 ? j % 3 : 0;
	return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};

function hitungkasir() {
	var money = $('.getjumbayar').val()-($('.tbiaya').text()-$('.getjumdiskon').val());
	if($('.getjumbayar').val() != ''){
		$('.kembalian').html(money.formatMoney(2, ",", "."));
	}
	else {
		$('.kembalian').html('0,00');
	}
}

function sum (n) {
	var v = function (x) {
		return sum (n + x);
	};
	
	v.valueOf = v.toString = function () {
		return n
	};

    return v;
}

jQuery.fn.ForceNumericOnly =
	function()
	{
		return this.each(function()
		{
			$(this).keydown(function(e)
			{
				var key = e.charCode || e.keyCode || 0;
				// allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
				// home, end, period, and numpad decimal
				return (
					key == 8 || 
					key == 9 ||
					key == 13 ||
					key == 46 ||
					key == 110 ||
					key == 190 ||
					(key >= 35 && key <= 40) ||
					(key >= 48 && key <= 57) ||
					(key >= 96 && key <= 105) ||
					(e.keyCode == 65 && e.ctrlKey === true)
				);
			});
		});
	}

function spinner(val, min) {
	jQuery(function($) {

		"use strict";
		$('.spinner3').ace_spinner({
			value:val,
			min:min,
			step:1, 
			on_sides: true, 
			icon_up:'ace-icon fa fa-plus', 
			icon_down:'ace-icon fa fa-minus', 
			btn_up_class:'btn-info', 
			btn_down_class:'btn-danger'
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
		
		
		$(tableTools_obj.fnContainer()).appendTo($('.tableTools-container-'+cls));
		setTimeout(function() {
			$(tableTools_obj.fnContainer()).find('a.DTTT_button').each(function() {
				var div = $(this).find('> div');
				if(div.length > 0) { 
					div.tooltip({container: 'body'});
				}
				else {
					$(this).tooltip({container: 'body'});
				}
			});
		}, 200);
		
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

function modal_remote(url, title) {
	jQuery(function($) {
		"use strict";
		$('#ModalRemote').on('show.bs.modal', function() {
			var link = url;
			$(this).find('.modal-title').text(title);
			$(this).find('.modal-body').load(link);
		}).modal({backdrop: 'static'});
	});
	return false;
}

function pilihObat(id) {
	$('.getidobat').val(id).attr('value', id);
	getDataObat(id);
	$('#cariobat').modal('hide');
}

function getDataObat(id) {
	var
		uri		=	$('.getidobat').attr('api-obat')
		tbl		=	$('.tbl-listobat'),
		tbls		=	tbl.attr('data-target'),
		tgt		=	(parseInt(tbls)+parseInt(1)),
		tbh		=	$('.tbl-tambah'),
		id			=	id,
		hrgppn	=	0;
		$.getJSON(uri, {'ambil-data':''+id}, function(data){
			hrgppn	=	parseFloat(data.pesan.hrgj_obat)+parseFloat(data.pesan.ppn_obat);
			tbh.find('tbody > tr:nth-child('+tgt+') :input.setkodeobat').val(data.pesan.kode_obat).attr('value', data.pesan.kode_obat);
			tbh.find('tbody > tr:nth-child('+tgt+') :input.setnamaobat').val(data.pesan.nama_obat).attr('value', data.pesan.nama_obat);
			tbh.find('tbody > tr:nth-child('+tgt+') :input.setjenisobat').val(data.pesan.jenis_obat).attr('value', data.pesan.jenis_obat);
			tbh.find('tbody > tr:nth-child('+tgt+') :input.setsatuanobat').val(data.pesan.satuan_obat).attr('value', data.pesan.satuan_obat);			
			tbh.find('tbody > tr:nth-child('+tgt+') :input.setexdate').val(data.pesan.expdt_obat).attr('value', data.pesan.expdt_obat);
			tbh.find('tbody > tr:nth-child('+tgt+') :input.setnobatch').val(data.pesan.nobatch_obat).attr('value', data.pesan.nobatch_obat);
			tbh.find('tbody > tr:nth-child('+tgt+') :input.sethrgbeli').val(data.pesan.hrgb_obat).attr('value', data.pesan.hrgb_obat);
			tbh.find('tbody > tr:nth-child('+tgt+') :input.sethrgjual').val(data.pesan.hrgj_obat).attr('value', data.pesan.hrgj_obat);
			tbh.find('tbody > tr:nth-child('+tgt+') :input.setsisaobat').val(data.pesan.sisa_obat).attr('value', data.pesan.sisa_obat);
			tbh.find('tbody > tr:nth-child('+tgt+') :input.sethargajual').val(hrgppn).attr('value', hrgppn);
			tbh.find('tbody > tr:nth-child('+tgt+') :input.getsisaobat').val(data.pesan.sisa_obat).attr('value', data.pesan.sisa_obat);
		});
}

function pilihPasien(kode) {
	$('.getkodepasien').val(kode).attr('value', kode);
	getFODataPasien(kode);
	$('#caripas').modal('hide');
}

function getFODataPasien(kode) {
	var
		uri		=	$('.getkodepasien').attr('api-pasien'),
		kode	=	kode;
		$.getJSON(uri, {'ambil-data':''+kode}, function(data){
			$('.setnikpasien').val(data.pesan.nik_pasien).attr('value', data.pesan.nik_pasien);
			$('.setnamapasien').val(data.pesan.nama_pasien).attr('value', data.pesan.nama_pasien);
			$('.setkkpasien').val(data.pesan.kk_pasien).attr('value', data.pesan.kk_pasien);
			$('.setalamatpasien').val(data.pesan.alamat_pasien).attr('value', data.pesan.alamat_pasien).text(data.pesan.alamat_pasien);
		});
}

function pilihKDPasien(kode) {
	$('.getkdpasien').val(kode).attr('value', kode);
	getAmbilDataPasien(kode);
	$('#caripas').modal('hide');
}

function getAmbilDataPasien(kode) {
	var
		uri		=	$('.getkdpasien').attr('api-pasien'),
		kode	=	kode;
		$.getJSON(uri, {'ambil-data':''+kode}, function(data){
		});
}

function pilihPenyakit(kode) {
	$('.getpenyakit').val(kode).attr('value', kode);
	getDataPenyakit(kode);
	$('#caripenyakit').modal('hide');
}

function getDataPenyakit(kode) {
	var
		uri		=	$('.getpenyakit').attr('api-penyakit'),
		kode	=	kode;
		$.getJSON(uri, {'ambil-data':''+kode}, function(data){
			$('.setkodepenyakit').val(data.pesan.kode_penyakit).attr('value', data.pesan.kode_penyakit);
			$('.setterjemahanpenyakit').val(data.pesan.terjemahan_penyakit).attr('value', data.pesan.terjemahan_penyakit);
		});
}

function pilihTindakan(kode) {
	$('.gettindakan').val(kode).attr('value', kode);
	getDataTindakan(kode);
	$('#caritindakan').modal('hide');
}

function getDataTindakan(kode) {
	var
		uri		=	$('.gettindakan').attr('api-tindakan'),
		kode	=	kode;
		$.getJSON(uri, {'ambil-data':''+kode}, function(data){
			$('.setkodetindakan').val(data.pesan.kode_tindakan).attr('value', data.pesan.kode_tindakan);
			$('.setnamapemtind').val(data.pesan.nama_tindakan).attr('value', data.pesan.nama_tindakan);
			$('.settarifpemtind').val(data.pesan.harga_tindakan).attr('value', data.pesan.harga_tindakan);
		});
}

function pilihDokter(kode) {
	$('.getdokter').val(kode).attr('value', kode);
	getDataDokter(kode);
	$('#caridokter').modal('hide');
}

function getDataDokter(kode) {
	var
		uri		=	$('.getdokter').attr('api-dokter'),
		kode	=	kode;
		$.getJSON(uri, {'ambil-data':''+kode}, function(data){
			$('.setniktadok').val(data.pesan.nik_pegawairs).attr('value', data.pesan.nik_pegawairs);
			$('.setnapegtadok').val(data.pesan.nama_pegawairs).attr('value', data.pesan.nama_pegawairs);
			$('.settariftadok').val(data.pesan.biaya_jasapegawairs).attr('value', data.pesan.biaya_jasapegawairs);
		});
}

function pilihPerawat(kode) {
	$('.getperawat').val(kode).attr('value', kode);
	getDataPerawat(kode);
	$('#cariperawat').modal('hide');
}

function getDataPerawat(kode) {
	var
		uri		=	$('.getperawat').attr('api-perawat'),
		kode	=	kode;
		$.getJSON(uri, {'ambil-data':''+kode}, function(data){
			$('.setniktaper').val(data.pesan.nik_pegawairs).attr('value', data.pesan.nik_pegawairs);
			$('.setnapegtaper').val(data.pesan.nama_pegawairs).attr('value', data.pesan.nama_pegawairs);
			$('.settariftaper').val(data.pesan.biaya_jasapegawairs).attr('value', data.pesan.biaya_jasapegawairs);
		});
}

function pilihLaborat(kode) {
	$('.getlaborat').val(kode).attr('value', kode);
	getDataLaborat(kode);
	$('#carilaborat').modal('hide');
}

function getDataLaborat(kode) {
	var
		uri		=	$('.getlaborat').attr('api-laborat'),
		kode	=	kode;
		$.getJSON(uri, {'ambil-data':''+kode}, function(data){
			$('.setkodetalab').val(data.pesan.kode_laborat).attr('value', data.pesan.kode_laborat);
			$('.setnamatalab').val(data.pesan.nama_laborat).attr('value', data.pesan.nama_laborat);
			$('.sethargatalab').val(data.pesan.biaya_laborat).attr('value', data.pesan.biaya_laborat);
		});
}

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

function clear_form(){
	$(':input:not([type=hidden])').val('').attr('value', '');
	$('textarea').val('').attr('value', '').text('');
	$('.select2').select2('val', '');
	$('.kota-change option, .kec-change option, .mitra-change, .kamar-change, .coa-change option').each( function() {
		$(this).remove();
	});
	$('.npm').attr('class', 'npm hidden');
}

jQuery(function($) {

	"use strict";
	
	$('.select2').css({'width': '100%', 'padding': '0px'}).select2({allowClear:true, placeholder: $(this).attr('data-placeholder')});
	
	$('#tabs').tabs();
	
	$('.colorpicker').colorpicker();
	
	$('[data-toggle="tooltip"]').tooltip();
	
	$('textarea[class*=autosize]').autosize({append: "\n"});
	
	$.mask.definitions['~']='[+-]';
	$('.brtbdn').mask('9?99');
	$('.tgibdn').mask('99?9');
	$('.tsidrh').mask('999/99?9');
	$('.shutbh').mask('99.9');
	$('.prnfsn').mask('99');
	
	$(':button[type=reset]').on('click', function(e) {
		e.preventDefault();
		$(':input:not([type=hidden])').val('').attr('value', '');
		$('textarea').val('').attr('value', '').text('');
		$('.select2').select2('val', '');
		$('.kota-change option, .kec-change option, .mitra-change option, .kamar-change option, coa-change option').each( function() {
			$(this).remove();
		});
		$('.npm').attr('class', 'npm hidden');
		$('#tableAjax-tblpen').dataTable().fnDestroy();
	});
		
	$('.btn-login-dark').on('click', function(e) {
		e.preventDefault();
		$('body').attr('class', 'login-layout');
		$('.id-text2').attr('class', 'white');
		$('.id-company-text').attr('class', 'blue');
	});

	$('.btn-login-light').on('click', function(e) {
		e.preventDefault();
		$('body').attr('class', 'login-layout light-login');
		$('.id-text2').attr('class', 'grey');
		$('.id-company-text').attr('class', 'blue');
	});
	
	$('.btn-login-blur').on('click', function(e) {
		e.preventDefault();
		$('body').attr('class', 'login-layout blur-login');
		$('.id-text2').attr('class', 'white');
		$('.id-company-text').attr('class', 'light-blue');
	});
	
	$('#ModalRemote').on('hidden.bs.modal', function () {
		$(this).removeData('bs.modal').data('bs.modal', null);
	});
	
	$('.modal-remote').bind('click', function () {
		$('#ModalRemote').removeData('bs.modal').data('bs.modal', null);
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
		
	$('.print-this').click(function(e) {
		e.preventDefault();
		$('.print-area').printThis({
			importCSS: true, 
			loadCSS: [
						BS_CSS,
						BSTHM_CSS,
						THEME_CSS
			]
		});
	});
		
	$('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true
	}).next().on(
		ace.click_event, function(){
			$(this).prev().focus();
		}
	).mask('99-99-9999');
	
	$('.date-range-picker').daterangepicker({
		'applyClass' : 'btn-sm btn-success',
		'cancelClass' : 'btn-sm btn-default',
		locale: {
			applyLabel: 'Apply',
			cancelLabel: 'Cancel',
		}
	}).prev().on(ace.click_event, function(){
		$(this).next().focus();
	});
	
	$('.numeric').ForceNumericOnly();
	
	/* Function Template */
	
	$('.ctn-sm-menu').click(function(e)	{
		e.preventDefault();
		$('.ctn-sm-menu').removeClass('disabled');
        $(this).addClass('disabled');
        $('.menu-hideshow').hide();
        var 
			smenu	=	$(this).attr('data-targetshow');
        $('.menu-hideshow:eq('+smenu+')').show();
	});
	
	$('.btn-refreshpas').click(function(e) {
		e.preventDefault();
		var	
			ini		=	$(this),
			uri		=	ini.attr('api-kdpas');
		$.getJSON(uri, {'':''}, function(r){
			$('.getkodepas').val(r.pesan).attr('value', r.pesan);
		});
	});
	
	$('.btn-refreshkdpo').click(function(e) {
		e.preventDefault();
		var	
			ini		=	$(this),
			uri		=	ini.attr('api-kdpo');
		$.getJSON(uri, {'':''}, function(r){
			$('.getkodepo').val(r.pesan).attr('value', r.pesan);
		});
	});
	
	$('.btn-refreshkdpen').click(function(e) {
		e.preventDefault();
		var	
			ini		=	$(this),
			uri		=	ini.attr('api-kdpen');
		$.getJSON(uri, {'':''}, function(r){
			$('.getkodepen').val(r.pesan).attr('value', r.pesan);
		});
	});
	
	$('.btn-cariobat').click(function(e) {
		e.preventDefault();
		var	
			ini		=	$(this),
			tbl	=	$('.tbl-listobat'),
			tgt	=	ini.attr('data-target');
		tbl.attr('data-target', tgt);
		$('#cariobat').modal({backdrop: 'static'});
	});
	
	$('.btn-caripas').click(function(e) {
		e.preventDefault();
		var	
			ini		=	$(this);
		$('#caripas').modal({backdrop: 'static'});
	});
	
	$('.btn-caripenyakit').click(function(e) {
		e.preventDefault();
		var	
			ini		=	$(this);
		$('#caripenyakit').modal({backdrop: 'static'});
	});
	
	$('.btn-caritindakan').click(function(e) {
		e.preventDefault();
		var	
			ini		=	$(this);
		$('#caritindakan').modal({backdrop: 'static'});
	});
	
	$('.btn-caridokter').click(function(e) {
		e.preventDefault();
		var	
			ini		=	$(this);
		$('#caridokter').modal({backdrop: 'static'});
	});
	
	$('.btn-cariperawat').click(function(e) {
		e.preventDefault();
		var	
			ini		=	$(this);
		$('#cariperawat').modal({backdrop: 'static'});
	});
	
	$('.btn-carilaborat').click(function(e) {
		e.preventDefault();
		var	
			ini		=	$(this);
		$('#carilaborat').modal({backdrop: 'static'});
	});
	
	$('.btn-caritrans').click(function(e) {
		e.preventDefault();
		var	
			ini		=	$(this),
			itu		=	$('.setkdtrans'),
			dtl		=	$('input[name=ID_FODETAIL]').val(),
			jpem	=	$('input[name=JENISPEMBAYARAN_FODETAIL]').val(),
			kdpas	=	$('.getkdpas').val(),
			apigkd	=	ini.attr('api-gettrans'),
			apiskd	=	itu.attr('api-kdtrans'),
			nilkd	=	'';
		$.getJSON(apigkd, {'get-kdtrans':'ok'}, function(r){
			itu.val(r.pesan).attr('value', r.pesan);
			$.getJSON(apiskd, {'set-kdtrans':''+r.pesan, 'set-fodetail':''+dtl, 'set-kdpas':''+kdpas, 'set-jpem':''+jpem}, function(data){
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
		});
	});
	
	$('.btn-caritransri').click(function(e) {
		e.preventDefault();
		var	
			ini		=	$(this),
			itu		=	$('.setkdtransri'),
			dtl		=	$('input[name=ID_FODETAIL]').val(),
			jpem	=	$('input[name=JENISPEMBAYARAN_FODETAIL]').val(),
			kdpas	=	$('.getkdpas').val(),
			bed		=	$('input[name=ID_BED]').val(),
			layanan	=	$('input[name=ID_LAYANAN]').val(),
			trf		=	$('input[name=TARIF_KAMARINAP]').val(),
			apigkd	=	ini.attr('api-gettransri'),
			apiskd	=	itu.attr('api-kdtransri'),
			nilkd	=	'';
		$.getJSON(apigkd, {'get-kdtransri':'ok'}, function(r){
			itu.val(r.pesan).attr('value', r.pesan);
			$.getJSON(apiskd, {'set-kd':''+r.pesan, 'set-fodetail':''+dtl, 'set-kdpas':''+kdpas, 'set-jpem':''+jpem, 'set-bed':''+bed, 'set-layanan':''+layanan, 'set-trf':''+trf}, function(data){
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
		});
	});
	
	$('.carabayar-change').change( function() {
		var	
			ini		=	$(this),
			nil		=	ini.val();
		if(nil	!=	'') {
			if(nil.toLowerCase()	==	'cash'){				
				$('.setjthtemp').val('').attr('value', '');
				$('.npm').attr('class', 'npm hidden');
			}
			else {
				$('.npm').attr('class', 'npm');
			}
		}
	});
	
	$('.permintaan-change').change( function() {
		var	
			ini		=	$(this),
			nil		=	ini.val(),
			turl	=	$('.tbl-listobat').attr('data-url'),
			uri	=	ini.parent().find('select').attr('api-permintaan'),
			itu	=	ini.closest('select');
		if(nil	!=	'') {
			$('#tableAjax-tblpen').dataTable().fnDestroy();
			initTable(turl+'?list-permintaan='+nil, 'tblpen');
			$.getJSON(uri, {'list-permintaan':''+nil}, function(r){
				$('.setkodeper').val(r.pesan.kd_per).attr('value', r.pesan.kd_per);
				$('.setideven').val(r.pesan.id_ven).attr('value', r.pesan.id_ven);
				$('.setnamaven').val(r.pesan.nama_ven).attr('value', r.pesan.nama_ven);
			});
		}
		else {
			$('#tableAjax-tblpen').dataTable().fnDestroy();
			$('.setkodeper').val('').attr('value', '');
			$('.setideven').val('').attr('value', '');
			$('.setnamaven').val('').attr('value', '');
		}
	});
	
	$('.tujuan-change').change( function() {
		var	
			ini		=	$(this),
			nil		=	ini.val(),
			uri		=	ini.parent().find('select').attr('api-antrian'),
			itu		=	ini.closest('select');
		if(nil	!=	'') {
			$.getJSON(uri, {'list-layanan':''+nil}, function(r){
				$('.setnoantrian').val(r.pesan.antrian).attr('value', r.pesan.antrian);
			});
		}
	});
	
	$('.jpem-change').change( function() {
		var	
			ini		=	$(this),
			nil		=	ini.val(),
			uri		=	ini.parent().find('select').attr('api-mitra'),
			itu		=	ini.closest('select'),
			optg	=	'';
		$('.mitra-change option').each( function() {
			$(this).remove();
		});
		$('.mitra-change').select2('val', '');
		if(nil	!=	'') {
			$.getJSON(uri, {'list-mitra':''+nil}, function(r){
				$.each(r.pesan.children, function(i, v){
					$('.mitra-change').parent().find('select').append(
						$('<option>', { 
							value: v.id,
							text : v.text
						})
					);
					if(r.pesan.text	!=	'-'){
						$('.npm').attr('class', 'npm ');
					}
					else {
						$('.npm').attr('class', 'npm hidden');
					}
				});
				optg	=	r.pesan.text;
			});
		}
	});
	
	$('.kea-change').change( function() {
		var	
			ini		=	$(this),
			nil		=	ini.val(),
			uri		=	ini.parent().find('select').attr('api-kamar'),
			itu		=	ini.closest('select'),
			optg	=	'';
		$('.kamar-change option').each( function() {
			$(this).remove();
		});
		$('.kamar-change').select2('val', '');
		if(nil	!=	'') {
			$.getJSON(uri, {'list-kamar':''+nil}, function(r){
				$.each(r.pesan.children, function(i, v){
					$('.kamar-change').parent().find('select').append(
						$('<option>', { 
							value: v.id,
							text : v.text
						})
					);
					if(r.pesan.text	!=	'-'){
						$('.npm').attr('class', 'npm ');
					}
					else {
						$('.npm').attr('class', 'npm hidden');
					}
				});
				optg	=	r.pesan.text;
			});
		}
	});
	
	$('.kt-change').change( function() {
		var	
			ini		=	$(this),
			nil		=	ini.val(),
			uri		=	ini.parent().find('select').attr('api-keadaan'),
			itu		=	ini.closest('select');
		if(nil	!=	'') {
			$.getJSON(uri, {'ambil-data':''+nil}, function(r){
				if(r.pesan	==	'OPNAME'){
					$('.npm').attr('class', 'npm ');
				}
				else {
					$('.npm').attr('class', 'npm hidden');
				}
				$('.setstatusfodtl').val(r.pesan).attr('value', r.pesan);
			});
		}
	});
	
	$('.kamar-change').change( function() {
		var	
			ini		=	$(this),
			nil		=	ini.val(),
			uri		=	ini.parent().find('select').attr('api-bed'),
			itu		=	ini.closest('select'),
			optg	=	'';
		$('.bed-change option').each( function() {
			$(this).remove();
		});
		$('.bed-change').select2('val', '');
		if(nil	!=	'') {
			$.getJSON(uri, {'list-bed':''+nil}, function(r){
				$.each(r.pesan.children, function(i, v){
					$('.bed-change').parent().find('select').append(
						$('<option>', { 
							value: v.id,
							text : v.text
						})
					);
					if(r.pesan.text	!=	'-'){
						$('.npm').attr('class', 'npm ');
					}
					else {
						$('.npm').attr('class', 'npm hidden');
					}
				});
				optg	=	r.pesan.text;
			});
		}
	});

	$('.umur-change').change( function() {
		var	
			ini		=	$(this),
			nil		=	ini.val(),
			uri		=	ini.attr('api-umur');
		if(nil	!=	'') {
			$.getJSON(uri, {'tgl-lhr':''+nil}, function(r){
				$('.umur').val(r.pesan.umur).attr('value', r.pesan.umur);
			});
		}
	});
	
	$('.coa-change').change( function(){
		var	
			ini		=	$(this),
			tgt		=	$('.setaccountcoapre'),
			nil		=	ini.val(),
			uri		=	ini.parent().find('select').attr('api-coa'),
			itu		=	ini.closest('select');
		if(nil	!=	'') {
			$.getJSON(uri, {'list-coa':''+nil}, function(r){
				tgt.val(r.pesan).attr('value', r.pesan);
			});
		}
		else {
			tgt.val('').attr('value', '');
		}
	});
	
	$('.prov-change').change( function(){
		var	
			ini		=	$(this),
			nil		=	ini.val(),
			uri		=	ini.parent().find('select').attr('api-kota'),
			itu		=	ini.closest('select'),
			optg	=	'';
		$('.kota-change option, .kec-change option').each( function() {
			$(this).remove();
		});
		$('.kota-change, .kec-change').select2('val', '');
		if(nil	!=	'') {
			$.getJSON(uri, {'list-kota':''+nil}, function(r){
				$.each(r.pesan.children, function(i, v){
					$('.kota-change').parent().find('select').append(
						$('<option>', { 
							value: v.id,
							text : v.text
						})
					);					
				});
				optg	=	r.pesan.text;
			});
		}
	});
	
	$('.kota-change').change( function(){
		var	
			ini		=	$(this),
			nil		=	ini.val(),
			uri		=	ini.parent().find('select').attr('api-kec'),
			itu		=	ini.closest('select'),
			optg	=	'';
		$('.kec-change option').each( function() {
			$(this).remove();
		});
		$('.kec-change').select2('val', '');
		if(nil	!=	'') {
			$.getJSON(uri, {'list-kec':''+nil}, function(r){
				$.each(r.pesan.children, function(i, v){
					$('.kec-change').parent().find('select').append(
						$('<option>', { 
							value: v.id,
							text : v.text
						})
					);
				});
				optg	=	r.pesan.text;
			});
		}
	});
	
	$('.getidjenisobat').change(function(){ 
		var 
			id_jenis = $(this), 
			nama_obat = $('.getkodeobat'), 
			kode_obat = nama_obat.val().charAt(0), 
			uri = nama_obat.attr('data-url'),
			jenis_obat	=	'';
		if(id_jenis.val()	!=	'-') {
			if(parseInt(id_jenis.val())	< 10) {
				jenis_obat = '0'+parseInt(id_jenis.val());
			}
			else {
				jenis_obat = parseInt(id_jenis.val());
			}
		}
		else{
			jenis_obat	=	'';
		}
		if(nama_obat.val().length > 0 || nama_obat.val() != '') {
			if(id_jenis.val()	!=	'-') {
				$.getJSON(uri, {'JENIS_OBAT':''+id_jenis.val(), 'NAMA_OBAT':''+nama_obat.val()}, function(r){
					$('.kodeobat').val(jenis_obat+'.'+kode_obat.toUpperCase()+''+r.pesan.kodeobat);		
				});
			}
			else {
				var dialog	=	'Isi Jenis Obat Dahulu!!';
				$('.konfirmasi-hapus').attr('title', 'Perhatian');
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
						'Oke': function() {
							$(this).dialog("close");
						}
					}
				});
				nama_obat.val('');
				$('.kodeobat').val('');
			}
		}
		else {
			$('.kodeobat').val('');
		}
	});
	
	$('.getkodepasien').keyup(function(){ 
		var	
			ini	=	$(this),
			kdpas	=	ini.val();
		getFODataPasien(kdpas);
	});
	
	$('.getkodeobat').keyup(function(){ 
		var 
			id_jenis = $('.getidjenisobat option:selected'), 
			nama_obat = $(this), 
			kode_obat = nama_obat.val().charAt(0), 
			uri = nama_obat.attr('data-url'),
			jenis_obat	=	'';
		if(id_jenis.val()	!=	'-') {
			if(parseInt(id_jenis.val())	< 10) {
				jenis_obat = '0'+parseInt(id_jenis.val());
			}
			else {
				jenis_obat = parseInt(id_jenis.val());
			}
		}
		else{
			jenis_obat	=	'';
		}
		if(nama_obat.val() != '') {
			if(id_jenis.val()	!=	'-') {
				$.getJSON(uri, {'JENIS_OBAT':''+id_jenis.val(), 'NAMA_OBAT':''+nama_obat.val()}, function(r){
					$('.kodeobat').val(jenis_obat+'.'+kode_obat.toUpperCase()+''+r.pesan.kodeobat);		
				});
			}
			else {
				var dialog	=	'Isi Jenis Obat Dahulu!!';
				$('.konfirmasi-hapus').attr('title', 'Perhatian');
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
						'Oke': function() {
							$(this).dialog("close");
						}
					}
				});
				nama_obat.val('');
				$('.kodeobat').val('');
			}
		}
		else {
			$('.kodeobat').val('');
		}
	});
	
	$('.getjumbayar').keyup(function(){
		hitungkasir();
	});
	
	$('.getjumdiskon').keyup(function(){
		hitungkasir();
	});
	
	$('.ICON_MODUL').keyup(function(){
		var	
			ini	=	$(this),
			out	=	ini.val();
		if(out	!=	''){
			$('.imodul-trigger').attr('class', 'imodul-trigger ace-icon fa '+out);
		}
		else {
			$('.imodul-trigger').attr('class', 'imodul-trigger ace-icon fa fa-blank');
		}
	});
	
	$('.setaccountcoasuf').keyup(function(){
		var	
			ini	=	$(this),
			pre	=	$('.setaccountcoapre'),
			tgt	=	$('.setaccountcoa'),
			preout	=	pre.val(),
			iniout	=	ini.val();
		if(ini	!=	''){
			if(preout	!=	'')	{
				tgt.val(preout+'.'+iniout).attr('value', preout+'.'+iniout);
			}
			else {
				tgt.val(iniout).attr('value', iniout);
			}
		}
		else {
			tgt.val('').attr('value', '');
		}
	});
	
	$('.btn-tambahtbl').click(function(e){
		e.preventDefault();
		$('.date-picker').datepicker('remove');
		var	
			i			=	0,
			ini			=	$(this),
			itu		=	$('.tbl-tambah'),
			tgt		=	$('.tbl-listobat'),
			body		=	itu.find('tbody'),
			tbody	=	itu.find('tbody	>	tr'),
			bbody	=	tbody.length,
			abody	=	itu.find('tbody	>	tr:last'),
			cbody	=	abody.clone(true);
			cbody.appendTo(body);
			if(bbody	>	0)	{
				itu.find('tbody	>	tr:last :input:not([type=hidden])').val('').attr('value', '');
				for(i	=	0;	i	<=	bbody;	i++)	{
					itu.find('tbody	>	tr:last :input.getsisaobat').attr('data-target', ''+i);
					itu.find('tbody	>	tr:last :input.setsisaobat').attr('data-target', ''+i);
					itu.find('tbody	>	tr:last :input.getjumobat').attr('data-target', ''+i);
					itu.find('tbody	>	tr:last :button.btn-cariobat').attr('data-target', ''+i);
					$('.date-picker').datepicker({
						autoclose: true,
						todayHighlight: true
					}).next().on(
						ace.click_event, function(){
							$(this).prev().focus();
						}
					).mask('99-99-9999');
				}
			}
	});
	
	$('.btn-kurangtbl').click(function(e){
		e.preventDefault();
		var	
			i			=	0,
			ini			=	$(this),
			itu		=	$('.tbl-tambah'),
			tbody	=	itu.find('tbody	>	tr'),
			bbody	=	tbody.length;
			if(bbody	>	1)	{
				itu.find('tbody	>	tr:last').remove();
			}
	});
	
	$(':input.setdiskonobat').keyup(function(){
		var	
			i	=	1,
			tharga	=	0,
			diskon	=	parseFloat($(this).val());
		$('.tbl-tambah').find('tbody > tr :input.settotalharga').each( function(i) {
			if((':input.settotalharga').val()	>	0)	{
				tharga +=	parseFloat($(this).val());
			}
		});
		if($(this).val()	!=	'')	{
			$('.settotalobat').val(tharga-diskon);
		}
		else {
			$('.settotalobat').val(tharga);
		}
	});
	
	$(':input.setsisaobat').keyup(function(){
		var
			ini			=	$(this),
			dtgs		=	ini.attr('data-target'),
			dtg		=	(parseInt(dtgs)+parseInt(1)),
			itu		=	$('.tbl-tambah'),
			tbody	=	itu.find('tbody	>	tr'),
			bbody	=	tbody.length,
			jmla		=	parseInt(itu.find('tbody	>	tr:nth-child('+dtg+') :input.getsisaobat').val()),
			jml		=	parseInt(itu.find('tbody	>	tr:nth-child('+dtg+') :input.setsisaobat').val());	
			if(jml	>	jmla){
				var dialog	=	'Jumlah Obat tidak boleh lebih dari '+jmla;
				$('.konfirmasi-hapus').attr('title', 'Perhatian');
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
						'Oke': function() {
							$(this).dialog("close");
						}
					}
				});
				itu.find('tbody	>	tr:nth-child('+dtg+') :input.setsisaobat').val('').attr('value', '');
			}
	});
	
	$(':input.getjumobat').keyup(function(){
		var
			ini			=	$(this),
			dtgs		=	ini.attr('data-target'),
			dtg		=	(parseInt(dtgs)+parseInt(1)),
			itu		=	$('.tbl-tambah'),
			tbody	=	itu.find('tbody	>	tr'),
			bbody	=	tbody.length,
			hrg		=	parseFloat(itu.find('tbody	>	tr:nth-child('+dtg+') :input.sethargajual').val()),			
			thrg		=	parseFloat(ini.val())*hrg;
			if(ini.val()	>	0)	{
				itu.find('tbody	>	tr:nth-child('+dtg+') :input.settotalharga').val(thrg).attr('value', thrg);
			}
			else {
				itu.find('tbody	>	tr:nth-child('+dtg+') :input.settotalharga').val('').attr('value', '');
			}
	});
	
	$(':input.setbiayaadmin').keyup(function(){
		var
			ini		=	$(this),
			tby	=	$('.gettbiaya').text(),
			nil		=	ini.val();
		if(nil	>	0)	{
			$('input[name=TOTALTAGIHAN_KASIRRI]').val(parseFloat(nil)+parseFloat(tby)).attr('value', parseFloat(nil)+parseFloat(tby));
			$('input[name=TOTALPEMBAYARAN_KASIRRI]').val(parseFloat(nil)+parseFloat(tby)).attr('value', parseFloat(nil)+parseFloat(tby));
			$('.settbiaya').html((parseFloat(nil)+parseFloat(tby)).formatMoney(2, ",", "."));
			$('.tbiaya').text(parseFloat(nil)+parseFloat(tby));
		}
		else {
			$('input[name=TOTALTAGIHAN_KASIRRI]').val(parseFloat(tby)).attr('value', parseFloat(tby));
			$('input[name=TOTALPEMBAYARAN_KASIRRI]').val(parseFloat(tby)).attr('value', parseFloat(tby));
			$('.settbiaya').html(parseFloat(tby).formatMoney(2, ",", "."));
		}
		hitungkasir();
	});
	
	$('.btn-getrm').click(function(e){
		e.preventDefault();
		var	
			ini		=	$(this),
			turl	=	ini.attr('data-url'),
			tnm		=	ini.attr('data-tabel'),
			fnm		=	ini.attr('data-field'),
			tgt		=	ini.attr('data-target'),			
			nil		=	$('.'+fnm).val();
		if(nil	!=	'') {
			$('#tableAjax-'+tnm).dataTable().fnDestroy();
			initTable(turl+'?list-rekammedik='+nil, tnm);
			$('.npm').hide();
			$('.npm:eq('+tgt+')').show();
		}
		else {
			$('#tableAjax-'+tnm).dataTable().fnDestroy();
			$('.npm').hide();
			$('.npm:eq('+tgt+')').hide();
		}
	});
	
	$('.btn-getlb').click(function(e){
		e.preventDefault();
		var	
			ini		=	$(this),
			turl	=	ini.attr('data-url'),
			tnm		=	ini.attr('data-tabel'),
			fnm		=	ini.attr('data-field'),
			tgt		=	ini.attr('data-target'),			
			nil		=	$('.'+fnm).val();
		if(nil	!=	'') {
			$('#tableAjax-'+tnm).dataTable().fnDestroy();
			initTable(turl+'?list-laporan-biaya='+nil, tnm);
			$('.npm').hide();
			$('.npm:eq('+tgt+')').show();
		}
		else {
			$('#tableAjax-'+tnm).dataTable().fnDestroy();
			$('.npm').hide();
			$('.npm:eq('+tgt+')').hide();
		}
	});
});