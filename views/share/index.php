<?php

use yii\helpers\Url;
use humhub\models\Setting;
use yii\bootstrap\ActiveForm;
use humhub\widgets\LoaderWidget;
?>
<style>

#gif-output{
	overflow-y: scroll;
	height: 250px;
}

#gif-output img{
	width: 130px;
    padding: 5px;
    height: 150px;
}

#searching{
	width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
	margin-bottom: 10px;
}
</style>
<script>

// callback for the top 8 GIFs of search
function tenorCallback_search(data) {
  // parse the json response
  let gifSize = "<?php print Setting::Get('gifSetting', 'gifs');?>";
  const gifs = data.results.map(r=>{
    let nanogif=r.media_formats.nanogif;
    return `<button type='button' class='close' data-dismiss='modal' aria-hidden='false' style='opacity: 1'><img src='${nanogif.url}' width='${nanogif.dims[0]}'></button>`
}).join("");
  $("#gif-output").html(gifs);
}


// function to call the trending and category endpoints
function grab_data() {
  // set the apikey and limit
  let apikey = "<?php print Setting::Get('client', 'gifs');?>";
  //Maximum lmt of 50
  let lmt = 40;

  // test search ter
  let searching = $(this).val();
  console.log(searching);

  let gifSearch = searching,
    search_url = "https://tenor.googleapis.com/v2/search?q=" + gifSearch + "&key=" + apikey + "&limit=" + lmt;
  console.log("gifSearch", gifSearch, search_url)
  $.getJSON(search_url, tenorCallback_search);

}
  $('#gif-output').click(function(e) {
    let img = new Image;
    img.src = e.target.src;
    currentCommentContainer.find('.field-comment-message .humhub-ui-richtext').append(img);
  });


$("#searching").on('keyup', grab_data);


</script>

<div class="modal-dialog modal-dialog-small animated fadeIn">

  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title" id="myModalLabel"><?= \Yii::t('GifsModule.base', 'Select a GIF'); ?></h4>
    </div>
    <div class="modal-body">
      <?php
  	if (!Setting::Get('client', 'gifs') || !Setting::Get('gifSetting', 'gifs')) {
 ?>
      <p>Please ensure both API client and GIFs settings are completed within administration section</p>
      <?php
	} else {
?>
      <div class="tab-pane">
		 <input type ="text" id="searching" placeholder="Search Tenor">
		<div class="panel panel-default clearfix">
			<div id="gif-output">
			</div>
		</div>

        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">
            <?= \Yii::t('GifsModule.base', 'Close'); ?>
          </button>
        
        </div>
      </div>
      <?php } ?>
      <?= LoaderWidget::widget(['id' => 'invite-loader', 'cssClass' => 'loader-modal hidden']); ?>
    </div>

  </div>

</div>
