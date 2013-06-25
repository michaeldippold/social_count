<?php defined('C5_EXECUTE') or die(_("Access Denied.")) ?>
<?php 

//  THIS IS WHERE YOU CAN EDIT THE STUFF YOU SEE IN THE BLOCK ON THE PAGE (right??)
//echo ("<h1>");
//echo $content;
//echo ("</h1>");


?>

<?php $counts = new SocialCountBlockController; global $c; ?>

<div class="share-widget">
  <span class="shame">Share this post:</span>
  <ul class="options">
      <li>
          <div class="count">
           <?php echo $counts->getTweetCount(); ?>
          </div>
          <a <?php echo "href=\"https://twitter.com/intent/tweet?url={$counts->getCurrentUrl()}&via=itsahappymedium&text={$c->getCollectionName()}\"" ?> class="icon-twitter" onclick="javascript:window.open(this.href,
'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
      </li>
      <li>
          <div class="count">
            <?php echo $counts->getPins(); ?>
          </div>
          <a href="javascript:void((function(){var e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)})());" class="pin-it-button icon-pinterest" count-layout="horizontal"></a>
      </li>
      <li>
          <div class="count">
            <?php echo $counts->getLikeCount(); ?>
          </div>
          <a <?php echo "href=\"http://www.facebook.com/sharer.php?u={$counts->getCurrentUrl()}\"" ?> class="icon-facebook" onclick="javascript:window.open(this.href,
'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
      </li>
      <li>
          <div class="count">
            <?php echo $counts->getPlusOnes(); ?>
          </div>
          <a <?php echo "href=\"https://plus.google.com/share?url={$counts->getCurrentUrl()}\"" ?> class="icon-google-plus" onclick="javascript:window.open(this.href,
'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
      </li>
  </ul>
<div class="count-wrap">
  <p class="total">
    <?php echo $counts->total_all_counts(); ?>
  </p>
  <p class="shares">
    shares
  </p>
</div>
</div>