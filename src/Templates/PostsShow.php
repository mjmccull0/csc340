<div id="slides" class="fullscreen">
  <div class="slide-container">
    <?php foreach ($this->data as $index => $data) { ?>
      <div class="slide<?php if($index == 0) { echo ' active'; } ?>" style="background: url(<?php echo $data->getImgUrl(); ?>) no-repeat center center fixed; background-size: cover;">
        <span class="title" ><?php echo $data->getTitle(); ?></span>
      </div>
    <?php } ?>
  </div>
</div>

<script>
let slides = document.querySelectorAll('#slides .slide');
let index = 0;
let slideInterval = setInterval(nextSlide,11000);

function nextSlide() {
    slides[index].className = slides[index].className.replace(/active/i, '');
    index = (index+1) % slides.length;
    slides[index].className = slides[index].className + ' active';
}
</script>
