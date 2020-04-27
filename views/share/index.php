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
</style>
<script>

function httpGetAsync(theUrl, callback) {
  // create the request object
  let xmlHttp = new XMLHttpRequest();

  // set the state change callback to capture when the response comes in
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      callback(xmlHttp.responseText);
    }
  }

  // open as a GET call, pass in the url and set async = True
  xmlHttp.open("GET", theUrl, true);

  // call send with no params as they were passed in on the url string
  xmlHttp.send(null);

  return;
}

// callback for the top 8 GIFs of search
function tenorCallback_search(responsetext) {
  // parse the json response
  const gifs = JSON.parse(responsetext).results.map(r => {
    const nanogif = r.media[0].nanogif
    return ` <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="opacity: 1 !important;"><img src="${nanogif.url}" width="${nanogif.dims[0]}" x-height="${nanogif.dims[0]}"></button>`;
    console.log(nanogif);
  }).join("");
  document.getElementById("gif-output").innerHTML = gifs;
}


// function to call the trending and category endpoints
function grab_data() {
  // set the apikey and limit
  let apikey = "<?php print Setting::Get('client', 'gifs');?>";
  let lmt = 50;

  // test search ter
  let searching = document.querySelector('#searching')

  searching.oninput = function(evt) {
    let gifSearch = searching.value,
    search_url = "https://api.tenor.com/v1/search?q=" + gifSearch + "&key=" + apikey + "&limit=" + lmt;
    httpGetAsync(search_url, tenorCallback_search);

  };

	document.getElementById('gif-output').onclick = function(e){
		let img = new Image;
		img.src = e.target.src;
		currentCommentContainer.find('.comment-create-input-group .humhub-ui-richtext').append(img);
	}
}

  var input = document.getElementById('searching');
  input.addEventListener('input', grab_data);


</script>

<div class="modal-dialog modal-dialog-small animated fadeIn">

  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title" id="myModalLabel"><?= \Yii::t('GifsModule.base', 'Select a GIF'); ?></h4>
    </div>
    <div class="modal-body">
      <?php
  	if (!Setting::Get('client', 'gifs')) {
 ?>
      <p>Please set your API client slot in administration</p>
      <?php
	} else {
?>
      <div class="tab-pane">
        <?php $form = ActiveForm::begin(); ?>
		 <?= $form->field($model, 'space')->textInput(['id' => 'searching', 'placeholder' => \Yii::t('GifsModule.base', 'Search Tenor')])->label(false); ?>
		<div class="panel panel-default clearfix">
			<div id="gif-output">
			</div>
		</div>

        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">
            <?= \Yii::t('GifsModule.base', 'Close'); ?>
          </button>
          <?php ActiveForm::end(); ?>
        </div>
      </div>
      <?php } ?>
      <?= LoaderWidget::widget(['id' => 'invite-loader', 'cssClass' => 'loader-modal hidden']); ?>
    </div>

  </div>

</div>
