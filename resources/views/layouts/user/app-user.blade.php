<!doctype html> 
<html> 
<head> 
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="{{ url('assets/user/dist/css/bootstrap.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="icon" href="{{ url('assets/SINOPAK2.png') }}" type="image/gif" sizes="20x20">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <title>SINOPAK</title>
    <style type="text/css">
    	.dropdown-submenu {
		  position: relative;
		}

		.dropdown-submenu a::after {
		  transform: rotate(-90deg);
		  position: absolute;
		  right: 6px;
		  top: .8em;
		}

		.dropdown-submenu .dropdown-menu {
		  top: 100%;
		  /*left: 100%;*/
		  margin-left: .1rem;
		  margin-right: .1rem;
		  left: 100px;
		}
		.pagination {
		    display: -ms-flexbox;
		    display: block ruby;
		}
		body  {
		  /*background-image: url("paper.gif");
		  background-color: #cccccc;*/
		}
		/*.nav-item:hover>.dropdown-menu {
			display: block;
		}
		.dropdown-submenu:hover>.dropdown-menu {
			display: block;
			left: 50px;
		}*/
    </style> 
</head> 
<body>
	@include('sweet::alert')
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: #001f3f;">
		@include('layouts/user/navbar')
	</nav>
	<br>
	@yield('content')
	@include('layouts/user/footer')
	<script src="{{ url('assets/user/js/dist/jquery.js') }}"></script> 
	<!-- <script src="{{ url('assets/user/js/dist/popper.js') }}"></script>  -->
	<script src="{{ url('assets/user/dist/js/bootstrap.js') }}"></script>
	<script type="text/javascript">
		$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
		  if (!$(this).next().hasClass('show')) {
		    $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
		  }
		  var $subMenu = $(this).next('.dropdown-menu');
		  $subMenu.toggleClass('show');


		  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
		    $('.dropdown-submenu .show').removeClass('show');
		  });


		  return false;
		});
	</script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="{{ url('assets/user/dist/js/bootstrap-datepicker.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
    	function getSegmen(e) {
    		let tamp = e.value;
    		let tamp1 = "http://10.35.31.243:8010/search-segmen/";
            var xhr = new XMLHttpRequest();
            var url = tamp1.concat(tamp);

            xhr.onloadstart = function () {
                document.getElementById("load").innerHTML = "Search...";
            }

            xhr.onerror = function () {
                alert("Data Tidak ditemukan !!!!!!");
            };

            xhr.onloadend = function () {
                if (this.responseText !== "") {
                	document.getElementById("load").innerHTML = "";
                    var data = JSON.parse(this.responseText);
                    // var img = document.createElement("img");
                    // img.src = data.avatar_url;
                    // var name = document.createElement("h3");
                    // name.innerHTML = data.name;
                    if (data[0].fbcc_segment == 'A') {
                    	$("#manager_name").val('IRMA SILVIA ADYATINI');
                    	$("#nik").val('770085');
                    	$("#segmen").val('A');
                    }else if (data[0].fbcc_segment == 'B') {
                    	$("#manager_name").val('MHM. THOHIRUN');
                    	$("#nik").val('740239');
                    	$("#segmen").val('B');
                    }else {
                    	$("#manager_name").val('GAMYA RIZKI');
                    	$("#nik").val('720049');
                    	$("#segmen").val('C');
                    }
                    // document.getElementById("load").append(img, name);
                    // document.getElementById("button").innerHTML = "Done";

                    setTimeout(function () {
                        // document.getElementById("button").innerHTML = "Load Lagi";
                    }, 3000);
                }
            };

            xhr.open("GET", url, true);
            xhr.send();
            // console.log($('#load').val());
        }
    </script>
    <script>
	// Disable form submissions if there are invalid fields
	(function() {
	  'use strict';
	  window.addEventListener('load', function() {
	    // Get the forms we want to add validation styles to
	    var forms = document.getElementsByClassName('needs-validation');
	    // Loop over them and prevent submission
	    var validation = Array.prototype.filter.call(forms, function(form) {
	      form.addEventListener('submit', function(event) {
	        if (form.checkValidity() === false) {
	          event.preventDefault();
	          event.stopPropagation();
	        }
	        form.classList.add('was-validated');
	      }, false);
	    });
	  }, false);
	})();
	</script>
    <script type="text/javascript">
        $(document).ready( function () {
            $('#TableMitra').DataTable();
            $('#Marketing').DataTable();
        } );

        $('.input-dateee').datepicker({
            startView:'months',
            minViewMode:'months',
            language:'id',
            todayBtn:'linked',
            format:'yyyy-mm-dd',
            autoclose:true
        });
    </script>
    <script type="text/javascript">
    	$(document).ready(function() {
		    $('.account').select2();
		    $('.periode').select2();
		    $('.kl').select2();
		});
    	$(document).ready(function() {
		    $('#example').DataTable({
		    	scrollX: true
		    });
		    $('#example1').DataTable({
		    	scrollX: true
		    });
		    $('#example').on('search.dt', function() {
			    var value = $('.dataTables_filter input').val();
			    console.log(value); // <-- the value
			}); 
		});
		$('#mgr_name').on('change', function() {
		    if(this.value == 'IRMA SILVIA ADYATINI'){
		      $("#nik").val("770085");
		      $("#segmen").val("A");
		    }else if(this.value == 'MHM. THOHIRUN'){
		      $("#nik").val("740239");
		      $("#segmen").val("B");
		    }else{
		      $("#nik").val("720049");
		      $("#segmen").val("C");
		    }
		});
		$('#segmen').on('change', function() {
		    if(this.value == 'A'){
		      $("#nik").val("770085");
		      $("#manager_name").val("IRMA SILVIA ADYATINI");
		    }else if(this.value == 'B'){
		      $("#nik").val("740239");
		      $("#manager_name").val("MHM. THOHIRUN");
		    }else{
		      $("#nik").val("720049");
		      $("#manager_name").val("GAMYA RIZKI");
		    }
		});
		$('.input-date').datepicker({
		    todayBtn:'linked',
		    format:'yyyy-mm-dd',
		    autoclose:true
		});
		$('.input-datee').datepicker({
		    startView:'months',
		    minViewMode:'months',
		    language:'id',
		    todayBtn:'linked',
		    format:'MM yyyy',
		    autoclose:true
		 });
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split       = number_string.split(','),
			sisa        = split[0].length % 3,
			rupiah        = split[0].substr(0, sisa),
			ribuan        = split[0].substr(sisa).match(/\d{3}/gi);
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
		  	if(ribuan){
		    	separator = sisa ? '.' : '';
		    	rupiah += separator + ribuan.join('.');
		  	}
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		 	return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
		
		// $(document).ready(function() {
		    $(".add-more").click(function(){ 
		      var html = $(".copy").html();
		      $(".after-add-more").after(html);
		    });
		    $("body").on("click",".remove",function(){ 
		      $(this).parents(".control-group").remove();
		    });

		    //Hide
		    $('.hide').hide();
		    $('#hide1').hide();
			$('#hide2').hide();
			$('#hide3').hide();
			$('#hide4').hide();
			$('#hide5').hide();
			$('#hide6').hide();
			$('#hide7').hide();
			$('#hide8').hide();
			$('#hide9').hide();
			$('#hide10').hide();

			$( "#nk" ).keyup(function() {
			  	nk.value = formatRupiah(this.value, 'Rp. ');
			  	nilai_kontrak.value = nk.value.replace(/[^,\d]/g, '').toString();
			});
			$("#jangka_waktu_kontrak").keyup(function () {
				$("#npk_month").val(this.value);
			});

			//OTC
			$( "#otccc1" ).keyup(function() {
			  	otccc1.value = formatRupiah(this.value, 'Rp. ');
  				otc1.value = otccc1.value.replace(/[^,\d]/g, '').toString();
  				$('#otc_ke').val('1');
			});
			$( "#otccc2" ).keyup(function() {
				otccc2.value = formatRupiah(this.value, 'Rp. ');
  				otc2.value = otccc2.value.replace(/[^,\d]/g, '').toString();
  				$('#otc_ke').val('2');
			});
			$( "#otccc3" ).keyup(function() {
				otccc3.value = formatRupiah(this.value, 'Rp. ');
  				otc3.value = otccc3.value.replace(/[^,\d]/g, '').toString();
  				$('#otc_ke').val('3');
			});
			$( "#otccc4" ).keyup(function() {
				otccc4.value = formatRupiah(this.value, 'Rp. ');
  				otc4.value = otccc4.value.replace(/[^,\d]/g, '').toString();
  				$('#otc_ke').val('4');
			});
			$( "#otccc5" ).keyup(function() {
				otccc5.value = formatRupiah(this.value, 'Rp. ');
  				otc5.value = otccc5.value.replace(/[^,\d]/g, '').toString();
  				$('#otc_ke').val('5');
			});

			//Termin
			$( "#terminnn1" ).keyup(function() {
				terminnn1.value = formatRupiah(this.value, 'Rp. ');
  				termin1.value = terminnn1.value.replace(/[^,\d]/g, '').toString();
  				$('#termin_ke').val('1');
			});
			$( "#terminnn2" ).keyup(function() {
			  	terminnn2.value = formatRupiah(this.value, 'Rp. ');
			  	termin2.value = terminnn2.value.replace(/[^,\d]/g, '').toString();
			  	$('#termin_ke').val('2');
			});
			$( "#terminnn3" ).keyup(function() {
				terminnn3.value = formatRupiah(this.value, 'Rp. ');
			  	termin3.value = terminnn3.value.replace(/[^,\d]/g, '').toString();
			  	$('#termin_ke').val('3');
			});
			$( "#terminnn4" ).keyup(function() {
			  	terminnn4.value = formatRupiah(this.value, 'Rp. ');
			  	termin4.value = terminnn4.value.replace(/[^,\d]/g, '').toString();
			  	$('#termin_ke').val('4');
			});
			$( "#terminnn5" ).keyup(function() {
			  	terminnn5.value = formatRupiah(this.value, 'Rp. ');
			  	termin5.value = terminnn5.value.replace(/[^,\d]/g, '').toString();
			  	$('#termin_ke').val('5');
			});
			$( "#mrccc" ).keyup(function() {
			  	mrccc.value = formatRupiah(this.value, 'Rp. ');
			  	mrc.value = mrccc.value.replace(/[^,\d]/g, '').toString();
			});
			$( "#exccc" ).keyup(function() {
			  	exccc.value = formatRupiah(this.value, 'Rp. ');
			  	exc.value = exccc.value.replace(/[^,\d]/g, '').toString();
			});
			$( "#n_npk" ).keyup(function() {
			  	n_npk.value = formatRupiah(this.value, 'Rp. ');
			  	nilai_npk.value = n_npk.value.replace(/[^,\d]/g, '').toString();
			});
			$( "#slggg" ).keyup(function() {
			  	slggg.value = formatRupiah(this.value, 'Rp. ');
			  	slg.value = slggg.value.replace(/[^,\d]/g, '').toString();
			});
			$( "#hrg_unit" ).keyup(function() {
			  	hrg_unit.value = formatRupiah(this.value, 'Rp. ');
			  	hargaunit.value = hrg_unit.value.replace(/[^,\d]/g, '').toString();
			});
		// });

			$('#ktr1').keyup(function(){
			    $('#ktr').val($(this).val());
			});

			$("input[name='otc']").change(function(){
			    if( $(this).is(":checked") ){
			    	var val = $(this).val();
			      	if (val=='tr1') {
			        	$('#hide1').show();
			        	$('#hide2').hide();
			        	$('#hide3').hide();
			        	$('#hide4').hide();
			        	$('#hide5').hide();
			      	}
			      	if (val=='tr2') {
			        	$('#hide1').hide();
			        	$('#hide2').show();
			        	$('#hide3').hide();
			        	$('#hide4').hide();
			        	$('#hide5').hide();
			     	}
			      	if (val=='tr3') {
			        	$('#hide1').hide();
			        	$('#hide2').hide();
			        	$('#hide3').show();
			        	$('#hide4').hide();
			        	$('#hide5').hide();
			     	}
			      	if (val=='tr4') {
			        	$('#hide1').hide();
			        	$('#hide2').hide();
			        	$('#hide3').hide();
			        	$('#hide4').show();
			        	$('#hide5').hide();
			      	}
			      	if (val=='tr5') {
			        	$('#hide1').hide();
			        	$('#hide2').hide();
			        	$('#hide3').hide();
			        	$('#hide4').hide();
			        	$('#hide5').show();
			      	}
			    }
			});
			$("input[name='termin']").change(function(){
			    if( $(this).is(":checked") ){
			      	var val = $(this).val();
			      	if (val=='tr1') {
			        	$('#hide6').show();
			        	$('#hide7').hide();
			        	$('#hide8').hide();
			        	$('#hide9').hide();
			        	$('#hide10').hide();
			      	}
			      	if (val=='tr2') {
			        	$('#hide6').hide();
			        	$('#hide7').show();
			        	$('#hide8').hide();
			        	$('#hide9').hide();
			        	$('#hide10').hide();
			      	}
			      	if (val=='tr3') {
				        $('#hide6').hide();
				        $('#hide7').hide();
				        $('#hide8').show();
				        $('#hide9').hide();
				        $('#hide10').hide();
			      	}
			      	if (val=='tr4') {
				        $('#hide6').hide();
				        $('#hide7').hide();
				        $('#hide8').hide();
				        $('#hide9').show();
				        $('#hide10').hide();
			      	}
			      	if (val=='tr5') {
				        $('#hide6').hide();
				        $('#hide7').hide();
				        $('#hide8').hide();
				        $('#hide9').hide();
				        $('#hide10').show();
			      	}
			    }
			});
			
			var tgl=new Date();
      		var hari=tgl.getDate()
      		var bulan=tgl.getMonth()+1
      		var bl = bulan.toString()
      		var tahun=tgl.getFullYear()
      		var tglSekarang= bl.length;
      		if (tglSekarang>1) {
        		$('#month').val(tahun+''+bulan);
      		}else {
        		$('#month').val(tahun+'0'+bulan);
     		}

     		if ($('input[name="otc"]:checked').val()=='tr1') {
     			$('#hide1').show();
     		}else if ($('input[name="otc"]:checked').val()=='tr2') {
     			$('#hide2').show();
     		}else if ($('input[name="otc"]:checked').val()=='tr3') {
     			$('#hide3').show();
     		}else if ($('input[name="otc"]:checked').val()=='tr4') {
     			$('#hide4').show();
     		}else if ($('input[name="otc"]:checked').val()=='tr5') {
     			$('#hide5').show();
     		}

     		if ($('input[name="termin"]:checked').val()=='tr1') {
     			$('#hide6').show();
     		}else if ($('input[name="termin"]:checked').val()=='tr2') {
     			$('#hide7').show();
     		}else if ($('input[name="termin"]:checked').val()=='tr3') {
     			$('#hide8').show();
     		}else if ($('input[name="termin"]:checked').val()=='tr4') {
     			$('#hide9').show();
     		}else if ($('input[name="termin"]:checked').val()=='tr5') {
     			$('#hide10').show();
     		}
    </script>
    <script type="text/javascript">
    	@if($msg = Session::get('sukses'))
            toastr.success('<?php echo $msg; ?>','Sukses',toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "3000",
                "extendedTimeOut" : "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            })
            @php
                Session::forget('sukses');
            @endphp
        @endif
        @if($msg = Session::get('warning'))
            toastr.warning('<?php echo $msg; ?>','Warning',{timeOut:5000})
        @php
            Session::forget('warning');
        @endphp
        @endif
    </script>

</body> 
</html>