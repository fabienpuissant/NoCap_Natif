function vote(value, id, $vote) {
  $.post('like.php', {
    ref_id : id,
    user_id : $vote.data('user_id'),
    vote : value
  }).done(function(data, textStatus, jqXHR){
    var find_like = '.like_count[data-ref_id='+id+']';
    var find_dislike = '.dislike_count[data-ref_id='+id+']';

    $(find_dislike).text(data.dislike_count);
    $(find_like).text(data.like_count);
    var select = '.vote[data-ref_id='+id+']';
    $(select).removeClass('is-liked is-disliked');

    if(data.success){
      if(value == 1){
        var image = '.vote[data-ref_id='+id+'] img';
        $(image).fadeOut('fast', function(){
          $(this).attr('src', 'img/coeurliked.png');
          $(this).fadeIn('fast');
        });

        $(select).addClass('is-liked');
      } else {

        //$(select).addClass('is-disliked');
      }
    } else {
      $(select).addClass('is-disliked');
      var image = '.vote[data-ref_id='+id+'] img';
      $(image).fadeOut('fast', function(){
        $(this).attr('src', 'img/coeur.png');
        $(this).fadeIn('fast');
      });

    }

    var ratio = Math.round(100 * (data.like_count / (parseInt(data.dislike_count) + parseInt(data.like_count))));
    var select_bar = '.vote_progress[data-ref_id='+id+']';
    $(select_bar).animate({'width': ratio + '%'}, 500);


  }).fail(function(jqXHR, textStatus, errorThrown){
    console.log(jqXHR);
  });
}

$(document).ready(function(){
  var $vote = $('.vote');

  $('body').on("click",".vote_like",function(e){
    e.preventDefault();
    if ($(this).data('user_connected') == 0){
        alert('Veuillez vous connecter pour voter');
    }
    var id = $(this).data('ref_id');
    vote(1, id, $vote);
  });

  $('.vote_dislike', $vote).on('click', function(){
    e.preventDefault();
    if ($(this).data('user_connected') == 0){
        alert('Veuillez vous connecter pour voter');
    }
    var id = $(this).data('ref_id');
    vote(0, id);
  });

  function display_images(debut, fin, retun_img_nb){
    var ip = $('#ip_content').val();
    var connected = $("#connected_content").val();
    if(ip != ""){
      var all_img_encode;
      var all_img;
      $.post("get_all_photos.php" ,function(data){
        all_img_encode = data;
        all_img = jQuery.parseJSON(all_img_encode);
        var i = debut;
        for(i = debut; i < fin; i++){
          value = all_img[i];
          $.post("test_data.php", {
              id: value,
              connected: connected,
              ip: ip
          } ,function(data){
            $("#conteneur_photo").append(data);

          });
        }
      });
    } else {
      $("#conteneur_photo").append("<div class='alert alert-danger'>Vous n'êtes pas connecté</div><div class='upload-btn-wrapper'><button class='btn'>Se Connecter</button><input type='file' accept='image/*' capture='camera' /></div>");
    }
  }


    var nb_img_diplayed_at_the_same_time = 6;
    var ip = $('#ip_content').val();
    var connected = $("#connected_content").val();
    if(ip != ""){
      var all_img_encode;
      var all_img;
      $.post("get_all_photos.php", function(data){
        all_img_encode = data;
        all_img = jQuery.parseJSON(all_img_encode);
        var nb_imgs = all_img.length;
        var compt = nb_img_diplayed_at_the_same_time;
        if(nb_imgs > 0){
          if(nb_imgs < nb_img_diplayed_at_the_same_time){
            display_images(0, nb_imgs);

          } else {
            display_images(1, nb_img_diplayed_at_the_same_time + 1);

            $(window).on("scroll", function() {
          	var scrollHeight = $(document).height();
          	var scrollPosition = $(window).height() + $(window).scrollTop();
          	if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
              if(compt + nb_img_diplayed_at_the_same_time <= nb_imgs){
          	    display_images(compt + 1, compt + nb_img_diplayed_at_the_same_time + 1);
                compt += nb_img_diplayed_at_the_same_time;
              } else  {
                var img_restante = nb_imgs - compt;
                  if(compt != nb_imgs){
                    display_images(compt + 1, compt + img_restante);
                    compt += img_restante
                  }
              }
          	}
          });
      }
    }
    });
  }
});
