<!-- Footer -->
</div>
</div>
<footer class="w3-container w3-theme-d3 w3-padding-16">
  <h5>ColayGram <?=date('Y')?></h5>
</footer>

<footer class="w3-container w3-theme-d5">
  <p>Powered by <a href="http://fb.com/dion.aryapamungkas" target="_blank">Dion Arya Pamungkas</a></p>
</footer>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.uploadPreview.min.js"></script>
<script>
$('.load_more').on("click",function() {
  //buat variabel id_terakhir dari id milik load_more
  var id_terakhir = $(this).attr("id");
  //Jika id_terakhir tidak sama dengan end
  if(id_terakhir!='end'){
    //lakukan request ajax
    $.ajax({
      type: "POST",
      url: "ajax/tampil_post.php",
    //proses ke file php
    data: "idakhir="+ id_terakhir,
    beforeSend: function() {
       $('a.load_more').append('<img src="https://www.codepolitan.com/uploads/image/source/20915/facebook_style_loader.gif" />');
     },
        success: function(html){
          $(".w3-card-4").remove();
        //hilangkan div dengan class name
        $("div#status_nya").append(html);
        //memberikan respon ke
      }
    });
  }
  return false;
});


function komen(isi_komen, id_status, id_user, munculinnya){
  var isi_komentar = $('#'+isi_komen).val().trim();
  console.log(isi_komentar);
  if(isi_komentar == ""){
    alert("Komentar Tidak Boleh Kosong");
  }else{
  $.ajax({
    method : "POST",
    url : "ajax/komentar.php",
    data : {isi_komen:isi_komentar, id_user:id_user, id_status:id_status},
    success: function(data){
      $('#'+isi_komen).val("");
      $('#'+munculinnya).append(data);
    },
    error: function(){

    }
  });
}
}

$(document).ready(function(e){
  $.uploadPreview({
    input_field: "#image-upload",
    preview_box: "#image-preview",
    label_field: "#image-label"
  });

  $('#form').on('submit', function(e){
    if ($('#isi').val().trim() == '' && $('#image-upload').val().trim() == ''){
      alert('Status Atau Foto Anda Tidak Boleh Kosong');
    }else{
    e.preventDefault();
    $.ajax({
      url: "ajax/status.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function(data){
        $('#status_nya').prepend(data);
        $('#isi').val('');
        $('#image-upload').val('');
        alert("Selamat Status Kamu Sudah Di update");
      },
      error: function(){
        alert("Ada Kesalahan");
      }
    });
  }
  });
});

</script>
<script>
// Accordion
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else {
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className =
        x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

</body>
</html>
