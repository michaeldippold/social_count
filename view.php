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
       <?php if ($counts->twitter_check($bID) == 1) {include('inc.twitter.php');} ?> 
       <?php if ($counts->pinterest_check($bID) == 1) {include('inc.pinterest.php');} ?> 
       <?php if ($counts->facebook_check($bID) == 1) {include('inc.facebook.php');} ?> 
       <?php if ($counts->google_check($bID) == 1) {include('inc.googleplus.php');} ?> 
  </ul>
<div class="count-wrap">
  <p class="total">
    <?php 

      $page = Page::getCurrentPage();  
      $total_shares = 0; 

        if ($counts->twitter_check($bID) == 1) {
          $total_shares += $counts->getTweetCount($page->getCollectionID());
        } 
        if ($counts->pinterest_check($bID) == 1) {
          $total_shares +=$counts->getPins($page->getCollectionID());
        } 
        if ($counts->facebook_check($bID) == 1) {
          $total_shares +=$counts->getLikeCount($page->getCollectionID());
        } 
        if ($counts->google_check($bID) == 1) {
          $total_shares += $counts->getPlusOnes($page->getCollectionID());
        } 

      echo ($total_shares);
    ?>
  </p>
  <p class="shares">
    shares
  </p>
</div>
</div>



